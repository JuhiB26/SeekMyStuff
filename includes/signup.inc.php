<?php

if (isset($_POST['submit'])) {
	include_once 'dbh.inc.php';
	$first = mysqli_real_escape_string($conn, $_POST['first']);
	$last = mysqli_real_escape_string($conn, $_POST['last']);
	$email = mysqli_real_escape_string($conn, $_POST['email']);
	$uid = mysqli_real_escape_string($conn, $_POST['uid']);
	$pwd = mysqli_real_escape_string($conn, $_POST['pwd']);
	
	//Error handlers
	//Check for empty fields
	if (empty($first) || empty($last) || empty($email) || empty($uid) || empty($pwd)) {
		echo '<script language="javascript">';
					echo 'alert("Missing fields")';
					echo '</script>';
			echo '<script language="javascript">';		
					echo "window.location.href='../signup.php'";
			echo '</script>';
		
	} else {
		//Check if input characters are valid
		if (!preg_match("/^[a-zA-Z]*$/", $first) || !preg_match("/^[a-zA-Z]*$/", $last)) {
			
			echo '<script language="javascript">';
					echo 'alert("Invalid Input")';
			echo '</script>';
			echo '<script language="javascript">';		
					echo "window.location.href='../signup.php'";
			echo '</script>';
		} else {
			//Check if email is valid
			if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
				echo '<script language="javascript">';
					echo 'alert("Invalid Email")';
					echo '</script>';
				echo '<script language="javascript">';		
					echo "window.location.href='../signup.php'";
			echo '</script>';
			} else {
				$sql = "SELECT * FROM users WHERE user_uid='$uid'";
				$result = mysqli_query($conn, $sql);
				$resultCheck = mysqli_num_rows($result);

				
				if ($resultCheck > 0) {
					echo '<script language="javascript">';
					echo 'alert("Already Registered")';
					echo '</script>';
					echo '<script language="javascript">';		
					echo "window.location.href='../signup.php'";
					echo '</script>';
				}
				else if(strlen($pwd)<8)
				{
					
					echo '<script language="javascript">';
					echo 'alert("Password length should be atleast 8")';
					echo '</script>';
					echo '<script language="javascript">';		
					echo "window.location.href='../index.php'";
					echo '</script>';
				} 
				else {
					//Hashing the password
					$hashedPwd = password_hash($pwd, PASSWORD_DEFAULT);
					//Insert the user into the database
					$sql = "INSERT INTO users (user_first, user_last, user_email, user_uid, user_pwd) VALUES ('$first', '$last', '$email', '$uid', '$hashedPwd');";
					mysqli_query($conn, $sql);
					echo '<script language="javascript">';
					echo 'alert("Registered Successfully")';
					echo '</script>';
					echo '<script language="javascript">';		
					echo "window.location.href='../signup.php'";
					echo '</script>';
				}
			}
		}
	}

} else {
	echo '<script language="javascript">';
					echo 'alert("Not Registered")';
					echo '</script>';
	header("Location: ../signup.php");
	//exit();
}