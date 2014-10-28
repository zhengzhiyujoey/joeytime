<?php

namespace Ku\Oauth\Token;

/**
 * 访问令牌
 *
 * @author ghost
 */
class Access {

    /**
     * 第三方的 UserId
     *
     * @var string
     */
    protected $_remoteUserId = '';

    /**
     * 第三方的令牌
     *
     * @var string
     */
    protected $_token = '';

    /**
     * 令牌过期时间
     *
     * @var int
     */
    protected $_expireTime = 0;

    /**
     * 令牌的类型
     * 例如: weibo, qq
     *
     * @var string
     */
    protected $_type = '';

    public function __construct($options = null) {
        if ($options) {
            $this->setOptions($options);
        }
    }

    /**
     * 通用设置方法
     *
     * @param array $options    参数. 如果是类, 必需实现了toArray(), 或者Traversabl接口的类.
     * @return \Ku\Oauth\Token\Access
     */
    public function setOptions($options) {
        if (is_object($options)) {
            if (method_exists($options, 'toArray')) {
                $options = $options->toArray();
            }
            else if (!($options instanceof \Traversable)) {
                return $this;
            }
        }
        else if (!is_array($options)) {
            return $this;
        }

        foreach ($options as $key => $value) {
            $method = 'set' . ucfirst($key);
            if (method_exists($this, $method)) {
                $this->$method($value);
            }
        }

        return $this;
    }

    /**
     * 远程用户的唯一标识
     *
     * @return type
     */
    public function getRemoteUserId() {
        return $this->_remoteUserId;
    }

    /**
     * 令牌
     *
     * @return string
     */
    public function getToken() {
        return $this->_token;
    }

    /**
     * 过期时间
     *
     * @return int
     */
    public function getExpireTime() {
        return $this->_expireTime;
    }

    /**
     * 驱动器类型
     *
     * @return string
     */
    public function getType() {
        return $this->_type;
    }

    /**
     * 远程用户的唯一标识
     *
     * @param string $remoteUserId
     * @return \Ku\Oauth\Token\Access
     */
    public function setRemoteUserId($remoteUserId) {
        $this->_remoteUserId = $remoteUserId;
        return $this;
    }

    /**
     * 令牌
     *
     * @param string $token
     * @return \Ku\Oauth\Token\Access
     */
    public function setToken($token) {
        $this->_token = $token;
        return $this;
    }

    /**
     * 过期时间
     *
     * @param int $expireTime
     * @return \Ku\Oauth\Token\Access
     */
    public function setExpireTime($expireTime) {
        $this->_expireTime = abs(intval($expireTime));
        return $this;
    }

    /**
     * 驱动器类型
     *
     * @param string $type
     * @return \Ku\Oauth\Token\Access
     */
    public function setType($type) {
        $this->_type = trim($type);
        return $this;
    }

    /**
     * @return array
     */
    public function toArray() {
        return array(
            'type'         => $this->_type,
            'token'        => $this->_token,
            'expireTime'   => $this->_expireTime,
            'remoteUserId' => $this->_remoteUserId,
        );
    }

}
