<?php

namespace Ku\Oauth\Driver;

use Ku\Http;
use Ku\Oauth\User;
use Ku\Oauth\Token\Access;

/**
 * @todo 还没有验证数据的有效性
 */
class Weibo extends AbstractDriver {

    /**
     * 请求的授权的URL
     * @var string
     */
    protected $_authorizeUrl = 'https://api.weibo.com/oauth2/authorize';

    /**
     * 转换 access 的URL
     *
     * @var string
     */
    protected $_accessTokenUrl = 'https://api.weibo.com/oauth2/access_token';

    /**
     * 获取用户资料的URL
     *
     * @var string
     */
    protected $_userInfoUrl = 'https://api.weibo.com/2/users/show.json';

    /**
     *
     * @param array $queryData
     * @param array $token
     * @param string $httpMethod
     * @param array $request
     * @return \Ku\Oauth\Token\Access
     */
    public function getAccessToken($queryData = array(), $token = null, $httpMethod = null, $request = null) {
        $params = array(
            'code'          => '',
            'grant_type'    => 'authorization_code',
            'client_id'     => $this->_key,
            'client_secret' => $this->_secret,
            'redirect_uri'  => $this->_callbackUrl,
        );

        if (isset($queryData['code'])) {
            $params['code'] = trim($queryData['code']);
        }

        $http = new Http();
        $http->setUrl($this->_accessTokenUrl);
        $http->setPostFields($params);

        $response = $http->send();

        $data = json_decode($response, true);

        $accessToken = new Access();
        $accessToken->setType('weibo');
        $accessToken->setToken($data['access_token']);
        $accessToken->setExpireTime(time() + $data['expires_in']);
        $accessToken->setRemoteUserId($data['uid']);

        return $accessToken;
    }

    public function getRequestTokenUrl() {
        $params = array(
            'response_type' => 'code',
            'client_id'     => $this->_key,
            'redirect_uri'  => $this->_callbackUrl,
            'state'         => md5(uniqid(rand(), true)),
        );

        return $this->getAuthorizeUrl() . '?' . http_build_query($params);
    }

    public function getUserInfo($remoteUserId = '', $token = '') {
        $http = new Http();

        $params = array(
            'uid'          => $remoteUserId,
            'access_token' => $token,
        );
        $url    = $this->_userInfoUrl . '?' . http_build_query($params);

        $http->setUrl($url);

        $data = json_decode($http->send(), true);

        $user = new User();
        $user->setRemoteUserId($data['id']);
        $user->setUserName($data['name']);
        $user->setGender($data['gender']);
        /* 50x50 */
        $user->setAvatar($data['profile_image_url']);
        /* 180x180 */
        $user->setAvatarhd($data['avatar_large']);

        return $user;
    }

}
