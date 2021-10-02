<?php

class Super_admin_model extends CI_Model {

    public function count_notification_for_the_user() {
        $this->db->where('view_status', 0);
        $this->db->from("tbl_notifications");
        return $this->db->count_all_results();
    }

    public function select_notification_for_the_user() {
        $this->db->where('view_status', 0);
        $this->db->order_by('pk_notification_id', 'DESC');
        $this->db->limit(5);
        $table_data = $this->db->get('tbl_notifications');
        return $table_data;
    }

    public function select_all_slider() {
        $this->db->where('setting_type', 1);
        $table_data = $this->db->get('tbl_settings')->result();
        return $table_data;
    }

    public function select_all_banner() {
        $this->db->where('setting_type', 2);
        $table_data = $this->db->get('tbl_settings')->result();
        return $table_data;
    }

    public function send_sms($to, $msg) {
        $mySMSArray = array();

        //create a json array of your sms
        $row_array['trxID'] = udate('YmdHisu');
        $row_array['trxTime'] = date('Y-m-d H:i:s');

        $mySMSArray[0]['smsID'] = udate('YmdHisu');
        $mySMSArray[0]['smsSendTime'] = date('Y-m-d H:i:s');
        $mySMSArray[0]['mask'] = 'EOUTLET BD';
        $mySMSArray[0]['mobileNo'] = "88$to";
        $mySMSArray[0]['smsBody'] = "$msg";

        $mySMSArray[1]['smsID'] = udate('YmdHisu');
        $mySMSArray[1]['smsSendTime'] = date('Y-m-d H:i:s');
        $mySMSArray[1]['mask'] = 'EOUTLET BD';
        $mySMSArray[1]['mobileNo'] = "88$to";
        $mySMSArray[1]['smsBody'] = "$msg";

        $row_array['smsDatumArray'] = $mySMSArray;

        $myJSonDatum = json_encode($row_array);

        //specifi the url
        $url = "https://api.infobuzzer.net/v3.1/SendSMS/sendSmsInfoStore";

        if ($ch = curl_init($url)) {
            //Your valid username & Password ----------Please update those field
            $username = 'sales.eoutletbd@gmail.com';
            $password = '@eoop%$';

            curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
            curl_setopt($ch, CURLOPT_USERPWD, $username . ':' . $password);
            curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');

            curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json',
                'Content-Length: ' . strlen($myJSonDatum)));

            curl_setopt($ch, CURLOPT_POST, true);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $myJSonDatum);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

            curl_setopt($ch, CURLOPT_TIMEOUT, 300);
            $response = curl_exec($ch);
            curl_close($ch);

            return $response;
//            echo('Response is: ' . $response);
        } else {
            return $response = 'Sorry,the connection cannot be established';
//            echo("Sorry,the connection cannot be established");
        }
    }

}
