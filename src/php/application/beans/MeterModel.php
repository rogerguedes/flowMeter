<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
include_once("application/beans/MyObject.php");
class MeterModel extends MyObject{
    private $id;
    private $name;
    private $description;
    private $commands;
    
    public function __construct($param0, $param1, $param2, $param3){
        $this->id = $param0;
        $this->name = $param1;
        $this->description = $param2;
        $this->commands = $param3;
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

    public function getCommands(){
        return $this->commands;
    }

    public function setCommands($param){
        $this->commands = $param;
    }
}
?>
