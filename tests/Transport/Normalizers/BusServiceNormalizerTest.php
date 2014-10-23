<?php

namespace Base\Transport\Normalizers;

use Base\Transport\Entities\BusService;
use PHPUnit_Framework_TestCase;
use Symfony\Component\Serializer\Serializer;

class BusServiceNormalizerTest extends PHPUnit_Framework_TestCase
{
    /**
     * @var Serializer
     */
    protected $serializer;
    protected $busService;

    public function setUp()
    {
        $this->serializer = new Serializer([new BusServiceNormalizer()]);
        $this->busService = new BusService();
        $this->busService->setDescription('description');
        $this->busService->setId(1);
        $this->busService->setInformation(['information']);
        $this->busService->setLines(['navy']);
        $this->busService->setName('1A');
        $this->busService->setOperation(['status' => 'running']);
    }

    public function testNormalization()
    {
        $normalized = $this->serializer->normalize($this->busService);
        $this->assertEquals(
            [
                'description' => 'description',
                'id' => 1,
                'information' => ['information'],
                'lines' => ['navy'],
                'name' => '1A',
                'operation' => ['status' => 'running']
            ],
            $normalized
        );
    }

    public function testDenormalization()
    {
        $denormalizeBusService = $this->serializer->denormalize(
            [
                'description' => 'description',
                'id' => 1,
                'information' => ['information'],
                'lines' => ['navy'],
                'name' => '1A',
                'operation' => ['status' => 'running']
            ],
            BusService::class
        );

        $this->assertEquals(
            $this->busService,
            $denormalizeBusService
        );
    }
}
