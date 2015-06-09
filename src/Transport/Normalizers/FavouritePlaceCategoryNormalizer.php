<?php

namespace Base\Transport\Normalizers;

use Base\Transport\Entities\FavouritePlaceCategory;
use Symfony\Component\Serializer\Normalizer\DenormalizerInterface;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;
use Symfony\Component\Serializer\Normalizer\SerializerAwareNormalizer;

class FavouritePlaceCategoryNormalizer extends SerializerAwareNormalizer implements NormalizerInterface, DenormalizerInterface
{
    public function normalize($object, $format = null, array $context = [])
    {
        return [
            'id' => $object->getId(),
            'label' => $object->getLabel(),
        ];
    }

    public function supportsNormalization($data, $format = null)
    {
        return is_a($data, 'Base\\Transport\\Entities\\FavouritePlaceCategory');
    }

    public function denormalize($data, $class, $format = null, array $context = [])
    {
        $category = new FavouritePlaceCategory();
        $category->setId($data['id']);
        $category->setLabel($data['label']);
        return $category;
    }

    public function supportsDenormalization($data, $type, $format = null)
    {
        return $type === 'Base\\Transport\\Entities\\FavouritePlaceCategory';
    }
}
