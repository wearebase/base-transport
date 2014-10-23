<?php
/**
 * AbstractWaypointTest.php
 *
 * PHP version 5.5
 *
 * @author   Dave Hulbert <dave@wearebase.com>
 * @license  Proprietary http://wearebase.com
 * @link     http://wearebase.com
 * @date     01/07/14
 * @project  nct-app
 */

namespace Base\Geospatial\Waypoint;

use Base\Geospatial\AbstractGeolocation;

/**
 * @coversDefaultClass Base\Geospatial\Waypoint\AbstractWaypoint
 */
class AbstractWaypointTest extends \PHPUnit_Framework_TestCase
{
    public function testGetGeolocation()
    {
        $geolocation = $this->getMockForAbstractClass(AbstractGeolocation::class);

        $mock = $this->getMockBuilder(AbstractWaypoint::class)
            ->setMethods(['__construct'])
            ->getMock();

        $property = new \ReflectionProperty($mock, 'geolocation');
        $property->setAccessible(true);

        $property->setValue($mock, $geolocation);

        $this->assertSame($geolocation, $mock->getGeolocation());
    }
}

