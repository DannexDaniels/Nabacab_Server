<?php
/**
 * Created by PhpStorm.
 * User: dannexdaniels
 * Date: 2/21/19
 * Time: 7:23 PM
 */

class AdminPortal extends CI_Controller
{
    public function index()
    {
        $this->load->view('admin_dashboard');
    }

    public function dashboard(){

    }
}