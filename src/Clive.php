<?php

namespace Stick\Housekeeper;

use Stick\Housekeeper\Backend\BackendInterface;
use Stick\Service\DataObjectInterface;

/**
 * Clive: A nice and friendly housekeeper!
 *
 * @package Stick\Housekeeper
 */
class Clive
{
    /**
     * @var BackendInterface
     */
    private $backend;

    /**
     * @var array
     */
    private $registry;

    /**
     * Clive constructor.
     * @param BackendInterface $backend
     */
    public function __construct(BackendInterface $backend)
    {
        $this->backend = $backend;
        $this->registry = [];
    }

    /**
     * @param string $type
     * @param string $dataObject
     */
    public function associate(string $type, string $dataObject)
    {
        $this->registry[$type] = $dataObject;
    }

    /**
     * @param string $type
     * @param string $key
     * @return DataObjectInterface
     * @throws TypeNotDefinedException
     */
    public function getObject(string $type, string $key): DataObjectInterface
    {
        $objectData = unserialize($this->backend->get($type, $key));
        if(isset($this->registry[$type])) {
            $class = $this->registry[$type];
        } else {
            throw new TypeNotDefinedException('type of ' . $type . ' is not defined!');
        }
        $instance = new $class;
        /**
         * @var $instance DataObjectInterface
         */
        $instance->setData($objectData);
        return $instance;
    }

    /**
     * @param string $type
     * @param string $key
     * @param DataObjectInterface $object
     */
    public function saveObject(string $type, string $key, DataObjectInterface $object)
    {
        $this->backend->save($type, $key, serialize($object->getData()));
    }

    /**
     * @param string $type
     * @param string $key
     */
    public function delete(string $type, string $key): void
    {
        $this->backend->delete($type, $key);
    }
}
