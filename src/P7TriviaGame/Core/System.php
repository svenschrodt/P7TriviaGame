<?php
/**
 * Simple class managing system environment
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
* @link https://travis-ci.org/github/svenschrodt/P7TriviaGame/
 * @license https://github.com/svenschrodt/P7TriviaGame/blob/master/LICENSE.md
 */

namespace P7TriviaGame\Core;


use P7TriviaGame\Application\Error;
use phpDocumentor\Reflection\Types\Static_;

class System
{

    const MESSAGE_SYSTEM_REQUIREMENT_OK = 'OK - system requirements  fulfilled';

    const ERROR_SYSTEM_REQUIREMENT_PECL = 'Error - PECL extension %s not found';

    const REQUIRED_PECL_LIB = ['tidy','curl', 'dom', 'PDO'];

    const REQUIRED_PHP_VERSION = '7.4';



    public static array $messages = [];


    /**
     * Checking if system requirements are fulfilled
     *
     * @return bool
     */
    public static function isSystemReady() :bool
    {
        $checked = static::checkSystemRequirements();
        return (count($checked)==1) &&  ( $checked[0] === \P7TriviaGame\Core\System::MESSAGE_SYSTEM_REQUIREMENT_OK);
    }

    /**
     * Processing steps to check, if current requirements are fulfilled
     *
     * @param false $verbose
     * @return string[]
     */
    public static function checkSystemRequirements($verbose = false) : array
    {

        $ready = true;
        // We will fill the array with index start
        $firstIndex = count(static::$messages);

        $needed = static::REQUIRED_PECL_LIB;

        for($i=0;$i<count($needed);$i++) {
           if(!in_array($needed[$i], get_loaded_extensions() )) {
               static::$messages[] = Error::getMessage(static::ERROR_SYSTEM_REQUIREMENT_PECL, $needed[$i]);
               $ready = false;
           }
        }


        if(!(version_compare(phpversion(), static::REQUIRED_PHP_VERSION, '>'))) {
            static::$messages[] = Error::getMessage(Error::INVALID_PHP_VERSION, static::REQUIRED_PHP_VERSION, phpversion());
            $ready = false;
        }



        if($ready) {
            return [static::MESSAGE_SYSTEM_REQUIREMENT_OK];
        } else {
            return array_splice(static::$messages, $firstIndex);
        }

    }

    public static function getCurrentMachineInfo()
    {
        return php_uname();
    }
}