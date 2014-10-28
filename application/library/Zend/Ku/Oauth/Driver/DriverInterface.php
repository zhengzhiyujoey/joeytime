<?php

namespace Ku\Oauth\Driver;

/**
 * Oauth 驱动器接口
 *
 * @author ghost
 */
interface DriverInterface {

    public function __construct($key, $secret, $callbackUrl);

    public function getUserInfo($remoteUserId = '', $token = '');

    public function getRequestTokenUrl();

    /**
     * @return \Ku\Oauth\Token\Access
     */
    public function getAccessToken($queryData = array(), $token = null, $httpMethod = null, $request = null);

    public function getAuthorizeUrl();
}
