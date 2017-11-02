<?php

namespace Stick\Housekeeper\Backend;

/**
 * Interface BackendInterface; low-level
 * @package Stick\Housekeeper\Backend
 */
interface BackendInterface
{
    /**
     * @param string $type
     * @param string $key
     * @param string $data
     * @throws DataAlreadyExistsException
     * @return void
     */
    public function save(string $type, string $key, string $data): void;

    /**
     * @param string $type
     * @param string $key
     * @throws DataNotFoundException
     * @return string
     */
    public function get(string $type, string $key): string;

    /**
     * @param $type
     * @param $key
     * @throws DataNotFoundException
     */
    public function delete($type, $key): void;
}
