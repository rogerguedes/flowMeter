<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
include_once("application/beans/MyObject.php");
class User extends MyObject{

    private $ID;
    private $name;
    private $email;
    private $password;
    private $accessLevel;

    public function __construct($id, $name, $email, $pass, $accLvl){
        $this->ID = $id;
        $this->name = $name;
        $this->email = $email;
        $this->password = $pass;
        $this->accessLevel = $accLvl;
    }

    public function getAsArray(){
        return get_object_vars($this);
    }

    public function getID(){
        return $this->ID;
    }

    public function setID($id){
        $this->ID = $id;
    }
    public function getName(){
        return $this->name;
    }

    public function setName($name){
        $this->name = $name;
    }

    public function getPassword(){
        return $this->password;
    }

    public function setPassword($password){
        $this->password = $password;
    }

    public function getEmail(){
        return $this->email;
    }

    public function setEmail($email){
        $this->email = $email;
    }

    public function getTeams(){
        return $this->teams;
    }

    public function setTeams($tms){
        $this->teams = $tms;
    }

    public function getMembers(){
        return $this->members;
    }

    public function setMembers($mbs){
        $this->members = $tms;
    }
}
?>
