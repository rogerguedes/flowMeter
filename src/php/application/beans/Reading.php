<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
include_once("application/beans/MyObject.php");
class Reading extends MyObject{
    private $id;
    private $flow;
    private $volume;
    private $date;
    
    public function __construct($param0, $param1, $param2, $param3){
        $this->id = $param0;
        $this->flow = $param1;
        $this->volume = $param2;
        $this->date = $param3;
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

    public function getFlow(){
        return $this->flow;
    }

    public function setFlow($param){
        $this->flow = $param;
    }

    public function getVolume(){
        return $this->volume;
    }

    public function setVolume($param){
        $this->volume = $param;
    }
    
    public function getDate(){
        return $this->date;
    }

    public function setDate($param){
        $this->date = $param;
    }

}
?>
