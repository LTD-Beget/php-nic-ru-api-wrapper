<?php

namespace LTDBeget\NicRu\Api;

class Contracts extends AbstractApi
{
    protected $type = "contract";


    public function search($params)
    {
        return $this->post(array_merge([
            'request'   => 'contract',
            'operation' => 'search',
        ], $params));
    }


    public function get($params)
    {
        return $this->post(array_merge([
            'request'   => 'contract',
            'operation' => 'get',
        ], $params));
    }


    public function create($params)
    {
        return $this->post(array_merge([
            'request'   => 'contract',
            'operation' => 'create',
        ], $params));
    }


    public function update($params)
    {
        return $this->post(array_merge([
            'request'   => 'contract',
            'operation' => 'update',
        ], $params));
    }
}
