<?php

namespace BigchainDB;

use Exception;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;

/**
 * Class Connection
 * @package BigchainDB
 */
class Connection
{
    /**
     * @var string $nodeUrl url to connect to
     */
    private $nodeUrl;
    private $headers;

    /**
     * Connection constructor.
     * @param string $node_url
     * @param array  $headers
     */
    public function __construct(string $node_url, array $headers = [])
    {
        $this->nodeUrl = $node_url;
        $this->headers = $headers;
    }

    /**
     * Send request
     *
     * @param string $method
     * @param string $path
     * @param array  $params
     * @return string
     * @throws \Exception
     */
    public function request(string $method = 'GET', string $path = null, array $params = []): string
    {
        if ($path) {
            $url = $this->nodeUrl . $path;
        } else {
            $url = $this->nodeUrl;
        }
        $client = new Client();

        $response = $client->request($method, $url, $params);

        if ($response->getStatusCode() !== 200) {
            throw new Exception('Request error');
        }
        try {
            $data = (string)$response->getBody();
        } catch (ClientException $exception) {
            return $exception->getMessage();
        }

        return $data;
    }

    /**
     * @return mixed
     */
    public function getNodeUrl()
    {
        return $this->nodeUrl;
    }

    /**
     * @param mixed $nodeUrl
     */
    public function setNodeUrl($nodeUrl)
    {
        $this->nodeUrl = $nodeUrl;
    }

    /**
     * @return mixed
     */
    public function getHeaders()
    {
        return $this->headers;
    }

    /**
     * @param mixed $headers
     */
    public function setHeaders($headers)
    {
        $this->headers = $headers;
    }

}