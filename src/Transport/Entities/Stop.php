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

    public function setAtcoCode($atcoCode)
    {
        $this->atcoCode = $atcoCode;
    }

    public function getAtcoCode()
    {
        return $this->atcoCode;
    }

    public function setNaptanCode($naptanCode)
    {
        $this->naptanCode = $naptanCode;
    }

    public function getNaptanCode()
    {
        return $this->naptanCode;
    }

    public function setCommonName($commonName)
    {
        $this->commonName = $commonName;
    }

    public function getCommonName()
    {
        return $this->commonName;
    }

    public function setLocalityName($localityName)
    {
        $this->localityName = $localityName;
    }

    public function getLocalityName()
    {
        return $this->localityName;
    }

    public function setGeolocation(GeolocationInterface $geolocation)
    {
        $this->geolocation = $geolocation;
    }

    public function getGeolocation()
    {
        return $this->geolocation;
    }
}
