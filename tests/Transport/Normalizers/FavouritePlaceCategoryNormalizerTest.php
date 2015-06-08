<?php

namespace Base\Transport\Normalizers;

use Base\Transport\Entities\FavouritePlaceCategory;
use Symfony\Component\Serializer\Serializer;

class FavouritePlaceCategoryNormalizerTest extends \PHPUnit_Framework_TestCase
{
    protected $serializer;

    public function setUp()
    {
        $this->serializer = new Serializer([new FavouritePlaceCategoryNormalizer()]);
    }

    public function testNormalization()
    {
        $category = new FavouritePlaceCategory;
        $category->setLabel('Label');
        $category->setId('id');

        $normalized = $this->serializer->normalize($category);
        $this->assertCount(2, $normalized);
        $this->assertEquals('Label', $normalized['label']);
        $this->assertEquals('id', $normalized['id']);
    }

    public function testDenormalization()
    {
        $category = [
            'label' => 'Label',
            'id' => 'id',
        ];

        $deNormalized = $this->serializer->denormalize($category, 'Base\\Transport\\Entities\\FavouritePlaceCategory');
        $this->assertEquals('Label', $deNormalized->getLabel());
        $this->assertEquals('id', $deNormalized->getId());
    }
}
