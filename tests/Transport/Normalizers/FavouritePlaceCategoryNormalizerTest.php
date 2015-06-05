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
        $icon = new FavouritePlaceCategory;
        $icon->setLabel('Label');
        $icon->setId('id');

        $normalized = $this->serializer->normalize($icon);
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
