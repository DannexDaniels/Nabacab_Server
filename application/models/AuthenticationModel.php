<?php
/**
 * Created by PhpStorm.
 * User: dannexdaniels
 * Date: 04/01/19
 * Time: 10:33
 */

class AuthenticationModel extends CI_Model
{
    function __construct()
    {
        parent::__construct();
    }

    function addClient($data){
        $this->db->insert('clients',$data);
    }

    function addDriver($data){
        $this->db->insert('drivers',$data);
    }

    function addUser($data){
        $this->db->insert('user',$data);
    }

    function getUser($phone){
        $query = $this->db->get_where('user',array('user_phone' => $phone));
        return $query->result_array();
    }

    function getClient($phone){
        $query = $this->db->get_where('all_clients',array('client_phone' => $phone));
        return $query->result_array();
    }

    function getDriver($phone){
        $query = $this->db->get_where('all_drivers',array('driver_phone' => $phone));
        return $query->result_array();
    }

    function updateLocation($location, $phone){
        $this->db->update('user', $location, array('user_phone' => $phone));
    }

    function updateLoginStatus($status, $user){
        $this->db->update('user', $status, array('user_phone' => $user));

        $data = array(
            'user' => $user,
            'status' => $status['login_status'],
            'user_log_latt' => $status['user_latt'],
            'user_log_long' => $status['user_long']
        );

        $this->db->insert('login_logs',$data);
    }


}