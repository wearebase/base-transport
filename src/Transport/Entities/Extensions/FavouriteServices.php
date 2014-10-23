<?php

namespace Base\Transport\Entities\Extensions;

use Base\Core\Extension\ExtensionInterface;
use Base\Transport\Entities\BusServiceCode;

/**
 * Class FavouriteServices
 * @package Base\Transport\Entities\Extensions
 */
class FavouriteServices implements ExtensionInterface
{
    /**
     * @return string
     */
    public function getKey()
    {
        return 'favouriteBusServices';
    }

    /**
     * @param $serializer
     * @param $object
     * @param null $format
     * @param array $context
     * @return array
     */
    public function normalize($serializer, $object, $format = null, array $context = [])
    {
        $data = array_map(
            function (BusServiceCode $serviceCode) {
                return (string) $serviceCode;
            },
            $object
        );

        return $data;
    }

    /**
     * @param $serializer
     * @param $data
     * @param null $format
     * @param array $context
     * @return array
     */
    public function denormalize($serializer, $data, $format = null, array $context = [])
    {
        $serviceCodes = array_map(
            function ($serviceCode) {
                return new BusServiceCode($serviceCode);
            },
            $data
        );

        return $serviceCodes;
    }
}
