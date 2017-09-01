<?php

class spilloverOperation {
    private $client_data;
    
    public function __construct($ifx_account = '', $email_address = '') {
        if(isset($ifx_account) && !empty($ifx_account)) {
            $this->client_data = $this->set_client_data($ifx_account);
        }
    }
	
    public function uplinemail($user_code,$level) {

       // Send activation link to email
        $subject = "You have a New Referral";
        $body = "
Dear " . $username . "


Thank you for supporting ZarFund.

Member $username has just signed up as your level $level referral!

Name: $fullname
Email: $email
Phone: $phone

Thank you.

ClassicAid Network
Your Sure Path to Wealth";
        
        $system_object->send_email($subject, $body, $email_address, $full_name);	
	/*	$headers = array("From: life@classicaid.net",
    "Reply-To: support@classicaid.net",
    "X-Mailer: PHP/" . PHP_VERSION
);
$headers = implode("\r\n", $headers);*/
$headers  = "MIME-Version: 1.0" . "\r\n";
$headers .= "Content-type: text/html; charset=iso-8859-1" . "\r\n";
$headers .= "From: ". $from. "\r\n";
$headers .= "Reply-To: ". $from. "\r\n";
$headers .= "X-Mailer: PHP/" . phpversion();
$headers .= "X-Priority: 1" . "\r\n"; 

$my_mail = "life@classicaid.net";
$my_replyto = "life@classicaid.net";

		mail($email_address, $subject, $body, $headers);
		
	  return $query ? $query : 0;
	}
		
    
	
}

?>