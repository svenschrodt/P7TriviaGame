<?php

use P7TriviaGame\Entity\Category;
use P7TriviaGame\Core\TestCase as FfTestCase;

class CategoryTest extends FfTestCase
{

    public function testCategoryConstruction()
    {

        $id = 88;
        $name = 'Wolf';
        $c = new Category($id, $name);
        $this->assertTrue($c->getId() == $id);
        $this->assertTrue($c->getName() == $name);



    }


    public function testTypes()
    {
        $c = new Category(23, 'F==o');
        $this->assertTrue(gettype($c->getId()) === 'integer');
        $this->assertTrue(gettype($c->getName()) === 'string');
    }


    public function testTypeErrorInteger()
    {
        $id = 88;
        $name = 'Wolf';
        $c = new Category($id, $name);
        $this->expectTypeError('int');
        $c->setId('FOOO');
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