<?php

namespace Base\Geospatial;

use Base\Geospatial\Geolocation;
use Base\Geospatial\BoundingBox;

class BoundingBoxTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @covers \Base\Geospatial\BoundingBox::__construct
     * @covers \Base\Geospatial\BoundingBox::validateBoundingBox
     * @covers \Base\Geospatial\Geolocation
     * @covers \Base\Geospatial\AbstractGeolocation
     *
     * @expectedException \InvalidArgumentException
     */
    public function testInverseLatitudes()
    {
        $topRight = new Geolocation(2, 2);
        $bottomLeft = new Geolocation(1, 1);

        new BoundingBox($bottomLeft, $topRight);
    }

    /**
     * @covers \Base\Geospatial\BoundingBox::__construct
     * @covers \Base\Geospatial\BoundingBox::validateBoundingBox
     * @covers \Base\Geospatial\Geolocation
     * @covers \Base\Geospatial\AbstractGeolocation
     *
     * @expectedException \InvalidArgumentException
     */
    public function testInverseLongitudes()
    {
        $topRight = new Geolocation(2, 2);
        $bottomLeft = new Geolocation(1, 1);

        new BoundingBox($topRight, $bottomLeft);
    }

    /**
     * @covers \Base\Geospatial\BoundingBox::__construct
     * @covers \Base\Geospatial\BoundingBox::validateBoundingBox
     * @covers \Base\Geospatial\Geolocation
     * @covers \Base\Geospatial\AbstractGeolocation
     */
    public function testEmptyIsOk()
    {
        $topLeft = new Geolocation(2, 1);

        new BoundingBox($topLeft, $topLeft);
        // no exception
        $this->assertTrue(true);
    }

    /**
     * @covers \Base\Geospatial\BoundingBox::__construct
     * @covers \Base\Geospatial\BoundingBox::validateBoundingBox
     * @covers \Base\Geospatial\Geolocation
     * @covers \Base\Geospatial\AbstractGeolocation
     */
    public function testValidGeolocations()
    {
        $topLeft = new Geolocation(2, 1);
        $bottomRight = new Geolocation(1, 2);

        new BoundingBox($topLeft, $bottomRight);
        // no exception
        $this->assertTrue(true);
    }

    /**
     * @covers \Base\Geospatial\BoundingBox::__construct
     * @covers \Base\Geospatial\BoundingBox::validateBoundingBox
     * @covers \Base\Geospatial\BoundingBox::contains
     * @covers \Base\Geospatial\Geolocation
     * @covers \Base\Geospatial\AbstractGeolocation
     */
    public function testEmptyContainsSelf()
    {
        $topLeft = new Geolocation(2, 1);
        $topRight = new Geolocation(2, 2);
        $bottomLeft = new Geolocation(1, 1);
        $bottomRight = new Geolocation(1, 2);

        $box = new BoundingBox($topLeft, $topLeft);

        $this->assertTrue($box->contains($topLeft));

        $this->assertFalse($box->contains($topRight));
        $this->assertFalse($box->contains($bottomLeft));
        $this->assertFalse($box->contains($bottomRight));
    }

    /**
     * @covers \Base\Geospatial\BoundingBox::__construct
     * @covers \Base\Geospatial\BoundingBox::validateBoundingBox
     * @covers \Base\Geospatial\BoundingBox::contains
     * @covers \Base\Geospatial\Geolocation
     * @covers \Base\Geospatial\AbstractGeolocation
     */
    public function testContains()
    {
        $topLeft = new Geolocation(2, 1);
        $topRight = new Geolocation(2, 2);
        $bottomLeft = new Geolocation(1, 1);
        $bottomRight = new Geolocation(1, 2);

        $centre = new Geolocation(1.5, 1.5);
        $above = new Geolocation(5, 1.5);
        $left = new Geolocation(1.5, 0);
        $aboveAndLeft = new Geolocation(5, 0);

        $box = new BoundingBox($topLeft, $bottomRight);

        $this->assertTrue($box->contains($centre));
        $this->assertTrue($box->contains($topLeft));
        $this->assertTrue($box->contains($topRight));
        $this->assertTrue($box->contains($bottomLeft));
        $this->assertTrue($box->contains($bottomRight));

        $this->assertFalse($box->contains($above));
        $this->assertFalse($box->contains($left));
        $this->assertFalse($box->contains($aboveAndLeft));
    }
}

