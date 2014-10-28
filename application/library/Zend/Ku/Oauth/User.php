<?php

namespace Ku\Oauth;

class User {

    protected $_remoteUserId = 0;
    protected $_userName     = '';
    protected $_gender       = 'U';
    protected $_avatar       = '';
    protected $_avatarhd     = '';

    public function getRemoteUserId() {
        return $this->_remoteUserId;
    }

    public function getUserName() {
        return $this->_userName;
    }

    public function getGender() {
        return $this->_gender;
    }

    public function getAvatar() {
        return $this->_avatar;
    }

    public function getAvatarhd() {
        return $this->_avatarhd;
    }

    public function setRemoteUserId($remoteUserId) {
        $this->_remoteUserId = $remoteUserId;

        return $this;
    }

    public function setUserName($userName) {
        $this->_userName = $userName;

        return $this;
    }

    public function setGender($gender) {
        $gender = strtoupper($gender);

        if (!in_array($gender, array('U', 'M', 'F'))) {
            $gender = 'U';
        }

        $this->_gender = $gender;

        return $this;
    }

    public function setAvatar($avatar) {
        $this->_avatar = $avatar;

        return $this;
    }

    public function setAvatarhd($avatarhd) {
        $this->_avatarhd = $avatarhd;

        return $this;
    }

}
