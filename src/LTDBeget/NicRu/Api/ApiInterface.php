<?php

namespace LTDBeget\NicRu\Api;

/**
 * Api interface
 *
 * @author Joseph Bielawski <stloyd@gmail.com>
 */
interface ApiInterface
{
    /**
     * @param array $params
     *
     * @return \LTDBeget\NicRu\Response
     */
    public function create(array $params);


    /**
     * @param array $params
     *
     * @return \LTDBeget\NicRu\Response
     */
    public function search(array $params);


    /**
     * @param array $params
     *
     * @return \LTDBeget\NicRu\Response
     */
    public function get(array $params);


    /**
     * @param array $params
     *
     * @return \LTDBeget\NicRu\Response
     */
    public function update(array $params);


    /**
     * @param array $params
     *
     * @return \LTDBeget\NicRu\Response
     */
    public function delete(array $params);
}
