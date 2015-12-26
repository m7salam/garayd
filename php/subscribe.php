<?php 

/* -----------------------------------------------------------------------------
 * Warning: Script must return TRUE (if allright) or FALSE (if e-mail not valid)
 * -----------------------------------------------------------------------------
 *
 * The script can work in two modes: CSV and Email
 * CSV [default]: The script saves emails to the file "emails.csv" in .csv format
 * Email: The script sends emails on your email address
 */
 
# Select the mode (csv or email) 
$_mode = 'csv';

# Email settings
$my_email = 'your_email@domain.com';
$from = "From: Your name <any_email@{$_SERVER['HTTP_HOST']}>\r\n";
$subject = 'Any subject';


if (!filter_var($_POST['sEmail'], FILTER_VALIDATE_EMAIL)) {
	echo 0;
	exit;
}

switch ($_mode) {
	case 'email':
		$message = $_POST['sEmail'];
		$r = mail($my_email, $subject, $message, $from);
		
		echo ($r) ? 1 : 0;
		break;
	
	default: 
		$fp = fopen('emails.csv', 'a');
	
		if ($fp) {
			$emails = file('emails.csv');	
			
			$in_list = false;
			foreach($emails as $k => $v) {	
				$email = explode(',', $v);
				if ($_POST['sEmail'] == $email[0]) {
					$in_list = true;
					break;
				}
			}
				
			if (!$in_list) {
				$lang = explode(',', $_SERVER['HTTP_ACCEPT_LANGUAGE']);
				$w = fputcsv($fp, array($_POST['sEmail'], $_SERVER['REMOTE_ADDR'], $lang[0]));
				
				if ($w) {
					echo 1;
					exit;
				}
			}
		}
		
		echo 0;
}