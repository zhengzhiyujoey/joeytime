<?php
namespace mapper;

class AdminModel extends \mapper\AbstractModel{
    protected $_dbModelClass = "\AdminModel";
    protected $_tableName = 'admin';
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
    
    public function findByUsername($username) {
        $select = $this->getDbSelect();
        $select->columns(array('id','username','password','groups','disabled'));
        $select->where(array('username' => $username));
        $resultSet = $this->getDbTableGateway()->selectWith($select);

        if(!$resultSet->count()){
            return null;
        }
        //操作orm层
        return new $this->_dbModelClass($resultSet->current());
    }

    public function find($id){
        return parent::find(array('id'=>$id));
    }
    
    public function fetchAll() {
        return parent::fetchAll();
    }
    
    public function insert(\AdminModel $adminModel){
        $where = $adminModel->toArray();
        return parent::_insert($where);
    }
    
    public function update(\AdminModel $adminModel){
        $set = $adminModel->toArray();
        $where = array('id'=>$set['id']);     
        unset($set['id']);      
        return parent::_update($set, $where);
    }
}

