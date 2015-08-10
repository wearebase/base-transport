<?php

namespace Base\Transport\Entities\Extensions;

use Base\Geospatial\Geolocation;
use Base\Geospatial\Normalizers\GeospatialNormalizer;
use Base\Transport\Entities\AtcoCode;
use Base\Transport\Entities\FavouritePlace;
use Base\Transport\Normalizers\TransportNormalizer;

class FavouritePlacesTest extends \PHPUnit_Framework_TestCase
{
    protected $extension;
    protected $serializer;

    public function setUp()
    {
        $this->extension = new FavouritePlaces();
        $this->serializer = new \Symfony\Component\Serializer\Serializer([
            new TransportNormalizer(),
            new GeospatialNormalizer(),
        ]);
    }

    public function testKey()
    {
        $this->assertInternalType('string', $this->extension->getKey());
    }

    public function testNormalization()
    {
        $favouritePlace = new FavouritePlace();
        $favouritePlace->setLabel('City Centre');
        $favouritePlace->setLocation('NG1 5AW');
        $favouritePlace->setGeolocation(new Geolocation(52.9549135, -1.1582327));
        $favouritePlace->setStops([
            new AtcoCode('3390Y4'),
            new AtcoCode('3390Y3'),
            new AtcoCode('3390Y2'),
        ]);

        $data = $this->extension->normalize($this->serializer, [$favouritePlace]);

        $this->assertInternalType('array', $data);
    }

    public function testDenormalization()
    {
        $object = $this->extension->denormalize($this->serializer, $this->getNormalized(), 'mongo');

        $this->assertInternalType('array', $object);
        $this->assertContainsOnlyInstancesOf(FavouritePlace::class, $object);
    }

    private function getNormalized()
    {
        return [[
            'label' => 'City Centre',
            'feature' => [
                'type' => 'Feature',
                'geometry' => [
                    'type' => 'Point',
                    'coordinates' => [52.9549135, -1.1582327],
                ],
                'properties' => [
                    'name' => 'NG1 5AW',
                ],
            ],
            'stops' => [
                '3390Y4',
                '3390Y3',
                '3390Y2',
            ],
        ]];
    }
}
