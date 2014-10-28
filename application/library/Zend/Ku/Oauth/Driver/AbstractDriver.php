<?php

namespace Ku\Oauth\Driver;

/**
 * 适配器抽象
 */
abstract class AbstractDriver implements DriverInterface {

    protected $_key         = '';
    protected $_secret      = '';
    protected $_callbackUrl = '';

    /**
     * 请求的授权的URL
     *
     * @var string
     */
    protected $_authorizeUrl = '';

    /**
     * 获取用户资料的URL
     *
     * @var string
     */
    protected $_userInfoUrl = '';

    public function __construct($key, $secret, $callbackUrl) {
        $this->_key         = trim($key);
        $this->_secret      = trim($secret);
        $this->_callbackUrl = trim($callbackUrl);


        if (empty($this->_callbackUrl)) {
            throw new \Exception('Callback URL can not be empty');
        }
    }

    public function getAuthorizeUrl() {
        return $this->_authorizeUrl;
    }

    public function getUserinfoUrl() {
        return $this->_userInfoUrl;
    }

}
