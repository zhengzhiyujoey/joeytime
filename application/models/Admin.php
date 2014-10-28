<?php
/**
 * 管理员模型
 */

class AdminModel extends AbstractModel {

    /**
     * 用户ID
     * @var int 
     */
    protected $_id;

    /**
     *用户名
     * @var string
     */
    protected $_username;

    /**
     *密码
     * @var string
     */
    protected $_password;
    /**
     *归属用户组
     * @var string
     */
    protected $_groups;

    protected $_disabled;
    public function getDisabled() {
        return $this->_disabled;
    }

    public function setDisabled($disabled) {
        $this->_disabled = $disabled;
        return $this;
    }


    public function getId() {
        return $this->_id;
    }

    public function setId($id) {
        $this->_id = $id;
    }

    public function getUsername() {
        return $this->_username;
    }

    public function setUsername($username) {
        $this->_username = $username;
        return $this;
    }

    public function getPassword() {
        return $this->_password;
    }

    public function setPassword($password) {
        $this->_password = $password;
        return $this;
    }

    public function getGroups() {
        return $this->_groups;
    }

    public function setGroups($groups) {
        $this->_groups = $groups;
        return $this;
    }
    

    public function toArray() {
        return array(
            'id'            => $this->_id,
            'username'      => $this->_username,
            'password'      => $this->_password,
            'groups'         => $this->_groups,
            'disabled'      => $this->_disabled
        );
    }
}