<?php

namespace LTDBeget\NicRu\Model;

use LTDBeget\NicRu\Client;
use LTDBeget\NicRu\Exception\RuntimeException;

abstract class AbstractModel
{
    protected static $_properties;

    /**
     * @var array
     */
    protected $_data = [];

    /**
     * @var Client
     */
    protected $_client;


    /**
     * @return Client
     */
    public function getClient()
    {
        return $this->_client;
    }


    /**
     * @param Client $client
     *
     * @return $this
     */
    public function setClient(Client $client = null)
    {
        if (null !== $client) {
            $this->_client = $client;
        }

        return $this;
    }


    /**
     * @param $api
     *
     * @return \LTDBeget\NicRu\Api\ApiInterface
     */
    public function api($api)
    {
        return $this->getClient()->api($api);
    }


    /**
     * @param array $data
     *
     * @return $this
     */
    public function hydrate(array $data = [])
    {
        if (!empty($data)) {
            foreach ($data as $k => $v) {
                if (in_array($k, static::$_properties)) {
                    $this->$k = $v;
                }
            }
        }

        return $this;
    }


    /**
     * @param $property
     * @param $value
     */
    public function __set($property, $value)
    {
        if (!in_array($property, static::$_properties)) {
            throw new RuntimeException(sprintf(
                'Property "%s" does not exist for %s object', $property, get_called_class()
            ));
        }

        $this->_data[$property] = $value;
    }


    /**
     * @param $property
     *
     * @return null
     */
    public function __get($property)
    {
        if (!in_array($property, static::$_properties)) {
            throw new RuntimeException(sprintf(
                'Property "%s" does not exist for %s object',
                $property, get_called_class()
            ));
        }

        if (isset($this->_data[$property])) {
            return $this->_data[$property];
        }

        return null;
    }
}