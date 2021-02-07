<?php
declare(strict_types=1);
/**
 * Class handling routing purposes
 *
 * - redirect(s)
 * - url routing
 *
 * @package P7TriviaGame
 * @author  Sven Schrodt <sven@schrodt-service.net>
 * @version 0.1
 * @since 2021-02-06
 * @link https://github.com/svenschrodt/P7TriviaGame
 * @link https://travis-ci.org/github/svenschrodt/P7TriviaGame/
 * @license https://github.com/svenschrodt/P7TriviaGame/blob/master/LICENSE.md
 */

namespace P7TriviaGame\Communication;


class HttpRouter
{

    const REDIRECTION_FAILS_EXIT_CODE = 2423;

    public function __construct()
    {
//        header('Content-Type: text/plain');
//        print_r($_SERVER);
    }

    public function redirectTo(string $resourceName)
    {
        // @FIXME -> ensure $resourceName's plausibility
        header('Location: ' . $resourceName);
        exit(self::REDIRECTION_FAILS_EXIT_CODE);


    }

}

$f = new HttpRouter();