<?php
namespace mapper;

class SentenceModel extends \mapper\AbstractModel{
    protected $_dbModelClass = "\SentenceModel";
    protected $_tableName = 'sentence';
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
    
    public function find($id) {
        return parent::find(array('id'=>$id));
    }
    public function fetchAll() {
        return parent::fetchAll();
    }
    
    public function insert(\SentenceModel $sentenceModel){
        $where = $sentenceModel->toArray();

        return parent::_insert($where);
    }
    
    public function update(\SentenceModel $sentenceModel) {
        $set = $sentenceModel->toArray();
        $where = array('id'=>$set['id']);
        unset($set['id']);
        
        return parent::_update($set, $where);
    }
   
}

