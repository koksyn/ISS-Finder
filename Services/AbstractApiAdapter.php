<?php

namespace Services;

use Engine\Configuration\Config;
use GuzzleHttp\Psr7\Response;
use GuzzleHttp\Client;

abstract class AbstractApiAdapter
{
    /** @var Client $client */
    private $client;
    /** @var string $baseUrl */
    private $baseUrl;

    /**
     * @param string $endpoint
     * @return string
     */
    abstract protected function generateUrl(string $endpoint): string;

    /**
     * @param string $endpoint
     */
    public function init(string $endpoint = '')
    {
        $baseUrl = $this->generateUrl($endpoint);
        $this->setBaseUrl($baseUrl);
        $this->createClient();
    }

    /**
     * @param string $baseUrl
     */
    private function setBaseUrl(string $baseUrl)
    {
        $this->baseUrl = $baseUrl;
    }

    private function createClient()
    {
        $this->client = new Client([
            'base_uri' => $this->baseUrl,
            'timeout'  => Config::get('apiMaxTimeout'),
        ]);
    }

    /**
     * @param array $params
     * @return bool|string
     */
    public function getFromParams(array $params)
    {
        return $this->get('', $params);
    }

    /**
     * @param string $url
     * @param array $params
     * @return bool|string
     */
    public function get(string $url = '', array $params = [])
    {
        $this->validateClient();

        /** @var array $queryOption */
        $queryOption = $this->generateQueryOption($params);

        /** @var Response $response */
        $response = $this->client->get($url, $queryOption);

        return json_decode($response->getBody());
    }

    /**
     * @throws \Exception
     */
    private function validateClient()
    {
        if(empty($this->client)) {
            throw new \Exception('Cannot call api, because Api adapter is not initialized.');
        }
    }

    /**
     * @param array $params
     * @return array
     */
    private function generateQueryOption(array $params)
    {
        /** @var array $queryOption */
        $queryOption = [];

        if(!empty($params)) {
            $queryOption['query'] = $params;
        }

        return $queryOption;
    }
}