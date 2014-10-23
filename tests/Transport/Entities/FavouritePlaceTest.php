<?php

namespace Base\Transport\Entities;

use Base\Geospatial\Geolocation;
use Symfony\Component\Validator\ConstraintValidatorFactory;
use Symfony\Component\Validator\DefaultTranslator;
use Symfony\Component\Validator\Mapping\ClassMetadataFactory;
use Symfony\Component\Validator\Mapping\Loader\YamlFileLoader;
use Symfony\Component\Validator\Validator;

class FavouritePlaceTest extends \PHPUnit_Framework_TestCase
{
    private $validator;

    public function setUp()
    {
        $this->validator = new Validator(
            new ClassMetadataFactory(new YamlFileLoader(__DIR__ . '/../../../resources/validation.yml')),
            new ConstraintValidatorFactory(),
            new DefaultTranslator(),
            'validators',
            []
        );
    }

    public function testNewInstance()
    {
        $favouritePlace = new FavouritePlace();

        $this->assertFalse($favouritePlace->isPermanent());
    }

    public function testAccessors()
    {
        $favouritePlace = new FavouritePlace();
        $favouritePlace->setId('12345');
        $favouritePlace->setLabel('Home');
        $favouritePlace->setGeolocation(new Geolocation(52.9549135, -1.1582327));
        $favouritePlace->setStops(['3390Y4', '3390Y3']);
        $favouritePlace->setPermanent(true);

        $this->assertEquals('12345', $favouritePlace->getId());
        $this->assertEquals('Home', $favouritePlace->getLabel());
        $this->assertInstanceOf('Base\\Geospatial\\Geolocation', $favouritePlace->getGeolocation());
        $this->assertEquals(['3390Y4', '3390Y3'], $favouritePlace->getStops());
        $this->assertTrue($favouritePlace->isPermanent());
    }

    public function testIsLikeLabel()
    {
        $favouritePlace = new FavouritePlace();
        $favouritePlace->setLabel('Home');

        $this->assertTrue($favouritePlace->isLikeLabel('Home'));
        $this->assertTrue($favouritePlace->isLikeLabel('home'));
        $this->assertFalse($favouritePlace->isLikeLabel('Work'));
    }

    public function testValidation()
    {
        $favouritePlace = new FavouritePlace();
        $this->assertEquals(1, $this->validator->validate($favouritePlace, 'create')->count());

        $favouritePlace = new FavouritePlace();
        $favouritePlace->setId('fp-' . uniqid());
        $this->assertEquals(0, $this->validator->validate($favouritePlace, 'create')->count());

        $favouritePlace = new FavouritePlace();
        $favouritePlace->setId('fp-' . uniqid());
        $this->assertEquals(2, $this->validator->validate($favouritePlace, 'update')->count());

        $favouritePlace = new FavouritePlace();
        $favouritePlace->setId('fp-' . uniqid());
        $favouritePlace->setLabel(['Work']);
        $favouritePlace->setLocation('City Centre');
        $this->assertEquals(0, $this->validator->validate($favouritePlace, 'update')->count());
    }
}
