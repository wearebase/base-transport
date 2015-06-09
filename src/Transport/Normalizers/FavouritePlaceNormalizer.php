<?php

namespace Base\Transport\Normalizers;

use Base\Transport\Entities\AtcoCode;

use Base\Transport\Entities\FavouritePlace;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;
use Symfony\Component\Serializer\Normalizer\DenormalizerInterface;
use Symfony\Component\Serializer\Normalizer\SerializerAwareNormalizer;

class FavouritePlaceNormalizer extends SerializerAwareNormalizer implements NormalizerInterface, DenormalizerInterface
{
    public function normalize($object, $format = null, array $context = [])
    {
        $data = [
            'id' => $object->getId(),
            'label' => $object->getLabel(),
            'stops' => [],
            'permanent' => $object->isPermanent(),
        ];

        foreach ($object->getStops() as $stop) {
            $data['stops'][] = $this->serializer->normalize($stop, $format, $context);
        }

        if ($object->getGeolocation()) {
            $data['feature'] = $this->serializer->normalize(
                $object->getGeolocation(),
                $format,
                $context
            );
            $data['feature']['properties']['name'] = $object->getLabel() ?: "";
            if ($object->getLocation()) {
                $data['feature']['properties'] = [
                    'name' => $object->getLocation(),
                ];
            }
        }
        else {
            $data['feature'] = null;
        }

        if ($object->getCategory()) {
            $data['category'] = $this->serializer->normalize($object->getCategory(), $format, $context);
        }

        return $data;
    }

    public function supportsNormalization($data, $format = null)
    {
        return is_a($data, 'Base\\Transport\\Entities\\FavouritePlace');
    }

    public function denormalize($data, $class, $format = null, array $context = [])
    {
        /** @var $favouritePlace FavouritePlace */
        $favouritePlace = new $class();
        $favouritePlace->setId(isset($data['id']) ? $data['id'] : 'fp-' . uniqid());
        $favouritePlace->setLabel(isset($data['label']) ? $data['label'] : null);

        if ($format === 'mongo') {
            $favouritePlace->setStops(
                array_map(
                    function ($stop) {
                        return new AtcoCode($stop);
                    },
                    isset($data['stops']) ? $data['stops'] : []
                )
            );
        } else {
            $serializer = $this->serializer;

            $stops = array_map(function ($stop) use ($serializer, $format) {
                return $serializer->denormalize(
                    $stop,
                    'Base\\Transport\\Entities\\Stop',
                    $format
                );
            }, $data['stops']);

            $favouritePlace->setStops($stops);
        }


        if (isset($data['feature']['geometry']['coordinates']) && count($data['feature']['geometry']['coordinates'])) {
            $favouritePlace->setGeolocation(
                $this->serializer->denormalize(
                    $data['feature'],
                    'Base\\Geospatial\\Geolocation',
                    $format,
                    $context
                )
            );
        }

        if (isset($data['permanent'])) {
            $favouritePlace->setPermanent((bool)$data['permanent']);
        }

        if (isset($data['feature']['properties']['name'])) {
            $favouritePlace->setLocation($data['feature']['properties']['name']);
        }

        if (isset($data['category'])) {
            $favouritePlace->setCategory(
                $this->serializer->denormalize(
                    $data['category'],
                    'Base\\Transport\\Entities\\FavouritePlaceCategory',
                    $format,
                    $context
                )
            );
        }

        return $favouritePlace;
    }

    public function supportsDenormalization($data, $type, $format = null)
    {
        return $type === 'Base\\Transport\\Entities\\FavouritePlace';
    }
}
