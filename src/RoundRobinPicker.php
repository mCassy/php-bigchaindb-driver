<?php

namespace BigchainDB;

/**
 * Class RoundRobinPicker
 * @package BigchainDB
 */
class RoundRobinPicker extends AbstractPicker
{
    /**
     * @var int index of picked connection
     */
    private $picked;

    /**
     * RoundRobinPicker constructor.
     */
    public function __construct()
    {
        $this->picked = -1;
    }

    /**
     *Pick one of Connections array
     * @param  $connections Array of Connection objects
     * @return mixed
     */
    function pick($connections)
    {
        $this->picked += 1;
        $this->picked = $this->picked % count($connections);
        return $connections[$this->picked];
    }
}