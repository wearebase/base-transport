<?php

namespace Base\Transport\Normalizers;

use Base\Transport\Entities\BusService;
use Symfony\Component\Serializer\Normalizer\DenormalizerInterface;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;
use Symfony\Component\Serializer\Normalizer\SerializerAwareNormalizer;

class BusServiceNormalizer extends SerializerAwareNormalizer implements NormalizerInterface, DenormalizerInterface
{
    public function normalize($object, $format = null, array $context = [])
    {
        /** @var BusService $object */
        return [
            'description' => $object->getDescription(),
            'id' => $object->getId(),
            'information' => $object->getInformation(),
            'lines' => $object->getLines(),
            'name' => $object->getName(),
            'operation' => $object->getOperation()
        ];
    }

    public function supportsNormalization($data, $format = null)
    {
        return is_a($data, 'Base\\Transport\\Entities\\BusService');
    }

    public function denormalize($data, $class, $format = null, array $context = [])
    {
        $busService = new BusService;
        $busService->setDescription($data['description']);
        $busService->setId($data['id']);
        $busService->setInformation($data['information']);
        $busService->setLines($data['lines']);
        $busService->setName($data['name']);
        $busService->setOperation($data['operation']);
        return $busService;
    }

    public function supportsDenormalization($data, $type, $format = null)
    {
        return $type === 'Base\\Transport\\Entities\\BusService';
    }
}
