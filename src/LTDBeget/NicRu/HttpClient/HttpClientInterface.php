<?php

namespace LTDBeget\NicRu\HttpClient;

use LTDBeget\NicRu\Exception\InvalidArgumentException;

/**
 * Performs requests on Nic API. API documentation should be self-explanatory.
 *
 * @author Joseph Bielawski <stloyd@gmail.com>
 */
interface HttpClientInterface
{
    /**
     * Send a GET request
     *
     * @param string $path Request path
     * @param array $parameters GET Parameters
     * @param array $headers Reconfigure the request headers for this call only
     *
     * @return array Data
     */
    public function get($path, array $parameters = [], array $headers = []);


    /**
     * Send a POST request
     *
     * @param string $path Request path
     * @param array $parameters POST Parameters
     * @param array $headers Reconfigure the request headers for this call only
     *
     * @return array Data
     */
    public function post($path, array $parameters = [], array $headers = []);


    /**
     * Send a PATCH request
     *
     * @param string $path Request path
     * @param array $parameters PATCH Parameters
     * @param array $headers Reconfigure the request headers for this call only
     *
     * @return array Data
     */
    public function patch($path, array $parameters = [], array $headers = []);


    /**
     * Send a PUT request
     *
     * @param string $path Request path
     * @param array $parameters PUT Parameters
     * @param array $headers Reconfigure the request headers for this call only
     *
     * @return array Data
     */
    public function put($path, array $parameters = [], array $headers = []);


    /**
     * Send a DELETE request
     *
     * @param string $path Request path
     * @param array $parameters DELETE Parameters
     * @param array $headers Reconfigure the request headers for this call only
     *
     * @return array Data
     */
    public function delete($path, array $parameters = [], array $headers = []);


    /**
     * Send a request to the server, receive a response,
     * decode the response and returns an associative array
     *
     * @param string $path Request API path
     * @param array $parameters Parameters
     * @param string $httpMethod HTTP method to use
     * @param array $headers Request headers
     *
     * @return array Data
     */
    public function request($path, array $parameters = [], $httpMethod = 'GET', array $headers = []);


    /**
     * Change an option value.
     *
     * @param string $name The option name
     * @param mixed $value The value
     *
     * @throws InvalidArgumentException
     */
    public function setOption($name, $value);


    /**
     * Set HTTP headers
     *
     * @param array $headers
     */
    public function setHeaders(array $headers);
}
