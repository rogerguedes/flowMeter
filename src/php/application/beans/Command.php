<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
include_once("application/beans/MyObject.php");
class Command extends MyObject{
    private $id;
    private $name;
    private $description;
    private $query;
    
    public function __construct($param0, $param1, $param2, $param3){
        $this->id = $param0;
        $this->name = $param1;
        $this->description = $param2;
        $this->query = $param3;
    }

    public function getAsArray(){
        return get_object_vars($this);
    }

    public function getId(){
        return $this->id;
    }

    public function setId($param){
        $this->id = $param;
    }

    public function getName(){
        return $this->name;
    }

    public function setName($param){
        $this->name = $param;
    }

    public function getDescription(){
        return $this->description;
    }

    public function setDescription($param){
        $this->description = $param;
    }

    public function getQuery(){
        return $this->query;
    }

    public function setQuery($param){
        $this->query = $param;
    }

}
?>
