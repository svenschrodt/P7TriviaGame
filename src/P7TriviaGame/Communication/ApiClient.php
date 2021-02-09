<?php
declare(strict_types=1);
/**
 * Client to retrieve data from open trivia db APi on a higher level - abstracted from HTTP
 *
 * @TODO DI-Container 4 cfg
 *
 * @package P7TriviaGame
 * @author  Sven Schrodt <sven@schrodt-service.net>
 * @version 0.1
 * @since 2021-02-06
 * @link https://github.com/svenschrodt/P7TriviaGame
* @link https://travis-ci.org/github/svenschrodt/P7TriviaGame/
 * @license https://github.com/svenschrodt/P7TriviaGame/blob/master/LICENSE.md
 */

namespace P7TriviaGame\Communication;


use P7TriviaGame\Application\Configuration;
use P7TriviaGame\Entity\Category;
use P7TriviaGame\Entity\Question;
use P7TriviaGame\Entity\ResponseCode;
use P7TriviaGame\Application\Error;

class ApiClient
{


    const CATEGORY_ROOT_ELEMENT = 'trivia_categories';

    const QUESTION_ROOT_ELEMENT = 'results';

    const QUESTION_RESPONSE_CODE = 'response_code';

    const API_TOKEN_CHARACTERS = 64;

    const ERROR_API_TOKEN_CHARACTERS =  'Invalid token format: %s - use API to retrieve one!';

    const MAX_QUESTIONS_PER_REQUEST = 50;


    /**
     * Used HTTP client
     *
     * @var HttpClient
     */
    private HttpClient $httpClient;

    /**
     * Current token from API (used to avoid duplicates for six hours)
     *
     * @var string|null
     */
    private ?string $token = null;

    private bool $useToken = true;

    /**
     * @return bool
     */
    public function isUseToken(): bool
    {
        return $this->useToken;
    }

    /**
     * @param bool $useToken
     * @return ApiClient
     */
    public function setUseToken(bool $useToken): ApiClient
    {
        $this->useToken = $useToken;
        return $this;
    }
    /**
     * Constructor function
     *
     * @TODO injecting DI-Container 4 cfg
     * @throws \ErrorException
     */
    public function __construct(string $tokenToBeused = '')
    {
        if(!$tokenToBeused === '') {
            $this->setToken($tokenToBeused);
        }
        $this->httpClient = new HttpClient();

    }

    /**
     * @deprecated -> use Factory
     * @return HttpClient
     */
    public function getHttpClient(): HttpClient
    {
        return $this->httpClient;
    }

    /**
     * @deprecated -> makes no sense here
     * @param HttpClient $httpClient
     * @return ApiClient
     */
    public function setHttpClient(HttpClient $httpClient): ApiClient
    {
        $this->httpClient = $httpClient;
        return $this;
    }

    /**
     * Returning category list as JSON
     *
     * @param bool $asJson
     */
    public function getCategoriesRaw(): string
    {
        return $this->httpClient->get(Configuration::CATEGORY_API_URI);
    }

    /**
     * Getting list of categories as parsed PHP data structure:
     *
     * - P7TriviaGame\Entity\Category[] ||
     * - array
     *
     * @param false $asArray
     * @return array|mixed
     */
    public function getCategories()
    {
        $foo = json_decode($this->getCategoriesRaw());
        if ($asArray) {
            return $foo[self::CATEGORY_ROOT_ELEMENT];
        } else {
            $ret = [];
            $rootName = self::CATEGORY_ROOT_ELEMENT;
            foreach ($foo->$rootName as $item) {
                $ret[] = new Category($item->id, $item->name);
            }
            return $ret;
        }

    }

    public function getQuestions($amount = Configuration::DEFAULT_QUESTION_AMOUNT, int $categoryId = 0)
    {

        $response = json_decode($this->getQuestionsRaw($amount, $categoryId));

        $responseCodeRoot = self::QUESTION_RESPONSE_CODE;
        $resultRoot = self::QUESTION_ROOT_ELEMENT;
        //@TODO general error handling ->network, server booh booh etc.
        if ($response->$responseCodeRoot !== ResponseCode::MSG_SUCCESS) {
            $this->handleNonOkStatus($response->$responseCodeRoot);
        } else {
            return $this->parseQuestion($response->$resultRoot);
        }
    }


    protected function handleNonOkStatus(string $responseCode )
    {
            //@TODO decide wether to catch from (file) cache or whatsoever
        throw new Exception('API raised Response code: ' . $responseCode);
    }

    /**
     * @param int $amount
     * @param int $categoryId
     * @param string $type
     * @return string
     */
    public function getQuestionsRaw(int $amount, int $categoryId = 0): string
    {
        $uri = Configuration::QUESTION_URI . $amount;
        if ($categoryId !== 0) {
            $uri .= Configuration::CATEGORY_URI_SUFFIX . $categoryId;
        }

        if($this->useToken && is_null($this->getToken())) {
            $this->setToken($this->getTokenFromApi());
        }

        if($this->useToken) {
            $uri .= '&token=' . $this->getToken();
        }
        die($uri);
        return $this->httpClient->get($uri);
    }


    /**
     * Parsing to Question[]
     *
     * @param array $questions
     * @return array
     */
    public function parseQuestion(array $questions): array
    {
        //@FIXME -> refactor me in separate class with defined attributes as class constants
        // and replace [] with instance of P7TriviaGame\Entity\QuestionList
        $parsed = [];
        foreach ($questions as $question) {
            $new = new Question();
            $new->setCategoryName($question->category);
            $new->setType($question->type);
            $new->setDifficultyLevel($question->difficulty);
            $new->setText($question->question);
            $new->setCorrectAnswer($question->correct_answer);
            $new->setWrongAnswers($question->incorrect_answers);
            $parsed[] = $new;
        }
        return $parsed;


    }

    /**
     * @return string|null
     */
    public function getToken(): ?string
    {
        return $this->token;
    }

    /**
     * @param string|null $token
     * @return ApiClient
     */
    public function setToken(?string $token): ApiClient
    {
        if(strlen($token)!= 64) {
            throw new \InvalidArgumentException(Error::getMessage(self::ERROR_API_TOKEN_CHARACTERS, $token ) );
        }
        $this->token = $token;
        return $this;
    }


    public function getTokenFromApi()
    {
        //FIXME Response code Check!
        $response = $this->httpClient->get(Configuration::TOKEN_API_URI);
        $temp = json_decode($response);
        return $temp->token;
    }
}
