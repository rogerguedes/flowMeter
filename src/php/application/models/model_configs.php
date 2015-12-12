<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Model_Configs extends CI_Model{
    function __construct(){
        parent::__construct();
        $this->load->database();
        include_once(APPPATH."beans/Broker.php");
    }

    function __destruct(){
        $this->db->close();
    }

    function read($obj=null){
        $queryString = "SELECT
                *
            FROM
                settings
            WHERE";
        
        $queryBinds = array();
        if( $obj ){
            $queryString .= " settings.key=?;";
            $queryBinds[] = $obj->key;
        }else{
            $queryString .= " TRUE;";
        }
        $queryResult = $this->db->query($queryString, $queryBinds);
        if($queryResult->num_rows > 0){
            $settings = array();
            foreach($queryResult->result() as $row){
                $settings[] = array($row->key => $row->value);
            }
            if($obj){
                return $settings[0];
            }else{
                return $settings;
            }
        }
        else{
            return null;
        }
    }
    
    function update($obj){
        if( !$obj->key ){
            return null;
        }
        
        $queryString = "UPDATE settings SET ";
        
        $queryBinds = array();
        
        $queryString .= "value=?," ;
        $queryBinds[] = $obj->value;
        
        $queryBinds[] = $obj->key;
        
        $queryString = substr($queryString, 0, -1)." WHERE settings.key=?;";

        
        $queryResult = $this->db->query($queryString, $queryBinds);
        return $queryResult;
        //var_dump( $this->db->last_query() );
        //exit();
    }
    
}
?>


