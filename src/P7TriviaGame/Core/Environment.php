<?php
/**
 * Simple class managing usage of environment (dev, stage, test, prod etc.)
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

namespace P7TriviaGame\Core;


class Environment
{
    /**
     * Enabling error reporting
     * For DEV and start: full take;-)
     *
     * @todo use different levels
     *
     */
    public static function enableErrorReporting($level, $display, $startup): void
    {
        ini_set('display_errors', $display);
        ini_set('display_startup_errors', $startup);
        error_reporting($level);
    }

    /**
     * Checking, if data was sent via HTTP POST
     *
     * @return bool
     * @todo use different levels
     */
    public static function isPosted(): bool
    {
        return ($_SERVER['REQUEST_METHOD'] == 'POST' && count($_POST) ? true : false);
    }


}