<?php

namespace BigchainDB;

/**
 * Class Transport
 * @package BigchainDB
 */
class Transport
{
    /**
     * @var $nodes
     */
    private $nodes;
    /**
     * @var array $headers Optional headers to connection instances,
     * which will add it to headers to be sent with request.
     */
    private $headers;
    /**
     * @var $pool Pool of Connections
     */
    private $pool;

    /**
     * Transport constructor.
     * @param       $nodes
     * @param array $headers
     */
    public function __construct(array $nodes, array $headers = [])
    {
        $this->headers = $headers;
        $this->nodes   = $nodes;
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
     * @param string      $method
     * @param null|string $path
     * @param array       $params
     * @return mixed
     * @throws \Exception
     */
    public function forwardRequest(string $method = 'GET', string $path = null, array $params = [])
    {
        $connection = $this->getConnection();

        return $connection->request($method, $path, $params);
    }

    /**
     * Returns connection from the pool
     * @return mixed
     */
    public function getConnection(): Connection
    {
        return $this->pool->getConnection();
    }

    /**
     * @return array
     */
    public function getHeaders(): array
    {
        return $this->headers;
    }

    /**
     * @param array $headers
     */
    public function setHeaders(array $headers)
    {
        $this->headers = $headers;
    }

    /**
     * @return array
     */
    public function getNodes(): array
    {
        return $this->nodes;
    }

    /**
     * @param array $nodes
     */
    public function setNodes(array $nodes)
    {
        $this->nodes = $nodes;
    }

}