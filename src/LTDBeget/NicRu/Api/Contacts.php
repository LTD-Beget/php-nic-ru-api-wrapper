<?php

namespace LTDBeget\NicRu\Api;

class Contacts extends AbstractApi
{
    protected $type = "contact";


    public function create(array $params)
    {
        return $this->post(array_merge([
            'request'   => 'contact',
            'operation' => 'create',
        ], $params));
    }


    public function search(array $params)
    {
        return $this->post(array_merge([
            'request'   => 'contact',
            'operation' => 'search',
        ], $params));
    }


    public function update(array $params)
    {
        return $this->post(array_merge([
            'request'   => 'contact',
            'operation' => 'update',
        ], $params));
    }


    public function delete(array $params)
    {
        return $this->post(array_merge([
            'request'   => 'contact',
            'operation' => 'delete',
        ], $params));
    }
}
