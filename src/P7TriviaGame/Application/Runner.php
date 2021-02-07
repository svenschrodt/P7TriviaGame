<?php


namespace P7TriviaGame\Application;
use P7TriviaGame\Entity\Game;

class Runner
{

    protected  ?Game $game = null;

    public function __construct(int $amount=0, int $category=0)
    {
        $this->game = new Game($amount, $category);



    }
}