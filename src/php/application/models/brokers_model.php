
<?php
class Brokers_Model extends CI_Model{
    function __construct(){
        parent::__construct();
        $this->load->database();
        include_once(APPPATH."beans/Broker.php");
    }

    function __destruct(){
        $this->db->close();
    }

    function create($newObj){
        $queryString = "INSERT INTO broker_entries ";
        
        $queryColumns = array('names'=>'(', 'values'=>'(');

        $queryBinds = array();
        if( $newObj->getIpAddress() ){
            $queryColumns['names'] .= "ip_address,";
            $queryColumns['values'] .= "?,";
            $queryBinds[] = $newObj->getIpAddress();
        }

        if( $newObj->getPort() ){
            $queryColumns['names'] .= "port,";
            $queryColumns['values'] .= "?,";
            $queryBinds[] = $newObj->getPort();
        }
        
        if( $newObj->getTopic() ){
            $queryColumns['names'] .= "topic,";
            $queryColumns['values'] .= "?,";
            $queryBinds[] = $newObj->getTopic();
        }

        
        $queryColumns['names'][strlen($queryColumns['names'])-1]=')';
        $queryColumns['values'][strlen($queryColumns['values'])-1]=')';

        $queryString .= $queryColumns['names']." VALUES ".$queryColumns['values'].";";
        
        $queryResult = $this->db->query($queryString, $queryBinds);
        
        $queryString = "SELECT
                id, ip_address, port, topic
            FROM
                broker_entries
            WHERE
                id=?
            ;";
        
        $queryBinds = array( $this->db->insert_id() );
        $queryResult = $this->db->query($queryString, $queryBinds)->result()[0];
        return new Broker( $queryResult->id, $queryResult->ip_address, $queryResult->port, $queryResult->topic );
        //var_dump( $this->db->last_query() );
        //exit();
    }

    function read($obj=null){
        $queryString = "SELECT
                id, ip_address, port, topic
            FROM
                broker_entries
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
                $brokers[] = new Broker( $row->id, $row->ip_address, $row->port, $row->topic );
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
    
    function update($obj){
        $id = $obj->getId();
        $obj->setId( null );
        if( !$id || $obj->isNull() ){
            return null;
        }
        
        $obj->setId( $id );

        $queryString = "UPDATE broker_entries SET ";
        
        $queryBinds = array();
        
        if( $obj->getIpAddress() ){
            $queryString .= "ip_address=?," ;
            $queryBinds[] = $obj->getIpAddress();
        }

        if( $obj->getPort() ){
            $queryString .= "port=?," ;
            $queryBinds[] = $obj->getPort();
        }

        if( $obj->getTopic() ){
            $queryString .= "topic=?," ;
            $queryBinds[] = $obj->getTopic();
        }
        
        $queryBinds[] = $obj->getId();
        
        $queryString = substr($queryString, 0, -1)." WHERE id=?;";

        
        $queryResult = $this->db->query($queryString, $queryBinds);
        return $queryResult;
        //var_dump( $this->db->last_query() );
        //exit();
    }
    
    function delete($obj){
        if( !$obj->getId() ){
            return null;
        }
        $queryString = "DELETE FROM broker_entries WHERE id=?;";
        $queryBinds = array($obj->getId());
        
        $queryResult = $this->db->query($queryString, $queryBinds);
        return $queryResult;
    }
}
?>
