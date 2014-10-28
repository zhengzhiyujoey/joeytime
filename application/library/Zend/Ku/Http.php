<?php

namespace Ku;

/**
 * 简单模拟的浏览器客户端
 */
class Http {

    protected $_url        = null;
    protected $_post       = false;
    protected $_postFields = null;
    protected $_timeout    = 1;
    protected $_cookie     = null;
    protected $_ua         = 'Ku Http';

    /**
     * 设置请求URL
     *
     * @param string $url
     * @return \Ku\Http
     */
    public function setUrl($url) {
        $this->_url = (string) $url;

        return $this;
    }

    /**
     * 设置POST 数据
     *
     * @param string|array $post
     * @return \Ku\Http
     */
    public function setPostFields($post) {
        $this->_post = true;

        if (is_array($post)) {
            $this->_postFields = http_build_query($post);
        }
        elseif (is_string($post)) {
            $this->_postFields = $post;
        }

        return $this;
    }

    /**
     * 设置超时
     *
     * @param smallint $time
     * @return \Ku\Http
     */
    public function setTimeout($time) {
        $this->_timeout = (int) $time;

        return $this;
    }

    /**
     * 设置COOKIE
     *
     * @param string $cookie
     * @return \Ku\Http
     */
    public function setCookie($cookie) {
        $this->_cookie = (string) $cookie;

        return $this;
    }

    public function setUa($ua = null) {
        $this->_ua = trim($ua);
    }

    /**
     * 发起一个CURL请求,模拟HTTP
     *
     * @return json|null|string|array|Object
     */
    public function send() {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $this->_url);
        curl_setopt($ch, CURLOPT_HEADER, 0);

        if ($this->_ua) {
            curl_setopt($ch, CURLOPT_USERAGENT, $this->_ua);
        }

        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
        curl_setopt($ch, CURLOPT_TIMEOUT, $this->_timeout);

        if (!empty($this->_cookie)) {
            curl_setopt($ch, CURLOPT_COOKIE, $this->_cookie);
        }

        if ($this->_post === true) {
            curl_setopt($ch, CURLOPT_POST, 1);

            if (!empty($this->_postFields)) {
                curl_setopt($ch, CURLOPT_POSTFIELDS, $this->_postFields);
            }
        }

        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);

        $response = curl_exec($ch);
        curl_close($ch);
        $this->reset();

        return $response;
    }

    /**
     * 重置
     */
    protected function reset() {
        $this->_url        = null;
        $this->_post       = false;
        $this->_postFields = null;
        $this->_timeout    = 1;
    }

}
