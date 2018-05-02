<!DOCTYPE html>
<html>
<head>
<style type="text/css">
.ip{
    margin-top: 25px;
    color: #000;
    }
</style>
</head>
<body>
<?php
 include "includes/dbh.inc.php";
 session_start();
if (isset($_SESSION['u_id'])) 
			{
	if (isset($_POST['upload'])) {
		$target = "images/".basename($_FILES['image']['name']);

		$u_id=$_SESSION['u_id'];
		$image = $_FILES['image']['name'];
		$image_text = mysqli_real_escape_string($conn, $_POST['image_text']);
		$found_at = mysqli_real_escape_string($conn, $_POST['found_at']);
		$contact = mysqli_real_escape_string($conn, $_POST['contact']);
		
		$sql = "INSERT INTO images (image, image_text, found_at, contact, user_id) VALUES ('$image', '$image_text','$found_at','$contact',$u_id)";
		mysqli_query($conn, $sql);

		if (move_uploaded_file($_FILES['image']['tmp_name'], $target)) {
			$msg = "Image uploaded successfully";
			unset($_POST['upload']);
			echo'<script>
			alert('.$msg.')</script>';
			
		}else{
			$msg = "Failed to upload image";
			unset($_POST['upload']);
			echo'<script>
			alert('.$msg.')</script>';
		}

	}

	



				/*echo '<div id="content">';
	while ($row = mysqli_fetch_array($result)) {
		echo "<div id='img_div'>";
			echo "<img src='images/".$row['image']."' >";
			echo "<p>".$row['image_text']."</p>";
			echo "<p>".$row['found_at']."</p>";
			echo "<p>".$row['contact']."</p>";
		echo "</div>";
	}*/
	include "myitems.php";

echo '
	<form method="POST" action="upload.php" enctype="multipart/form-data">
		<input type="hidden" name="size" value="1000000">
		<div>
			<input type="file" name="image">
		</div>
		<div>
			<input class = "ip" id="text1" cols="30" rows="1" name="image_text" placeholder="Item Name"></textarea>
		<br><input id="text2" class = "ip" cols="30" rows="1" name="found_at" placeholder="Found at"></textarea>
				
			<br><input class = "ip" id="text3" cols="30" rows="1" name="contact" placeholder="Contact"></textarea>

		</div>
		<div>
			<button class = "ip" type="submit" name="upload">POST</button>
		</div>
		';
		/*</form><form action="display.php"><input type="submit" value="New page" /></form>
</div></section>*/

}
else
{
	header("Location: index.php");
	die();
}
?>
</body>
</html>