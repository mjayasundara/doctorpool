<?php
/* Code by David McKeown - craftedbydavid.com */
/* Editable entries are bellow hello@harvard.edu.lk*/

include("config.php");

$send_to = $email_address;
$send_subject = "Harvard Educational Consultants Inquiry Form";

/*Be careful when editing below this line */

$f_name    = cleanupentries($_POST["name2"]);
$f_email   = cleanupentries($_POST["email2"]);
$f_phone   = cleanupentries($_POST["phone2"]);
$f_date   = cleanupentries($_POST["date2"]);
$f_message = cleanupentries($_POST["message2"]);
//$f_catType = cleanupentries($_POST["vehicle"]);
$from_ip = $_SERVER['REMOTE_ADDR'];
$from_browser = $_SERVER['HTTP_USER_AGENT'];

function cleanupentries($entry) {
	$entry = trim($entry);
	$entry = stripslashes($entry);
	$entry = htmlspecialchars($entry);

	return $entry;
}

$message = "This email was submitted on " . date('m-d-Y') . 
"\n\nName: " . $f_name . 
"\n\nE-mail: " . $f_email . 
"\n\nRequest Date: " . $f_date . 
"\n\nPhone number: " . $f_phone . 

"\n\nMessage: \n" . $f_message . 
"\n\n\nTechnical Details:\n" . $from_ip . "\n" . $from_browser;

$send_subject .= " - {$f_name}";

$headers = "";

       

if (!$f_email) {
	echo "no email";
	exit;
}else if (!$f_name){
	echo "no name";
	exit;
}else{
	if (filter_var($f_email, FILTER_VALIDATE_EMAIL)) {
		mail($send_to, $send_subject, $message, $headers, '-f return@srilionssoftware.com');
		echo "true";
		echo "<script>alert('Message Sent..! Well get back to you soon..!');
				window.location = 'index.php';
			 </script>";
	}else{
		echo "invalid email";
		exit;
	}
}
?>