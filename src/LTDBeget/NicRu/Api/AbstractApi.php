<?php

namespace LTDBeget\NicRu\Api;

use LTDBeget\NicRu\Client;
use LTDBeget\NicRu\Exception\NotImplementedException;

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
     * @inheritDoc
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

            $param = explode("\n", $param);
            foreach ($param as $multi_line_param) {
                $content .= $key . ":" . $multi_line_param . "\n";
            }
        }

        $content = iconv('UTF-8', 'KOI8-R//TRANSLIT', $content);
        $content = [
            'SimpleRequest' => $content,
        ];

        $response = $this->client->getHttpClient()->post('', $content, $requestHeaders);

        return $response;
    }


    /**
     * {@inheritDoc}
     */
    protected function patch(array $parameters = [], $requestHeaders = [])
    {
        return $this->client->getHttpClient()->patch('', $parameters, $requestHeaders);
    }


    /**
     * {@inheritDoc}
     */
    protected function put(array $parameters = [], $requestHeaders = [])
    {
        return $this->client->getHttpClient()->put('', $parameters, $requestHeaders);
    }


    /**
     * @param array $params
     *
     * @return \LTDBeget\NicRu\Response
     * @throws NotImplementedException
     */
    public function create(array $params)
    {
        throw new NotImplementedException("Method 'create' is not implemented for this API");
    }


    /**
     * @param array $params
     *
     * @return \LTDBeget\NicRu\Response
     * @throws NotImplementedException
     */
    public function search(array $params)
    {
        throw new NotImplementedException("Method 'search' is not implemented for this API");
    }


    /**
     * @param array $params
     *
     * @return \LTDBeget\NicRu\Response
     * @throws NotImplementedException
     */
    public function update(array $params)
    {
        throw new NotImplementedException("Method 'update' is not implemented for this API");
    }


    /**
     * @param array $params
     *
     * @return \LTDBeget\NicRu\Response
     * @throws NotImplementedException
     */
    public function get(array $params)
    {
        throw new NotImplementedException("Method 'get' is not implemented for this API");
    }


    /**
     * @param array $params
     *
     * @return \LTDBeget\NicRu\Response
     * @throws NotImplementedException
     */
    public function delete(array $params)
    {
        throw new NotImplementedException("Method 'delete' is not implemented for this API");
    }
}
