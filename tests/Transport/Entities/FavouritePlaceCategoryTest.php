<?php

namespace Base\Transport\Entities;

class FavouritePlaceCategoryTest extends \PHPUnit_Framework_TestCase
{
    /** @var FavouritePlaceCategory */
    private $category;

    public function setUp()
    {
        $this->category = new FavouritePlaceCategory();
    }

    public function testCategoryIdIsLowercase()
    {
        $this->category->setId('THIS SHOULD BE LOWERCASE');
        $this->assertEquals('this should be lowercase', $this->category->getId());
    }
}
