<?php

namespace Base\Transport\Entities\Extensions;

use Base\Core\Extension\ExtensionInterface;
use Base\Transport\Entities\AtcoCode;

class FavouriteStops implements ExtensionInterface
{
    public function getKey()
    {
        return 'favouriteStops';
    }

    public function normalize($serializer, $object, $format = null, array $context = [])
    {
        $data = array_map(function (AtcoCode $atcoCode) {
            return (string) $atcoCode;
        }, $object);

        return $data;
    }

    public function denormalize($serializer, $data, $format = null, array $context = [])
    {
        $atcoCodes = array_map(function ($atcoCode) {
            return new AtcoCode($atcoCode);
        }, $data);

        return $atcoCodes;
    }
}
