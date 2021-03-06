<?php
/**
 * TestCase - extending PHPUnit's test case for some 'short hand' functions
 *
 * @package P7TriviaGame
 * @author  Sven Schrodt <sven@schrodt-service.net>
 * @version 0.1
 * @since 2021-02-06
 * @link https://github.com/svenschrodt/P7TriviaGame
* @link https://travis-ci.org/github/svenschrodt/P7TriviaGame/
 * @license https://github.com/svenschrodt/P7TriviaGame/blob/master/LICENSE.md
 */

namespace P7TriviaGame\Core;


class TestCase  extends \PHPUnit\Framework\TestCase
{
    public function expectTypeError(string $type='int')
    {
        $this->expectErrorMessageMatches('/ of the type '.$type.'/');
    }

}