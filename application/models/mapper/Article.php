<?php
namespace mapper;

class ArticleModel extends \mapper\AbstractModel{
    protected $_dbModelClass = "\ArticleModel";
    protected $_tableName = 'article';
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
    

    public function find($id){
        return parent::find(array('id'=>$id));
    }
    
    public function fetchAll() {
        return parent::fetchAll();
    }
    
    public function insert(\ArticleModel $articleModel){
        $where = $articleModel->toArray();

        return parent::_insert($where);
    }
    
    public function update(\ArticleModel $articleModel){
        $set = $articleModel->toArray();
        $where = array('id'=>$set['id']);     
        unset($set['id']);      
        return parent::_update($set, $where);
    }
    
    public function getArticleBySort($sort){
        $select = $this->getDbSelect();
        $select->columns(array('id','title','body','addtime','letter'));
        $select->join('sort', 'sort.id=article.sort_ids', array('name'), 'left');
        $select->where(array('sort.name'=>$sort));
        $result = $this->getDbTableGateway()->selectWith($select)->toArray();
        return $result ? $result : array();
                
    }
}

