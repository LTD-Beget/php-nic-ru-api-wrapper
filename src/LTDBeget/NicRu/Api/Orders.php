<?php

namespace LTDBeget\NicRu\Api;

class Orders extends AbstractApi
{
    protected $type = "order";


    public function create($params)
    {
        return $this->post(array_merge([
            'request'   => 'order',
            'operation' => 'create',
        ], $params));
    }


    public function search($params)
    {
        return $this->post(array_merge([
            'request'   => 'order',
            'operation' => 'search',
        ], $params));
    }


    public function get($params)
    {
        return $this->post(array_merge([
            'request'   => 'order',
            'operation' => 'get',
        ], $params));
    }


    public function delete($params)
    {
        return $this->post(array_merge([
            'request'   => 'order',
            'operation' => 'delete',
        ], $params));
    }
}
