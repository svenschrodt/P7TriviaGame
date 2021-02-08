<?php
declare(strict_types=1);
/**
 * Class handling http response
 *
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
use P7TriviaGame\Communication\HttpProtocol;

class HttpResponse
{

    protected int $code = HttpProtocol::STATUS_CODE_OK;

    public function __construct()
    {
//        header('Content-Type: text/plain');
//        print_r($_SERVER);
    }

    public function setStatus(string $code)
    {
        $this->code = $code;
    }

    public function finalize()
    {
        http_response_code($this->code);
    }


}