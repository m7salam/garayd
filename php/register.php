<?php 
	$name = $_POST['name'];
	$email = $_POST['email'];
    $phone = $_POST['phone'];
    $plan = $_POST['plan'];

    $to = 'gelevanog@gmail.com';    
    $subject = 'Person registered for the meeting';
    $body = "Detail:<br><br>			
            Name: <strong>$name</strong><br>   
            Email: <strong>$email</strong><br>          
            Phone: <strong>$phone</strong><br>
            Plan: <strong>$plan</strong><br>           
            ";

    $headers = array(); 
	$headers[] = "MIME-Version: 1.0"; 
	$headers[] = "Content-type: text/html; charset=utf-8"; 
	$headers[] = "Subject: {$subject}"; 
	$headers[] = "X-Mailer: PHP/".phpversion();
       
    $ok = mail($to, $subject, $body, implode("\r\n", $headers));
    if($ok)
        echo '1';
    else
        echo '0';
?>