<?php

namespace mapper;
use Zend\Db\TableGateway\TableGateway;
use Zend\Db\Sql\Sql;
abstract class AbstractModel {
    
    protected $_tableName = null;
    protected $_dbModelClass = null;

    static public function getDbAdapter(){
        static $adapter = null;
        if(!$adapter)
            $adapter =  \Yaf\Registry::get('adapter');
        return $adapter;
    }
    public function getDbTableGateway(){
        $tableGateway = new TableGateway($this->_tableName,self::getDbAdapter());
        return $tableGateway;
    }
    
    public function getDbSelect(){
        $sql = new Sql(self::getDbAdapter(),$this->_tableName);
        return $sql->select();
    }
    
    public function find($where){
        $resultSet = $this->getDbTableGateway()->select($where);
        if(!($resultSet->count())){
            return false;
        }
        return new $this->_dbModelClass($resultSet->current());
    }
    
    public function fetchAll() {
        $resultSet =  $this->getDbTableGateway()->select();
        if(!($resultSet->count())){
            return false;
        }
        $entities = array();    

        foreach ($resultSet as $result){           
            array_push($entities, new $this->_dbModelClass($result));
        } 
        return $entities;
    }
    
    public function _update($set,$where){
        return $this->getDbTableGateway()->update($set, $where);
    }
    
    public function _insert($set){
        return $this->getDbTableGateway()->insert($set);
    }
    
    public function _delete($where){
        return $this->getDbTableGateway()->delete($where);
    }
}
