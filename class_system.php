<?php

class LifeHelpSystem {
    
    // function to send SMTP emails
    public function send_email($subject, $message, $sendto_email, $sendto_name, $from_name = '') {
        
        //PHPMailer Object
        $mail = new PHPMailer;
        $mail->IsSMTP();
        $mail->Host = "life@classicaid.net";  // specify main and backup server
        $mail->SMTPAuth = true;     // turn on SMTP authentication
        $mail->Username = "life@classicaid.net";  // SMTP username
        $mail->Password = "wedu123"; // SMTP password

        //From email address and name
        $mail->From = "support@classicaid.net";
        
        if(isset($from_name) && !empty($from_name)) {
            $mail->FromName = $from_name;
            
            //Address to which recipient will reply
            $mail->addReplyTo("support@classicaid.net", $from_name);
        } else {
            $mail->FromName = "ClassicAid Network";
            
            //Address to which recipient will reply
            $mail->addReplyTo("support@classicaid.net", "ClassicAid Network");
        }

        //Send HTML or Plain Text email
        $mail->isHTML(true);
        
        //To address and name
        $mail->clearAddresses();
        $mail->addAddress("$sendto_email", "$sendto_name");

        $mail->Subject = $subject;
        $mail->Body = $message;

        return $mail->send() ? true : false;
    }
    
    // function to send sms
    public function send_sms($phone, $my_message) {
        $phone_number = trim(preg_replace('/[\s\t\n\r\s]+/', '', $phone));
        $message = str_replace(" ","+",$my_message);
        file_get_contents("http://www.smslive247.com/http/index.aspx?cmd=sendmsg&sessionid=5b422f10-7b78-4631-9b98-a1c2e1872099&message=$message&sender=INSTAFXNG&sendto=$phone_number&msgtype=0");
        return true;
    }

    // Get all the states
    public function get_all_states() {
        global $db_handle;

        $query = "SELECT state_id, state FROM state ORDER BY state_id ASC";
        $result = $db_handle->runQuery($query);
        $fetched_data = $db_handle->fetchAssoc($result);

        return $fetched_data ? $fetched_data : false;
    }

    // Get all the banks
    public function get_all_banks() {
        global $db_handle;

        $query = "SELECT bank_id, bank_name FROM bank ORDER BY bank_id ASC";
        $result = $db_handle->runQuery($query);
        $fetched_data = $db_handle->fetchAssoc($result);

        return $fetched_data ? $fetched_data : false;
    }



    // Calculate saldo report
    public function get_saldo_report($from_date, $to_date) {
        global $db_handle;

        $query = "SELECT SUM(real_naira_confirmed) AS sum_total FROM user_deposit WHERE status = '8' AND created BETWEEN '$from_date' AND '$to_date' ";
        $result = $db_handle->runQuery($query);
        $selected_data = $db_handle->fetchAssoc($result);
        $total_deposit = $selected_data[0]['sum_total'];

        $query = "SELECT SUM(naira_total_withdrawable) AS sum_total FROM user_withdrawal WHERE status = '10' AND created BETWEEN '$from_date' AND '$to_date' ";
        $result = $db_handle->runQuery($query);
        $selected_data = $db_handle->fetchAssoc($result);
        $total_withdrawal = $selected_data[0]['sum_total'];

        $saldo_calculated = $total_deposit - $total_withdrawal;

        $saldo = array("saldo" => $saldo_calculated, "deposit" => $total_deposit, "withdrawal" => $total_withdrawal);
        return $saldo;
    }

    // Calculate commission report
    public function get_comission_report($from_date, $to_date) {
        global $db_handle;

        $query = "SELECT COUNT(ifx_acct_no) AS accounts, SUM(volume) AS volume, SUM(commission) AS commission FROM trading_commission WHERE date_earned BETWEEN '$from_date' AND '$to_date' ";
        $result = $db_handle->runQuery($query);
        $selected_data = $db_handle->fetchAssoc($result);

        return $selected_data[0];
    }

