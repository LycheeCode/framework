<?php

/**
 * 微信请求
 * 
 * @package Lychee
 */

namespace Lychee;

use Lychee\Message\Auto;

class Request
{
    /**
     * 是否是消息包体请求
     *
     * @var boolean
     */
    private $isMsg = false;

    /**
     * 消息包体
     *
     * @var object
     */
    private $msg;

    /**
     * 是否为微信验证请求
     *
     * @var boolean
     */
    private $isValidation = false;

    /**
     * 校验数据
     *
     * @var array
     */
    private $validData = [];

    public function captrue()
    {
        $method =  strtoupper($_SERVER['REQUEST_METHOD']);

        $valids = ['signature', 'timestamp', 'nonce'];
        foreach ($valids as $key) {
            if (! empty($_GET[$key])) {
                $this->validData[$key] = $_GET[$key];
            }
        }
        
        if ($method == 'POST') {
            $body = file_get_contents("php://input");
            try {
                $this->msg = Auto::init($body);
            } catch (\Exception $e) {
                return;
            }
            $this->isMsg = true;
        } else if ($method == 'GET' && ! empty($_GET['echostr'])) {
            $this->validData['echostr'] = $_GET['echostr'];
            $this->isValidate = true;
        }
    }

    /**
     * 是否是消息包体请求
     *
     * @return boolean
     */
    public function isMsg()
    {
        return $this->isMsg;
    }

    /**
     * 获取消息包体
     *
     * @return object
     */
    public function getMsg()
    {
        return $this->msg;
    }

    /**
     * 是否为微信验证请求
     *
     * @return boolean
     */
    public function isValidate()
    {
        return $this->isValidate;
    }

    /**
     * 获取校验数据
     *
     * @return array
     */
    public function getValidData(): array
    {
        return $this->validData;
    }
}