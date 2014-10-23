<?php

namespace Base\Transport\Entities\Extensions;


use Base\Transport\Entities\BusServiceCode;
use PHPUnit_Framework_TestCase;
use Symfony\Component\Serializer\Serializer;

/**
 * Class FavouriteServicesTest
 * @package Base\Transport\Entities\Extensions
 */
class FavouriteServicesTest extends PHPUnit_Framework_TestCase
{
    /**
     * @var FavouriteServices
     */
    protected $extension;

    /**
     * @var Serializer
     */
    protected $serializer;

    public function setUp()
    {
        $this->extension = new FavouriteServices();
        $this->serializer = new Serializer();
    }

    public function testKey()
    {
        $this->assertInternalType('string', $this->extension->getKey());
    }

    public function testNormalization()
    {
        $object = [new BusServiceCode('1'), new BusServiceCode('1a'), new BusServiceCode('1b')];
        $data = $this->extension->normalize($this->serializer, $object);
        $this->assertEquals($this->getNormalized(), $data);
    }

    public function testDenormalization()
    {
        $object = $this->extension->denormalize($this->serializer, $this->getNormalized());
        $this->assertInternalType('array', $object);
        $this->assertContainsOnlyInstancesOf(BusServiceCode::class, $object);
    }

    private function getNormalized()
    {
        return ['1', '1a', '1b'];
    }
}
