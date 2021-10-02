<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Store extends CI_Controller {

    public function index() {
        $data = array();
        $data['title'] = 'E-Captains';
        $data['all_categories'] = $this->Store_model->select_categories();
        $data['all_subcategories'] = $this->Store_model->select_subcategories();
        $data['all_subcategory_items'] = $this->Store_model->select_subcategory_items();
        $data['new_arrivals'] = $this->Store_model->select_new_arrivals();
        $data['best_sellers'] = $this->Store_model->select_best_sellers();
        $data['all_sliders'] = $this->Super_admin_model->select_all_slider();
        $data['all_banners'] = $this->Super_admin_model->select_all_banner();
        $data['home'] = $this->load->view('store/home', $data, true);
        $this->load->view('store/master', $data);
    }

    public function add_to_cart($product_id) {
        $product_info = $this->Store_model->select_product_for_cart($product_id);
        $data = array(
            'id' => $product_info->pk_product_id,
            'image' => $product_info->product_image_thumb,
            'name' => $product_info->product_name,
            'qty' => 1,
            'price' => $product_info->product_price,
        );
        $this->cart->insert($data);
        $this->load->view('store/cartTotal');
    }

    public function update_cart() {
        $qty = $this->input->post('product_quantity', true);
        $rowid = $this->input->post('rowid', true);
        $data = array(
            'rowid' => $rowid,
            'qty' => $qty
        );
        $this->cart->update($data);
        redirect('store/shopping_cart');
    }

    public function remove($rowid) {
        $data = array(
            'rowid' => $rowid,
            'qty' => '0'
        );
        $this->cart->update($data);
        redirect('store/shopping_cart');
    }

    public function checkout() {
        $data = array();
        $data['title'] = 'E-Captains';
        $data['all_categories'] = $this->Store_model->select_categories();
        $data['all_subcategories'] = $this->Store_model->select_subcategories();
        $data['all_subcategory_items'] = $this->Store_model->select_subcategory_items();
        $data['home'] = $this->load->view('store/shipping_form', $data, true);
        $this->load->view('store/master', $data);
    }

    public function shopping_cart() {
        $data = array();
        $data['title'] = 'E-Captains';
        $data['all_categories'] = $this->Store_model->select_categories();
        $data['all_subcategories'] = $this->Store_model->select_subcategories();
        $data['all_subcategory_items'] = $this->Store_model->select_subcategory_items();
        $data['home'] = $this->load->view('store/cart_view', $data, true);
        $this->load->view('store/master', $data);
    }

    public function register() {
        $data = array();
        $data['title'] = 'Register';
        $data['all_categories'] = $this->Store_model->select_categories();
        $data['all_subcategories'] = $this->Store_model->select_subcategories();
        $data['all_subcategory_items'] = $this->Store_model->select_subcategory_items();
        $data['home'] = $this->load->view('store/customer_signup', $data, true);
        $this->load->view('store/master', $data);
    }
    
    public function about() {
        $data = array();
        $data['title'] = 'Register';
        $data['all_categories'] = $this->Store_model->select_categories();
        $data['all_subcategories'] = $this->Store_model->select_subcategories();
        $data['all_subcategory_items'] = $this->Store_model->select_subcategory_items();
        $data['home'] = $this->load->view('store/about', $data, true);
        $this->load->view('store/master', $data);
    }
    
    public function contact() {
        $data = array();
        $data['title'] = 'Register';
        $data['all_categories'] = $this->Store_model->select_categories();
        $data['all_subcategories'] = $this->Store_model->select_subcategories();
        $data['all_subcategory_items'] = $this->Store_model->select_subcategory_items();
        $data['home'] = $this->load->view('store/contact', $data, true);
        $this->load->view('store/master', $data);
    }

    public function save_customer() {
        $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email|is_unique[tbl_users.user_email]');
        $this->form_validation->set_rules('mobile', 'Mobile', 'trim|required|numeric|exact_length[11]|is_unique[tbl_users.user_mobile]');
        if ($this->form_validation->run() == FALSE) {
            $data = array();
            $data['title'] = 'Register';
            $data['all_categories'] = $this->Store_model->select_categories();
            $data['all_subcategories'] = $this->Store_model->select_subcategories();
            $data['all_subcategory_items'] = $this->Store_model->select_subcategory_items();
            $data['home'] = $this->load->view('store/customer_signup', $data, true);
            $this->load->view('store/master', $data);
        } else {
            $data = array();
            $data['user_fullname'] = $this->input->post('name', true);
            if ($_FILES['profile_picture']['tmp_name']) {
                /* Initialize Image Library */
                $config['upload_path'] = 'media_library/images/user_images/';
                $config['allowed_types'] = 'gif|jpg|png|jpeg';
                $config['max_size'] = 51200;
                $config['max_width'] = 5000;
                $config['max_height'] = 5000;
                $config['remove_spaces'] = TRUE;
                $config['encrypt_name'] = TRUE;
                /* End of Initialize Image Library */
                $this->load->library('upload', $config);
                /* Start Image Upload */
                if (!$this->upload->do_upload('profile_picture')) {
                    $this->session->set_flashdata('error', $this->upload->display_errors());
                    redirect('super_admin/add_customer');
                } else {
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
            $this->db->insert('tbl_users', $data);

            $send_sms = $this->Super_admin_model->send_sms($data['user_mobile'], 'ই-আউটলেট বিডিতে স্বাগতম, সুপার ডিলের জন্য আমাদের সাথে থাকুন');

            $config = Array(
                'protocol' => 'smtp',
                'smtp_host' => 'ssl://mail.eoutlet-bd.com',
                'smtp_port' => 465,
                'smtp_user' => 'info@eoutlet-bd.com',
                'smtp_pass' => 'eoutlet3432',
                'mailtype' => 'html',
                'charset' => 'iso-8859-1',
                'wordwrap' => TRUE
            );

            $subject = 'Eoutlet-BD Registration Success';
            $message = '<!DOCTYPE html>
        
        <html>
            <head>
                <meta name="viewport" content="width=device-width">
                <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
                <title>Evis-Technology</title>
                <style>
                    /* -------------------------------------
                        INLINED WITH htmlemail.io/inline
                    ------------------------------------- */
                    /* -------------------------------------
                        RESPONSIVE AND MOBILE FRIENDLY STYLES
                    ------------------------------------- */
                    @media only screen and (max-width: 620px) {
                        table[class=body] h1 {
                            font-size: 28px !important;
                            margin-bottom: 10px !important;
                        }
                        table[class=body] p,
                        table[class=body] ul,
                        table[class=body] ol,
                        table[class=body] td,
                        table[class=body] span,
                        table[class=body] a {
                            font-size: 16px !important;
                        }
                        table[class=body] .wrapper,
                        table[class=body] .article {
                            padding: 10px !important;
                        }
                        table[class=body] .content {
                            padding: 0 !important;
                        }
                        table[class=body] .container {
                            padding: 0 !important;
                            width: 100% !important;
                        }
                        table[class=body] .main {
                            border-left-width: 0 !important;
                            border-radius: 0 !important;
                            border-right-width: 0 !important;
                        }
                        table[class=body] .btn table {
                            width: 100% !important;
                        }
                        table[class=body] .btn a {
                            width: 100% !important;
                        }
                        table[class=body] .img-responsive {
                            height: auto !important;
                            max-width: 100% !important;
                            width: auto !important;
                        }
                    }
                    /* -------------------------------------
                        PRESERVE THESE STYLES IN THE HEAD
                    ------------------------------------- */
                    @media all {
                        .ExternalClass {
                            width: 100%;
                        }
                        .ExternalClass,
                        .ExternalClass p,
                        .ExternalClass span,
                        .ExternalClass font,
                        .ExternalClass td,
                        .ExternalClass div {
                            line-height: 100%;
                        }
                        .apple-link a {
                            color: inherit !important;
                            font-family: inherit !important;
                            font-size: inherit !important;
                            font-weight: inherit !important;
                            line-height: inherit !important;
                            text-decoration: none !important;
                        }
                        .btn-primary table td:hover {
                            background-color: #34495e !important;
                        }
                        .btn-primary a:hover {
                            background-color: #34495e !important;
                            border-color: #34495e !important;
                        }
                    }
                </style>
            </head>
            <body class="" style="background-color: #f6f6f6; font-family: sans-serif; -webkit-font-smoothing: antialiased; font-size: 14px; line-height: 1.4; margin: 0; padding: 0; -ms-text-size-adjust: 100%; -webkit-text-size-adjust: 100%;">
                <table border="0" cellpadding="0" cellspacing="0" class="body" style="border-collapse: separate; mso-table-lspace: 0pt; mso-table-rspace: 0pt; width: 100%; background-color: #f6f6f6;">
                    <tr>
                        <td style="font-family: sans-serif; font-size: 14px; vertical-align: top;">&nbsp;</td>
                        <td class="container" style="font-family: sans-serif; font-size: 14px; vertical-align: top; display: block; Margin: 0 auto; max-width: 580px; padding: 10px; width: 580px;">
                            <div class="content" style="box-sizing: border-box; display: block; Margin: 0 auto; max-width: 580px; padding: 10px;">

                                <!-- START CENTERED WHITE CONTAINER -->
                                <span class="preheader" style="color: transparent; display: none; height: 0; max-height: 0; max-width: 0; opacity: 0; overflow: hidden; mso-hide: all; visibility: hidden; width: 0;">Eoutlet-BD</span>
                                <table class="main" style="border-collapse: separate; mso-table-lspace: 0pt; mso-table-rspace: 0pt; width: 100%; background: #ffffff; border-radius: 3px;">

                                    <!-- START MAIN CONTENT AREA -->
                                    <tr>
                                        <td class="wrapper" style="font-family: sans-serif; font-size: 14px; vertical-align: top; box-sizing: border-box; padding: 20px;">
                                            <table border="0" cellpadding="0" cellspacing="0" style="border-collapse: separate; mso-table-lspace: 0pt; mso-table-rspace: 0pt; width: 100%;">
                                                <tr>
                                                    <td style="font-family: sans-serif; font-size: 14px; vertical-align: top;">
                                                        <p style="font-family: sans-serif; font-size: 14px; font-weight: normal; margin: 0; Margin-bottom: 15px;">Greetings from Eoutlet-BD</p>
                                                        <p style="font-family: sans-serif; font-size: 14px; font-weight: normal; margin: 0; Margin-bottom: 15px;">Your account is successfully created. For more existinment news and offer please stay tuned.</p>
                                                    </td>
                                                </tr>
                                            </table>
                                        </td>
                                    </tr>

                                    <!-- END MAIN CONTENT AREA -->
                                </table>

                                <!-- START FOOTER -->
                                <div class="footer" style="clear: both; Margin-top: 10px; text-align: center; width: 100%;">
                                    <table border="0" cellpadding="0" cellspacing="0" style="border-collapse: separate; mso-table-lspace: 0pt; mso-table-rspace: 0pt; width: 100%;">
                                        <tr>
                                            <td class="content-block" style="font-family: sans-serif; vertical-align: top; padding-bottom: 10px; padding-top: 10px; font-size: 12px; color: #999999; text-align: center;">
                                                <span class="apple-link" style="color: #999999; font-size: 12px; text-align: center;">Eoutlet-BD Ecommerce</span>
                                            </td>
                                        </tr>
                                    </table>
                                </div>
                                <!-- END FOOTER -->

                                <!-- END CENTERED WHITE CONTAINER -->
                            </div>
                        </td>
                        <td style="font-family: sans-serif; font-size: 14px; vertical-align: top;">&nbsp;</td>
                    </tr>
                </table>
            </body>
        </html>';

            $this->load->library('email', $config);
            $this->email->set_mailtype('html');
            $this->email->set_newline("\r\n");
            $this->email->from('info@eoutlet-bd.com', 'Eoutlet-BD');
            $this->email->to($data['user_email']);
            $this->email->subject($subject);
            $this->email->message($message);
            if ($this->email->send()) {
                $this->session->set_flashdata('save_customer', 'Customer Saved!. Thank You For Registering With Eoutlet-BD');
                redirect('store/register');
            } else {
                show_error($this->email->print_debugger());
            }
        }
    }

    public function product_details($product_id) {
        $data = array();
        $data['title'] = 'Register';
        $data['all_categories'] = $this->Store_model->select_categories();
        $data['all_subcategories'] = $this->Store_model->select_subcategories();
        $data['all_subcategory_items'] = $this->Store_model->select_subcategory_items();
        $data['best_sellers'] = $this->Store_model->select_best_sellers();
        $data['product_details'] = $this->Store_model->select_product_details_by_id($product_id);
        $data['home'] = $this->load->view('store/product_details', $data, true);
        $this->load->view('store/master', $data);
    }

    public function product_listing($category_id) {
        $data = array();
        $data['title'] = 'Register';
        $data['all_categories'] = $this->Store_model->select_categories();
        $data['all_subcategories'] = $this->Store_model->select_subcategories();
        $data['all_subcategory_items'] = $this->Store_model->select_subcategory_items();
        $data['product_listing'] = $this->db->where('fk_subcategory_item_id', $category_id)->get('tbl_products')->result();
        $data['category_name'] = $this->db->where('pk_category_id', $data['product_listing'][0]->fk_subcategory_item_id)->get('tbl_categories')->row();
        $data['home'] = $this->load->view('store/product_listing', $data, true);
        $this->load->view('store/master', $data);
    }

    public function category($category_id) {
        $data = array();
        $data['title'] = 'Category';
        $data['all_categories'] = $this->Store_model->select_categories();
        $data['all_subcategories'] = $this->Store_model->select_subcategories();
        $data['all_subcategory_items'] = $this->Store_model->select_subcategory_items();
        $data['product_listing'] = $this->db->where('fk_subcategory_id', $category_id)->get('tbl_products')->result();
        $data['category_name'] = $this->db->where('pk_category_id', $data['product_listing'][0]->fk_subcategory_id)->get('tbl_categories')->row();
        $data['home'] = $this->load->view('store/product_listing', $data, true);
        $this->load->view('store/master', $data);
    }

}
