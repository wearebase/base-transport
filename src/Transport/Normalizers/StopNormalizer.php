<?php

namespace Base\Transport\Normalizers;

use Base\Geospatial\Geolocation;
use Symfony\Component\Serializer\Normalizer\DenormalizerInterface;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;
use Symfony\Component\Serializer\Normalizer\SerializerAwareNormalizer;

class StopNormalizer extends SerializerAwareNormalizer implements NormalizerInterface, DenormalizerInterface
{
    public function normalize($object, $format = null, array $context = [])
    {
        $data = [
            'atco_code' => $object->getAtcoCode(),
            'naptan' => $object->getNaptanCode(),
            'lat' => $object->getGeolocation()->getLat(),
            'lng' => $object->getGeolocation()->getLong(),
            'ref' => $object->getAtcoCode(),
            'commonname' => $object->getCommonName(),
            'common_name' => $object->getCommonName(),
            'localityname' => $object->getLocalityName(),
            'locality_name' => $object->getLocalityName(),
            'direction' => $object->getDirection(),
        ];

        return $data;
    }

    public function supportsNormalization($data, $format = null)
    {
        return is_a($data, 'Base\\Transport\\Entities\\Stop');
    }

    public function denormalize($data, $class, $format = null, array $context = [])
    {
        $stop = new $class();
        $stop->setAtcoCode($data['atco_code']);
        $stop->setNaptanCode($data['naptan']);
        $stop->setCommonName($data['commonname']);
        $stop->setLocalityName($data['localityname']);
        $stop->setGeolocation(new Geolocation($data['lat'], $data['lng']));
        
        if (isset($data['direction'])) {
            $stop->setDirection($data['direction']);
        }

        return $stop;
    }

    public function supportsDenormalization($data, $type, $format = null)
    {
        return $type === 'Base\\Transport\\Entities\\Stop';
    }
}
