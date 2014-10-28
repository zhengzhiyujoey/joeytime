<?php

namespace Ku\Oauth\Driver;

use Ku\Http;
use Ku\Oauth\User;
use Ku\Oauth\Token\Access;

/**
 * @todo 还没有验证数据的有效性
 */
class Qq extends AbstractDriver {

    /**
     * 请求的授权的URL
     * @var string
     */
    protected $_authorizeUrl = 'https://graph.qq.com/oauth2.0/authorize';

    /**
     * 转换 access 的URL
     *
     * @var string
     */
    protected $_accessTokenUrl = 'https://graph.qq.com/oauth2.0/token';

    /**
     * 获取用户资料的URL
     *
     * @var string
     */
    protected $_userInfoUrl = 'https://graph.qq.com/user/get_user_info';

    /**
     * 通过 accessToken 获取用户的唯一标识符
     *
     * @var string
     */
    protected $_userOpenIdUrl = 'https://graph.qq.com/oauth2.0/me';

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
            'scopt'         => 'get_user_info,get_info',
        );

        if (isset($queryData['code'])) {
            $params['code'] = trim($queryData['code']);
        }

        $http = new Http();
        $http->setUrl($this->_accessTokenUrl);
        $http->setPostFields($params);

        $response = $http->send();

        $data = array();
        parse_str($response, $data);

        $accessToken = new Access();
        $accessToken->setType('qq');
        $accessToken->setToken($data['access_token']);
        $accessToken->setExpireTime(time() + $data['expires_in']);

        $data['uid'] = $this->queryUserOpenId($data['access_token']);

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

    /**
     * 获取用户在Qq上的唯一标识符号
     *
     * @param string $accessToken
     */
    protected function queryUserOpenId($accessToken) {
        $http = new \Ku\Http();
        $http->setUrl($this->_userOpenIdUrl . '?access_token=' . trim($accessToken));

        $response = $http->send();
        $jsonData = $this->parseJsonpResponse($response);

        return isset($jsonData['openid']) ? $jsonData['openid'] : '';
    }

    public function getUserInfo($remoteUserId = '', $token = '') {
        $http = new Http();

        $params = array(
            'openid'             => $remoteUserId,
            'access_token'       => $token,
            'oauth_consumer_key' => $this->_key,
        );
        $url    = $this->_userInfoUrl . '?' . http_build_query($params);

        $http->setUrl($url);

        $data = json_decode($http->send(), true);

        // 获取数据失败
        if (0 !== $data['ret']) {
            return null;
        }

        $genderArr = array(
            '男' => 'M',
            '女' => 'F',
        );

        $user = new User();
        $user->setRemoteUserId($remoteUserId);
        $user->setUserName($data['nickname']);
        $user->setGender(isset($genderArr[$data['gender']]) ? $genderArr[$data['gender']] : 'U');
        /* 40x40 */
        $user->setAvatar($data['figureurl_qq_1']);
        /* 100x100, 需要注意, 不是所有的用户都拥有QQ的100x100的头像, 但40x40像素则是一定会有 */
        $user->setAvatarhd($data['figureurl_qq_2']);

        return $user;
    }

    protected function parseJsonpResponse($string) {
        $string = trim($string);

        if (empty($string)) {
            return null;
        }

        $lpos = strpos($string, '(');
        $rpos = strrpos($string, ')');

        return json_decode(substr($string, $lpos + 1, $rpos - $lpos - 1), true);
    }

}
