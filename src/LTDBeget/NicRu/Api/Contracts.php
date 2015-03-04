<?php

namespace LTDBeget\NicRu\Api;

class Contracts extends AbstractApi
{
    protected $type = "contract";


    public function search(array $params)
    {
        return $this->post(array_merge([
            'request'   => 'contract',
            'operation' => 'search',
        ], $params));
    }


    public function get(array $params)
    {
        return $this->post(array_merge([
            'request'   => 'contract',
            'operation' => 'get',
        ], $params));
    }


    public function create(array $params)
    {
        return $this->post(array_merge([
            'request'   => 'contract',
            'operation' => 'create',
        ], $params));
    }


    public function update(array $params)
    {
        return $this->post(array_merge([
            'request'   => 'contract',
            'operation' => 'update',
        ], $params));
    }
}
