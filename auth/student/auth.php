<?php 
session_start();
include '../../db/dbcon.php';

if (isset($_POST['user_name']) && isset($_POST['password'])) {
	
	$user_name = $_POST['user_name'];
	$password = $_POST['password'];
	echo($user_name);

	if (empty($user_name)) {
		header("Location: login.php?error=Username is required");
	}else if (empty($password)){
		header("Location: login.php?error=Password is required&user_name=$user_name");
	}else {
		$stmt = $conn->prepare("SELECT * FROM user_std WHERE user_name=?");
		$stmt->execute([$user_name]);

		if ($stmt->rowCount() === 1) {
			$user = $stmt->fetch();

			$std_user_name = $user['user_name'];
			//$std_password = $user['password'];

			if ($user_name === $std_user_name) {
				$_SESSION['std_user_name'] = $std_user_name;
				//$_SESSION['std_password'] = $std_password;
				header("Location: index.php");
			}else {
				header("Location: login.php?error=Incorect User name or password&user_name=$user_name");
			}
		}else {
			header("Location: login.php?error=Incorect User name or password&user_name=$user_name");
		}
	}
}
