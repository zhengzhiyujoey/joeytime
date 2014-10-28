<?php

namespace Ku\Oauth;

/**
 * Oauth2.0 的适配器
 *
 * @author ghost
 */
class Adapter {

    /**
     * 驱动
     *
     * @var \Ku\Oauth\Driver\AbstractDriver
     */
    protected $_driver      = null;
    protected $_driverName  = '';
    protected $_key         = '';
    protected $_secret      = '';
    protected $_callbackUrl = '';

    /**
     * @param array $conf
     */
    public function __construct($conf = array()) {
        if ($conf) {
            $this->setOptions($conf);
        }
    }

    /**
     * 设置驱动器
     *
     * @param string $driverName   驱动器名称
     * @throws \Exception Undefined driver
     */
    public function setDriver($driverName) {
        $className = '\\Ku\\Oauth\\Driver\\' . trim(ucfirst(strtolower($driverName)));

        if (!class_exists($className)) {
            throw new \Exception('Undefined driver');
        }

        $this->_driver = new $className($this->_key, $this->_secret, $this->_callbackUrl);
    }

    /**
     * 设置参数
     *
     * @param array $opt
     */
    public function setOptions($opt) {
        $def = array(
            'driver'      => '',
            'key'         => '',
            'secret'      => '',
            'callbackUrl' => '',
        );

        $o = array_merge($def, $opt);

        $this->_driverName  = trim(ucfirst(strtolower($o['driver'])));
        $this->_key         = trim($o['key']);
        $this->_secret      = trim($o['secret']);
        $this->_callbackUrl = trim($o['callbackUrl']);

        if ($this->_driverName) {
            $this->setDriver($this->_driverName);
        }
    }

    /**
     * 获取驱动
     *
     * @return \Ku\Oauth\Driver\AbstractDriver
     */
    public function getDriver() {
        return $this->_driver;
    }

    /**
     *
     * @return string
     */
    public function getRequestTokenUrl() {
        return $this->_driver->getRequestTokenUrl();
    }

    /**
     * 换取访问令牌
     *
     * @param array $queryData
     * @param array $token
     * @param string $httpMethod
     * @param array $request
     * @return \Ku\Oauth\Token\Access
     */
    public function getAccessToken($queryData = array(), $token = null, $httpMethod = null, $request = null) {
        return $this->_driver->getAccessToken($queryData, $token, $httpMethod, $request);
    }

    /**
     * 获取用户信息
     *
     * @param string $remoteUserId
     * @param string $token
     * @return \Ku\Oauth\User|null
     */
    public function getUserInfo($remoteUserId, $token) {
        return $this->_driver->getUserInfo($remoteUserId, $token);
    }

}
