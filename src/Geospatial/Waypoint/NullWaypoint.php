<?php

namespace Base\Geospatial\Waypoint;

class NullWaypoint extends WaypointWithLabel implements WaypointInterface
{
    public function __construct($label = null)
    {
        $this->label = $label;
    }

    public function getGeolocation()
    {
        throw new \LogicException("NullWaypoints do not have a Geolocation");
    }
}