    // Calculate VAT charge report
    public function get_vat_charge_report($from_date, $to_date, $vat_type) {
        global $db_handle;

        if($vat_type == 'Deposit') {
            $query = "SELECT SUM(naira_vat_charge) AS vat FROM user_deposit WHERE status = '8' AND created BETWEEN '$from_date' AND '$to_date' ";
        } else {
            $query = "SELECT SUM(naira_vat_charge) AS vat FROM user_withdrawal WHERE status = '10' AND created BETWEEN '$from_date' AND '$to_date' ";
        }

        $result = $db_handle->runQuery($query);
        $selected_vat = $db_handle->fetchAssoc($result);

        return $selected_vat[0]['vat'];
    }

    // Calculate Service charge report
    public function get_service_charge_report($from_date, $to_date, $vat_type) {
        global $db_handle;

        if($vat_type == 'Deposit') {
            $query = "SELECT SUM(naira_service_charge) AS service_charge FROM user_deposit WHERE status = '8' AND created BETWEEN '$from_date' AND '$to_date' ";
        } else {
            $query = "SELECT SUM(naira_service_charge) AS service_charge FROM user_withdrawal WHERE status = '10' AND created BETWEEN '$from_date' AND '$to_date' ";
        }

        $result = $db_handle->runQuery($query);
        $selected_service_charge = $db_handle->fetchAssoc($result);

        return $selected_service_charge[0]['service_charge'];
    }

    // Get bulletin by id
    public function get_bulletin_by_id($bulletin_id) {
        global $db_handle;

        $query = "SELECT * FROM admin_bulletin WHERE admin_bulletin_id = $bulletin_id LIMIT 1";
        $result = $db_handle->runQuery($query);
        $fetched_data = $db_handle->fetchAssoc($result);

        return $fetched_data ? $fetched_data : false;
    }

    // Get article by id
    public function get_article_by_id($article_id) {
        global $db_handle;

        $query = "SELECT * FROM article WHERE article_id = $article_id LIMIT 1";
        $result = $db_handle->runQuery($query);
        $fetched_data = $db_handle->fetchAssoc($result);

        return $fetched_data ? $fetched_data : false;
    }
	
	    // Get signal by id
    public function get_signal_by_id($signal_daily_id) {
        global $db_handle;

        $query = "SELECT * FROM signal_daily WHERE signal_daily_id = $signal_daily_id LIMIT 1";
        $result = $db_handle->runQuery($query);
        $fetched_data = $db_handle->fetchAssoc($result);

        return $fetched_data ? $fetched_data : false;
    }

    // Get
    public function get_free_training_reg_by_id($selected_id) {
        global $db_handle;

        $query = "SELECT * FROM free_training_campaign WHERE free_training_campaign_id = $selected_id LIMIT 1";
        $result = $db_handle->runQuery($query);
        $fetched_data = $db_handle->fetchAssoc($result);

        return $fetched_data ? $fetched_data : false;
    }

    public function update_free_training_registration($selected_id, $train_interest, $train_centre, $comment, $admin_unique_code) {
        global $db_handle;

        $query = "UPDATE free_training_campaign SET training_interest = '$train_interest', training_centre = '$train_centre' WHERE free_training_campaign_id = $selected_id";
        $db_handle->runQuery($query);

        if(!empty($comment)) {
            $query = "INSERT INTO free_training_campaign_comment (training_campaign_id, admin_code, comment) VALUES ($selected_id, '$admin_unique_code', '$comment')";
            $db_handle->runQuery($query);
        }
        return true;
    }

    public function get_free_training_registration_comment($selected_id) {
        global $db_handle;

        $query = "SELECT admin_code, comment, created FROM free_training_campaign_comment WHERE training_campaign_id = $selected_id ORDER BY created DESC";
        $result = $db_handle->runQuery($query);
        $fetched_data = $db_handle->fetchAssoc($result);

        return $fetched_data;

    }

    // Add a new bulletin
    public function add_new_snappy_help($snappy_no, $content, $snappy_status = '3', $admin_code) {
        global $db_handle;

        if(!empty($snappy_no)) {
            $query = "UPDATE snappy_help SET content = '$content', status = '$snappy_status' WHERE snappy_help_id = $snappy_no";
        } else {
            $query = "INSERT INTO snappy_help (admin_code, content, status) VALUES ('$admin_code', '$content', '$snappy_status')";
        }

        $db_handle->runQuery($query);

        return $db_handle->affectedRows() > 0 ? true : false;
    }

