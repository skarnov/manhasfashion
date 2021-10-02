<?php

class Store_model extends CI_Model {
    
    public function save_user_activity($user_activity_url, $user_activity_type, $created_at, $created_by) {
        $data = array(
            'user_activity_url' => $user_activity_url,
            'user_activity_type' => $user_activity_type,
            'created_at' => $created_at,
            'created_by' => $created_by
        );
        $this->db->insert('tbl_user_activities', $data);
    }
    
    public function select_categories() {
        $this->db->select('*');
        $this->db->from('tbl_categories');
        $this->db->where('category_type', 1);
        $this->db->order_by('category_serial', 'ASC');
        return $this->db->get();
    }
    
    public function select_subcategories() {
        $this->db->select('*');
        $this->db->from('tbl_categories');
        $this->db->where('category_type', 2);
        $this->db->order_by('category_serial', 'ASC');
        return $this->db->get();
    }
    
    public function select_subcategory_items() {
        $this->db->select('*');
        $this->db->from('tbl_categories');
        $this->db->where('category_type', 3);
        $this->db->order_by('category_serial', 'ASC');
        return $this->db->get();
    }
    
    public function select_new_arrivals() {
        $sql = "SELECT * FROM tbl_products WHERE product_attribute = '2'";
        $query_result = $this->db->query($sql);
        $result = $query_result->result('array');
        if ($result) {
            foreach ($result as $i => $product) {
                $sql = "SELECT product_meta_name, product_meta_value FROM tbl_productmeta WHERE fk_product_id = '" . $product['pk_product_id'] . "'";
                $meta = $this->db->query($sql);
                $metaData = $meta->result('array');
                $result[$i]['meta'] = array();
                if ($metaData) {
                    foreach ($metaData as $eachMeta) {
                        $result[$i]['meta'][$eachMeta['product_meta_name']] = $eachMeta['product_meta_value'];
                    }
                }
            }
        }
        return $result;
    }
    
    public function select_best_sellers() {
        $sql = "SELECT * FROM tbl_products WHERE product_attribute = '1'";
        $query_result = $this->db->query($sql);
        $result = $query_result->result('array');
        if ($result) {
            foreach ($result as $i => $product) {
                $sql = "SELECT product_meta_name, product_meta_value FROM tbl_productmeta WHERE fk_product_id = '" . $product['pk_product_id'] . "'";
                $meta = $this->db->query($sql);
                $metaData = $meta->result('array');
                $result[$i]['meta'] = array();
                if ($metaData) {
                    foreach ($metaData as $eachMeta) {
                        $result[$i]['meta'][$eachMeta['product_meta_name']] = $eachMeta['product_meta_value'];
                    }
                }
            }
        }
        return $result;
    }
    
    public function select_product_for_cart($product_id) {
        $sql = "SELECT pk_product_id, product_image_thumb, product_name, product_price FROM tbl_products WHERE pk_product_id = '$product_id'";
        $query_result = $this->db->query($sql);
        $result = $query_result->row();
        return $result;
    }
    
    public function select_product_details_by_id($product_id) {
        $sql = "SELECT * FROM tbl_products WHERE pk_product_id = '$product_id'";
        $query_result = $this->db->query($sql);
        $result = $query_result->row_array();
        if ($result) {
            $sql = "SELECT product_meta_name, product_meta_value FROM tbl_productmeta WHERE fk_product_id = '$product_id'";
            $meta = $this->db->query($sql);
            $metaData = $meta->result('array');
            $result['meta'] = array();
            if ($metaData) {
                foreach ($metaData as $eachMeta) {
                    $result['meta'][$eachMeta['product_meta_name']] = $eachMeta['product_meta_value'];
                }
            }
        }
        return $result;
    }
    
    public function select_order_info($customer_id) {
        $sql = "SELECT * FROM tbl_orders AS o, tbl_users AS u, tbl_shippings AS s WHERE o.created_by = '$customer_id' AND u.pk_user_id = '$customer_id' AND o.fk_shipping_id = s.pk_shipping_id LIMIT 1";
        $query_result = $this->db->query($sql);
        $result = $query_result->row();
        return $result;
    }
}