<?php
// If it's going to need the database, then it's 
// probably smart to require it before we start.
require_once('class_database.php');

class AdminUser {

    public function authenticate($email_address = "", $password = "") {
        global $db_handle;
        $email_address = $db_handle->sanitizePost($email_address);

        $query = "SELECT password FROM sma_users WHERE email = '$email_address' OR username = '$email_address' OR admin_code = '$email_address' LIMIT 1";
        $result = $db_handle->runQuery($query);
        //return $result;
        if($db_handle->numOfRows($result) == 1) {
            $user = $db_handle->fetchAssoc($result);
            $pass_salt = $user[0]['password'];
			$pwdver=verify($password,$pass_salt);
            if (strlen($email_address) > 4 and ($pwdver == 1)){
			 	$query = "select * from sma_users where (email='" . $email_address. "' or username='" . $email_address. "' or admin_code='" . $email_address. "') LIMIT 1";
				$result = $db_handle->runQuery($query);
			  
				if($db_handle->numOfRows($result) == 1) {
					$found_user = $db_handle->fetchAssoc($result);
					$_SESSION['group_id'] = $found_user[0]['group_id'];
					$_SESSION['user_id'] = $found_user[0]['id'];
					if($found_user[0]['accounttype'] == "warehouse"){
						$_SESSION['warehouse_id'] = $found_user[0]['warehouse_id'];
					}
					if($found_user[0]['accounttype'] == "store"){
						$_SESSION['store_id'] = $found_user[0]['store_id'];
					}
					if($found_user[0]['accounttype'] == "salespoint"){
						$_SESSION['salespoint_id'] = $found_user[0]['salespoint_id'];
					}
					$_SESSION['biller_id'] = $found_user[0]['biller_id'];
					return $found_user;
				} else {
					return false;
				}
			}
        } else {
            return false;
        }
    }
    
    public function get_admin_detail($username = "", $password = "") {
        return $this->authenticate($username, $password);
    }
    
    public function update_admin_password($username = "", $password = "") {
        global $db_handle;
        
        $query = "SELECT pass_salt FROM admin WHERE email = '{$username}' LIMIT 1";
        $result = $db_handle->runQuery($query);
        $user = $db_handle->fetchAssoc($result);
        $pass_salt = $user[0]['pass_salt'];
        $hashed_password = hash("SHA512", "$pass_salt.$password");
        
        $query = "UPDATE admin SET password = '{$hashed_password}' WHERE email = '{$username}' LIMIT 1";
        $result = $db_handle->runQuery($query);
        
        if($db_handle->affectedRows() > 0) {
            return true;
        } else {
            return false;
        }
    }
    
    public function get_admin_name_by_code($admin_code) {
        global $db_handle;
        
        $query = "SELECT CONCAT(last_name, ' ', first_name) AS full_name FROM sma_users WHERE admin_code = '$admin_code'";
        $result = $db_handle->runQuery($query);
        $fetched_data = $db_handle->fetchAssoc($result);
        
        $full_name = $fetched_data[0]['full_name'];
        return $full_name;
    }
    
    public function get_admin_detail_by_code($admin_code) {
        global $db_handle;
        
        $query = "SELECT last_name, first_name, email, status FROM admin WHERE admin_code = '$admin_code' LIMIT 1";
        $result = $db_handle->runQuery($query);
        
        if($db_handle->numOfRows($result) > 0) {
            $fetched_data = $db_handle->fetchAssoc($result);
            return $fetched_data[0];
        } else {
            return false;
        }
        
    }
    
    public function get_privileges($admin_code) {
        global $db_handle;
        
        $query = "SELECT allowed_pages FROM sma_groups WHERE id = '$admin_code' LIMIT 1";
        $result = $db_handle->runQuery($query);
        
        if($db_handle->numOfRows($result) > 0) {
            $fetched_data = $db_handle->fetchAssoc($result);
            return $fetched_data[0];
        } else {
            return false;
        }
    }
    
    // Confirm that the email address is not existing
    public function admin_is_duplicate($email) {
        global $db_handle;
        
        $query = "SELECT * FROM sma_users WHERE email = '$email' OR username = '$email'";
        $result = $db_handle->numRows($query);
        
        if($result) {
            return true;
        } else {
            return false;
        }
    }
    
    // Check whether admin has an active status
    public function admin_is_active($email) {
        global $db_handle;
        
        $query = "SELECT status FROM sma_users WHERE email = '$email' OR username = '$email'";
        $result = $db_handle->runQuery($query);
        $fetched_data = $db_handle->fetchAssoc($result);
        
        if($fetched_data[0]['status'] == '1') {
            return true;
        } else {
            return false;
        }
    }
    
    public function get_admin_type($email) {
        global $db_handle;
        
        $query = "SELECT accounttype FROM admin WHERE email = '$email' OR admin_code = '$email' OR username = '$email'";
        $result = $db_handle->runQuery($query);
        $fetched_data = $db_handle->fetchAssoc($result);
        
        if($fetched_data[0]['status'] == '1') {
            return true;
        } else {
            return false;
        }
    }
    
