<?php
/**
 * Configuration class for application
 *
 *
 * @package P7TriviaGame
 * @author  Sven Schrodt <sven@schrodt-service.net>
 * @version 0.1
 * @since 2021-02-06
 * @link https://github.com/svenschrodt/P7TriviaGame
 * @link https://travis-ci.org/github/svenschrodt/P7TriviaGame/
 * @license https://github.com/svenschrodt/P7TriviaGame/blob/master/LICENSE.md
 */

namespace P7TriviaGame\Application;

class Configuration
{
    const APPLICATION_NAME = 'P7 Trivia Game';

    const APPLICATION_VERSION = '0.1';

    const APPLICATION_THEME_MIDFIX  = '/Application/Theme/';

    const BASE_API_URI = 'https://opentdb.com/';

    const QUESTION_URI = self::BASE_API_URI . 'api.php?amount=';

    const CATEGORY_URI_SUFFIX = '&category=';

    const CATEGORY_API_URI = self::BASE_API_URI . 'api_category.php';

    const TOKEN_API_URI = self::BASE_API_URI . 'api_token.php?command=request';

    const DEFAULT_QUESTION_AMOUNT = 8; // 2^3 ;-)

    const MESSAGE_SESSION_STATS_PLAYED = 'In the current session you played %s time%s';

    const MESSAGE_SESSION_STATS_AVERAGE = 'In the current session your average is: %d %% correct answers';

    const FILE_CACHE_DIRECTORY = 'tmp/';

    const APPLICATION_PATH_SUFFIX = 'Application';


    const APPLICATION_CACHE_PATH_SUFFIX = '/Application/Cache/';

    /**
     * Containing current base path of application
     *
     * @var string|false
     */
    protected string $basePath = '';

    /**
     * Containing name of current theme
     *
     * @deprecated
     * @var string
     */
    protected string $themeName = '';

    /**
     * Containing name of current theme
     *
     *
     * @var string
     */
    protected string $currentTheme = 'default';



    /**
     * @return string
     */
    public function getCurrentTheme(): string
    {
        return $this->currentTheme;
    }

    /**
     *
     *
     * @param string $currentTheme
     */
    public function setCurrentTheme(string $currentTheme): void
    {
        $this->currentTheme = $currentTheme;
    }

    /**
     * @return false|string
     */
    public function getBasePath()
    {
        return $this->basePath;
    }

    /**
     * @param false|string $basePath
     */
    public function setBasePath($basePath): void
    {
        $this->basePath = $basePath;
    }

    /**
     * @return string
     */
    public function getThemeName(): string
    {
        return $this->themeName;
    }

    /**
     * @param string $themeName
     */
    public function setThemeName(string $themeName): void
    {
        $this->themeName = $themeName;
    }


    public function getNamedPath(string $name) : string
    {
        switch ($name) {
            case self::APPLICATION_CACHE_PATH_SUFFIX:
                return $this->basePath . self::APPLICATION_CACHE_PATH_SUFFIX;
                break;
        }
    }



    public function __construct()
    {
        $this->basePath = realpath(dirname(dirname(__FILE__)));
    }

    public function getTemplatePath()
    {


        return $this->basePath . self::APPLICATION_THEME_MIDFIX . $this->currentTheme .'/';
    }
    //

}