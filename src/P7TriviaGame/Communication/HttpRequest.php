<?php
declare(strict_types=1);
/**
 * Class handling http request
 *
 * @package P7TriviaGame
 * @author  Sven Schrodt <sven@schrodt-service.net>
 * @version 0.1
 * @since 2021-02-07
 * @link https://github.com/svenschrodt/P7TriviaGame
 * @link https://travis-ci.org/github/svenschrodt/P7TriviaGame/
 * @license https://github.com/svenschrodt/P7TriviaGame/blob/master/LICENSE.md
 */

namespace P7TriviaGame\Communication;


class HttpRequest
{


    public function __construct()
    {

    }

    public function getAction()
    {
        $tmp = $this->getGet('action') ?? '';
        return strtolower($tmp);
    }

    public function getGet(string $key = '')
    {
        if ($key === '') {
            return $_GET;
        } else {
            return $_GET[$key] ?? null;
        }
    }

    public function getPost(string $key = '')
    {
        if ($key === '') {
            return $_POST;
        } else {
            return $_POST[$key] ?? null;
        }
    }
}