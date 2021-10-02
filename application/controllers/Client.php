<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Client extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $user_id = $this->session->userdata('user_id');
        if ($user_id == NULL) {
            redirect('checkout/login', 'refresh');
        }
    }

    public function logout() {
        $this->session->unset_userdata('user_id');
        $this->session->unset_userdata('user_image');
        $this->session->unset_userdata('user_name');
        $this->session->set_flashdata('exception', 'You are Successfully Logout!');
        redirect('checkout/login');
    }

    public function shipping_form() {
        if(!$this->cart->total_items()){
            redirect('store');
        }
        $user_id = $this->session->userdata('user_id');
        $data = array();
        $data['title'] = 'Shipping Form';
        $data['all_categories'] = $this->Store_model->select_categories();
        $data['all_subcategories'] = $this->Store_model->select_subcategories();
        $data['all_subcategory_items'] = $this->Store_model->select_subcategory_items();
        $data['customer_info'] = $this->db->where('pk_user_id', $user_id)->get('tbl_users');
        $data['home'] = $this->load->view('store/shipping_form', $data, true);
        $this->load->view('store/master', $data);
    }
    
    public function save_shipping_info() {
        $shipping_data=array();        
        $shipping_data['delivery_name'] = $this->input->post('delivery_name', true);
        $shipping_data['delivery_email'] = $this->input->post('delivery_email', true);
        $shipping_data['delivery_mobile'] = $this->input->post('delivery_mobile', true);
        $shipping_data['delivery_address'] = $this->input->post('delivery_address', true);
        $shipping_data['billing_name'] = $this->input->post('billing_name', true);
        $shipping_data['billing_email'] =  $this->input->post('billing_email', true);
        $shipping_data['billing_mobile'] = $this->input->post('billing_mobile', true);   
        $shipping_data['billing_address'] = $this->input->post('billing_address', true);   
        $this->session->set_userdata($shipping_data);
        redirect('client/payment_form');
    }
    
    public function payment_form() 
    {
        $data = array();
        $data['title'] = 'Payment Form';
        $data['all_categories'] = $this->Store_model->select_categories();
        $data['all_subcategories'] = $this->Store_model->select_subcategories();
        $data['all_subcategory_items'] = $this->Store_model->select_subcategory_items();
        $data['home'] = $this->load->view('store/payment_form', $data, true);
        $this->load->view('store/master', $data);
    }
    
    public function confirm_order() 
    {
        $user_id = $this->session->userdata('user_id');    
        $shipping_info = array();
        $shipping_info['delivery_name'] = $this->session->userdata('delivery_name');
        $shipping_info['delivery_email'] = $this->session->userdata('delivery_email');
        $shipping_info['delivery_mobile'] = $this->session->userdata('delivery_mobile');
        $shipping_info['delivery_address'] = $this->session->userdata('delivery_address');
        $shipping_info['billing_name'] = $this->session->userdata('billing_name');
        $shipping_info['billing_email'] =  $this->session->userdata('billing_email');
        $shipping_info['billing_mobile'] = $this->session->userdata('billing_mobile');   
        $shipping_info['billing_address'] = $this->session->userdata('billing_address');
        $this->db->insert('tbl_shippings', $shipping_info);
        $shipping_id = $this->db->insert_id();
        $order = array();
        $order['fk_shipping_id'] = $shipping_id;
        $order['discount'] = $this->cart->total() * $this->session->userdata('discount');
        $order['order_total'] = $this->cart->total() - $order['discount'];
        $order['created_by'] = $user_id;
        $order['created_at'] = date("Y-m-d H:i:s");
        $this->db->insert('tbl_orders', $order);
        $order_id = $this->db->insert_id();
        $contents = $this->cart->contents();
        foreach ($contents as $v_contents):
            $ordermeta = array();
            $ordermeta['fk_order_id'] = $order_id;
            $ordermeta['fk_product_id'] = $v_contents['id'];
            $ordermeta['product_name'] = $v_contents['name'];
            $ordermeta['product_price'] = $v_contents['price'];
            $ordermeta['product_sales_quantity'] = $v_contents['qty'];
            $this->db->insert('tbl_ordermeta', $ordermeta);
        endforeach;
        $mdata = array();
        $mdata['order_info'] = $this->Store_model->select_order_info($user_id);
        $mdata['from_address'] = 'sales@e-captains.com';
        $mdata['admin_full_name'] = 'Ecaptains ';
        $mdata['to_address'] = $mdata['order_info']->user_email;
        $mdata['subject'] = 'Order Invoice';       
        $this->Mailer_model->sendEmail($mdata, 'invoice');
        $orderID = array();
        $orderID['order_id'] = $order_id;        
        $this->session->set_userdata($orderID);
        $notification = array();
        $notification['notification'] = 'Order ID <strong>C'.date('Y').$order_id.'</strong> is created for '. $mdata['order_info']->user_fullname;
        $notification['created_at'] = date("Y-m-d H:i:s");
        $notification['created_by'] = $user_id;
        $this->db->insert('tbl_notifications',$notification);
        redirect('client/confirm_success');
    }
    
    public function confirm_success()
    {
        $order_id = $this->session->userdata('order_id');
        $this->session->unset_userdata('discount');
        $this->cart->destroy();
        $this->session->set_flashdata('success', 'Order <strong>C'.date('Y').$order_id.'</strong> Has Been Placed Successfully! Check Your Email For Invoice');
        redirect('store');
    }
}