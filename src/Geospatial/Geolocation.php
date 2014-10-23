<?php

namespace Base\Geospatial;

class Geolocation extends AbstractGeolocation implements GeolocationInterface
{
    /**
     * @param $lat float degrees
     * @param $long float degrees
     */
    public function __construct($lat, $long)
    {
        $this->verifyNumeric($lat);
        $this->verifyNumeric($long);

        $this->lat = (float) $lat;
        $this->long = (float) $long;
    }

    private function verifyNumeric($var)
    {
        if (!is_numeric($var)) {
            throw new \InvalidArgumentException($var . " must be numeric.");
        }
    }

    public static function fromString($latLong)
    {
        list($lat, $long) = explode(',', $latLong);

        return new static($lat, $long);
    }
}
