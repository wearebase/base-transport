<?php

namespace Base\Geospatial\Waypoint;

use Base\Geospatial\GeolocationInterface;

abstract class AbstractWaypoint implements WaypointInterface
{
    /**
     * @var GeolocationInterface
     */
    protected $geolocation;

    /** @return GeolocationInterface */
    public function getGeolocation()
    {
        return $this->geolocation;
    }
}
