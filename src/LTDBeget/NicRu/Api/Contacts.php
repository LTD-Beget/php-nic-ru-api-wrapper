<?php

namespace LTDBeget\NicRu\Api;

class Contacts extends AbstractApi
{
    protected $type = "contact";


    public function create($params)
    {
        return $this->post(array_merge([
            'request'   => 'contact',
            'operation' => 'create',
        ], $params));
    }


    public function search($params)
    {
        return $this->post(array_merge([
            'request'   => 'contact',
            'operation' => 'search',
        ], $params));
    }


    public function update($params)
    {
        return $this->post(array_merge([
            'request'   => 'contact',
            'operation' => 'update',
        ], $params));
    }


    public function delete($params)
    {
        return $this->post(array_merge([
            'request'   => 'contact',
            'operation' => 'delete',
        ], $params));
    }
}
