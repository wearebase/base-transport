<?php

namespace Base\Geospatial\Waypoint;

interface WaypointPathInterface
{
    /** @return WaypointInterface */
    public function getOrigin();

    /** @return WaypointInterface */
    public function getDestination();
}
