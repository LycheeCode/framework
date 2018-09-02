<?php

/**
 * 响应数据
 * 
 * @package Lychee
 */

namespace Lychee;

class Response
{
    /**
     * HTTP Response Headers
     *
     * @var array
     */
    private $headers = [];

    /**
     * HTTP Response Body
     *
     * @var string
     */
    private $body = "";

    /**
     * 设置消息体
     *
     * @param object $msg
     * @return void
     */
    public function setMsg($msg)
    {
        $this->body = $msg->toXML();
        $this->headers['Content-Type'] = 'text/xml; charset=UTF-8';
    }

    /**
     * 设置 raw body
     *
     * @param string $raw
     * @return void
     */
    public function setRawBody($raw)
    {
        $this->body = $raw;
        $this->headers['Content-Type'] = 'text/plain; charset=UTF-8';
    }

    // TODO: 设置 header 方法

    /**
     * 发送响应
     *
     * @return void
     */
    public function send()
    {
        foreach ($this->headers as $key => $value) {
            header("{$key}: $value", true);
        }
        echo $this->body;
    }
}