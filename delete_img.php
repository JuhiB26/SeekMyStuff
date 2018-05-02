<?php
	include "includes/dbh.inc.php";
	$response=[];
	

	//if (isset($_POST['u_id'])&&$_POST['id']) 
	{
		$id = $_POST['u_id'];
		$cur=$_POST['id'];
		$sql='SELECT * FROM images where user_id = '.$id.';';
		$result = mysqli_query($conn, $sql);
		if (mysqli_num_rows($result) > 0)
		{
			while($row = mysqli_fetch_assoc($result))
			{
				array_push($response,$row['id']);
			}
		}
		$tbd = $response[$cur];
		print_r($response);
		echo $tbd;
		$del='DELETE FROM images where id = '.$tbd.';';
		//array_push($superresponse,$response);
		//$superresponse=array_fill_keys($superresponse,'event');
		echo $del;
		if (mysqli_query($conn, $del)) 
		{
		    echo "Record deleted successfully";
		} else {
		    echo "Error deleting record: " . mysqli_error($conn);
		}
	}
	/*else
	{

		echo json_encode("never");
	}*/
?>
