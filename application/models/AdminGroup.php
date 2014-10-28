<?php
/**
 * 模型
 */

class AdminGroupModel extends AbstractModel {


    /**
     *管理组ID
     * @var int
     */
    protected $_id;

    /**
     * 管理组名称
     * @var string
     */
    protected $_group_name;
    /**
     * 权限管理
     * @var string
     */
    protected $_purview;

    public function getId() {
        return $this->_id;
    }

    public function setId($id) {
        $this->_id = $id;
        return $this;
    }

    public function getGroup_name() {
        return $this->_group_name;
    }

    public function setGroup_name($group_name) {
        $this->_group_name = $group_name;
        return $this;
    }

    public function getPurview() {
        return $this->_purview;
    }

    public function setPurview($purview) {
        $this->_purview = $purview;
        return $this;
    }



    public function toArray() {
        return array(
            'id'=>  $this->getId(),
            'group_name'=>  $this->getGroup_name(),
            'purview' => $this->getPurview()
        );
    }
}