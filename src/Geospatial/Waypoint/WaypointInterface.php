<?php

namespace Base\Geospatial\Waypoint;

use Base\Geospatial\GeolocationInterface;

interface WaypointInterface
{
    /** @return GeolocationInterface */
    public function getGeolocation();
}
