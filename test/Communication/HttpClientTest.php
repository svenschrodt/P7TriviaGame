<?php
/**
 * Unit testing \P7TriviaGame\Communication\HttpClient
 *
 * @package P7TriviaGame
 * @author  Sven Schrodt <sven@schrodt-service.net>
 * @version 0.1
 * @since 2021-02-06
 * @link https://github.com/svenschrodt/P7TriviaGame
 * @link https://travis-ci.org/github/svenschrodt/P7TriviaGame/
 * @license https://github.com/svenschrodt/P7TriviaGame/blob/master/LICENSE.md
 */

use P7TriviaGame\Communication\HttpClient;
use P7TriviaGame\Communication\HttpProtocol;
use P7TriviaGame\Core\TestCase as FfTestCase;

class HttpClientTest extends FfTestCase
{

    public function testInstantiation()
    {

        $c = new HttpClient();
        $this->assertInstanceOf('P7TriviaGame\Communication\HttpClient', $c);
    }
    public function testBasicGet()
    {
        $c = new HttpClient();
        $c->get('https://www.example.org/');
        $sc = $c->getHttpStatus();
        $this->assertIsInt($sc);
        $this->assertEquals(HttpProtocol::STATUS_CODE_OK, $sc);
    }

    public function testForcedFileNotFound()
    {
        $c = new HttpClient();
        $c->get('https://www.example.org/FooBar/89569/23');
        $sc = $c->getHttpStatus();
        $this->assertIsInt($sc);
        $this->assertEquals(HttpProtocol::STATUS_CODE_NOT_FOUND, $sc);
    }



}