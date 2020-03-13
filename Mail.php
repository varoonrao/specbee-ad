<?php
$servername = "localhost";
$username = "html";
$password = "n&a2M8ae#1";
$dbname = "specbee_html";
// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
	die("Connection failed: " . $conn->connect_error);
}
	if(isset($_POST)) {
		if ($_POST['form_name']=='pop-up') {
			$name = $_POST['name'];
			$email = $_POST['email'];
			$number = $_POST['number'];
			$message = $_POST['message'];
			$created_on = "FROM_UNIXTIME(UNIX_TIMESTAMP(),'%Y-%m-%d %h:%i:%s')";
			$sql = "INSERT INTO contactus ( name , email , number, message, created_on)
			VALUES ('$name', '$email', $number , '$message', $created_on )";
			if ($conn->query($sql) === TRUE) {
				echo "New record created successfully";
			} else {
				echo "Error: " . $sql . "<br>" . $conn->error;
			}
			$conn->close();
			$subject = "Enquiry";
			$content ='Name: '.$_POST['name'].'
			Email: '.$_POST['email'].'
			Mobile: '.$_POST['number'].'
			Message: '.$_POST['message'];
			sendmails($subject,$content);
		}
	}
	function sendmails($subject,$content) {
		require_once "Mail.php";
		$from = "enquiry <info@specbee.com>";
		$to = "info <info@specbee.com>";
		$host = "ssl://smtp.gmail.com";
		$port = "465";
		// credential
		$username = "enquiry@specbee.com";
		$password = "Spec!bee@123";
		$headers = array ('From' => $from,
		  'To' => $to,
		  'Subject' => $subject);
		$smtp = Mail::factory('smtp',
		  array ('host' => $host,
		    'port' => $port,
		    'auth' => true,
		    'username' => $username,
		    'password' => $password));
		$mail = $smtp->send($to, $headers, $content);
		if (PEAR::isError($mail)) {
		  echo("<p>" . $mail->getMessage() . "</p>");
		 } else {
		  echo("<p>Message successfully sent!</p>");
		 }
		/*redirection to form filled page*/
		$return = explode("?",$_SERVER['HTTP_REFERER']);
		$page = "/thanks";
		header('Location: '.$page);
	}
 ?>
