<?php

declare(strict_types=1);
/**
 * Base Exception class
 *
 * currently the client is working with default settings - configuration will follow
 *
 *
 * @TODO DI-Container 4 cfg
 *
 * @FIXME reacting on http status code !== 200
 *
 * @package P7TriviaGame
 * @author  Sven Schrodt <sven@schrodt-service.net>
 * @version 0.1
 * @since 2021-02-06
 * @link https://github.com/svenschrodt/P7TriviaGame
 * @license https://github.com/svenschrodt/P7TriviaGame/blob/master/LICENSE.md
 */

namespace P7TriviaGame\Communication;


class CommunicationException extends \Exception
{

}