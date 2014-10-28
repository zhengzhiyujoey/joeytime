<?php
/**
 * 文章模型
 */

class ArticleModel extends AbstractModel {

    /**
     * 文章ID
     * @var int 
     */
    protected $_id = null;
    protected $_title = null;
    protected $_body = null;
    protected $_image = null;
    protected $_sort_ids = null;
    protected $_recommended = null;
    protected $_author = null;
    protected $_addtime = null;
    protected $_uptime = null;
    protected $_letter = null;
 
    public function getId() {
        return $this->_id;
    }

    public function setId($id) {
        $this->_id = (int)$id;
        return $this;
    }

    public function getTitle() {
        return $this->_title;
    }

    public function setTitle($title) {
        $this->_title = (string)$title;
        return $this;
    }

    public function getBody() {
        return $this->_body;
    }

    public function setBody($body) {
        $this->_body = (string)$body;
        return $this;
    }

    public function getImage() {
        return $this->_image;
    }

    public function setImage($image) {
        $this->_image = (string)$image;
        return $this;
    }

    public function getSort_ids() {
        return $this->_sort_ids;
    }

    public function setSort_ids($sort_ids) {
        $this->_sort_ids = (string)$sort_ids;
        return $this;
    }
    
    public function getAddtime() {
        return $this->_addtime;
    }

    public function setAddtime($addtime) {
        $this->_addtime = (string)$addtime;
        return $this;
    }

    public function getUptime() {
        return $this->_uptime;
    }
   
    public function setUptime($uptime) {
        $this->_uptime = (string)$uptime;
        return $this;
    }
    
    public function setRecommended($recommended) {
        $this->_recommended = (int)$recommended;
        return $this;
    }
    
    public function getRecommended() {
        return $this->_recommended;
    }

    public function setAuthor($value) {
        $this->_author = $value;
        return $this;
    }

    public function getAuthor() {
        return $this->_author;
    }
   
    public function getLetter() {
        return $this->_letter;
    }
    
    public function setLetter($value) {
        $this->_letter = $value;
        return $this;
    }

  



    public function toArray() {
        return array(
            'id'           => $this->_id,
            'title'        => $this->_title,
            'body'         => $this->_body,
            'image'        => $this->_image,
            'sort_ids'     => $this->_sort_ids,
            'recommended'  => $this->_recommended,
            'author'     => $this->_author,
            'addtime'      => $this->_addtime,
            'uptime'       => $this->_uptime,
            'letter'       => $this->_letter
        );
    }
}