    // Add a new bulletin
    public function add_new_campaign_email($campaign_email_no, $subject, $campaign_category, $content, $admin_code, $campaign_email_status = '1') {
        global $db_handle;

        if(!empty($campaign_email_no)) {
            $query = "UPDATE campaign_email SET campaign_category_id = '$campaign_category', subject = '$subject', content = '$content', status = '$campaign_email_status' WHERE campaign_email_id = $campaign_email_no LIMIT 1";
        } else {
            $query = "INSERT INTO campaign_email (admin_code, campaign_category_id, subject, content, status) VALUES ('$admin_code', $campaign_category, '$subject', '$content', '$campaign_email_status')";
        }

        $db_handle->runQuery($query);

        return $db_handle->affectedRows() > 0 ? true : false;
    }

    // Get snappy help by id
    public function get_snappy_help_by_id($snappy_id) {
        global $db_handle;

        $query = "SELECT * FROM snappy_help WHERE snappy_help_id = $snappy_id LIMIT 1";
        $result = $db_handle->runQuery($query);
        $fetched_data = $db_handle->fetchAssoc($result);

        return $fetched_data ? $fetched_data : false;
    }

    // Get campaign email by id
    public function get_campaign_email_by_id($campaign_email_id) {
        global $db_handle;

        $query = "SELECT * FROM campaign_email WHERE campaign_email_id = $campaign_email_id LIMIT 1";
        $result = $db_handle->runQuery($query);
        $fetched_data = $db_handle->fetchAssoc($result);

        return $fetched_data ? $fetched_data : false;
    }

    // Get campaign category by id
    public function get_campaign_category_by_id($campaign_id) {
        global $db_handle;

        $query = "SELECT * FROM campaign_category WHERE campaign_category_id = $campaign_id LIMIT 1";
        $result = $db_handle->runQuery($query);
        $fetched_data = $db_handle->fetchAssoc($result);

        return $fetched_data ? $fetched_data : false;
    }

    // Get campaign category by id
    public function get_account_flag_by_id($account_flag_id) {
        global $db_handle;

        $query = "SELECT uaf.user_account_flag_id, uaf.comment, uaf.status, ui.ifx_acct_no
                FROM user_account_flag AS uaf
                INNER JOIN user_ifxaccount AS ui ON uaf.ifxaccount_id = ui.ifxaccount_id
                WHERE uaf.user_account_flag_id = $account_flag_id LIMIT 1";

        $result = $db_handle->runQuery($query);
        $fetched_data = $db_handle->fetchAssoc($result);

        return $fetched_data ? $fetched_data : false;
    }

    // Confirm that the commission is not for a previously uploaded date
    public function commission_upload_duplicate($commission_date) {
        global $db_handle;

        $query = "SELECT date_earned FROM trading_commission WHERE date_earned = '$commission_date'";
        $result = $db_handle->numRows($query);

        return $result ? true : false;
    }

    // Get system message by id
    public function get_system_message_by_id($message_id) {
        global $db_handle;

        $query = "SELECT * FROM system_message WHERE system_message_id = $message_id LIMIT 1";
        $result = $db_handle->runQuery($query);
        $fetched_data = $db_handle->fetchAssoc($result);

        if($fetched_data) {
            return $fetched_data;
        } else {
            return false;
        }
    }

