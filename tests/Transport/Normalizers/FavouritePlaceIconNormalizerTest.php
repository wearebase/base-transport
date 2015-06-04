<?php

namespace Base\Transport\Normalizers;

use Base\Transport\Entities\FavouritePlaceIcon;
use Symfony\Component\Serializer\Serializer;

class FavouritePlaceIconNormalizerTest extends \PHPUnit_Framework_TestCase
{
    protected $serializer;

    public function setUp()
    {
        $this->serializer = new Serializer([new FavouritePlaceIconNormalizer()]);
    }

    public function testNormalization()
    {
        $icon = new FavouritePlaceIcon;
        $icon->setLabel('Label');
        $icon->setCategory('CATEGORY');

        $normalized = $this->serializer->normalize($icon);
        $this->assertCount(2, $normalized);
        $this->assertEquals('Label', $normalized['label']);
        $this->assertEquals('category', $normalized['category']);
    }

    public function testDenormalization()
    {
        $icon = [
            'label' => 'Label',
            'category' => 'CATEGORY',
        ];

        $deNormalized = $this->serializer->denormalize($icon, 'Base\\Transport\\Entities\\FavouritePlaceIcon');
        $this->assertEquals('Label', $deNormalized->getLabel());
        $this->assertEquals('category', $deNormalized->getCategory());
    }
}
