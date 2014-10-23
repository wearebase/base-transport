<?php

namespace Base\Geospatial\Normalizers;

use Base\Geospatial\GeolocationInterface;

use Symfony\Component\Serializer\Normalizer\NormalizerInterface;
use Symfony\Component\Serializer\Normalizer\DenormalizerInterface;

class GeospatialNormalizer implements NormalizerInterface, DenormalizerInterface
{
    public function normalize($object, $format = null, array $context = [])
    {
        return [
            'type' => 'Feature',
            'geometry' => [
                'type' => 'Point',
                'coordinates' => [
                    $object->getLat(),
                    $object->getLong(),
                ],
            ],
        ];
    }

    public function supportsNormalization($data, $format = null)
    {
        return is_subclass_of($data, 'Base\\Geospatial\\GeolocationInterface');
    }

    public function denormalize($data, $class, $format = null, array $context = [])
    {
        return new $class(
            $data['geometry']['coordinates'][0],
            $data['geometry']['coordinates'][1]
        );
    }

    public function supportsDenormalization($data, $type, $format = null)
    {
        return is_subclass_of($type, 'Base\\Geospatial\\GeolocationInterface');
    }
}
