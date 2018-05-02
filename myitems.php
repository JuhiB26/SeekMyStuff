<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
 include "includes/dbh.inc.php";
 if (isset($_SESSION['u_id'])) 
{
	$result = mysqli_query($conn, "SELECT * FROM images where user_id = ".$_SESSION['u_id']." ");
	$elements = array();
	 ?>
	 <!DOCTYPE html>
	<html>
	<head>
		
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
		<link rel="stylesheet" href="home_style.css">
		<title>My Uploads</title>
		<style type="text/css">
			#content
			{
				width: 50%;
				margin: 20px auto;
				border: 1px solid #cbcbcb;
			}
			form
			{
				width: 50%;
				margin: 20px auto;
			}
			form div
			{
				margin-top: 5px;
			}
			.img_div{
				width: 80%;
				padding: 5px;
				margin: 15px auto;
				border: 1px solid #cbcbcb;
			}
			.img_div:after{
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

		<script type="text/javascript">
			function del(id)
			{
				var r = confirm("Delete this request as resolved?");
    			if (r == true) 
    			{
        
		    		var len =id.length - 1;
					var element=id.charAt(len)
					console.log(element);
					var myvar = <?php echo json_encode($_SESSION['u_id']); ?>;
					console.log(myvar);

					var opt=	{
							  "id":element,
							  "u_id":myvar
							};

					var tosend=JSON.stringify(opt);

					$.ajax({
			 	            url: "delete_img.php",
			 	            type: "POST",
			 	             data: {id: element,u_id: myvar},
			 	        	
			 	             success: function(response) {
			 	             		alert("Deleted");
									window.location.reload();
			 	             	},
			 	             	 error : function(error_msg){
			 	             	console.log(error_msg);
			 	             }

				});
			}
		}
		</script>
	</head>
	<body>
		<div>
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
	<div>
	<div id="content">
		 <center><h4><div class="panel-heading" style="margin: 5; padding: 5">MY UPLOADS</div></h4></center>
		 <hr>
		 <div class="panel-heading" style="margin: 5; padding: 5">

		 	<?php
		$i=0;
		
		while ($row = mysqli_fetch_array($result))
		{
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
				echo '<center><button class="btn btn-danger" onclick="del(this.id)" id="del'.$i.'">DELETE</button></center>';
			$i=$i+1;
		}
	?></div>
	<?php 
		}
		else
		{
			header("Location: index.php");
			exit();
		}
	?>
</div>
</div>
</div>
</body>
</html>