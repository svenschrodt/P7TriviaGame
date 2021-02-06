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
 * @license https://github.com/svenschrodt/P7TriviaGame/blob/master/LICENSE.md
 */

namespace P7TriviaGame\Application;

class Configuration
{

    const BASE_API_URI = 'https://opentdb.com/';

    const QUESTION_URI = self::BASE_API_URI .  'api.php?amount=';

    const CATEGORY_URI_SUFFIX = '&category=';

    const CATEGORY_API_URI = self::BASE_API_URI .  'api_category.php';

    const TOKEN_API_URI = self::BASE_API_URI .  'api_token.php?command=request';

    const DEFAULT_QUESTION_AMOUNT = 8; // 2^3 ;-)

    const MESSAGE_SESSION_STATS_PLAYED = 'In the current session you played %s time%s';

    const MESSAGE_SESSION_STATS_AVERAGE = 'In the current session your average is: %d %% correct answers';

    const FILE_CACHE_DIRECTORY = 'tmp/';

    const APPLICATION_THEME = 'default';

    //

}