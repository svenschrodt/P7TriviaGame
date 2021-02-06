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
 * @license https://github.com/svenschrodt/P7TriviaGame/blob/master/LICENSE.md
 */

namespace P7TriviaGame\Communication;


use P7TriviaGame\Application\Configuration;
use P7TriviaGame\Entity\Category;
use P7TriviaGame\Entity\Question;
use P7TriviaGame\Entity\ResponseCode;

class ApiClient
{


    const CATEGORY_ROOT_ELEMENT = 'trivia_categories';

    const QUESTION_ROOT_ELEMENT = 'results';

    const QUESTION_RESPONSE_CODE = 'response_code';


    /**
     * Used HTTP client
     *
     * @var HttpClient
     */
    private HttpClient $httpClient;


    /**
     * Constructor function
     *
     * @TODO injecting DI-Container 4 cfg
     * @throws \ErrorException
     */
    public function __construct()
    {
        $this->httpClient = new HttpClient();

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
    public function getCategories($asArray = false)
    {
        $foo = json_decode($this->getCategoriesRaw(), $asArray);
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
        //@TODO genaral error handling ->network, server booh booh etc.
        if ($response->$responseCodeRoot !== ResponseCode::MSG_SUCCESS) {
            $this->handleNonOkStatus();
        } else {
            return $this->parseQuestion($response->$resultRoot);
        }
    }


    protected function handleNonOkStatus()
    {

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


    public function getToken()
    {
        //FIXME Response code Check!
        $response = $this->httpClient->get(Configuration::TOKEN_API_URI);
        $temp = json_decode($response);
        return $temp->token;
    }
}