    // Add a new admin profile
   /* public function add_new_admin($first_name, $last_name, $email, $password) {
        global $db_handle;
        global $system_object;
        
        //check whether admin_code generated by rand_string is already existing
        admin_code:
        $admin_code = rand_string(5);
        if($db_handle->numRows("SELECT admin_code FROM admin WHERE admin_code = '$admin_code'") > 0) { goto admin_code; };
    
		$pass_salt = generateHash($password);
        
        $query = "INSERT INTO admin (admin_code, email, pass_salt, password, first_name, last_name) VALUES ('$admin_code', '$email', '$pass_salt', '$password', '$first_name', '$last_name')";
        $db_handle->runQuery($query);
        
        if($db_handle->affectedRows() > 0) {
            
            $query = "INSERT INTO admin_privilege (admin_code, allowed_pages) VALUES ('$admin_code', '')";
            $db_handle->runQuery($query);
            
            //New admin succefully inserted, send default password to the admin
            $subject = "DeNoble Awka Admin Login";
            $body = "
Dear " . $first_name . "

A new DeNoble Awka Admin profile has been created for you.

Your password is $password

Login with the URL below, you can update your password in the
profile settings.

https://deNobleawka.net/admin

Do not share your Admin credentials with anyone.


DeNoble Awka Support
www.deNobleawka.net";
            
            $system_object->send_email($subject, $body, $email, $first_name);
            
            return true;
        } else {
            return false;
        }
    }*/
    
    
    // Update admin profile - modify the status
    public function modify_admin_profile($admin_code, $admin_status) {
        global $db_handle;
        
        $query = "UPDATE admin SET status = '{$admin_status}' WHERE admin_code = '{$admin_code}' LIMIT 1";
        $result = $db_handle->runQuery($query);
        
        if($db_handle->affectedRows() > 0) {
            return true;
        } else {
            return false;
        }
    }
    
    public function modify_admin_privilege($admin_code, $allowed_pages) {
        global $db_handle;
        
        $query = "UPDATE sma_groups SET allowed_pages = '{$allowed_pages}' WHERE id = '{$admin_code}' LIMIT 1";
        $result = $db_handle->runQuery($query);
        
        if($db_handle->affectedRows() > 0) {
            return true;
        } else {
            return false;
        }
    }
    
    // Add a new article
    public function update_system_message($system_message_id, $system_message_type, $subject, $content) {
        global $db_handle;
        
        // if it is an email, i.e. type == 1 and the subject is empty, do nothing
        // because an email message requires a subject to be set
        if($system_message_type == '1' && empty($subject)) {
            return false;
        }
        
        if($system_message_type == '1') {
            $query = "UPDATE system_message SET subject = '{$subject}', value = '$content' WHERE system_message_id = $system_message_id LIMIT 1";
        } else {
            $query = "UPDATE system_message SET value = '$content' WHERE system_message_id = $system_message_id LIMIT 1";
        }
        
        $result = $db_handle->runQuery($query);
        
        if($db_handle->affectedRows() > 0) {
            return true;
        } else {
            return false;
        }
    }
	
	public function get_user_pic($user_code,$width='',$user_image='',$userprofile='') {
		//get registration details for a particular person in one year
        global $db_handle;

        $query = "SELECT username,user_code,profile_pic,gender FROM participants where user_code = '$user_code' OR username='$user_code'";
        $result = $db_handle->runQuery($query);
        $fetched_data = $db_handle->fetchAssoc($result);
        $profile_pic = $fetched_data[0]['profile_pic'];
        $gender = $fetched_data[0]["gender"];
        $user_code = $fetched_data[0]["user_code"];
		
		if ($gender=='female'){
			$avatar = 'avatar_f.png';	
		}else{
			$avatar = 'avatar_m.png';	
		}

		if ($profile_pic == ""){ 
			  $pic = "<img src='dist/img/$avatar' class='img-responsive img-circle' width='$width' height='40'>";
			  if ($user_image == '1'){
			  $pic = "<img src='dist/img/$avatar' class='img-responsive img-circle'>";
			  }
			  if ($userprofile == '1'){
			  $pic = "<img src='dist/img/$avatar' alt='user_auth' class='user-img img-circle' width='$width'>";
			  }
		 }else{ 
			  $pic = "<img src='dist/img/users/$user_code/$profile_pic' alt='user_auth' class='user-auth-img img-circle' width='$width'>";
			  if ($user_image == '1'){
			  $pic = "<img src='dist/img/users/$user_code/$profile_pic' alt='user_auth' class='img-responsive img-circle' width='$width'>";
			  }
			  if ($userprofile == '1'){
			  $pic = "<img src='dist/img/users/$user_code/$profile_pic' alt='user_auth' class='user-img img-circle' width='$width'>";
			  }
		 } 
		  

        return $pic ? $pic : 0;
    }
    
}

$admin_object = new AdminUser();