    // Schedule a campaign to be sent - cron jobs will take over from here
    public function schedule_campaign($campaign_email_id, $campaign_type) {
        global $db_handle;

        switch ($campaign_type) {
            case 'email':
                $main_table = "campaign_email";
                $track_table = "campaign_email_track";
                break;
            case 'sms':
                $main_table = "campaign_sms";
                $track_table = "campaign_sms_track";
                break;
        }

        // get recipient query
        $query = "SELECT campaign_category_id FROM campaign_email WHERE campaign_email_id = $campaign_email_id LIMIT 1";
        $result = $db_handle->runQuery($query);
        $fetched_data = $db_handle->fetchAssoc($result);
        $category_id = $fetched_data[0]['campaign_category_id'];

        $query = "SELECT client_group FROM campaign_category WHERE campaign_category_id = $category_id LIMIT 1";
        $result = $db_handle->runQuery($query);
        $fetched_data = $db_handle->fetchAssoc($result);
        $client_group = $fetched_data[0]['client_group'];

        $recipient_query = $db_handle->sanitizePost(client_group_query($client_group));
        $total_recipient = $db_handle->numRows(stripslashes($recipient_query));

        // schedule campaign
        $query = "INSERT INTO $track_table (campaign_id, recipient_query, total_recipient) VALUES ('$campaign_email_id', '$recipient_query', $total_recipient)";
        $db_handle->runQuery($query);

        // log send date
        $query = "UPDATE $main_table SET send_status = '1', send_date = NOW(), status = '5' WHERE campaign_email_id = $campaign_email_id LIMIT 1";
        $db_handle->runQuery($query);

        return true;
    }

    // generate a unique user code
    public function generate_user_code() {
        global $db_handle;

        unique_user_code:
        $user_code = rand_string(11);
        if($db_handle->numRows("SELECT user_code FROM user WHERE user_code = '$user_code'") > 0) { goto unique_user_code; };

        return $user_code;
    }

    // generate a unique partner code
    public function generate_partner_code() {
        global $db_handle;

        unique_partner_code:
        $partner_code = strtoupper(rand_string(5));
        if($db_handle->numRows("SELECT partner_code FROM partner WHERE partner_code = '$partner_code'") > 0) { goto unique_partner_code; };

        return $partner_code;
    }

    public function get_client_distribution() {
        global $db_handle;

        $total_client = $db_handle->numRows("SELECT user_code FROM user");
        $unverified = $db_handle->numRows("SELECT user_code FROM user WHERE password IS NULL");
//        $level_one = $db_handle->numRows("SELECT user_code FROM user");
//        $level_two = $db_handle->numRows("SELECT user_code FROM user");
//        $level_three = $db_handle->numRows("SELECT user_code FROM user");


        $fetched_data = array('total_client' => $total_client, 'unverified' => $unverified);
        return $fetched_data;
    }

    // Create new campaign category
    public function add_new_campaign_category($title, $description, $campaign_category_status, $campaign_category_no, $client_group) {
        global $db_handle;

        if(!empty($campaign_category_no)) {
            $query = "UPDATE campaign_category SET title = '$title', description = '$description', status = '$campaign_category_status', client_group = '$client_group' WHERE campaign_category_id = $campaign_category_no";
        } else {
            $query = "INSERT INTO campaign_category (title, description, status, client_group) VALUES ('$title', '$description', '$campaign_category_status', '$client_group')";
        }

        $db_handle->runQuery($query);

        return $db_handle->affectedRows() > 0 ? true : false;
    }

    // Get all the campaign categories
    public function get_all_campaign_category() {
        global $db_handle;

        $query = "SELECT * FROM campaign_category ORDER BY created DESC";
        $result = $db_handle->runQuery($query);
        $fetched_data = $db_handle->fetchAssoc($result);

        return $fetched_data ? $fetched_data : false;
    }



    // Create new campaign solo group
    public function add_new_campaign_solo_group($group_name, $group_no) {
        global $db_handle;

        if(!empty($group_no)) {
            $query = "UPDATE campaign_email_solo_group SET group_name = '$group_name' WHERE campaign_email_solo_group_id = $group_no";
        } else {
            $query = "INSERT INTO campaign_email_solo_group (group_name) VALUES ('$group_name')";
        }

        $db_handle->runQuery($query);

        return $db_handle->affectedRows() > 0 ? true : false;
    }

    // Get campaign category by id
    public function get_campaign_solo_group_by_id($solo_group_id) {
        global $db_handle;

        $query = "SELECT * FROM campaign_email_solo_group WHERE campaign_email_solo_group_id = $solo_group_id LIMIT 1";
        $result = $db_handle->runQuery($query);
        $fetched_data = $db_handle->fetchAssoc($result);

        return $fetched_data ? $fetched_data : false;
    }

