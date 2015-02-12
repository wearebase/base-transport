<?php

namespace Base\Geospatial;

class BoundingBox implements GeolocationAreaInterface
{
    /**
     * @var GeolocationInterface
     */
    private $topLeft;
    /**
     * @var GeolocationInterface
     */
    private $bottomRight;

    /**
     *                            $topLeft->getLat()
     *                     +------------------------------+
     *                     | $topLeft                     |
     * $topLeft->getLong() |                              | $bottomRight->getLong()
     *                     |                              |
     *                     |                 $bottomRight |
     *                     +------------------------------+
     *                            $bottomRight->getLat()
     */
    public function __construct(GeolocationInterface $topLeft, GeolocationInterface $bottomRight)
    {
        $this->validateBoundingBox($topLeft, $bottomRight);

        $this->topLeft = $topLeft;
        $this->bottomRight = $bottomRight;
    }

    public function contains(GeolocationInterface $geolocation)
    {
        return $this->topLeft->getLong() <= $geolocation->getLong() &&
            $this->topLeft->getLat() >= $geolocation->getLat() &&
            $this->bottomRight->getLong() >= $geolocation->getLong() &&
            $this->bottomRight->getLat() <= $geolocation->getLat();
    }

    /**
     * @param GeolocationInterface $topLeft
     * @param GeolocationInterface $bottomRight
     *
     * @throws \InvalidArgumentException
     */
    private function validateBoundingBox(GeolocationInterface $topLeft, GeolocationInterface $bottomRight)
    {
        if ($topLeft->getLat() < $bottomRight->getLat()) {
            throw new \InvalidArgumentException('$topLeft must have a greater latitude than $bottomRight');
        }

        if ($topLeft->getLong() > $bottomRight->getLong()) {
            throw new \InvalidArgumentException('$topLeft must have a lesser longitude than $bottomRight');
        }
    }

    public static function fromCenterAndDistance(GeolocationInterface $center, Distance $distance)
    {
        $radLat = deg2rad($center->getLat());
        $radLon = deg2rad($center->getLong());

        // angular distance in radians on a great circle
        $radDist = $distance->getMeters() / GeolocationInterface::EARTH_RADIUS;

        $minLat = $radLat - $radDist;
        $maxLat = $radLat + $radDist;

        $deltaLon = asin(sin($radDist) / cos($radLat));

        $minLon = $radLon - $deltaLon;
        //if (minLon < MIN_LON) {minLon += 2d * Math.PI;}

        $maxLon = $radLon + $deltaLon;
        //if (maxLon > MAX_LON) {maxLon -= 2d * Math.PI;}

        $min = new Geolocation(rad2deg($maxLat), rad2deg($minLon));
        $max = new Geolocation(rad2deg($minLat), rad2deg($maxLon));

        return new BoundingBox($min, $max);
    }

    /** @return GeolocationInterface */
    public function getTopLeft()
    {
        return $this->topLeft;
    }

    /** @return GeolocationInterface */
    public function getBottomRight()
    {
        return $this->bottomRight;
    }
}
