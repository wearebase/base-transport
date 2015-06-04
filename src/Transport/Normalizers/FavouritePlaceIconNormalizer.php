<?php

namespace Base\Transport\Normalizers;

use Base\Transport\Entities\FavouritePlaceIcon;
use Symfony\Component\Serializer\Normalizer\DenormalizerInterface;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;
use Symfony\Component\Serializer\Normalizer\SerializerAwareNormalizer;

class FavouritePlaceIconNormalizer extends SerializerAwareNormalizer implements NormalizerInterface, DenormalizerInterface
{
    public function normalize($object, $format = null, array $context = [])
    {
        return [
            'category' => $object->getCategory(),
            'label' => $object->getLabel(),
        ];
    }

    public function supportsNormalization($data, $format = null)
    {
        return is_a($data, 'Base\\Transport\\Entities\\FavouritePlaceIcon');
    }

    public function denormalize($data, $class, $format = null, array $context = [])
    {
        $icon = new FavouritePlaceIcon();
        $icon->setCategory($data['category']);
        $icon->setLabel($data['label']);
        return $icon;
    }

    public function supportsDenormalization($data, $type, $format = null)
    {
        return $type === 'Base\\Transport\\Entities\\FavouritePlaceIcon';
    }
}