    // Add a new bulletin
    public function add_new_solo_campaign_email($campaign_email_no, $subject, $solo_group, $send_day, $content, $admin_code, $solo_campaign_email_status = '1') {
        global $db_handle;

        if(!empty($campaign_email_no)) {
            $query = "UPDATE campaign_email_solo SET solo_group = '$solo_group', subject = '$subject', content = '$content', status = '$solo_campaign_email_status', day_to_send = $send_day WHERE campaign_email_solo_id = $campaign_email_no LIMIT 1";
        } else {
            $query = "INSERT INTO campaign_email_solo (admin_code, solo_group, subject, content, status, day_to_send) VALUES ('$admin_code', $solo_group, '$subject', '$content', '$solo_campaign_email_status', $send_day)";
        }

        $db_handle->runQuery($query);

        return $db_handle->affectedRows() > 0 ? true : false;
    }

    // Get all the campaign categories
    public function get_all_campaign_solo_group() {
        global $db_handle;

        $query = "SELECT * FROM campaign_email_solo_group ORDER BY campaign_email_solo_group_id ASC";
        $result = $db_handle->runQuery($query);
        $fetched_data = $db_handle->fetchAssoc($result);

        return $fetched_data ? $fetched_data : false;
    }

    // Get campaign email by id
    public function get_solo_campaign_email_by_id($campaign_email_id) {
        global $db_handle;

        $query = "SELECT * FROM campaign_email_solo WHERE campaign_email_solo_id = $campaign_email_id LIMIT 1";
        $result = $db_handle->runQuery($query);
        $fetched_data = $db_handle->fetchAssoc($result);

        return $fetched_data ? $fetched_data : false;
    }

    public function get_latest_funding() {
        global $db_handle;

        $query = "SELECT ud.trans_id, ud.dollar_ordered, ud.status, ui.ifx_acct_no, CONCAT(u.last_name, SPACE(1), u.first_name) AS full_name
              FROM user_deposit AS ud
              INNER JOIN user_ifxaccount AS ui ON ud.ifxaccount_id = ui.ifxaccount_id
              INNER JOIN user AS u ON ui.user_code = u.user_code
              WHERE ud.status <> '1' ORDER BY ud.created DESC LIMIT 10";

        $result = $db_handle->runQuery($query);
        $fetched_data = $db_handle->fetchAssoc($result);

        return $fetched_data ? $fetched_data : false;
    }

    public function get_latest_withdrawal() {
        global $db_handle;

        $query = "SELECT uw.trans_id, uw.dollar_withdraw, uw.status, ui.ifx_acct_no, CONCAT(u.last_name, SPACE(1), u.first_name) AS full_name
              FROM user_withdrawal AS uw
              INNER JOIN user_ifxaccount AS ui ON uw.ifxaccount_id = ui.ifxaccount_id
              INNER JOIN user AS u ON ui.user_code = u.user_code
              ORDER BY uw.created DESC LIMIT 10";

        $result = $db_handle->runQuery($query);
        $fetched_data = $db_handle->fetchAssoc($result);

        return $fetched_data ? $fetched_data : false;
    }

    public function get_latest_bulletin() {
        global $db_handle;

        $query = "SELECT ab.admin_bulletin_id, ab.title, ab.created, a.first_name, a.last_name
              FROM admin_bulletin AS ab
              INNER JOIN admin AS a ON ab.admin_code = a.admin_code
              WHERE ab.status = '1' ORDER BY ab.created DESC LIMIT 5";

        $result = $db_handle->runQuery($query);
        $fetched_data = $db_handle->fetchAssoc($result);

        return $fetched_data ? $fetched_data : false;
    }
	
	    //Get bank name by bank id
    public function get_bank_by_bank_id($bank_id) {
        global $db_handle;
        
        $query = "SELECT bank_name FROM bank WHERE bank_id = '$bank_id' LIMIT 1";
        $result = $db_handle->runQuery($query);
        $fetched_data = $db_handle->fetchAssoc($result);
        $bank_name = $fetched_data[0]['bank_name'];
        
        return $bank_name;
    }
    
}

$system_object = new LifeHelpSystem();