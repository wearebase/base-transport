<?php

namespace Base\Transport\Normalizers;

use Base\Geospatial\Geolocation;
use Base\Transport\Entities\Stop;

class StopNormalizerTest extends \PHPUnit_Framework_TestCase
{
    protected $serializer;

    public function setUp()
    {
        $this->serializer = new \Symfony\Component\Serializer\Serializer([new StopNormalizer()]);
    }

    public function testNormalization()
    {
        $stop = new Stop();
        $stop->setAtcoCode('3390Y4');
        $stop->setNaptanCode('ntmatgap');
        $stop->setGeolocation(new Geolocation(52.95512390, '-1.15813422'));
        $stop->setCommonName('Cathedral');
        $stop->setLocalityName('Nottingham');
        $stop->setDirection('inbound');

        $normalized = $this->serializer->normalize($stop);

        $this->assertEquals($this->getNormalized(), $normalized);
    }

    public function testDenormalization()
    {
        $stop = $this->serializer->denormalize($this->getNormalized(), 'Base\\Transport\\Entities\\Stop');

        $this->assertEquals('3390Y4', $stop->getAtcoCode());
        $this->assertEquals('ntmatgap', $stop->getNaptanCode());
        $this->assertEquals(52.95512390, $stop->getGeolocation()->getLat());
        $this->assertEquals(-1.15813422, $stop->getGeolocation()->getLong());
        $this->assertEquals('Cathedral', $stop->getCommonName());
        $this->assertEquals('Nottingham', $stop->getLocalityName());
        $this->assertEquals('inbound', $stop->getDirection());
    }

    private function getNormalized()
    {
        return [
            'atco_code' => '3390Y4',
            'naptan' => 'ntmatgap',
            'lat' => '52.95512390',
            'lng' => '-1.15813422',
            'ref' => '3390Y4',
            'commonname' => 'Cathedral',
            'common_name' => 'Cathedral',
            'localityname' => 'Nottingham',
            'locality_name' => 'Nottingham',
            'direction' => 'inbound',
        ];
    }
}
