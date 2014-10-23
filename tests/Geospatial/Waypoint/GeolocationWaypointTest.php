<?php
/**
 * GeolocationWaypointTest.php
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
 * @coversDefaultClass Base\Geospatial\Waypoint\GeolocationWaypoint
 */
class GeolocationWaypointTest extends \PHPUnit_Framework_TestCase
{
    public function testConstruct()
    {
        $geolocation = $this->getMockForAbstractClass(AbstractGeolocation::class);
        $waypoint = new GeolocationWaypoint($geolocation);
        $this->assertSame($geolocation, $waypoint->getGeolocation());
    }
}

