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
     * @param array $connections
     * @return mixed
     */
    public function pick(array $connections)
    {
        ++$this->picked;
        $this->picked %= count($connections);

        return $connections[$this->picked];
    }
}