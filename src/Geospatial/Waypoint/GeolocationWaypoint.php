<?php

namespace Base\Geospatial\Waypoint;

use Base\Geospatial\GeolocationInterface;

class GeolocationWaypoint extends AbstractWaypoint implements WaypointInterface
{
    public function __construct(GeolocationInterface $geolocation)
    {
        $this->geolocation = $geolocation;
    }
}
