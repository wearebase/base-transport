<?php

namespace Base\Transport\Entities\Extensions;

use Base\Transport\Entities\AtcoCode;

class FavouriteStopsTest extends \PHPUnit_Framework_TestCase
{
    protected $extension;
    protected $serializer;

    public function setUp()
    {
        $this->extension = new FavouriteStops();
        $this->serializer = new \Symfony\Component\Serializer\Serializer();
    }

    public function testKey()
    {
        $this->assertInternalType('string', $this->extension->getKey());
    }

    public function testNormalization()
    {
        $object = [new AtcoCode('3390Y4'), new AtcoCode('3390Y3')];
        $data = $this->extension->normalize($this->serializer, $object);
        $this->assertEquals($this->getNormalized(), $data);
    }

    public function testDenormalization()
    {
        $object = $this->extension->denormalize($this->serializer, $this->getNormalized());
        $this->assertInternalType('array', $object);
        $this->assertContainsOnlyInstancesOf(AtcoCode::class, $object);
    }

    private function getNormalized()
    {
        return ['3390Y4', '3390Y3'];
    }
}

