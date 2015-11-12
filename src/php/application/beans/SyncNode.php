<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
include_once("application/beans/MyObject.php");
class SyncNode extends MyObject{
    private $id;
    private $alias;
    private $ipAddress;
    private $status;
    private $meters;

    public function __construct($param0, $param1, $param2, $param3, $param4){
        $this->id = $param0;
        $this->alias = $param1;
        $this->ipAddress = $param2;
        $this->status = $param3;
        $this->meters = $param4;
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

    public function getAlias(){
        return $this->alias;
    }

    public function setAlias($param){
        $this->alias = $param;
    }

    public function getIpAddress(){
        return $this->ipAddress;
    }

    public function setIpAddres($param){
        $this->ipAddress = $param;
    }

    public function getStatus(){
        return $this->status;
    }

    public function setStatus($param){
        $this->status = $param;
    }

    public function getMeters(){
        return $this->meters;
    }

    public function setMeters($param){
        $this->meters = $param;
    }
}
?>
