<?php

class Not_found extends CI_Controller {
    
    public function __construct() {
        parent::__construct();
        $notification = array();
        $notification['notifications_number'] = $this->Super_admin_model->count_notification_for_the_user();
        $notification['notifications'] = $this->Super_admin_model->select_notification_for_the_user();
        $this->session->set_userdata($notification);
    }
    
    public function index() {        
        $admin_id = $this->session->userdata('admin_id');        
        if ($admin_id) {
            $this->load->view('errors/admin-404');
        }
        else{
            $this->load->view('errors/website-404');
        }
    }
}