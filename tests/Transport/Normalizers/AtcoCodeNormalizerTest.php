<?php

namespace Base\Transport\Normalizers;

use Base\Transport\Entities\AtcoCode;

class AtcoCodeNormalizerTest extends \PHPUnit_Framework_TestCase
{
    protected $serializer;

    public function setUp()
    {
        $this->serializer = new \Symfony\Component\Serializer\Serializer([new AtcoCodeNormalizer()]);
    }

    public function testNormalization()
    {
        $normalized = $this->serializer->normalize(new AtcoCode('3390Y4'));
        $this->assertEquals('3390Y4', $normalized);
    }

    public function testDenormalization()
    {
        $atcoCode = $this->serializer->denormalize('3390Y4', 'Base\\Transport\\Entities\\AtcoCode');
        $this->assertEquals('3390Y4', (string) $atcoCode);
    }
}
