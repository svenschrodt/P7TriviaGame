<?php declare(strict_types=1);
/**
 * Auto loading for namespace P7TriviaGame 
 *
 * *
 * @package P7TriviaGame
 * @author  Sven Schrodt <sven@schrodt-service.net>
 * @version 0.1
 * @since 2021-02-06
 * @link https://github.com/svenschrodt/P7TriviaGame
* @link https://travis-ci.org/github/svenschrodt/P7TriviaGame/
 * @license https://github.com/svenschrodt/P7TriviaGame/blob/master/LICENSE.md
 */


/**
 * Constant for application PHP namespace
 *
 * @var string
 */
define('TRIVIA_GAME_NS', 'P7TriviaGame');


/**
 * Constant for path prefix to lib location
 *
 * @var string
 */
define('LIB_PREFIX', 'src/');

spl_autoload_register(function ($className) {

    // Getting parts of (sub) namespaces from URI    
    $parts = explode('\\', $className);

    // Check if namespace of class to be instantiated is belonging to us 
    if (substr($className, 0, strlen(TRIVIA_GAME_NS)) === TRIVIA_GAME_NS) {

        $file = LIB_PREFIX . str_replace('\\', '/', $className) . '.php';

        // Check if destination class file exists   an include it
        if (file_exists($file)) {
            require_once $file;
        } else { // throw exception, if not 
            throw new \Exception('NO SUCH FILE OR DIRECTORY: ' . $className . '.php');
        }
    }


});

