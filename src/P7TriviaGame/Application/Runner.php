<?php


namespace P7TriviaGame\Application;
use P7TriviaGame\Entity\Game;

class Runner
{

    protected  ?Game $game = null;

    /**
     * Available APIs
     *
     * - direct communication to external API via https ||
     *    - using cached data from file system ||
     *                           - data base
     *
     * @var array
     */
    const AVAILABLE_API = ['external', 'file_cache', 'db_cache'];

    public function __construct(int $amount=0, int $category=0)
    {
        $this->game = new Game($amount, $category);



    }
}