<?php 
session_start();
include 'db/dbcon.php';

if (isset($_POST['username']) && isset($_POST['password'])) {
	
	$username = $_POST['username'];
	$password = $_POST['password'];
	echo($username);

	if (empty($username)) {
		header("Location: login.php?error=Username is required");
	}else if (empty($password)){
		header("Location: login.php?error=Password is required&username=$username");
	}else {
		$stmt = $conn->prepare("SELECT * FROM admin WHERE username=?");
		$stmt->execute([$username]);

		if ($stmt->rowCount() === 1) {
			$user = $stmt->fetch();

			$user_id = $user['id'];
			$user_username = $user['username'];
			$user_password = $user['password'];

			if ($username === $user_username) {
				if (password_verify($password, $user_password)) {
					$_SESSION['user_id'] = $user_id;
					$_SESSION['user_username'] = $user_username;
					header("Location: index.php");

				}else {
					header("Location: login.php?error=Incorect User name or password&username=$username");
				}
			}else {
				header("Location: login.php?error=Incorect User name or password&username=$username");
			}
		}else {
			header("Location: login.php?error=Incorect User name or password&username=$username");
		}
	}
}
