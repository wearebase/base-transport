<?php

namespace Base\Geospatial;

abstract class AbstractGeolocation implements GeolocationInterface
{
    /** @var float degrees */
    protected $lat;

    /** @var float degrees*/
    protected $long;

    private $latRadians;
    private $longRadians;

    public function setLat($lat)
    {
        $this->lat = $lat;
    }

    public function getLat()
    {
        return $this->lat;
    }

    public function setLong($long)
    {
        $this->long = $long;
    }

    public function getLong()
    {
        return $this->long;
    }

    public function toString()
    {
        return $this->getLat() . ',' . $this->getLong();
    }

    public function isEqualTo(GeolocationInterface $other)
    {
        return $this->getLat() === $other->getLat() && $this->getLong() === $other->getLong();
    }

    /** @return Distance */
    public function distanceTo(GeolocationInterface $otherGeolocation)
    {
        if (!$this->latRadians) {
            $this->latRadians = deg2rad($this->lat);
        }
        if (!$this->longRadians) {
            $this->longRadians = deg2rad($this->long);
        }

        $latFrom = $this->latRadians;
        $lonFrom = $this->longRadians;

        $latTo = deg2rad($otherGeolocation->getLat());
        $lonTo = deg2rad($otherGeolocation->getLong());

        $latDelta = $latTo - $latFrom;
        $lonDelta = $lonTo - $lonFrom;

        $angle = 2 * asin(sqrt(pow(sin($latDelta / 2), 2) + cos($latFrom) * cos($latTo) * pow(sin($lonDelta / 2), 2)));

        return new Distance($angle * GeolocationInterface::EARTH_RADIUS);
    }
}
