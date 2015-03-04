<?php

namespace LTDBeget\NicRu\Api;

class Services extends AbstractApi
{
    protected $type = "service";


    public function search(array $params)
    {
        return $this->post(array_merge([
            'request'   => 'service',
            'operation' => 'search',
        ], $params));
    }
}
