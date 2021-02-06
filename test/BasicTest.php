<?php declare(strict_types=1);
/**
 * Basic testing of PHPUnit's functionality
 *
 * @author Sven Schrodt<sven@schrodt-service.net>
 * @package P7TriviaGame
 * @copyright Sven Schrodt<sven@schrodt-service.net>
 * @version 0.1
 * @since 2021-02-06
 * @link https://github.com/svenschrodt/P7TriviaGame
 * @license https://github.com/svenschrodt/P7TriviaGame/blob/master/LICENSE.md
 * 
 */

class BasicTest extends \PHPUnit\Framework\TestCase
{
    /**
     * Checking for needed PECL extensions - if it fails, needed extensions MUST be installed
     */
    public function testIfNeededExtensionsAreLoaded()
    {
        $needed = \P7TriviaGame\Core\System::REQUIRED_PECL_LIB;

        for($i=0;$i<count($needed);$i++) {
            $this->assertTrue(in_array($needed[$i], get_loaded_extensions() ));
        }

    }

    /**
     * Checking if PHP version is "young" enough
     */
    public function testIfPhPVersionIsSufficent()
    {
        $this->assertTrue(version_compare(phpversion(), \P7TriviaGame\Core\System::REQUIRED_PHP_VERSION, '>'));
    }




}

