<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
include_once("application/beans/MyObject.php");
class Broker extends MyObject{
    private $id;
    private $ipAddress;
    private $port;
    private $topic;
    
    public function __construct($param0, $param1, $param2, $param3){
        $this->id = $param0;
        $this->ipAddress = $param1;
        $this->port = $param2;
        $this->topic = $param3;
    }
    
    public function getAsArray(){
        $objArray = get_object_vars($this);
        foreach($objArray as &$objAtt){
            if(is_object($objAtt) && method_exists($objAtt,'getAsArray')){
                $objAtt = $objAtt->getAsArray();
            }else{
                if( is_array($objAtt) ){
                    foreach($objAtt as &$arrayObjAtt){
                        if(is_object($arrayObjAtt) && method_exists($arrayObjAtt,'getAsArray')){
                            $arrayObjAtt = $arrayObjAtt->getAsArray();
                        }
                    }
                }
            }
        }
        return $objArray;
    }

    public function getId(){
        return $this->id;
    }

    public function setId($param){
        $this->id = $param;
    }

    public function getIpAddress(){
        return $this->ipAddress;
    }

    public function setIpAddress($param){
        $this->ipAddress = $param;
    }

    public function getPort(){
        return $this->port;
    }

    public function setPort($param){
        $this->port = $param;
    }

    public function getTopic(){
        return $this->topic;
    }

    public function setTopic($param){
        $this->topic = $param;
    }
}
?>
