<?php
	include "includes/dbh.inc.php";
	$response=[];
	

	//if (isset($_POST['u_id'])&&$_POST['id']) 
	{
		$uid = $_POST['u_id'];
		$pwd=$_POST['pwd'];
		$sql = "SELECT * FROM users WHERE user_uid='$uid' OR user_email='$uid'";
		$result = mysqli_query($conn, $sql);
		
		$resultCheck = mysqli_num_rows($result);
		if ($resultCheck > 0) {

			while($row = mysqli_fetch_assoc($result))
			{
				array_push($response,$row['user_email']);
			}
			//print_r($response);
			$email=$response[0];
			$hashedPwd = password_hash($pwd, PASSWORD_DEFAULT);
			$up = "UPDATE users SET user_pwd = '".$hashedPwd."' WHERE user_email='".$email."';";
			if(mysqli_query($conn, $up))
			{
				echo json_encode($response);
			}
			else
			{
				echo "Error deleting record: " . mysqli_error($conn);
			}
		}
		else
		{
			echo "failed";
		}
	}
	/*else
	{

		echo json_encode("never");
	}*/
?>
