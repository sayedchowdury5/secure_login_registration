
<?php
	require_once ('connect.php');

	if(isset($_POST['login'])){
		if ($_POST['user_email'] != "" || $_POST['user_password'] != "") {
			//collect user inputs
			$user_email = $_POST['user_email'];
			$user_password = $_POST['user_password'];

			//select user details from database
			$sql = "SELECT * FROM users WHERE user_email = ? ";
			$prepare = $conn->prepare($sql);
			$prepare->execute(array($user_email));
			$rowCount = $prepare->rowCount();
			$fetch = $prepare->fetch();
			
			if ($rowCount > 0) {
				
				//verify user password before login
				if (password_verify($user_password, $fetch['user_password'])) {
					
					//keep session record
					session_start();
					$_SESSION['logged_in'] = true;
					$_SESSION['user_email'] = $user_email;
					echo "<script>alert('You Successfully logged in'); window.location.href = 'index-1.php';</script>";
				} else {
					echo "<script>alert('Your Credetials not match!'); window.location.href = 'auth-sign-in-social.htm';</script>";
				}
			} else {
				echo "<script>alert('Your Credetials not match!'); window.location.href = 'auth-sign-in-social.htm';</script>";
			}
		}
	}
	
	if(isset($_POST['register'])){
		if ($_POST['user_name'] != "" || $_POST['user_email'] != "" || $_POST['user_password'] != "" || $_POST['user_confirm_password'] != "") {
			//collect user inputs
			$user_name = $_POST['user_name'];
			$user_email = $_POST['user_email'];
			$user_password = $_POST['user_password'];
			$user_confirm_password = $_POST['user_confirm_password'];
			$password = "";
			$hash = "";

			//select user details from database to compare existing user
			$a = "SELECT user_email FROM users WHERE user_email = ?";
			$p = $conn->prepare($a);
			$p->execute([$user_email]);
			$r = $p->rowCount();

			if ($r > 0) {
				echo "<script> alert('This email already exist.'); window.location.href = 'test.php'; </script>";
				//compare user password inputs
			} elseif($user_password != $user_confirm_password) {
				echo "<script> alert('Password not match.'); window.location.href = 'test.php'; </script>";
				//encrypt user passwords to store into database
			} else {
				$password = $user_password;
				$hash = password_hash($password, PASSWORD_DEFAULT);

				//prepare welcome email for user
				$to = $user_email; // Send email to our user
				$subject = "Welcome Mail"; // Give the email a subject 
				$emessage = "welcome Dear, for registering in our system.";

				// if emessage is more than 70 chars
				$emessage = wordwrap($emessage, 70, "\r\n");

				// Our emessage above including the link
				$headers   = array();
				$headers[] = "MIME-Version: 1.0";
				$headers[] = "Content-type: text/plain;charset=UTF-8";
				//$headers[] = "From: Katekmall Admin <noreply@yourdomain.com>";
				$headers[] = "Subject: {$subject}";
				//$headers[] = "X-Mailer: PHP/".phpversion(); // Set from headers

				$send = mail($to, $subject, $emessage, implode("\r\n", $headers));

				if (!$send) {
					echo "<script>alert('Email can not sent!'); window.location.href = 'test.php';</script>";
				} else {
					//insert user details into database
					$sql = "INSERT INTO users (user_name, user_email, user_password) VALUES (?, ?, ?)";
					$prepare = $conn->prepare($sql);
					$prepare->execute(array($user_name, $user_email, $hash));
					if (!$prepare) {
						echo "<script>alert('Something wrong! Please try again.'); window.location.href = 'index.php';</script>";
					} else {
						echo "<script>alert('Successfully Registration Done. Check your email now then You can Login'); window.location.href = 'test.php';</script>";
					}
				}
			}
		}
	}
?>
