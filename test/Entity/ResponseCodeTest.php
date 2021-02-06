<?php

use P7TriviaGame\Entity\ResponseCode;
use P7TriviaGame\Core\TestCase as FfTestCase;

class ResponseCodeTest extends FfTestCase
{

    public function testResponseCodeArray()
    {
        $this->assertIsArray(ResponseCode::getConstants());
        $this->assertTrue(count(ResponseCode::getConstants()) === 5);

    }


    public function testIfExceptionIsThrown()
    {
        // \InvalidArgumentException
        $this->expectException('\InvalidArgumentException');
        ResponseCode::getMessageByCode(99);
    }


    public function testMessageShortAndVerbose()
    {
        for ($i = 0; $i < 5; $i++) {
            $a = ResponseCode::getMessageByCode($i);
            $b = ResponseCode::getMessageByCode($i, true);
            $this->assertIsString($a);
            $this->assertIsString($b);
            $this->assertTrue(strlen($b) > strlen($a));
        }
    }

}