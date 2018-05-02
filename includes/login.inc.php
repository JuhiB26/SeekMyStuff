<?php

session_start();

if (isset($_POST['submit'])) {
	
	include 'dbh.inc.php';

	$uid = mysqli_real_escape_string($conn, $_POST['uid']);
	$pwd = mysqli_real_escape_string($conn, $_POST['pwd']);

	//Error handlers
	//Check if inputs are empty
	if (empty($uid) || empty($pwd)) {
		echo '<script language="javascript">';
					echo 'alert("Missing fields")';
					echo '</script>';
			echo '<script language="javascript">';		
					echo "window.location.href='../index.php'";
			echo '</script>';

	} else {
		$sql = "SELECT * FROM users WHERE user_uid='$uid' OR user_email='$uid'";
		$result = mysqli_query($conn, $sql);
		$resultCheck = mysqli_num_rows($result);
		if ($resultCheck < 1) 
		{
			echo '<script language="javascript">';
					echo 'alert("Invalid Credentials")';
					echo '</script>';
			echo '<script language="javascript">';		
					echo "window.location.href='../index.php'";
			echo '</script>';

		} else {
			if ($row = mysqli_fetch_assoc($result)) {
				//De-hashing the password
				$hashedPwdCheck = password_verify($pwd, $row['user_pwd']);
				if ($hashedPwdCheck == false) {
					echo '<script language="javascript">';
					echo 'alert("Incorrect Password!")';
					echo '</script>';
			echo '<script language="javascript">';		
					echo "window.location.href='../index.php'";
			echo '</script>';
					exit();
				} elseif ($hashedPwdCheck == true) {
					//Log in the user here
					$_SESSION['u_id'] = $row['user_id'];
					$_SESSION['u_first'] = $row['user_first'];
					$_SESSION['u_last'] = $row['user_last'];
					$_SESSION['u_email'] = $row['user_email'];
					$_SESSION['u_uid'] = $row['user_uid'];
					header("Location: ../home.php");
					exit();
				}
			}
		}
	}
} else {
	header("Location: ../index.php?login=error");
	exit();
}