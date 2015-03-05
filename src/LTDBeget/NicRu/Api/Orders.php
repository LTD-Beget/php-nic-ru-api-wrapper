<?php

namespace LTDBeget\NicRu\Api;

class Orders extends AbstractApi
{
    protected $type = "order-item";


    public function create(array $params)
    {
        return $this->post(array_merge([
            'request'   => 'order',
            'operation' => 'create',
        ], $params));
    }


    public function search(array $params)
    {
        return $this->post(array_merge([
            'request'   => 'order',
            'operation' => 'search',
        ], $params));
    }


    public function get(array $params)
    {
        return $this->post(array_merge([
            'request'   => 'order',
            'operation' => 'get',
        ], $params));
    }


    public function delete(array $params)
    {
        return $this->post(array_merge([
            'request'   => 'order',
            'operation' => 'delete',
        ], $params));
    }
}
