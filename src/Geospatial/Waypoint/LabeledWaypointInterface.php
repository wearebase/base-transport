<?php

namespace Base\Geospatial\Waypoint;

interface LabeledWaypointInterface extends WaypointInterface
{
    /** @return string */
    public function getLabel();

    /** @return bool */
    public function isLikeLabel($label);
}
