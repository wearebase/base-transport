<?php

namespace Base\Geospatial;

class Distance
{
    private $meters;

    public function __construct($meters)
    {
        $this->meters = (float) $meters;
    }

    /**
     * @return float
     */
    public function getMeters()
    {
        return $this->meters;
    }

    public function add(Distance $distance)
    {
        return new Distance($this->getMeters() + $distance->getMeters());
    }
}
