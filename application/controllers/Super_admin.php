<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Super_admin extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $admin_id = $this->session->userdata('admin_id');
        if ($admin_id == NULL) {
            redirect('login/admin_login', 'refresh');
        }
        $notification = array();
        $notification['notifications_number'] = $this->Super_admin_model->count_notification_for_the_user();
        $notification['notifications'] = $this->Super_admin_model->select_notification_for_the_user();
        $this->session->set_userdata($notification);
    }

    public function index() {
        $data = array();
        $data['title'] = 'Super Admin';
        $data['dashboard'] = $this->load->view('super_admin/dashboard', $data, true);
        $this->load->view('super_admin/master', $data);
    }
    
    public function settings() {
        $data = array();
        $data['title'] = 'Settings';
        $data['all_sliders'] = $this->Super_admin_model->select_all_slider();        
        $data['all_banners'] = $this->Super_admin_model->select_all_banner();
        $data['dashboard'] = $this->load->view('super_admin/settings', $data, true);
        $this->load->view('super_admin/master', $data);
    }
    
    public function save_slider() {
        $data = array();
        /* Initialize Image Library */
        $config['upload_path']          = 'media_library/images/slider_images/';
        $config['allowed_types']        = 'gif|jpg|png|jpeg';
        $config['max_size'] = 51200;
        $config['max_width'] = 5000;
        $config['max_height'] = 5000;
        $config['remove_spaces'] = TRUE;
        $config['encrypt_name'] = TRUE;
        /* End of Initialize Image Library */
        $this->load->library('upload', $config);
        /* Start Image Upload */
        if (!$this->upload->do_upload('picture'))
        {
            $this->session->set_flashdata('error', $this->upload->display_errors());
            redirect('super_admin/settings');
        }
        else
        {
            $data['setting'] = $this->upload->data('file_name');
        }
        /* End of Image Upload */
        $data['setting_type'] = 1;
        $this->db->insert('tbl_settings', $data);
        $this->session->set_flashdata('save_slider', 'Slider Saved!');
        redirect('super_admin/settings');        
    }
    
    public function delete_slider($slider_id) {
        $sql = "SELECT setting FROM tbl_settings WHERE pk_setting_id = '$slider_id'";      
        $query_result = $this->db->query($sql);
        $result = $query_result->row();
        $delete_image=$result->setting;
        unlink("./media_library/images/slider_images/".$delete_image);
        $this->db->where('pk_setting_id', $slider_id);
        $this->db->delete('tbl_settings');
        redirect('super_admin/settings');
    }
    
    public function save_banner() {
        $data = array();
        /* Initialize Image Library */
        $config['upload_path']          = 'media_library/images/banner_images/';
        $config['allowed_types']        = 'gif|jpg|png|jpeg';
        $config['max_size'] = 51200;
        $config['max_width'] = 5000;
        $config['max_height'] = 5000;
        $config['remove_spaces'] = TRUE;
        $config['encrypt_name'] = TRUE;
        /* End of Initialize Image Library */
        $this->load->library('upload', $config);
        /* Start Image Upload */
        if (!$this->upload->do_upload('picture'))
        {
            $this->session->set_flashdata('error', $this->upload->display_errors());
            redirect('super_admin/settings');
        }
        else
        {
            $data['setting'] = $this->upload->data('file_name');
        }
        /* End of Image Upload */
        $data['setting_data'] = $this->input->post("text");
        $data['setting_position'] = $this->input->post("setting_position");
        $data['setting_type'] = 2;
        $this->db->insert('tbl_settings', $data);
        $this->session->set_flashdata('save_banner', 'Banner Saved!');
        redirect('super_admin/settings');        
    }
    
    public function delete_banner($banner_id) {
        $sql = "SELECT setting FROM tbl_settings WHERE pk_setting_id = '$banner_id'";      
        $query_result = $this->db->query($sql);
        $result = $query_result->row();
        $delete_image=$result->setting;
        unlink("./media_library/images/banner_images/".$delete_image);
        $this->db->where('pk_setting_id', $banner_id);
        $this->db->delete('tbl_settings');
        redirect('super_admin/settings');
    }
    
    public function logout() {
        $this->session->unset_userdata('admin_id');
        $this->session->unset_userdata('admin_image');
        $this->session->unset_userdata('admin_name');
        $this->session->set_flashdata('exception', 'You are Successfully Logout!');
        redirect('login/admin_login');
    }

    public function manage_notifications() {
        $sql = "SELECT * FROM tbl_notifications ORDER BY pk_notification_id DESC";
        $query_result = $this->db->query($sql);
        $result = $query_result->result();
        $data = array();
        $data['title'] = 'Manage Notifications';
        $data['all_notifications'] = $result;
        $data['dashboard'] = $this->load->view('super_admin/manage_notifications', $data, true);
        $this->load->view('super_admin/master', $data);
    }
    
    public function delete_notification($notification_id) {
        $this->db->where('pk_notification_id', $notification_id);
        $this->db->delete('tbl_notifications');
        redirect('super_admin/manage_notifications');
    }
    
    public function manage_admins() {
        $row_count = $this->db->where('user_type', '1')->get('tbl_users');
        $config['base_url'] = base_url() . 'super_admin/manage_admins/';
        $config['total_rows'] = $row_count->num_rows();
        $this->pagination->initialize($config);
        $per_page = $this->pagination->per_page;
        $offset = $this->uri->segment(3);
        if ($offset == NULL)
        {
            $offset = 0;
        }
        $sql = "SELECT * FROM tbl_users WHERE user_type='1' ORDER BY pk_user_id DESC LIMIT $offset,$per_page";
        $query_result = $this->db->query($sql);
        $result = $query_result->result();
        $data = array();
        $data['title'] = 'Manage Admins';
        $data['all_admins'] = $result;
        $data['dashboard'] = $this->load->view('super_admin/manage_admins', $data, true);
        $this->load->view('super_admin/master', $data);
    }
    
    public function inactivate_admin($admin_id) {
        $this->db->set('user_status', 0);
        $this->db->where('pk_user_id', $admin_id);
        $this->db->update('tbl_users');
        redirect('super_admin/manage_admins');
    }

    public function activate_admin($admin_id) {
        $this->db->set('user_status', 1);
        $this->db->where('pk_user_id', $admin_id);
        $this->db->update('tbl_users');
        redirect('super_admin/manage_admins');
    }

    public function view_admin($admin_id) {
        $sql = "SELECT * FROM tbl_users WHERE user_type='1' AND pk_user_id='$admin_id'";
        $query_result = $this->db->query($sql);
        $result = $query_result->row();
        $data = array();
        $data['title'] = 'View The Admin';
        $data['admin_info'] = $result;
        $data['dashboard'] = $this->load->view('super_admin/view_admin', $data, true);
        $this->load->view('super_admin/master', $data);
    }

    public function edit_admin($admin_id) {
        $sql = "SELECT * FROM tbl_users WHERE user_type='1' AND pk_user_id='$admin_id'";
        $query_result = $this->db->query($sql);
        $result = $query_result->row();
        $data = array();
        $data['title'] = 'Edit New Admin';
        $data['admin_info'] = $result;
        $data['dashboard'] = $this->load->view('super_admin/edit_admin', $data, true);
        $this->load->view('super_admin/master', $data);
    }
    
    public function update_admin() {
        $id = $this->input->post("user_id");
        $this->form_validation->set_rules('email','Email','trim|required|valid_email|edit_unique[tbl_users.user_email.'.$id.']');
        $this->form_validation->set_rules('mobile', 'Mobile', 'trim|required|numeric|exact_length[11]|edit_unique[tbl_users.user_mobile.'.$id.']');
        if ($this->form_validation->run() == FALSE) {
            $sql = "SELECT * FROM tbl_users WHERE user_type='1' AND pk_user_id='$id'";
            $query_result = $this->db->query($sql);
            $result = $query_result->row();
            $data = array();
            $data['title'] = 'Edit New Admin';
            $data['admin_info'] = $result;
            $data['dashboard'] = $this->load->view('super_admin/edit_admin', $data, true);
            $this->load->view('super_admin/master', $data);
        } else {
            $data = array();                
            $data['user_fullname'] = $this->input->post('name', true);
            /* Initialize Image Library */
            $config['upload_path']          = 'media_library/images/user_images/';
            $config['allowed_types']        = 'gif|jpg|png|jpeg';
            $config['max_size'] = 51200;
            $config['max_width'] = 5000;
            $config['max_height'] = 5000;
            $config['remove_spaces'] = TRUE;
            $config['encrypt_name'] = TRUE;
            /* End of Initialize Image Library */
            $this->load->library('upload', $config);
            /* Update Profile Image */
            if($_FILES['profile_picture']['tmp_name']){
                if (!$this->upload->do_upload('profile_picture'))
                {
                    $this->session->set_flashdata('error', $this->upload->display_errors());
                    redirect('super_admin/edit_admin/'.$id);
                }
                else
                {
                    $data['user_image'] = $this->upload->data('file_name');
                }
                /* Delete Previous Profile Image */
                $previous_image=$this->input->post('previous_image');
                unlink('media_library/images/user_images/'.$previous_image);
            }
            else{
                /* If User Does Not Change Profile Image */
                $data['user_image'] = $this->input->post('previous_image', true);
            }
            /* End of Update Profile Image */
            $data['user_email'] = $this->input->post("email");
            $data['user_password'] = $this->input->post('password', true);
            $data['user_mobile'] = $this->input->post("mobile");
            $data['modified_at'] = date("Y-m-d H:i:s");
            $data['modified_by'] = $this->session->userdata('admin_id');
            $this->db->where('pk_user_id', $id);
            $this->db->update('tbl_users', $data);
            $this->session->set_flashdata('update_admin', 'Admin Updated!');
            redirect('super_admin/manage_admins');
        }
    }

    public function delete_admin($admin_id) {
        $sql = "SELECT user_image FROM tbl_users WHERE pk_user_id = '$admin_id'";      
        $query_result = $this->db->query($sql);
        $result = $query_result->row();
        $delete_image=$result->user_image;
        unlink("./media_library/images/user_images//".$delete_image);
        $this->db->where('pk_user_id', $admin_id);
        $this->db->delete('tbl_users');
        redirect('super_admin/manage_admins');
    }
    
    public function add_admin() {
        $data = array();
        $data['title'] = 'Add New Admin';
        $data['dashboard'] = $this->load->view('super_admin/add_admin', $data, true);
        $this->load->view('super_admin/master', $data);
    }

    public function save_admin() {
        $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email|is_unique[tbl_users.user_email]');
        $this->form_validation->set_rules('mobile', 'Mobile', 'trim|required|numeric|exact_length[11]|is_unique[tbl_users.user_mobile]');
        if ($this->form_validation->run() == FALSE) {
            $data = array();
            $data['title'] = 'Add New Admin';
            $data['dashboard'] = $this->load->view('super_admin/add_admin', $data, true);
            $this->load->view('super_admin/master', $data);
        } else {
            $data = array();
            $data['user_fullname'] = $this->input->post('name', true);
            if($_FILES['profile_picture']['tmp_name']){
                /* Initialize Image Library */
                $config['upload_path']          = 'media_library/images/user_images/';
                $config['allowed_types']        = 'gif|jpg|png|jpeg';
                $config['max_size'] = 51200;
                $config['max_width'] = 5000;
                $config['max_height'] = 5000;
                $config['remove_spaces'] = TRUE;
                $config['encrypt_name'] = TRUE;
                /* End of Initialize Image Library */
                $this->load->library('upload', $config);
                /* Start Image Upload */
                if (!$this->upload->do_upload('profile_picture'))
                {
                    $this->session->set_flashdata('error', $this->upload->display_errors());
                    redirect('super_admin/add_admin');
                }
                else
                {
                    $data['user_image'] = $this->upload->data('file_name');
                }
                /* End of Image Upload */
            }
            $data['user_email'] = $this->input->post('email', true);
            $data['user_password'] = $this->input->post('password', true);
            $data['user_mobile'] = $this->input->post('mobile', true);
            $data['user_type'] = 1;
            $data['created_at'] = date("Y-m-d H:i:s");
            $data['created_by'] = $this->session->userdata('admin_id');
            $this->db->insert('tbl_users', $data);
            $this->session->set_flashdata('save_admin', 'Admin Saved!');
            redirect('super_admin/add_admin');
        }
    }
    
    public function manage_customers() {
        $row_count = $this->db->where('user_type', '3')->get('tbl_users');
        $config['base_url'] = base_url() . 'super_admin/manage_customers/';
        $config['total_rows'] = $row_count->num_rows();
        $this->pagination->initialize($config);
        $per_page = $this->pagination->per_page;
        $offset = $this->uri->segment(3);
        if ($offset == NULL)
        {
            $offset = 0;
        }
        $sql = "SELECT * FROM tbl_users WHERE user_type='3' ORDER BY pk_user_id DESC LIMIT $offset,$per_page";
        $query_result = $this->db->query($sql);
        $result = $query_result->result();
        $data = array();
        $data['title'] = 'Manage Customers';
        $data['all_customers'] = $result;
        $data['dashboard'] = $this->load->view('super_admin/manage_customers', $data, true);
        $this->load->view('super_admin/master', $data);
    }
    
    public function inactivate_customer($customer_id) {
        $this->db->set('user_status', 0);
        $this->db->where('pk_user_id', $customer_id);
        $this->db->update('tbl_users');
        redirect('super_admin/manage_customers');
    }

    public function activate_customer($customer_id) {
        $this->db->set('user_status', 1);
        $this->db->where('pk_user_id', $customer_id);
        $this->db->update('tbl_users');
        redirect('super_admin/manage_customers');
    }

    public function view_customer($customer_id) {
        $sql = "SELECT * FROM tbl_users WHERE user_type='3' AND pk_user_id='$customer_id'";
        $query_result = $this->db->query($sql);
        $result = $query_result->row();
        $data = array();
        $data['title'] = 'View The Customer';
        $data['customer_info'] = $result;
        $data['dashboard'] = $this->load->view('super_admin/view_customer', $data, true);
        $this->load->view('super_admin/master', $data);
    }

    public function edit_customer($customer_id) {
        $sql = "SELECT * FROM tbl_users WHERE user_type='3' AND pk_user_id='$customer_id'";
        $query_result = $this->db->query($sql);
        $result = $query_result->row();
        $data = array();
        $data['title'] = 'Edit New Customer';
        $data['customer_info'] = $result;
        $data['dashboard'] = $this->load->view('super_admin/edit_customer', $data, true);
        $this->load->view('super_admin/master', $data);
    }
    
    public function update_customer() {
        $id = $this->input->post("user_id");
        $this->form_validation->set_rules('email','Email','trim|required|valid_email|edit_unique[tbl_users.user_email.'.$id.']');
        $this->form_validation->set_rules('mobile', 'Mobile', 'trim|required|numeric|exact_length[11]|edit_unique[tbl_users.user_mobile.'.$id.']');
        if ($this->form_validation->run() == FALSE) {
            $sql = "SELECT * FROM tbl_users WHERE user_type='3' AND pk_user_id='$id'";
            $query_result = $this->db->query($sql);
            $result = $query_result->row();
            $data = array();
            $data['title'] = 'Edit New Customer';
            $data['customer_info'] = $result;
            $data['dashboard'] = $this->load->view('super_admin/edit_customer', $data, true);
            $this->load->view('super_admin/master', $data);
        } else {
            $data = array();                
            $data['user_fullname'] = $this->input->post('name', true);
            /* Initialize Image Library */
            $config['upload_path']          = 'media_library/images/user_images/';
            $config['allowed_types']        = 'gif|jpg|png|jpeg';
            $config['max_size'] = 51200;
            $config['max_width'] = 5000;
            $config['max_height'] = 5000;
            $config['remove_spaces'] = TRUE;
            $config['encrypt_name'] = TRUE;
            /* End of Initialize Image Library */
            $this->load->library('upload', $config);
            /* Update Profile Image */
            if($_FILES['profile_picture']['tmp_name']){
                if (!$this->upload->do_upload('profile_picture'))
                {
                    $this->session->set_flashdata('error', $this->upload->display_errors());
                    redirect('super_admin/edit_customer/'.$id);
                }
                else
                {
                    $data['user_image'] = $this->upload->data('file_name');
                }
                /* Delete Previous Profile Image */
                $previous_image=$this->input->post('previous_image');
                unlink('media_library/images/user_images/'.$previous_image);
            }
            else{
                /* If User Does Not Change Profile Image */
                $data['user_image'] = $this->input->post('previous_image', true);
            }
            /* End of Update Profile Image */
            $data['user_email'] = $this->input->post("email");
            $data['user_mobile'] = $this->input->post("mobile");
            $data['user_password'] = $this->input->post('password', true);
            $data['user_address'] = $this->input->post("address");
            $data['modified_at'] = date("Y-m-d H:i:s");
            $data['modified_by'] = $this->session->userdata('admin_id');
            $this->db->where('pk_user_id', $id);
            $this->db->update('tbl_users', $data);
            $this->session->set_flashdata('update_customer', 'Customer Updated!');
            redirect('super_admin/manage_customers');
        }
    }

    public function delete_customer($customer_id) {
        $sql = "SELECT user_image FROM tbl_users WHERE pk_user_id = '$customer_id'";      
        $query_result = $this->db->query($sql);
        $result = $query_result->row();
        $delete_image=$result->user_image;
        unlink("./media_library/images/user_images/".$delete_image);
        $this->db->where('pk_user_id', $customer_id);
        $this->db->delete('tbl_users');
        redirect('super_admin/manage_customers');
    }
    
    public function add_customer() {
        $data = array();
        $data['title'] = 'Add New Customer';
        $data['dashboard'] = $this->load->view('super_admin/add_customer', $data, true);
        $this->load->view('super_admin/master', $data);
    }

    public function save_customer() {
        $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email|is_unique[tbl_users.user_email]');
        $this->form_validation->set_rules('mobile', 'Mobile', 'trim|required|numeric|exact_length[11]|is_unique[tbl_users.user_mobile]');
        if ($this->form_validation->run() == FALSE) {
            $data = array();
            $data['title'] = 'Add New Customer';
            $data['dashboard'] = $this->load->view('super_admin/add_customer', $data, true);
            $this->load->view('super_admin/master', $data);
        } else {
            $data = array();
            $data['user_fullname'] = $this->input->post('name', true);
            if($_FILES['profile_picture']['tmp_name']){
                /* Initialize Image Library */
                $config['upload_path']          = 'media_library/images/user_images/';
                $config['allowed_types']        = 'gif|jpg|png|jpeg';
                $config['max_size'] = 51200;
                $config['max_width'] = 5000;
                $config['max_height'] = 5000;
                $config['remove_spaces'] = TRUE;
                $config['encrypt_name'] = TRUE;
                /* End of Initialize Image Library */
                $this->load->library('upload', $config);
                /* Start Image Upload */
                if (!$this->upload->do_upload('profile_picture'))
                {
                    $this->session->set_flashdata('error', $this->upload->display_errors());
                    redirect('super_admin/add_customer');
                }
                else
                {
                    $data['user_image'] = $this->upload->data('file_name');
                }
                /* End of Image Upload */
            }
            $data['user_email'] = $this->input->post('email', true);
            $data['user_mobile'] = $this->input->post('mobile', true);
            $data['user_password'] = $this->input->post('password', true);
            $data['user_address'] = $this->input->post('address', true);
            $data['user_type'] = 3;
            $data['created_at'] = date("Y-m-d H:i:s");
            $data['created_by'] = $this->session->userdata('admin_id');
            $this->db->insert('tbl_users', $data);
            $this->session->set_flashdata('save_customer', 'Customer Saved!');
            redirect('super_admin/add_customer');
        }
    }
    
    public function manage_categories() {
        $row_count = $this->db->get('tbl_categories');
        $config['base_url'] = base_url() . 'super_admin/manage_categories/';
        $config['total_rows'] = $row_count->num_rows();
        $this->pagination->initialize($config);
        $per_page = $this->pagination->per_page;
        $offset = $this->uri->segment(3);
        if ($offset == NULL)
        {
            $offset = 0;
        }
        $sql = "SELECT * FROM tbl_categories ORDER BY pk_category_id DESC LIMIT $offset,$per_page";
        $query_result = $this->db->query($sql);
        $result = $query_result->result();
        $data = array();
        $data['title'] = 'Manage Categories';
        $data['all_categories'] = $result;
        $data['dashboard'] = $this->load->view('super_admin/manage_categories', $data, true);
        $this->load->view('super_admin/master', $data);
    }
    
    public function edit_category($category_id) {
        $sql = "SELECT * FROM tbl_categories WHERE pk_category_id='$category_id'";
        $query_result = $this->db->query($sql);
        $result = $query_result->row();
        $data = array();
        $data['title'] = 'Edit New Category';
        $data['category_info'] = $result;
        $data['dashboard'] = $this->load->view('super_admin/edit_category', $data, true);
        $this->load->view('super_admin/master', $data);
    }
    
    public function update_category() {
        $data = array();
        $data['category_serial'] = $this->input->post('serial', true);
        $data['category_name'] = $this->input->post('category_name', true);
        $id = $this->input->post('category_id', true);
        $this->db->where('pk_category_id', $id);
        $this->db->update('tbl_categories', $data);
        $this->session->set_flashdata('update_category', 'Category Updated!');
        redirect('super_admin/manage_categories');
    }

    public function delete_category($category_id) {
        $this->db->where('pk_category_id', $category_id);
        $this->db->delete('tbl_categories');
        redirect('super_admin/manage_categories');
    }
    
    public function add_category() {
        $data = array();
        $data['title'] = 'Add New Category';
        $data['dashboard'] = $this->load->view('super_admin/add_category', $data, true);
        $this->load->view('super_admin/master', $data);
    }

    public function save_category() {
        $this->form_validation->set_rules('category_name', 'Category Name', 'trim|required|is_unique[tbl_categories.category_name]');
        if ($this->form_validation->run() == FALSE) {
            $data = array();
            $data['title'] = 'Add New Category';
            $data['dashboard'] = $this->load->view('super_admin/add_category', $data, true);
            $this->load->view('super_admin/master', $data);
        } else {
            $data = array();
            $data['category_name'] = $this->input->post('category_name', true);
            $data['category_type'] = 1;
            $this->db->insert('tbl_categories', $data);
            $this->session->set_flashdata('save_category', 'Category Saved!');
            redirect('super_admin/add_category');
        }
    }
    
    public function add_subcategory() {
        $data = array();
        $data['title'] = 'Add New Subcategory';
        $data['all_categories'] = $this->db->where('category_type', 1)->get('tbl_categories')->result();
        $data['dashboard'] = $this->load->view('super_admin/add_subcategory', $data, true);
        $this->load->view('super_admin/master', $data);
    }

    public function save_subcategory() {
        $this->form_validation->set_rules('category_name', 'Sub Category Name', 'trim|required|is_unique[tbl_categories.category_name]');
        if ($this->form_validation->run() == FALSE) {
            $data = array();
            $data['title'] = 'Add New Subcategory';
            $data['all_categories'] = $this->db->where('category_type', 1)->get('tbl_categories')->result();
            $data['dashboard'] = $this->load->view('super_admin/add_subcategory', $data, true);
            $this->load->view('super_admin/master', $data);
        } else {
            $data = array();
            $data['category_name'] = $this->input->post('category_name', true);
            $data['category_type'] = 2;
            $data['category_relation'] = $this->input->post('category_id', true);
            $this->db->insert('tbl_categories', $data);
            $this->session->set_flashdata('save_category', 'Subcategory Saved!');
            redirect('super_admin/add_subcategory');
        }
    }
    
    public function ajax_subcategories($category_id)
    {
        $data = array();
        $data['all_subcategories'] = $this->db->where('category_relation', $category_id)->get('tbl_categories')->result();
        $this->load->view('super_admin/subcategories', $data);
    }
    
    public function add_subcategory_item() {
        $data = array();
        $data['title'] = 'Add New Category';
        $data['all_categories'] = $this->db->where('category_type', 1)->get('tbl_categories')->result();
        $data['all_subcategories'] = $this->db->where('category_type', 2)->get('tbl_categories')->result();
        $data['dashboard'] = $this->load->view('super_admin/add_subcategory_item', $data, true);
        $this->load->view('super_admin/master', $data);
    }

    public function save_subcategory_item() {
        $this->form_validation->set_rules('category_name', 'Sub Category Item Name', 'trim|required|is_unique[tbl_categories.category_name]');
        if ($this->form_validation->run() == FALSE) {
            $data = array();
            $data['title'] = 'Add New Category';
            $data['all_categories'] = $this->db->where('category_type', 1)->get('tbl_categories')->result();
            $data['all_subcategories'] = $this->db->where('category_type', 2)->get('tbl_categories')->result();
            $data['dashboard'] = $this->load->view('super_admin/add_subcategory_item', $data, true);
            $this->load->view('super_admin/master', $data);
        } else {
            $data = array();
            $data['category_name'] = $this->input->post('category_name', true);
            $data['category_type'] = 3;
            $data['category_relation'] = $this->input->post('subcategory_id', true);
            $this->db->insert('tbl_categories', $data);
            $this->session->set_flashdata('save_category', 'Category Saved!');
            redirect('super_admin/add_subcategory_item');
        }
    }
    
    public function ajax_subcategory_items($category_id)
    {
        $data = array();
        $data['all_subcategory_items'] = $this->db->where('category_relation', $category_id)->get('tbl_categories')->result();
        $this->load->view('super_admin/subcategoryItems', $data);
    }
    
    public function manage_products() {
        $row_count = $this->db->get('tbl_products');
        $config['base_url'] = base_url() . 'super_admin/manage_products/';
        $config['total_rows'] = $row_count->num_rows();
        $this->pagination->initialize($config);
        $per_page = $this->pagination->per_page;
        $offset = $this->uri->segment(3);
        if ($offset == NULL)
        {
            $offset = 0;
        }
        $sql = "SELECT * FROM tbl_products ORDER BY pk_product_id DESC LIMIT $offset,$per_page";
        $query_result = $this->db->query($sql);
        $result = $query_result->result('array');
        if ($result) {
            foreach ($result as $i => $product) {
                $sql = "SELECT category_name FROM tbl_categories WHERE pk_category_id = '" . $product['fk_category_id'] . "'";
                $category = $this->db->query($sql);
                $metaData = $category->row_array();
                $result[$i]['category'] = $metaData['category_name'];
            }
        }
        if ($result) {
            foreach ($result as $i => $product) {
                $sql = "SELECT category_name FROM tbl_categories WHERE pk_category_id = '" . $product['fk_subcategory_id'] . "'";
                $subcategory = $this->db->query($sql);
                $metaData = $subcategory->row_array();
                $result[$i]['subcategory'] = $metaData['category_name'];
            }
        }
        if ($result) {
            foreach ($result as $i => $product) {
                $sql = "SELECT category_name FROM tbl_categories WHERE pk_category_id = '" . $product['fk_subcategory_item_id'] . "'";
                $subcategory_item = $this->db->query($sql);
                $metaData = $subcategory_item->row_array();
                $result[$i]['subcategory_item'] = $metaData['category_name'];
            }
        }
        $data = array();
        $data['title'] = 'Manage Products';
        $data['all_products'] = $result;
        $data['dashboard'] = $this->load->view('super_admin/manage_products', $data, true);
        $this->load->view('super_admin/master', $data);
    }
    
    public function inactivate_product($product_id) {
        $this->db->set('product_status', 0);
        $this->db->where('pk_product_id', $product_id);
        $this->db->update('tbl_products');
        redirect('super_admin/manage_products');
    }

    public function activate_product($product_id) {
        $this->db->set('product_status', 1);
        $this->db->where('pk_product_id', $product_id);
        $this->db->update('tbl_products');
        redirect('super_admin/manage_products');
    }

    public function edit_product($product_id) {
        $sql = "SELECT * FROM tbl_products WHERE pk_product_id='$product_id'";
        $query_result = $this->db->query($sql);
        $result = $query_result->row_array();
        if ($result) {
            $sql = "SELECT product_meta_name, product_meta_value FROM tbl_productmeta WHERE fk_product_id = '" . $product_id . "'";
            $metaData = $this->db->query($sql);
            $meta = $metaData->result('array');
            $result['meta'] = array();
            if ($meta) {
                foreach ($meta as $eachMeta) {
                    $result['meta'][$eachMeta['product_meta_name']] = $eachMeta['product_meta_value'];
                }
            }
        }
        $data = array();
        $data['title'] = 'Edit New Product';
        $data['all_categories'] = $this->db->where('category_type', 1)->get('tbl_categories')->result();
        $data['all_subcategories'] = $this->db->where('category_type', 2)->get('tbl_categories')->result();
        $data['all_subcategory_items'] = $this->db->where('category_type', 3)->get('tbl_categories')->result();
        $data['product_info'] = $result;
        $data['dashboard'] = $this->load->view('super_admin/edit_product', $data, true);
        $this->load->view('super_admin/master', $data);
    }
    
    public function update_product() {
        $admin_id = $this->session->userdata('admin_id');
        $id = $this->input->post("product_id");
        $data = array();
        $data['product_attribute'] = $this->input->post('attribute', true);
        $data['fk_category_id'] = $this->input->post('category_id', true);
        $data['fk_subcategory_id'] = $this->input->post('subcategory_id', true);
        $data['fk_subcategory_item_id'] = $this->input->post('subcategory_item_id', true);
        $data['product_name'] = $this->input->post('name', true);
        /* Path and Library Configuration */
        $config['upload_path']          = 'media_library/images/product_images/';
        $config['allowed_types']        = 'gif|jpg|png|jpeg';
        $config['max_size'] = 51200;
        $config['max_width'] = 5000;
        $config['max_height'] = 5000;
        $config['remove_spaces'] = TRUE;
        $config['encrypt_name'] = TRUE;
        $this->load->library('upload', $config);
        /* End of Path and Library Configuration */
        /* Upload Product Image */
        if($_FILES['product_picture']['tmp_name']){
            if (!$this->upload->do_upload('product_picture'))
            {
                $this->session->set_flashdata('error', $this->upload->display_errors());
                redirect('super_admin/add_product');
            }
            else
            {
                $data['product_image'] = $this->upload->data('file_name');
            }
            /* Resize Image */
            $upload_data = $this->upload->data();
            $config['image_library'] = 'gd2';
            $config['source_image'] = $upload_data['full_path'];
            $config['create_thumb'] = TRUE;
            $config['maintain_ratio'] = FALSE;
            $config['width']         = 250;
            $config['height']       = 300;
            $this->load->library('image_lib', $config);
            $this->image_lib->resize();
            /* End of Resize Image */
            $data['product_image_thumb'] = $this->upload->data('raw_name').'_thumb'.$this->upload->data('file_ext');
            /* Delete Previous Product Image */
            $previous_product_image=$this->input->post('previous_product_picture', true);
            unlink('media_library/images/product_images/'.$previous_product_image);
            $previous_thumb_image=$this->input->post('previous_product_picture_thumb', true);
            unlink('media_library/images/product_images/'.$previous_thumb_image);
        }    
        else{
            /* If User Does Not Change Product Image */
            $data['product_image'] = $this->input->post('previous_product_picture', true);
        }
        /* End of Upload Product Image */
        $old_price = $this->input->post('old_price', true);
        if($old_price > 0){
            $data['product_old_price'] = $old_price;
        }
        else{
             $data['product_old_price'] = NULL;
        }
        $data['product_price'] = $this->input->post('price', true);
        $data['modified_at'] = date("Y-m-d H:i:s");
        $data['modified_by'] = $admin_id;
        $this->db->where('pk_product_id', $id);
        $this->db->update('tbl_products', $data);
        $this->db->where('fk_product_id', $id);
        $this->db->delete('tbl_productmeta');
        foreach ($this->input->post('meta') as $key => $value) {
            $meta = array();
            $meta['fk_product_id'] = $id;
            $meta['product_meta_name'] = $key;
            $meta['product_meta_value'] = $value;
            $this->db->insert('tbl_productmeta', $meta);
        }
        if($_FILES['product_picture_2']['tmp_name']){
            $meta_image = array();
            $meta_image['fk_product_id'] = $id;
            $meta_image['product_meta_name'] = 'product_image_2';
            if (!$this->upload->do_upload('product_picture_2'))
            {
                $this->session->set_flashdata('error', $this->upload->display_errors());
                redirect('super_admin/add_product');
            }
            else
            {
                $meta_image['product_meta_value'] = $this->upload->data('file_name');
            }            
            $this->db->insert('tbl_productmeta', $meta_image);
            $previous_product_picture_2 = $this->input->post('previous_product_picture_2', true);
            unlink("./media_library/images/product_images/".$previous_product_picture_2);
        }
        else{
            $meta_image = array();
            $meta_image['fk_product_id'] = $id;
            $meta_image['product_meta_name'] = 'product_image_2';
            $meta_image['product_meta_value'] = $this->input->post('previous_product_picture_2', true);
            $this->db->insert('tbl_productmeta', $meta_image);
        }
        if($_FILES['product_picture_3']['tmp_name']){
            $meta_image = array();
            $meta_image['fk_product_id'] = $id;
            $meta_image['product_meta_name'] = 'product_image_3';
            if (!$this->upload->do_upload('product_picture_3'))
            {
                $this->session->set_flashdata('error', $this->upload->display_errors());
                redirect('super_admin/add_product');
            }
            else
            {
                $meta_image['product_meta_value'] = $this->upload->data('file_name');
            }            
            $this->db->insert('tbl_productmeta', $meta_image);
            $previous_product_picture_3 = $this->input->post('previous_product_picture_3', true);
            unlink("./media_library/images/product_images/".$previous_product_picture_3);
        }
        else{
            $meta_image = array();
            $meta_image['fk_product_id'] = $id;
            $meta_image['product_meta_name'] = 'product_image_3';
            $meta_image['product_meta_value'] = $this->input->post('previous_product_picture_3', true);
            $this->db->insert('tbl_productmeta', $meta_image);
        }
        if($_FILES['product_picture_4']['tmp_name']){
            $meta_image = array();
            $meta_image['fk_product_id'] = $id;
            $meta_image['product_meta_name'] = 'product_image_4';
            if (!$this->upload->do_upload('product_picture_4'))
            {
                $this->session->set_flashdata('error', $this->upload->display_errors());
                redirect('super_admin/add_product');
            }
            else
            {
                $meta_image['product_meta_value'] = $this->upload->data('file_name');
            }            
            $this->db->insert('tbl_productmeta', $meta_image);
            $previous_product_picture_4 = $this->input->post('previous_product_picture_4', true);
            unlink("./media_library/images/product_images/".$previous_product_picture_4);
        }
        else{
            $meta_image = array();
            $meta_image['fk_product_id'] = $id;
            $meta_image['product_meta_name'] = 'product_image_4';
            $meta_image['product_meta_value'] = $this->input->post('previous_product_picture_4', true);
            $this->db->insert('tbl_productmeta', $meta_image);
        }
        if($_FILES['product_picture_5']['tmp_name']){
            $meta_image = array();
            $meta_image['fk_product_id'] = $id;
            $meta_image['product_meta_name'] = 'product_image_5';
            if (!$this->upload->do_upload('product_picture_5'))
            {
                $this->session->set_flashdata('error', $this->upload->display_errors());
                redirect('super_admin/add_product');
            }
            else
            {
                $meta_image['product_meta_value'] = $this->upload->data('file_name');
            }            
            $this->db->insert('tbl_productmeta', $meta_image);
            $previous_product_picture_5 = $this->input->post('previous_product_picture_5', true);
            unlink("./media_library/images/product_images/".$previous_product_picture_5);
        }
        else{
            $meta_image = array();
            $meta_image['fk_product_id'] = $id;
            $meta_image['product_meta_name'] = 'product_image_5';
            $meta_image['product_meta_value'] = $this->input->post('previous_product_picture_5', true);
            $this->db->insert('tbl_productmeta', $meta_image);
        }
        $this->session->set_flashdata('update_product', 'Product Updated!');
        redirect('super_admin/manage_products');
    }

    public function delete_product($product_id) {
        $img = "SELECT product_image FROM tbl_products WHERE pk_product_id = '$product_id'";      
        $query_img = $this->db->query($img);
        $result_img = $query_img->row();
        $delete_img=$result_img->product_image;
        unlink("./media_library/images/product_images/".$delete_img);
        $thumb_img = "SELECT product_image_thumb FROM tbl_products WHERE pk_product_id = '$product_id'";      
        $query_thumb = $this->db->query($thumb_img);
        $result_thumb = $query_thumb->row();
        $img_name = $result_thumb->product_image_thumb;
        unlink("./media_library/images/product_images/".$img_name);
        $img_2 = "SELECT product_meta_value FROM tbl_productmeta WHERE product_meta_name = 'product_image_2' AND fk_product_id = '$product_id'";      
        $query_img_2 = $this->db->query($img_2);
        $result_img_2 = $query_img_2->row();
        $delete_img_2=$result_img_2->product_meta_value;
        unlink("./media_library/images/product_images/".$delete_img_2);
        $img_3 = "SELECT product_meta_value FROM tbl_productmeta WHERE product_meta_name = 'product_image_3' AND fk_product_id = '$product_id'";      
        $query_img_3 = $this->db->query($img_3);
        $result_img_3 = $query_img_3->row();
        $delete_img_3=$result_img_3->product_meta_value;
        unlink("./media_library/images/product_images/".$delete_img_3);
        $img_4 = "SELECT product_meta_value FROM tbl_productmeta WHERE product_meta_name = 'product_image_4' AND fk_product_id = '$product_id'";      
        $query_img_4 = $this->db->query($img_4);
        $result_img_4 = $query_img_4->row();
        $delete_img_4=$result_img_4->product_meta_value;
        unlink("./media_library/images/product_images/".$delete_img_4);
        $img_5 = "SELECT product_meta_value FROM tbl_productmeta WHERE product_meta_name = 'product_image_5' AND fk_product_id = '$product_id'";      
        $query_img_5 = $this->db->query($img_5);
        $result_img_5 = $query_img_5->row();
        $delete_img_5=$result_img_5->product_meta_value;
        unlink("./media_library/images/product_images/".$delete_img_5);
        $this->db->where('pk_product_id', $product_id);
        $this->db->delete('tbl_products');
        $this->db->where('fk_product_id', $product_id);
        $this->db->delete('tbl_productmeta');
        redirect('super_admin/manage_products');
    }
    
    public function add_product() {
        $data = array();
        $data['title'] = 'Add New Product';
        $data['all_categories'] = $this->db->where('category_type', 1)->get('tbl_categories')->result();
        $data['all_subcategories'] = $this->db->where('category_type', 2)->get('tbl_categories')->result();
        $data['dashboard'] = $this->load->view('super_admin/add_product', $data, true);
        $this->load->view('super_admin/master', $data);
    }

    public function save_product() {
        $admin_id = $this->session->userdata('admin_id');
        $data = array();
        $data['product_attribute'] = $this->input->post('attribute', true);
        $data['fk_category_id'] = $this->input->post('category_id', true);
        $data['fk_subcategory_id'] = $this->input->post('subcategory_id', true);
        $data['fk_subcategory_item_id'] = $this->input->post('subcategory_item_id', true);
        $data['product_name'] = $this->input->post('name', true);
        /* Path and Library Configuration */
        $config['upload_path']          = 'media_library/images/product_images/';
        $config['allowed_types']        = 'gif|jpg|png|jpeg';
        $config['max_size'] = '51200';
        $config['max_width'] = '5000';
        $config['max_height'] = '5000';
        $config['remove_spaces'] = TRUE;
        $config['encrypt_name'] = TRUE;
        $this->load->library('upload', $config);
        /* End of Path and Library Configuration */
        /* Upload Product Image */
        if($_FILES['product_picture']['tmp_name']){
            if (!$this->upload->do_upload('product_picture'))
            {
                $this->session->set_flashdata('error', $this->upload->display_errors());
                redirect('super_admin/add_product');
            }
            else
            {
                $data['product_image'] = $this->upload->data('file_name');
            }
            /* Resize Image */
            $upload_data = $this->upload->data();
            $config['image_library'] = 'gd2';
            $config['source_image'] = $upload_data['full_path'];
            $config['create_thumb'] = TRUE;
            $config['maintain_ratio'] = FALSE;
            $config['width']         = 250;
            $config['height']       = 300;
            $this->load->library('image_lib', $config);
            $this->image_lib->resize();
            /* End of Resize Image */
            $data['product_image_thumb'] = $this->upload->data('raw_name').'_thumb'.$this->upload->data('file_ext');
        }
        /* End of Upload Product Image */
        $data['product_price'] = $this->input->post('price', true);
        $data['created_at'] = date("Y-m-d H:i:s");
        $data['created_by'] = $admin_id;
        $this->db->insert('tbl_products', $data);
        $fk_product_id = $this->db->insert_id();
        foreach ($this->input->post('meta') as $key => $value) {
            $meta = array();
            $meta['fk_product_id'] = $fk_product_id;
            $meta['product_meta_name'] = $key;
            $meta['product_meta_value'] = $value;
            $this->db->insert('tbl_productmeta', $meta);
        }
        if($_FILES['product_picture_2']['tmp_name']){
            $meta_image = array();
            $meta_image['fk_product_id'] = $fk_product_id;
            $meta_image['product_meta_name'] = 'product_image_2';
            if (!$this->upload->do_upload('product_picture_2'))
            {
                $this->session->set_flashdata('error', $this->upload->display_errors());
                redirect('super_admin/add_product');
            }
            else
            {
                $meta_image['product_meta_value'] = $this->upload->data('file_name');
            }            
            $this->db->insert('tbl_productmeta', $meta_image);
        }
        if($_FILES['product_picture_3']['tmp_name']){
            $meta_image = array();
            $meta_image['fk_product_id'] = $fk_product_id;
            $meta_image['product_meta_name'] = 'product_image_3';
            if (!$this->upload->do_upload('product_picture_3'))
            {
                $this->session->set_flashdata('error', $this->upload->display_errors());
                redirect('super_admin/add_product');
            }
            else
            {
                $meta_image['product_meta_value'] = $this->upload->data('file_name');
            }            
            $this->db->insert('tbl_productmeta', $meta_image);
        }
        if($_FILES['product_picture_4']['tmp_name']){
            $meta_image = array();
            $meta_image['fk_product_id'] = $fk_product_id;
            $meta_image['product_meta_name'] = 'product_image_4';
            if (!$this->upload->do_upload('product_picture_4'))
            {
                $this->session->set_flashdata('error', $this->upload->display_errors());
                redirect('super_admin/add_product');
            }
            else
            {
                $meta_image['product_meta_value'] = $this->upload->data('file_name');
            }            
            $this->db->insert('tbl_productmeta', $meta_image);
        }
        if($_FILES['product_picture_5']['tmp_name']){
            $meta_image = array();
            $meta_image['fk_product_id'] = $fk_product_id;
            $meta_image['product_meta_name'] = 'product_image_5';
            if (!$this->upload->do_upload('product_picture_5'))
            {
                $this->session->set_flashdata('error', $this->upload->display_errors());
                redirect('super_admin/add_product');
            }
            else
            {
                $meta_image['product_meta_value'] = $this->upload->data('file_name');
            }            
            $this->db->insert('tbl_productmeta', $meta_image);
        }
        $this->session->set_flashdata('success', 'Product Saved!');
        redirect('super_admin/add_product');
    }
    
    public function manage_orders() {
        $row_count = $this->db->get('tbl_orders');
        $config['base_url'] = base_url() . 'super_admin/manage_orders/';
        $config['total_rows'] = $row_count->num_rows();
        $this->pagination->initialize($config);
        $per_page = $this->pagination->per_page;
        $offset = $this->uri->segment(3);
        if ($offset == NULL)
        {
            $offset = 0;
        }
        $sql = "SELECT * FROM tbl_orders ORDER BY pk_order_id DESC LIMIT $offset,$per_page";
        $query_result = $this->db->query($sql);
        $result = $query_result->result('array');
        $data = array();
        $data['title'] = 'Manage Orders';
        $data['all_orders'] = $result;
        $data['dashboard'] = $this->load->view('super_admin/manage_orders', $data, true);
        $this->load->view('super_admin/master', $data);
    }
    
    public function unconfirmed_payment($order_id) {
        $this->db->set('modified_at', date("Y-m-d H:i:s"));
        $this->db->set('modified_by', $this->session->userdata('admin_id'));
        $this->db->set('order_status', 0);
        $this->db->where('pk_order_id', $order_id);
        $this->db->update('tbl_orders');
        redirect('super_admin/manage_orders');
    }

    public function confirm_payment($order_id) {
        $this->db->set('modified_at', date("Y-m-d H:i:s"));
        $this->db->set('modified_by', $this->session->userdata('admin_id'));
        $this->db->set('order_status', 1);
        $this->db->where('pk_order_id', $order_id);
        $this->db->update('tbl_orders');
        redirect('super_admin/manage_orders');
    }

    public function view_order($order_id) {
        $this->db->set('view_status', 1);
        $this->db->where('notification', $order_id);
        $this->db->update('tbl_notifications');
        $sql = "SELECT * FROM tbl_orders AS o, tbl_users AS u, tbl_shippings AS s WHERE pk_order_id='$order_id' AND o.created_by = u.pk_user_id AND o.fk_shipping_id = s.pk_shipping_id";
        $query_result = $this->db->query($sql);
        $result = $query_result->row();
        $order_details = "SELECT * FROM tbl_ordermeta WHERE fk_order_id='$order_id'";
        $order_result = $this->db->query($order_details);
        $ordermeta = $order_result->result();
        $data = array();
        $data['title'] = 'View The Order';
        $data['order_info'] = $result;
        $data['ordermeta'] = $ordermeta;
        $data['dashboard'] = $this->load->view('super_admin/view_order', $data, true);
        $this->load->view('super_admin/master', $data);
    }

    public function delete_order($order_id) {
        $this->db->where('pk_order_id', $order_id);
        $this->db->delete('tbl_orders');
        $this->db->where('fk_order_id', $order_id);
        $this->db->delete('tbl_ordermeta');
        redirect('super_admin/manage_orders');
    }
}