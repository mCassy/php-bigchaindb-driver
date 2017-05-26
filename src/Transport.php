<?php

namespace BigchainDB;

/**
 * Class Transport
 * @package BigchainDB
 */
class Transport
{
    /**
     * @var $nodes Nodes
     */
    private $nodes;
    /**
     * @var $headers Optional headers to connection instances,
     * which will add it to headers to be sent with request.
     */
    private $headers;
    /**
     * @var $pool Pool of Connections
     */
    private $pool;

    /**
     * Transport constructor.
     * @param $nodes
     * @param array $headers
     */
    public function __construct($nodes, $headers = [])
    {
        $this->headers = $headers;
        $this->nodes = $nodes;
    }

    /**
     * Initialize pool of connections
     * @return $this
     */
    public function initPool()
    {
        $connections = [];
        foreach ($this->nodes as $node) {
            $connections[] = new Connection($node, $this->headers);
        }
        $this->pool = new Pool($connections);

        return $this;
    }

    /**
     * Forwards an http request to a connection
     * @param string $method
     * @param null $path
     * @param array $params
     * @return mixed
     */
    public function forwardRequest($method = 'GET', $path = null, $params = [])
    {
        $connection = $this->getConnection();
        $result = $connection->request($method, $path, $params);
        return $result;
    }

    /**
     * Returns connection from the pool
     * @return mixed
     */
    public function getConnection()
    {
        return $this->pool->getConnection();
    }

    /**
     * @return Optional
     */
    public function getHeaders(): Optional
    {
        return $this->headers;
    }

    /**
     * @param Optional $headers
     */
    public function setHeaders(Optional $headers)
    {
        $this->headers = $headers;
    }

    /**
     * @return Nodes
     */
    public function getNodes(): Nodes
    {
        return $this->nodes;
    }

    /**
     * @param Nodes $nodes
     */
    public function setNodes(Nodes $nodes)
    {
        $this->nodes = $nodes;
    }

}