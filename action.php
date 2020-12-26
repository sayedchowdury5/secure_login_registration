
<?php
	require ('connect.php');
	
	if(isset($_POST['login'])){
		session_start();
		if ($_POST['user_email'] != "" || $_POST['user_password'] != "") {
			$user_email = $_POST['user_email'];
			$user_password = $_POST['user_password'];
			$sql = "SELECT * FROM users WHERE user_email = ? ";
			$query = $conn->prepare($sql);
            $query->execute(array($user_email));
			$row = $query->rowCount();
			$fetch = $query->fetch();
			
			if ($row > 0) {
				if (password_verify($user_password, $fetch['user_password'])) {
					echo "<script>alert('You Successfully logged in'); window.location.href = 'home.php';</script>";
				} else {
					echo "<script>alert('Your Credetials not match!'); window.location.href = 'index.php';</script>";
				}
			} else {
				echo "<script>alert('Your Credetials not match!'); window.location.href = 'index.php';</script>";
			}
		}
	}
	
	if(isset($_POST['register'])){
		if ($_POST['user_name'] != "" || $_POST['user_email'] != "" || $_POST['user_password'] != "" || $_POST['user_confirm_password'] != "") {
			$user_name = $_POST['user_name'];
			$user_email = $_POST['user_email'];
			$user_password = $_POST['user_password'];
			$user_confirm_password = $_POST['user_confirm_password'];
			$password = "";
			$hash = "";

			$a = "SELECT user_email FROM users WHERE user_email = ?";
			$p = $conn->prepare($a);
			$p->execute([$user_email]);
			$r = $p->rowCount();
			if ($r > 0) {
				echo "<script> alert('This email already exist.'); window.location.href = 'test.php'; </script>";
			} elseif($user_password != $user_confirm_password) {
				echo "<script> alert('Password not match.'); window.location.href = 'test.php'; </script>";
			} else {
				$password = $user_password;
				$hash = password_hash($password, PASSWORD_DEFAULT);

				$sql = "INSERT INTO users (user_name, user_email, user_password) VALUES (?, ?, ?)";
				$prepare = $conn->prepare($sql);
				$prepare->execute(array($user_name, $user_email, $hash));
				if (!$prepare) {
					echo "<script>alert('Something wrong! Please try again.'); window.location.href = 'index.php';</script>";
				} else {
					echo "<script>alert('Successfully Registration Done. You can Login now'); window.location.href = 'test.php';</script>";
				}
			}
		}
	}

?>