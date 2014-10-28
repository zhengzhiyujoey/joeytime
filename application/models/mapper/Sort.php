<?php
namespace mapper;
class SortModel extends \mapper\AbstractModel{
    protected $_tableName = 'sort';
    protected $_dbModelClass = '\SortModel';
    private static $_instance = null;
    
    /**
     * 获取类实例
     *
     * @return \Mapper\SortModel;
     */
    public static function getInstance(){
        if(!(self::$_instance) instanceof self){
            self::$_instance = new self;
        }        
        return self::$_instance;    
    }
    
    public function __clone(){
         trigger_error('Clone is not allow!', E_USER_ERROR);
    }
    
    public function fetchAll(){
        return parent::fetchAll();
    }
    
    public function find($id){
        return parent::find(array('id'=>$id));
    }
    
    public function update(\SortModel $sort){
        $where = array('id'=>$sort->getId());
        $data = $sort->toArray();
        unset($data['id']);
        return parent::_update($data,$where);
    }
    
    public function insert(\SortModel $sort){
        $where = $sort->toArray();
        return parent::_insert($where);
    }
    
    public function delete($id){
        return parent::_delete(array('id='.$id));
    }

}

