<?php

declare(strict_types=1);

namespace App\UI\Controller\EasyAdmin\Traits;

use Symfony\Component\Serializer\SerializerInterface;

trait UtilsAdminTrait
{
    /**
     * @var SerializerInterface
     */
    private $serializer;

    /**
     * @var object
     */
    private $oldEntity;

    /**
     * @var string
     */
    private $serializeFormat = 'json';

    /**
     * @param object $entity
     * @return string
     * @throws \Symfony\Component\Serializer\Exception\ExceptionInterface
     */
    private function serializeEntity(object $entity): string
    {
        $arrayEntity = $this->serializer->normalize($entity, $this->serializeFormat);
        return json_encode($this->normalizeData($arrayEntity));
    }

    /**
     * @param $data
     * @param int $depth
     * @return array
     */
    private function normalizeData($data, $depth = 2): array
    {
        $result = [];

        array_walk($data, function($item, $key) use(&$result, $depth) {
            if (is_string($key) && is_array($item) && $depth <= 1) {
                return false;
            }

            if ($key === 'roles' && is_array($item)) {
                $item = implode('', $item);
            }

            $result[$key] = is_array($item) ? $this->normalizeData($item, --$depth) : $item;
        });

        return $result;
    }

    /**
     * @param $jsonEntity
     * @param $className
     * @return object|null
     */
    private function unserializeEntity($jsonEntity, $className): ?object
    {
        if (empty(json_decode($jsonEntity))) {
            return null;
        }

        return $this
            ->serializer
            ->deserialize($jsonEntity, $className, 'json');
    }

    /**
     * @param $namespace
     * @return string
     */
    private function getClassNameFromNamespace($namespace): string
    {
        $entityName = explode('\\', $namespace);
        return array_pop($entityName);
    }

    /**
     * @param $newEntity
     * @return false|object
     */
    private function getOldEntity($newEntity)
    {
        return $this->oldEntity == $newEntity
            ? false
            : $this->oldEntity;
    }

    /**
     * @return array
     */
    private function getEasyAdminAttribute(): array
    {
        return $this->request->attributes->get('easyadmin');
    }

    /**
     * saving previous entity state because late we can`t compare them
     */
    private function savePreviousEntityState()
    {
        $easyadmin = $this->getEasyAdminAttribute();
        $this->oldEntity = clone $easyadmin['item'];
    }
}