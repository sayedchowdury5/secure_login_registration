
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
				//keep session record
				session_start();
				$_SESSION['login'] = true;
				$_SESSION['user_email'] = $user_email;
				
				//verify user password before login
				if (password_verify($user_password, $fetch['user_password'])) {
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
			$s = "SELECT user_email FROM users WHERE user_email = ?";
			$p = $conn->prepare($s);
			$p->execute([$user_email]);
			$r = $p->rowCount();

			if ($r > 0) {
				echo "<script> alert('This name already exist.'); window.location.href = 'auth-sign-up-social-header-footer.htm'; </script>";
				//compare user password inputs
			} elseif($user_password != $user_confirm_password) {
				echo "<script> alert('Password not match.'); window.location.href = 'auth-sign-up-social-header-footer.htm'; </script>";

				//encrypt user passwords to store into database
			} else {
				$password = $user_password;
				$hash = password_hash($password, PASSWORD_DEFAULT);
				
				//insert user details into database
				$sql = "INSERT INTO users (user_name, user_email, user_password) VALUES (?, ?, ?)";
				$prepare = $conn->prepare($sql);
				$prepare->execute(array($user_name, $user_email, $hash));
				if (!$prepare) {
					echo "<script>alert('Something wrong! Please try again.'); window.location.href = 'auth-sign-up-social-header-footer.htm';</script>";
				} else {
					echo "<script>alert('Successfully Registration Done.'); window.location.href = 'index-1.htm';</script>";
				}
			}
		}
	}
?>
