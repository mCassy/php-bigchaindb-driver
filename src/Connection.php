<?php
namespace BigchainDB;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\BadResponseException;
use GuzzleHttp\Exception\ClientException;

/**
 * Class Connection
 * @package BigchainDB
 */
class Connection
{
    /**
     * @var $nodeUrl Node url to connect to
     */
    private $nodeUrl;
    private $headers;

    /**
     * Connection constructor.
     * @param $node_url
     * @param array $headers
     */
    public function __construct($node_url, $headers = [])
    {
        $this->nodeUrl;
        $this->headers = $headers;
    }

    /**
     * Send request
     *
     * @param string $method
     * @param string $path
     * @param array $params
     * @return string
     */
    public function request($method = 'GET', $path = null, $params = [])
    {
        if($path){
            $url = $this->nodeUrl . $path;
        }else{
            $url = $this->nodeUrl;
        }
        $client = new Client();

        $response = $client->request($method, $url, $params);
        if($response->getStatusCode() !== 200){
            throw new BadResponseException();
        }
        try{
            $data = (string)$response->getBody();
        }catch (ClientException $exception){
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