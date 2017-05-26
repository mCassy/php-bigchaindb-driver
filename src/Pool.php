<?php

namespace BigchainDB;

/**
 * Class Pool
 * @package BigchainDB
 */
class Pool
{
    /**
     * @var array Array of connection instances
     */
    private $connections;
    /**
     * @var string ClassName of picker class
     */
    private $pickerClass;

    /**
     * Pool constructor.
     * @param array $connections
     * @param string $pickerClass
     */
    public function __construct(array $connections, string $pickerClass = RoundRobinPicker::class)
    {
        $this->connections = $connections;
        $this->pickerClass = $pickerClass;
    }

    public function getConnection(){
        if(count($this->connections) > 1){
            return new $this->pickerClass->pick($this->connections);
        }
        return $this->connections[0];
    }

    /**
     * @return mixed
     */
    public function getConnections()
    {
        return $this->connections;
    }

    /**
     * @param mixed $connections
     */
    public function setConnections($connections)
    {
        $this->connections = $connections;
    }

    /**
     * @return mixed
     */
    public function getPickerClass()
    {
        return $this->pickerClass;
    }

    /**
     * @param mixed $pickerClass
     */
    public function setPickerClass($pickerClass)
    {
        $this->pickerClass = $pickerClass;
    }

}