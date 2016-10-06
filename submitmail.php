<?php
 $to = $_POST['mailto'];
 $ipadr = $_POST['ips'];
 $seed = $_POST['seed'];
 $salt = $_POST['salt'];
 $seedcheck = $_POST['seedcheck'];
 
 $from = $_POST['from'];
 $subject = $_POST['subject'];
 $words = explode(',', $salt);
 $ipTemp = array_keys($ipadr);
 
 $ip = $ipTemp[0];
 $host =  $ipadr[$ip];
 
 $headers = "MIME-Version: 1.0\r\n";
 $headers .= "Content-type: text/html; charset=iso-8859-1\r\n";
 $headers .= "From: $from<contact@$host>\r\n";
 $headers .= "to:$to\r\n";
 $headers .= "Subject:".'=?UTF-8?B?'.base64_encode($subject).'?='."\r\n";
 
 if($seedcheck == 'true' ) {
 	$emailbody = 	 "$seed";
	sendSMTPMail($ip, 2525, "contact@$host", $to, $headers, $emailbody);
	echo 'Seed Test Sent';
	exit();
 }
 
 foreach($words as $word) {
  
  $emailbody = 	 "$seed,$word";
  sendSMTPMail($ip, 2525, "contact@$host", $to, $headers, $emailbody);
 }
 
 echo 'Mails Sent';

 function logInfo($msg) 
 {
 }
 
 function sendSMTPMail($ip, $port, $from, $to, $header='', $msg)
	{
				logInfo("sendSMTPMail starts");
		logInfo("FROM $from");
		/*error_log("----------EMAIL BODY------------");
		error_log($msg);
		error_log("----------EMAIL BODY ENDS------------");
		*/
		if(!empty($ip) && !empty($to) && !empty($msg))
		{
			$connection = fsockopen($ip, $port);
			if($connection)
			{
				$line = fgets($connection);
				logInfo($line);
				fputs($connection,"helo $ip\r\n");
				$line = fgets($connection);
				logInfo($line);
				fputs($connection,"mail from:<$from>\r\n");
				$line = fgets($connection);
				logInfo($line);
				fputs($connection,"rcpt to:<$to>\r\n");
				$line = fgets($connection);
				logInfo($line);
				fputs($connection,"data\r\n");
				$line = fgets($connection);
				logInfo($line);
				fputs($connection,"$header \r\n");
				fputs($connection,"$msg\r\n");
				fputs($connection,".\r\n");
				$line = fgets($connection);
				logInfo($line);
				fputs($connection, "QUIT\r\n");
				$line = fgets($connection);
				logInfo($line);
				fclose($connection);
				$stamp = date("H:i:s");
			}else
			{
				printf("\n \033[31mConnection failed for ".$ip." at port ".$port."\033[0m");
			}
	 	}
	}
?>