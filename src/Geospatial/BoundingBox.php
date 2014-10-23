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
}
