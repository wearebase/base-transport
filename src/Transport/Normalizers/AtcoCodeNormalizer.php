<?php

namespace Base\Transport\Normalizers;

use Base\Transport\Entities\AtcoCode;

use Symfony\Component\Serializer\Normalizer\NormalizerInterface;
use Symfony\Component\Serializer\Normalizer\DenormalizerInterface;
use Symfony\Component\Serializer\Normalizer\SerializerAwareNormalizer;

class AtcoCodeNormalizer extends SerializerAwareNormalizer implements NormalizerInterface, DenormalizerInterface
{
    public function normalize($object, $format = null, array $context = [])
    {
        return (string) $object;
    }

    public function supportsNormalization($data, $format = null)
    {
        return is_a($data, 'Base\\Transport\\Entities\\AtcoCode');
    }

    public function denormalize($data, $class, $format = null, array $context = [])
    {
        return new AtcoCode($data);
    }

    public function supportsDenormalization($data, $type, $format = null)
    {
        return $type === 'Base\\Transport\\Entities\\AtcoCode';
    }
}
