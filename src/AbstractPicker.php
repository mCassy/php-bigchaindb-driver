<?php

namespace BigchainDB;

/**
 * Class AbstractPicker
 * @package BigchainDB
 */
abstract class AbstractPicker
{
    /**
     *Pick one of Connections array
     * @param array $connections
     * @return mixed
     */
    abstract public function pick(array $connections);
}