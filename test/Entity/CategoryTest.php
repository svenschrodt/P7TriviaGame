<?php

use P7TriviaGame\Entity\Category;
use P7TriviaGame\Core\TestCase as FfTestCase;

class CategoryTest extends FfTestCase
{

    public function testCategoryConstruction()
    {

        $id = 88;
        $name = 'Wolf';
        $apiId = 888;
        $c = new Category($id, $name, $apiId);
        $this->assertTrue($c->getApiId() == $apiId);
        $this->assertTrue($c->getName() == $name);



    }


    public function testTypes()
    {
        $c = new Category('FOO08e9289', 'F==o', 988);

        $this->assertTrue(gettype($c->getApiId()) === 'integer');
        $this->assertTrue(gettype($c->getName()) === 'string');
    }


    public function testTypeErrorInteger()
    {
        $id = 88;
        $name = 'Wolf';
        $c = new Category($name, $id);
        $this->expectTypeError('int');
        $c->setApiId('FOOO');
    }

    public function testTypeErrorString()
    {
        $id = 88;
        $name = 'Wolf';
        $c = new Category($id, $name);
        $this->expectTypeError('string');
        $c->setName(new \stdClass());
    }
}