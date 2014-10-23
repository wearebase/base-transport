<?php

namespace Base\Geospatial;

interface GeolocationInterface
{
    const EARTH_RADIUS = 6371000;

    public function getLat();
    public function getLong();

    public function toString();

    /** @return bool */
    public function isEqualTo(GeolocationInterface $geolocation);

    /** @return Distance */
    public function distanceTo(GeolocationInterface $getGeolocation);
}
