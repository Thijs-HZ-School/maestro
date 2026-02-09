<?php

namespace Framework;

use phpDocumentor\GraphViz\Exception;

class ServiceContainer
{
    /** @var array <class-string, object> */
    private array $instances = [];

    /**
     * @throws Exception
     */
    public function set(string $id, object $object): void {
        if (!isset($id)) {
            throw new Exception("$id is not real");
        }
        $this->instances[$id] = $object;
    }

    /**
     * @throws Exception
     */
    public function get(string $id): object {
        if (!isset($this->instances[$id])) {
            throw new Exception("$id does not exist");
        }
        return $this->instances[$id];
    }
}