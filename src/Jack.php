<?php

namespace Stick\Housekeeper;

use Stick\Housekeeper\Backend\DataNotFoundException;
use Stick\Service\EntityInterface;
use Stick\Service\MetadataObject;

/**
 * Class Jack
 * @package Stick\Housekeeper
 */
class Jack extends Clive
{

    /**
     * @param $type
     * @param $key
     * @return EntityInterface
     * @throws ObjectOfWrongTypeException
     */
    public function getEntity($type, $key): EntityInterface
    {
        $instance = $this->getObject($type, $key);
        if($instance instanceof EntityInterface) {
            try {
                /**
                 * @var $meta MetadataObject
                 */
                $meta = $this->getObject('metadata', $type . '.' . $key);
            } catch(DataNotFoundException $e) {
                $meta = null;
            }
            $instance->setMetadata($meta);
        } else {
            throw new ObjectOfWrongTypeException();
        }
        return $instance;
    }

    /**
     * @param string $type
     * @param string $key
     * @param EntityInterface $entity
     */
    public function saveEntity(string $type, string $key, EntityInterface $entity): void
    {
        $this->saveObject($type, $key, $entity);
        $this->saveObject('metadata', $type . '.' . $key, $entity->getMetadata());
    }
}
