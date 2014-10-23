<?php

namespace Base\Geospatial;

class AbstractGeolocationTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @covers \Base\Geospatial\AbstractGeolocation::isEqualTo
     */
    public function testEqualTo()
    {
        $one = $this->createGeolocation(123.45, 1.11);
        $two = $this->createGeolocation(123.45, 1.11);

        $this->assertTrue($one->isEqualTo($two));
        $this->assertTrue($two->isEqualTo($one));
    }

    /**
     * @covers \Base\Geospatial\AbstractGeolocation::isEqualTo
     */
    public function testNotEqualTo()
    {
        $one = $this->createGeolocation(123.45, 1.11);
        $two = $this->createGeolocation(7, 7);

        $this->assertFalse($one->isEqualTo($two));
        $this->assertFalse($two->isEqualTo($one));
    }

    /**
     * @covers \Base\Geospatial\AbstractGeolocation::isEqualTo
     */
    public function testAlmostEqualTo()
    {
        $one = $this->createGeolocation(123.45, 1.11);
        $two = $this->createGeolocation(123.45, 7);

        $this->assertFalse($one->isEqualTo($two));
        $this->assertFalse($two->isEqualTo($one));
    }

    /**
     * @param $two
     * @return AbstractGeolocation
     */
    protected function createGeolocation($lat, $long)
    {
        $geolocation = $this->getMockBuilder(AbstractGeolocation::class)
            ->setMethods(['getLat', 'getLong'])
            ->getMock();

        $geolocation->expects($this->any())
            ->method('getLat')
            ->willReturn($lat);

        $geolocation->expects($this->any())
            ->method('getLong')
            ->willReturn($long);

        return $geolocation;
    }

    public function testToString()
    {
        $geolocation = $this->createGeolocation(123.45, 1.11);
        $this->assertEquals("123.45,1.11", $geolocation->toString());
    }

    public function testDistanceTo()
    {
        $start = $this->getMockForAbstractClass('Base\\Geospatial\\AbstractGeolocation');
        $start->setLat(51.5072);
        $start->setLong(0.1273);

        $finish = $this->getMockForAbstractClass('Base\\Geospatial\\AbstractGeolocation');
        $finish->setLat(50.7200);
        $finish->setLong(1.8800);

        $distance = $start->distanceTo($finish);

        $this->assertInstanceOf('Base\\Geospatial\\Distance', $distance);
        $this->assertEquals(150429, (int) $distance->getMeters());
    }
}
