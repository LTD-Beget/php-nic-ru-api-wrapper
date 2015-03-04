<?php

namespace LTDBeget\NicRu\Api;

class ServiceObjects extends AbstractApi
{
    protected $type = "service";


    public function search(array $params)
    {
        return $this->post(array_merge([
            'request'   => 'service-object',
            'operation' => 'search',
        ], $params));
    }
}
