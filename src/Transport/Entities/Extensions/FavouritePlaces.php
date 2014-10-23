<?php

namespace Base\Transport\Entities\Extensions;

use Base\Core\Extension\ExtensionInterface;
use Base\Transport\Entities\AtcoCode;
use Base\Transport\Entities\FavouritePlace;

class FavouritePlaces implements ExtensionInterface
{
    public function getKey()
    {
        return 'favouritePlaces';
    }

    public function normalize($serializer, $object, $format = null, array $context = [])
    {
        $data = array_map(function ($item) use ($serializer, $format, $context) {
            return $serializer->normalize(
                $item,
                $format,
                $context
            );
        }, $object);

        return $data;
    }

    public function denormalize($serializer, $data, $format = null, array $context = [])
    {
        $data = array_map(function ($datum) use ($serializer, $format, $context) {
            return $serializer->denormalize(
                $datum,
                'Base\\Transport\\Entities\\FavouritePlace',
                $format,
                $context
            );
        }, $data);

        return $data;
    }
}
