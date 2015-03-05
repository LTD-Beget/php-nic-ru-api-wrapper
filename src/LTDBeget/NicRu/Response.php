<?php
/**
 * Wrap for HTTP client response
 *
 * @author Kolesnikov Vladislav
 * @date 04.03.15
 */

namespace LTDBeget\NicRu;


use LTDBeget\NicRu\Exception\ResponseException;

class Response
{
    /**
     * @var \Buzz\Message\Response
     */
    protected $response;

    /**
     * @var int
     */
    protected $state;

    /**
     * @var string
     */
    protected $stateMessage;


    /**
     * @var bool
     */
    protected $isParsed = false;

    /**
     * @var string
     */
    protected $requestId;

    /**
     * @var string[]
     */
    protected $errors = [];

    /**
     * @var string[][]
     */
    protected $body = [];


    /**
     * @param \Buzz\Message\Response $response
     */
    public function __construct(\Buzz\Message\Response $response)
    {
        $this->response = $response;

        $this->parse();
    }


    /**
     * Parse nic.ru api response
     */
    protected function parse()
    {
        if ($this->isParsed) {
            return;
        }

        if ($this->response->isServerError()) {
            throw new ResponseException("nic.ru server error");
        }

        $contentType = $this->response->getHeader("Content-Type");

        if ($contentType !== "text/plain") {
            throw new ResponseException("Incorrect Content-Type of response: {$contentType}");
        }

        if (!$this->response->isOk()) {
            throw new ResponseException("Incorrect response code: {$this->response->getStatusCode()}");
        }

        $content      = $this->getRawContent();
        $contentParts = explode("\r\n\r\n", $content);

        if (empty($contentParts)) {
            throw new ResponseException("Incorrect response: {$content}");
        }

        if (count($contentParts) == 0) {
            throw new ResponseException("Response header is empty!");
        }

        $this->parseHeader(trim($contentParts[0]));
        $this->parseBody(trim($contentParts[1]));

        $this->isParsed = true;
    }


    /**
     * Parse nic.ru api response header
     * Format is:
     *   State: <code> <description>
     *   request-id: <request-id>
     *
     * @param $header
     */
    protected function parseHeader($header)
    {
        if ($this->isParsed) {
            return;
        }

        $headerParts = explode("\n", $header);

        if (count($headerParts) != 2) {
            throw new ResponseException("Response header must contain 2 lines! Given: {$header}");
        }

        // Parsing State
        $stateParts = $this->parseLine($headerParts[0]);

        if (!$stateParts || $stateParts[0] != "State") {
            throw new ResponseException("Cannot parse a State field in response header");
        }

        $this->state        = (int)substr($stateParts[1], 0, 3);
        $this->stateMessage = substr($stateParts[1], 4);

        // Parsing request-id
        $requestIdParts = $this->parseLine($headerParts[1]);

        if (!$requestIdParts || $requestIdParts[0] != "request-id") {
            throw new ResponseException("Cannot parse a reqeust-id field in response header");
        }

        $this->requestId = $requestIdParts[1];
    }


    /**
     * @param $line
     *
     * @return string[]|null
     */
    protected function parseLine($line)
    {
        $lineParts = explode(":", trim($line), 2);

        if (count($lineParts) != 2) {
            return null;
        }

        return [trim($lineParts[0]), trim($lineParts[1])];
    }


    /**
     * Parse nic.ru api response body
     *
     * @param $body
     */
    protected function parseBody($body)
    {
        if ($this->isParsed) {
            return;
        }

        if ($this->isSuccess()) {
            $bodyLines = explode("\n", $body);

            foreach ($bodyLines as $line) {
                if(empty($line) || $line[0] == "[") {
                    continue;
                }

                $lineParts = $this->parseLine($line);

                if (!$lineParts) {
                    continue;
                }

                list($key, $value) = $lineParts;

                if (!isset($this->body[$key])) {
                    $this->body[$key] = [];
                }

                $this->body[$key][] = $value;
            }
        } elseif ($this->getState() === 402) {
            $bodyLines = explode("\n", $body);

            if ($bodyLines[0] != "[errors]") {
                return;
            }

            unset($bodyLines[0]);

            foreach ($bodyLines as $errorLine) {
                $errorLine = trim($errorLine);

                if ($errorLine) {
                    $this->errors[] = $errorLine;
                }
            }
        }
    }


    /**
     * Return the raw response content
     * @return string
     */
    public function getRawContent()
    {
        return iconv('KOI8-R', 'UTF-8', $this->response->getContent());
    }


    /**
     * @return bool
     */
    public function isSuccess()
    {
        return $this->getState() === 200;
    }


    /**
     * @return int
     */
    public function getState()
    {
        return $this->state;
    }


    /**
     * @return bool
     */
    public function hasErrors()
    {
        return count($this->errors) > 0;
    }


    /**
     * @return \string[]
     */
    public function getErrors()
    {
        return $this->errors;
    }


    /**
     * Return body parameter by key
     * @param $key
     * @param null $defaultValue
     *
     * @return null|string
     */
    public function getBodyParam($key, $defaultValue = null)
    {
        if (!isset($this->body[$key])) {
            return $defaultValue;
        }

        return implode("\n", $this->body[$key]);
    }


    /**
     * Return all parsed body
     * @return \string[][]
     */
    public function getBody()
    {
        return $this->body;
    }


    /**
     * @return string
     */
    public function getStateMessage()
    {
        return $this->stateMessage;
    }


    /**
     * @return string
     */
    public function getRequestId()
    {
        return $this->requestId;
    }
}