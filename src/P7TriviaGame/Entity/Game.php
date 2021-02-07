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

use P7TriviaGame\Communication\ApiClient;

class Game
{
    protected array $questionList = [];

    protected ?ApiClient $apiClient = null;

    public function __construct(int $amount = 0, int $category=0)
    {
        $this->apiClient = new ApiClient();

        $this->questionList = $this->apiClient->getQuestions($amount, $category);
    }


}