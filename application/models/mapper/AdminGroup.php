<?php
namespace mapper;

class AdminGroupModel extends \mapper\AbstractModel{
    protected $_dbModelClass = "\AdminGroupModel";
    protected $_tableName = 'admingroup';
    private static $_instance = null;
    
    public static function getInstance(){
        if(!(self::$_instance instanceof self)){
            self::$_instance = new self();
        }
        return self::$_instance;
    }
    
    public function __clone() {
        trigger_error('clone is not allowed',E_USER_ERROR);
    }
    
    public function getGroups(){
        $groups = $this->fetchAll();
        $group = array();      
        foreach ($groups as $g){
            $group[$g->getId()] = $g->getGroup_name();
        }
        return $group;
    }
    
    public function fetchAll() {
        return parent::fetchAll();
    }
    
    public function find($id) {
        return parent::find(array('id'=>$id));
    }
    
    public function update(\AdminGroupModel $adminGroup){
        $set = $adminGroup->toArray();
        $where = array('id' => $set['id']);
        unset($set['id']);
        return parent::_update($set, $where);
    }
    
    public function insert(\AdminGroupModel $adminGroup){
        $set = $adminGroup->toArray();
        return parent::_insert($set);
    }
}

