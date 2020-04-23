<?php
/**
 * Created by PhpStorm.
 * User: dannexdaniels
 * Date: 28/12/18
 * Time: 11:30
 */

class RequestRideModel extends CI_Model
{
    function __construct()
    {
        parent::__construct();
    }

    function addRequest($data){
        $this->db->insert('drive_requests',$data);
    }

    function checkRequest1($driver){
        $query = $this->db->get_where('client_requests',array('status' => "new",'license' => $driver));
        return $query->result_array();
    }
    
    function getRequestId($client){
        $query = $this->db->get_where('client_requests',array('status' => "new",'phone' => $client));
        return $query->result_array();
    }
    
    function checkRequest2($request){
        $query = $this->db->get_where('client_requests',array('id' => $request));
        return $query->result_array();
    }

    function getDrivers(){
        $query = $this->db->get_where('driver_status',array('login_status' => "available"));
        return $query->result_array();
    }

    function updateRequest($status, $id){
        $this->db->update('drive_requests', $status, array('request_id' => $id));
    }
    
    function updateJourney($status, $id){
        $this->db->update('drive_requests', array('journey_status' => $status), array('request_id' => $id));
    }

}