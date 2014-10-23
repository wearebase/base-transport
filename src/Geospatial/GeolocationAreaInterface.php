<?php

namespace Base\Geospatial;

interface GeolocationAreaInterface
{
    /**
     * @param  GeolocationInterface $geolocation
     * @return bool
     */
    public function contains(GeolocationInterface $geolocation);
}
