<?php
/**
 * Created by PhpStorm.
 * User: dannexdaniels
 * Date: 13/02/19
 * Time: 05:33
 */

class PaymentModel extends CI_Model
{
    function __construct()
    {
        parent::__construct();
    }
    
    function addPayment($data){
        $this->db->insert('payments',$data);
    }
    
    function getPayment($id){
        $query = $this->db->get_where('payments',array('pay_request' => $id));
        return $query->result_array();
    }
    
    function updatePaymentStatus($status, $id){
        $this->db->update('payments', $status, array('pay_request' => $id));
    }
    
    function addMpesa($data){
        $this->db->insert('mpesa_logs',$data);
    }
    
    function getMpesa($id){
        $query = $this->db->get_where('mpesa_logs',array('pay_no' => $id));
        return $query->result_array();
    }
}