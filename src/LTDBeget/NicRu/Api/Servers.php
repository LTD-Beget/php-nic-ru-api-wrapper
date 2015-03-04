<?php

namespace LTDBeget\NicRu\Api;

class Servers extends AbstractApi
{
    protected $type = "server";


    public function create(array $params)
    {
        return $this->post(array_merge([
            'request'   => 'server',
            'operation' => 'create',
        ], $params));
    }


    public function update(array $params)
    {
        return $this->post(array_merge([
            'request'   => 'server',
            'operation' => 'update',
        ], $params));
    }


    public function search(array $params)
    {
        return $this->post(array_merge([
            'request'   => 'server',
            'operation' => 'search',
        ], $params));
    }


    public function delete(array $params)
    {
        return $this->post(array_merge([
            'request'   => 'server',
            'operation' => 'delete',
        ], $params));
    }
}
