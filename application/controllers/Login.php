<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {
    
    public function __construct(){
        parent::__construct();
        $admin_id = $this->session->userdata('admin_id');
        if ($admin_id != NULL){
            redirect('super_admin', 'refresh');
        }
    }
        
    public function admin_login(){
        $this->load->view('super_admin/login');
    }
    
    public function check_admin_login(){   
        $email=$this->input->post('email', true); 
        $password=$this->input->post('password', true);
        $sql = "SELECT * FROM tbl_users WHERE user_email='$email' AND user_password='$password' AND user_type = '1' AND user_status='1'";
        $query_result = $this->db->query($sql);
        $result = $query_result->row();
        $user_activity_url = 'Admin Login';
        $user_activity_type = 'Login';
        $created_at = date('l d F Y h:i:s A');
        $sdata = array();
        if ($result){
            $created_by = $result->pk_user_id;
            $this->Store_model->save_user_activity($user_activity_url, $user_activity_type, $created_at, $created_by);
            $sdata['admin_id'] = $created_by;
            $sdata['admin_image'] = $result->user_image;
            $sdata['admin_name'] = $result->user_fullname;
            $this->session->set_userdata($sdata);
            redirect('super_admin');
        } 
        else{
            $created_by = NULL;
            $user_activity_url = 'Admin Login';
            $user_activity_type = "Failed Login. Wrong Email is '$email' and Password '$password'";
            $created_at = date('l d F Y h:i:s A').' From '.php_uname();
            $this->Store_model->save_user_activity($user_activity_url, $user_activity_type, $created_at, $created_by);
            $this->session->set_flashdata('exception', 'Your Email / Password Invalide!');
            redirect('login/admin_login');
        }
    }
}