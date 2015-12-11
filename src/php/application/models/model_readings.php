<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Model_Readings extends CI_Model{
    function __construct(){
        parent::__construct();
        $this->load->database();
        include_once(APPPATH."beans/Reading.php");
    }

    function __destruct(){
        $this->db->close();
    }
    function read($obj=null){
        $queryString = "SELECT
                id, flow, volume, date
            FROM
                readings
            WHERE";
        
        $queryBinds = array();
        if( $obj ){
            $queryString .= " id=?;";
            $queryBinds[] = $obj->getId();
        }else{
            $queryString .= " TRUE;";
        }
        $queryResult = $this->db->query($queryString, $queryBinds);
        if($queryResult->num_rows > 0){
            $brokers = array();
            foreach($queryResult->result() as $row){
                $brokers[] = new Reading( $row->id, $row->flow, $row->volume, $row->date );
            }
            if($obj){
                return $brokers[0];
            }else{
                return $brokers;
            }
        }
        else{
            return null;
        }
    }
}
?>
