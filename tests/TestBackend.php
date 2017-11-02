<?php

namespace Tests;

use Stick\Housekeeper\Backend\BackendInterface;
use Stick\Housekeeper\Backend\DataAlreadyExistsException;
use Stick\Housekeeper\Backend\DataNotFoundException;

/**
 * Class TestBackend
 * @package Tests
 */
class TestBackend implements BackendInterface
{

    /**
     * @var array
     */
    private $data;

    /**
     * @param string $type
     * @param string $key
     * @param string $data
     * @throws DataAlreadyExistsException
     * @return void
     */
    public function save(string $type, string $key, string $data) : void
    {
        if(isset($this->data[$type])) {
            if(isset($this->data[$type][$key])) {
                throw new DataAlreadyExistsException();
            } else {
                $this->data[$type][$key] = $data;
            }
        } else {
            $this->data[$type] = [];
            $this->data[$type][$key] = $data;
        }
    }

    /**
     * @param string $type
     * @param string $key
     * @throws DataNotFoundException
     * @return string
     */
    public function get(string $type, string $key) : string
    {
        if(isset($this->data[$type][$key])) {
            return $this->data[$type][$key];
        } else {
            throw new DataNotFoundException();
        }
    }

    /**
     * @param $type
     * @param $key
     * @throws DataNotFoundException
     */
    public function delete($type, $key) : void
    {
        unset($this->data[$type][$key]);
    }
}
