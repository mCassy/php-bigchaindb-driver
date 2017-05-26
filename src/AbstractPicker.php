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
     * @param  $connections Array of Connection objects
     * @return mixed
     */
    abstract function pick($connections);
}