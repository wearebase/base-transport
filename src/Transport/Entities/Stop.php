<?php

namespace Base\Transport\Entities;

use Base\Geospatial\GeolocationInterface;

class Stop
{
    protected $atcoCode;
    protected $naptanCode;
    protected $commonName;
    protected $localityName;
    protected $geolocation;
    protected $direction;

    /**
     * @param array $properties
     * @return Stop
     */
    public static function createFromArray(array $properties)
    {
        $stop = new self();

        foreach ($properties as $property => $value) {
            $method = 'set' . ucfirst($property);

            if (method_exists($stop, $method)) {
                $stop->$method($value);
            }
        }

        return $stop;
    }

    /**
     * @param string $atcoCode
     */
    public function setAtcoCode($atcoCode)
    {
        $this->atcoCode = $atcoCode;
    }

    /**
     * @return string
     */
    public function getAtcoCode()
    {
        return $this->atcoCode;
    }

    /**
     * @param string $naptanCode
     */
    public function setNaptanCode($naptanCode)
    {
        $this->naptanCode = $naptanCode;
    }

    /**
     * @return string
     */
    public function getNaptanCode()
    {
        return $this->naptanCode;
    }

    /**
     * @param string $commonName
     */
    public function setCommonName($commonName)
    {
        $this->commonName = $commonName;
    }

    /**
     * @return string
     */
    public function getCommonName()
    {
        return $this->commonName;
    }

    /**
     * @param string $localityName
     */
    public function setLocalityName($localityName)
    {
        $this->localityName = $localityName;
    }

    /**
     * @return string
     */
    public function getLocalityName()
    {
        return $this->localityName;
    }

    /**
     * @param GeolocationInterface $geolocation
     */
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

    /**
     * @param string $direction
     */
    public function setDirection($direction)
    {
        $this->direction = $direction;
    }

    /**
     * @return string
     */
    public function getDirection()
    {
        return $this->direction;
    }
}
