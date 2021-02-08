<?php
declare(strict_types=1);
/**
 * Class representing instance of trivia game
 *
 * @package P7TriviaGame
 * @author  Sven Schrodt <sven@schrodt-service.net>
 * @version 0.1
 * @since 2021-02-06
 * @link https://github.com/svenschrodt/P7TriviaGame
 * @link https://travis-ci.org/github/svenschrodt/P7TriviaGame/
 * @license https://github.com/svenschrodt/P7TriviaGame/blob/master/LICENSE.md
 */

namespace P7TriviaGame\Entity;

use P7TriviaGame\Application\Configuration;
use P7TriviaGame\Communication\ApiClient;
use P7TriviaGame\Application\GameSolver;

class Game
{
    /**
     * List of questions in current game
     *
     * @var Question[]
     */
    protected array $questionList = [];

    /**
     * Instance of API client
     *
     * @var ApiClient|null
     */
    protected ?ApiClient $apiClient = null;

    /**
     * Instance of game solver
     *
     * @var GameSolver|null
     */
    protected ?GameSolver $solver = null;

    /**
     * Game constructor function
     *
     * @param int $amount
     * @param int $category
     */
    public function __construct(int $amount =  Configuration::DEFAULT_QUESTION_AMOUNT, int $category=0)
    {
        $this->apiClient = new ApiClient();
        $this->questionList = $this->apiClient->getQuestions($amount, $category);

    }

    /**
     * @return Question[]
     */
    public function getQuestionList(): array
    {
        return $this->questionList;
    }

    /**
     * @param Question[] $questionList
     * @return Game
     */
    public function setQuestionList(array $questionList): Game
    {
        $this->questionList = $questionList;
        return $this;
    }

    /**
     * @return ApiClient|null
     */
    public function getApiClient(): ?ApiClient
    {
        return $this->apiClient;
    }

    /**
     * @param ApiClient|null $apiClient
     * @return Game
     */
    public function setApiClient(?ApiClient $apiClient): Game
    {
        $this->apiClient = $apiClient;
        return $this;
    }

    /**
     * @return GameSolver|null
     */
    public function getSolver(): ?GameSolver
    {
        return $this->solver;
    }

    /**
     * @param GameSolver|null $solver
     * @return Game
     */
    public function setSolver(?GameSolver $solver): Game
    {
        $this->solver = $solver;
        return $this;
    }




}