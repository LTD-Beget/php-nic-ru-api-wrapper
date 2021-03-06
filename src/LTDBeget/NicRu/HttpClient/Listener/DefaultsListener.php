<?php

namespace LTDBeget\NicRu\HttpClient\Listener;

use LTDBeget\NicRu\Exception\InvalidArgumentException;

use Buzz\Listener\ListenerInterface;
use Buzz\Message\MessageInterface;
use Buzz\Message\RequestInterface;

/**
 * @author Joseph Bielawski <stloyd@gmail.com>
 */
class DefaultsListener implements ListenerInterface
{
    /**
     * @var array
     */
    private $options;


    /**
     * @param array $options
     */
    public function __construct($options)
    {
        $this->options = $options;
    }


    /**
     * {@inheritDoc}
     *
     * @throws InvalidArgumentException
     */
    public function preSend(RequestInterface $request)
    {
        $parameters = $this->options;

        $content_out = "";

        foreach ($parameters as $key => $param) {
            $content_out .= $key . ":" . $param;
            $content_out .= "\n";
        }

        $content = $request->getContent();
        parse_str($content, $content);
        $content = $content['SimpleRequest'];
        $content = iconv('KOI8-R', 'UTF-8', $content);

        $content = $content_out . $content;

        $content = iconv('UTF-8', 'KOI8-R', $content);
        $content = [
            'SimpleRequest' => $content,
        ];

        $request->setContent(http_build_query($content));
    }


    /**
     * {@inheritDoc}
     */
    public function postSend(RequestInterface $request, MessageInterface $response)
    {
    }
}
