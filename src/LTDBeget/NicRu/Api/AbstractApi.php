<?php

namespace LTDBeget\NicRu\Api;

use LTDBeget\NicRu\Client;

/**
 * Abstract class for Api classes
 *
 * @author Joseph Bielawski <stloyd@gmail.com>
 */
abstract class AbstractApi implements ApiInterface
{
    protected $type = "";
    /**
     * Default entries per page
     */
    const PER_PAGE = 20;

    /**
     * The client
     *
     * @var Client
     */
    protected $client;


    /**
     * @param Client $client
     */
    public function __construct(Client $client)
    {
        $this->client = $client;
    }


    public function configure()
    {
    }


    /**
     * {@inheritDoc}
     */
    protected function get(array $parameters = [], $requestHeaders = [])
    {
        $response = $this->client->getHttpClient()->get('', $parameters, $requestHeaders);

        return $response->getContent();
    }


    /**
     * {@inheritDoc}
     */
    protected function post(array $parameters = [], $requestHeaders = [])
    {
        $content = "";
        $first   = true;
        if (isset($parameters['request'])) {
            $content .= "request:" . $parameters['request'] . "\n";
            unset($parameters['request']);
        }
        if (isset($parameters['operation'])) {
            $content .= "operation:" . $parameters['operation'] . "\n";
            unset($parameters['operation']);
        }
        if (isset($parameters['subject-contract'])) {
            $content .= "subject-contract:" . $parameters['subject-contract'] . "\n";
            unset($parameters['subject-contract']);
        }
        if ($content !== "") {
            $content .= "\n";
        }

        if (count($parameters) > 0) {
            $content .= "[" . $this->type . "]\n";
        }
        foreach ($parameters as $key => $param) {
            if (!$first) {
                $content .= "\n";
            } else {
                $first = false;
            }

            if(is_array($param)) {
                foreach($param as $multi_line_param) {
                    $content .= $key . ":" . $multi_line_param;
                }
            } else {
                $content .= $key . ":" . $param;
            }
        }
        $content = iconv('UTF-8', 'KOI8-R', $content);
        $content = [
            'SimpleRequest' => $content,
        ];

        $response = $this->client->getHttpClient()->post('', $content, $requestHeaders);

        return $response->getArrayContent();
    }


    /**
     * {@inheritDoc}
     */
    protected function patch(array $parameters = [], $requestHeaders = [])
    {
        $response = $this->client->getHttpClient()->patch('', $parameters, $requestHeaders);

        return $response->getContent();
    }


    /**
     * {@inheritDoc}
     */
    protected function put(array $parameters = [], $requestHeaders = [])
    {
        $response = $this->client->getHttpClient()->put('', $parameters, $requestHeaders);

        return $response->getContent();
    }


    /**
     * {@inheritDoc}
     */
    protected function delete(array $parameters = [], $requestHeaders = [])
    {
        $response = $this->client->getHttpClient()->delete('', $parameters, $requestHeaders);

        return $response->getContent();
    }
}
