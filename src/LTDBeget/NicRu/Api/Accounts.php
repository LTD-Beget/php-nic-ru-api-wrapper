<?php

namespace LTDBeget\NicRu\Api;

class Accounts extends AbstractApi
{
    protected $type = "account";


    public function get(array $params)
    {
        return $this->post(array_merge([
            'request'   => 'account',
            'operation' => 'get',
        ], $params));
    }
}
