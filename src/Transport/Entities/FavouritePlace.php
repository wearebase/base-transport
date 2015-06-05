<?php

namespace Base\Transport\Entities;

use Base\Geospatial\Waypoint\LabeledWaypointInterface;
use Base\Geospatial\GeolocationInterface;

class FavouritePlace implements LabeledWaypointInterface
{
    protected $id;
    protected $label;
    protected $location;
    protected $geolocation;
    protected $stops = [];
    protected $permanent = false;
    protected $category;

    public function setId($id)
    {
        $this->id = $id;
    }

    public function getId()
    {
        return $this->id;
    }

    public function setLabel($label)
    {
        $this->label = $label;
    }

    public function getLabel()
    {
        return $this->label;
    }

    public function isLikeLabel($label)
    {
        return strtolower($this->label) === strtolower($label);
    }

    public function setLocation($location)
    {
        $this->location = $location;
    }

    public function getLocation()
    {
        return $this->location;
    }

    public function setGeolocation(GeolocationInterface $geolocation)
    {
        $this->geolocation = $geolocation;
    }

    /**
     * @return GeolocationInterface
     */
    public function getGeolocation()
    {
        return $this->geolocation;
    }

    public function setStops(array $stops)
    {
        $this->stops = $stops;
    }

    public function getStops()
    {
        return $this->stops;
    }

    public function setPermanent($permanent)
    {
        $this->permanent = (bool) $permanent;
    }

    public function isPermanent()
    {
        return $this->permanent === true;
    }

    /**
     * @param FavouritePlaceCategory $category
     */
    public function setCategory(FavouritePlaceCategory $category)
    {
        $this->category = $category;
    }

    /**
     * @return FavouritePlaceCategory
     */
    public function getCategory()
    {
        return $this->category;
    }
}
