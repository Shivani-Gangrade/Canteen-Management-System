<?php
session_start();
	if (isset($_POST['signup_submit'])) {
		$username = $_POST['username'];
		$email = $_POST['email'];
		$password = $_POST['password'];
		// $user_type = $_POST['usertype'];

		$conn = mysqli_connect('localhost', 'root', '', 'HCU_FOOD');
		$query = "INSERT INTO customers (username, email, password) VALUES ('$username', '$email', '$password')";
		$result = mysqli_query($conn, $query);

		if ($result) {
			echo '<script>alert("Sign up successful");</script>';
			sleep(20);
			header('location: index.php');
		} else {
			echo '<script>alert("Sign up failed");</script>';
			sleep(2000);
			header('location: index.php');
		}
	}
?>
