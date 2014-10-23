<?php

namespace Base\Geospatial\Waypoint;

use Base\Geospatial\AbstractGeolocation;

class WaypointWithLabelTest extends \PHPUnit_Framework_TestCase
{
    public function setUp()
    {
        $this->geolocation = $this->getMockForAbstractClass(AbstractGeolocation::class);
    }

    /**
     * @covers \Base\Geospatial\Waypoint\WaypointWithLabel::__construct
     * @uses \Base\Geospatial\Waypoint\AbstractWaypoint
     * @uses \Base\Geospatial\Waypoint\GeolocationWaypoint
     * @covers \Base\Geospatial\Waypoint\WaypointWithLabel::getLabel
     */
    public function testLabelIsSet()
    {
        $waypoint = new WaypointWithLabel($this->geolocation, 'foo');

        $this->assertEquals('foo', $waypoint->getLabel());
    }

    public function testIsLikeLabel()
    {
        $waypoint = new WaypointWithLabel($this->geolocation, 'foo');

        $this->assertTrue($waypoint->isLikeLabel('foo'));
        $this->assertTrue($waypoint->isLikeLabel('Foo'));
        $this->assertFalse($waypoint->isLikeLabel('bar'));
    }
}
