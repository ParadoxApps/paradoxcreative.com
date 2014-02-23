<?php 	
	$name = trim($_POST['name']);
	$email = trim($_POST['email']);
	
	if(function_exists('stripslashes')) {
		$message = stripslashes(trim($_POST['message']));
	} else {
		$message = trim($_POST['message']);
	}
	
	// Replace this with your email
	$emailTo = trim($_POST['emailTo']);
	
	$host = $_SERVER['HTTP_HOST'];
	$host = str_replace('www.','',$host);
	$subject = "Contact Form Submission from ".$name;
	$body = "$message <br><br>$name<br>$email";
	$header = "Content-type: text/html\n";
	$header .= "From: \"Contact Form\"<noreply@$host>\n";
	
	mail($emailTo, $subject, $body, $header);

?>