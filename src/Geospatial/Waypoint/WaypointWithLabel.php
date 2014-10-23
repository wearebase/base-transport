<?php

namespace Base\Geospatial\Waypoint;

use Base\Geospatial\GeolocationInterface;

class WaypointWithLabel extends GeolocationWaypoint implements LabeledWaypointInterface
{
    /** @var string */
    protected $label;

    public function __construct(GeolocationInterface $geolocation, $label = null)
    {
        $this->label = $label;
        parent::__construct($geolocation);
    }

    /**
     * @return string
     */
    public function getLabel()
    {
        return $this->label;
    }

    public function isLikeLabel($label)
    {
        return strtolower($this->label) === strtolower($label);
    }
}
