<?php

namespace Base\Geospatial;

class Speed
{
    private $metersPerSecond;

    public function __construct($metersPerSecond)
    {
        $this->metersPerSecond = (float) $metersPerSecond;
    }

    /**
     * @return float
     */
    public function getMetersPerSecond()
    {
        return $this->metersPerSecond;
    }
}
