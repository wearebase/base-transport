<?php

namespace Base\Transport\Normalizers;

use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;
use Symfony\Component\Serializer\Normalizer\DenormalizerInterface;
use Symfony\Component\Serializer\Normalizer\SerializerAwareNormalizer;

class TransportNormalizer extends SerializerAwareNormalizer implements NormalizerInterface, DenormalizerInterface
{
    protected $normalizers = [];

    public function __construct()
    {
        $this->normalizers[] = new FavouritePlaceNormalizer();
        $this->normalizers[] = new FavouritePlaceCategoryNormalizer();
        $this->normalizers[] = new StopNormalizer();
        $this->normalizers[] = new AtcoCodeNormalizer();
    }

    public function setSerializer(SerializerInterface $serializer)
    {
        $this->serializer = $serializer;

        foreach ($this->normalizers as $normalizer) {
            if (is_a($normalizer, 'Symfony\\Component\\Serializer\\Normalizer\\SerializerAwareNormalizer')) {
                $normalizer->setSerializer($serializer);
            }
        }
    }

    public function normalize($object, $format = null, array $context = [])
    {
        foreach ($this->normalizers as $normalizer) {
            if ($normalizer->supportsNormalization($object, $format)) {
                return $normalizer->normalize($object, $format, $context);
            }
        }

        throw new \Exception('No valid sub-normalizer found');
    }

    public function supportsNormalization($data, $format = null)
    {
        foreach ($this->normalizers as $normalizer) {
            if ($normalizer->supportsNormalization($data, $format)) {
                return true;
            }
        }

        return false;
    }

    public function denormalize($data, $class, $format = null, array $context = [])
    {
        foreach ($this->normalizers as $normalizer) {
            if ($normalizer->supportsDenormalization($data, $class, $format)) {
                return $normalizer->denormalize($data, $class, $format, $context);
            }
        }

        throw new \Exception('No valid sub-normalizer found');
    }

    public function supportsDenormalization($data, $type, $format = null)
    {
        foreach ($this->normalizers as $normalizer) {
            if ($normalizer->supportsDenormalization($data, $type, $format)) {
                return true;
            }
        }

        return false;
    }
}
