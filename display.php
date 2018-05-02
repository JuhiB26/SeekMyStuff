<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
 include "includes/dbh.inc.php";
$result = mysqli_query($conn, "SELECT * FROM images");
if (isset($_SESSION['u_id'])) 
{
	$result = mysqli_query($conn, "SELECT * FROM images");
	$elements = array();
	 ?>
 <!DOCTYPE html>
<html>
<head>
	<title>Image Upload</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
		<link rel="stylesheet" href="home_style.css">
	<style type="text/css">
		#content{
			width: 50%;
			margin: 20px auto;
			border: 1px solid #cbcbcb;
		}
		form{
			width: 50%;
			margin: 20px auto;
		}
		form div{
			margin-top: 5px;
		}
		#img_div{
			width: 80%;
			padding: 5px;
			margin: 15px auto;
			border: 1px solid #cbcbcb;
		}
		#img_div:after{
			content: "";
			display: block;
			clear: both;
		}
		.myimg{
			float: left;
			margin: 5px;
			width: 300px;
			height: 140px;
		}
	</style>
</head>
	
<body>
		
		<div >
		
		<div class='container2'>
        <div>
            <img src='transparent logo.png' class='iconDetails'>
        </div>
    <div style='margin-left:100px;'>
<h1><font size="7" color="black" face="Segoe Print"><b>SEEK MY STUFF</b></font></h1><br>
</div>
</div>
<ul class="nav">

<li id='logout' onclick="logoutme()"><a href="includes/logout.inc.php">Log Out</a></li>
 <li><a href="upload.php">Upload Lost Item</a></li>
<li><a href="display.php">Find Your Item</a></li>

</ul>
<br>
	<div id="content">

		 <div class="panel-heading" style="margin: 5; padding: 5"><b>Lost Items</b></div>
			<hr>
		 <div class="panel-heading" style="margin: 5; padding: 5">

		 	<?php
			
		while ($row = mysqli_fetch_array($result)) {
			$cur_user=$row['user_id'];
			$sql = "SELECT * from users where user_id = $cur_user";
			$res= mysqli_query($conn, $sql);
			$cur_name = 'NULL';
			//echo $cur_user;
			array_push($elements, $row['id']);
			$r = mysqli_fetch_array($res);
			if($r['user_id']==$_SESSION['u_id'])
					$cur_name="Me";
				else
					$cur_name=$r['user_first'].' '.$r['user_last'];
		
				echo " <div class = 'img_div' style='margin: 5; padding: 5'>";
				echo "<img class='img-rounded myimg' class='img-responsive' src='images/".$row['image']."' >";
				
				echo "<p>".$row['image_text']."</p>";
				echo "<p>".$row['found_at']."</p>";
				echo "<p>".$row['contact']."</p>";
				echo "<p>".$cur_name."</p><br>";
				echo "</div>";			
				echo '<center><hr></center>';
			
		}
	?></div>
	</div>
</div>
</body>
</body>
</body>
</html>
	<?php 
		}
		else
		{
			header("Location: index.php");
			die();
		}
	?>