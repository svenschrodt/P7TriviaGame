<?php
/**
 * Class for generation of error messages
 *
 * @package P7TriviaGame
 * @author  Sven Schrodt <sven@schrodt-service.net>
 * @version 0.1
 * @since 2021-02-06
 * @link https://github.com/svenschrodt/P7TriviaGame
 * @license https://github.com/svenschrodt/P7TriviaGame/blob/master/LICENSE.md
 */

namespace P7TriviaGame\Application;

class Error
{

    const INVALID_RESPONSE_CODE = 'Invalid code given:%s - use one of these: %s';

    const INVALID_PHP_VERSION = 'PHP version needed: %s+ - current version: %s';

    /**
     * Getting formatted (error) message with optional parameters
     *
     * @param string $message
     * @param string $param1
     * @param string $param2
     * @return string
     */
    public static function getMessage(string $message, string $param1 = '', $param2 = ''): string
    {
        if ($param1 === '') {
            return $message;
        } else {
            if ($param2 === '') {
                return sprintf($message, $param1);
            } else {
                return sprintf($message, $param1, $param2);
            }
        }
    }
}