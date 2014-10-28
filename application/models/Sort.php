<?php
/**
 * 分类模型
 * @author Administrator
 */
class SortModel extends AbstractModel{

    /**
     *
     * 分类ID
     */
    protected $_id;

    /**
     *
     * 分类名称
     */
    protected $_name;


    protected $_mappath;

    /**
     *
     * 父类ID
     */
    protected $_parentid;
    public function getId() {
        return $this->_id;
    }

    public function getName() {
        return $this->_name;
    }

    public function getParentid() {
        return $this->_parentid;
    }

    public function setId($id) {
        $this->_id = $id;
    }

    public function setName($name) {
        $this->_name = $name;
    }

    public function setParentid($parentid) {
        $this->_parentid = $parentid;
    }

    public function getMappath() {
        return $this->_mappath;
    }

    public function setMappath($mappath) {
        $this->_mappath = $mappath;
    }

    public function toArray() {
        return array(
            'id'=>  $this->_id,
            'name'=> $this->_name,
            'parentid'=>  $this->_parentid,
            'mappath' => $this->_mappath
        );
    }

}
