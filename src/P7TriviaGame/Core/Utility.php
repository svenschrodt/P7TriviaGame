<?php


namespace P7TriviaGame\Core;


class Utility
{

    protected static float $start = 0;

    public function startMeasuring()
    {
        self::$start = microtime(true);

    }

    public function stopMeasuring()
    {
        return microtime(true) - self::$start;
    }

}