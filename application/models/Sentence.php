<?php
/**
 * 句子模型
 */

class SentenceModel extends AbstractModel {

    protected $_id = null;
    protected $_body = null;
    protected $_sort_ids = null;
    protected $_recommended = null;
    protected $_author = null;
    protected $_addtime = null;
    protected $_uptime = null;
    protected $_letter = null;
 
    public function getId() {
        return $this->_id;
    }

    public function setId($value) {
        $this->_id = $value;
        return $this;
    }


    public function getBody() {
        return $this->_body;
    }

    public function setBody($value) {
        $this->_body = $value;
        return $this;
    }

    public function getSort_ids() {
        return $this->_sort_ids;
    }

    public function setSort_ids($value) {
        $this->_sort_ids = $value;
        return $this;
    }
    
    public function getAddtime() {
        return $this->_addtime;
    }

    public function setAddtime($value) {
        $this->_addtime = $value;
        return $this;
    }

    public function getUptime() {
        return $this->_uptime;
    }
   
    public function setUptime($value) {
        $this->_uptime = $value;
        return $this;
    }
    
    public function setRecommended($value) {
        $this->_recommended = $value;
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
    
    public function setLetter($value) {
        $this->_letter = $value;
        return $this;
    }

    public function getLetter() {
        return $this->_letter;
    }



    public function toArray() {
        return array(
            'id'           => $this->_id,
            'body'         => $this->_body,
            'sort_ids'     => $this->_sort_ids,
            'recommended'  => $this->_recommended,
            'author'       => $this->_author,
            'addtime'      => $this->_addtime,
            'uptime'       => $this->_uptime,
            'letter'       => $this->_letter
        );
    }
}