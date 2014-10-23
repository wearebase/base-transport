<?php

namespace Base\Geospatial;

class GeolocationTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @covers \Base\Geospatial\Geolocation::__construct
     * @covers \Base\Geospatial\Geolocation::verifyNumeric
     */
    public function testInt()
    {
        new Geolocation(1, 2);
        // no exception
        $this->assertTrue(true);
    }

    /**
     * @covers \Base\Geospatial\Geolocation::__construct
     * @covers \Base\Geospatial\Geolocation::verifyNumeric
     */
    public function testFloat()
    {
        new Geolocation(0.1, 0.2);
        // no exception
        $this->assertTrue(true);
    }

    /**
     * @covers \Base\Geospatial\Geolocation::__construct
     * @covers \Base\Geospatial\Geolocation::verifyNumeric
     */
    public function testNumericString()
    {
        new Geolocation("1", "2");
        // no exception
        $this->assertTrue(true);
    }

    /**
     * @covers \Base\Geospatial\Geolocation::__construct
     * @covers \Base\Geospatial\Geolocation::verifyNumeric
     *
     * @expectedException \InvalidArgumentException
     */
    public function testNonNumericLat()
    {
        new Geolocation('foo', 2);
    }

    /**
     * @covers \Base\Geospatial\Geolocation::__construct
     * @covers \Base\Geospatial\Geolocation::verifyNumeric
     *
     * @expectedException \InvalidArgumentException
     */
    public function testNonNumericLong()
    {
        new Geolocation(1, 'foo');
    }

    /**
     * @covers \Base\Geospatial\Geolocation::__construct
     * @covers \Base\Geospatial\Geolocation::verifyNumeric
     *
     * @expectedException \InvalidArgumentException
     */
    public function testNonNumericLatAndLong()
    {
        new Geolocation('foo', 'bar');
    }

    public function testFromString()
    {
        $geolocation = Geolocation::fromString('0.1,0.2');

        $this->assertEquals(0.1, $geolocation->getLat());
        $this->assertEquals(0.2, $geolocation->getLong());
    }
}
