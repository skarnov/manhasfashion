<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Checkout extends CI_Controller {
    
    public function __construct(){
        parent::__construct();
        $user_id = $this->session->userdata('user_id');
        if ($user_id != NULL){
            redirect('client/shipping_form', 'refresh');
        }
    }
        
    public function login(){
        $data = array();
        $data['title'] = 'Login';
        $data['all_categories'] = $this->Store_model->select_categories();
        $data['all_subcategories'] = $this->Store_model->select_subcategories();
        $data['all_subcategory_items'] = $this->Store_model->select_subcategory_items();
        $data['home'] = $this->load->view('store/login', $data, true);
        $this->load->view('store/master', $data);
    }
    
    public function check_client_login(){   
        $email=$this->input->post('email', true); 
        $password=$this->input->post('password', true);
        $sql = "SELECT * FROM tbl_users WHERE user_email='$email' AND user_password='$password' AND (user_type = '2' OR user_type = '3') AND user_status='1'";
        $query_result = $this->db->query($sql);
        $result = $query_result->row();
        $user_activity_url = 'Client Login';
        $user_activity_type = 'Login';
        $created_at = date('l d F Y h:i:s A');
        $sdata = array();
        if ($result){
            $created_by = $result->pk_user_id;
            $this->Store_model->save_user_activity($user_activity_url, $user_activity_type, $created_at, $created_by);
            $user_type = $result->user_type;
            if($user_type == '3'){
                $sql = "SELECT SUM(order_total) as Total_Sale FROM tbl_orders WHERE order_status = '1' AND created_by = '$created_by'";
                $query_result = $this->db->query($sql);
                $sale = $query_result->row();
                if($sale->Total_Sale >= '1000')
                {
                    $update = "UPDATE tbl_users SET user_type = '2' WHERE pk_user_id = '$created_by'";
                    $this->db->query($update);
                    /* Discount As A Member */
                    $sdata['discount'] = 0.05;
                    /* End of Discount */
                    $notification = array();
                    $notification['notification'] = 'Client Name <strong>'.$result->user_fullname.'</strong> Becomes Member';
                    $notification['created_at'] = date("Y-m-d H:i:s");
                    $notification['created_by'] = $created_by;
                    $this->db->insert('tbl_notifications',$notification);
                }
            }
            if($user_type == '2'){
                /* Discount As A Member */
                $sdata['discount'] = 0.05;
                /* End of Discount */
            }
            $sdata['user_id'] = $created_by;
            $sdata['user_image'] = $result->user_image;
            $sdata['user_name'] = $result->user_fullname;
            $this->session->set_userdata($sdata);
            redirect('client/shipping_form');
        } 
        else{
            $created_by = NULL;
            $user_activity_url = 'Client Login';
            $user_activity_type = "Failed Login. Wrong Email is '$email' and Password '$password'";
            $created_at = date('l d F Y h:i:s A').' From '.php_uname();
            $this->Store_model->save_user_activity($user_activity_url, $user_activity_type, $created_at, $created_by);
            $this->session->set_flashdata('exception', 'Your Email / Password Invalide!');
            redirect('checkout/login');
        }
    }
    
    public function save_customer_info() {
        $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email|is_unique[tbl_users.user_email]');
        $this->form_validation->set_rules('mobile', 'Mobile', 'trim|required|numeric|exact_length[11]|is_unique[tbl_users.user_mobile]');
        if ($this->form_validation->run() == FALSE) {
            $data = array();
            $data['title'] = 'Login';
            $data['all_categories'] = $this->Store_model->select_categories();
            $data['all_subcategories'] = $this->Store_model->select_subcategories();
            $data['all_subcategory_items'] = $this->Store_model->select_subcategory_items();
            $data['home'] = $this->load->view('store/login', $data, true);
            $this->load->view('store/master', $data);
        } else {
            $data = array();        
            $data['user_fullname'] = $this->input->post('name', true);
            $data['user_mobile'] = $this->input->post('mobile', true);
            $data['user_email'] = $this->input->post('email', true);
            $data['user_type'] = '3';
            $this->db->insert('tbl_users', $data);
            $user_id = $this->db->insert_id();
            $sdata = array();
            $sdata['user_id'] = $user_id;
            $this->session->set_userdata($sdata);
            redirect('client/shipping_form');
        }
    }
}