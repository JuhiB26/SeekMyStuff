<?php
	if (session_status() == PHP_SESSION_NONE) 
	{
    session_start();
    if (isset($_SESSION['u_id'])) 
			{
				header("Location: home.php");
				exit();
			}
	}
?>

<!DOCTYPE html>
<html>
<head>	
	<link rel="stylesheet" href="home_style.css">
 <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
	<title>Home</title>
	<link rel="stylesheet" type="text/css" href="style.css">
	<script type="text/javascript">
		function signin()
		{
			window.location = "signup.php";
		}

		function reset(mdoal_footer)
		{
			var u_id=document.getElementById("uid").value;
			var opt=	{
							  "id":u_id,
							};

					var tosend=JSON.stringify(opt);

			var paswd=document.getElementById("pwd").value;

			if(paswd.length>8)
			{	
			
			$.ajax({
			 	            url: "reset_pwd.php",
			 	            type: "POST",
			 	             data: {
			 	             	u_id: u_id,
			 	             	pwd: paswd
			 	             },

			 	             success: function(response) {
			 	             		console.log(response);
			 	             		var paswd=document.getElementById("pwd").value;
			 	             		if(response!="failed")
			 	             		{
			 	             				/*var parent=document.getElementById("m_footer");
			 	             				var pwd = document.createElement("input");
			 	             				pwd.id="new_pwd"
			 	             				parent.append(pwd);
			 	             				console.dir(pwd);
			 	             				var okbtn=document.createElement("button");
			 	             				okbtn.id="new_ok";
			 	             				var textnode1 = document.createTextNode("Ok");
			 	             				okbtn.value="Ok";
			 	             				okbtn.appendChild(textnode1);
			 	             				parent.append(okbtn);
			 	             				var tbd=document.getElementById("forgot");
			 	             				tbd.remove();
			 	             				console.dir(okbtn);*/
			 	             				//console.log("res: "+response);
			 	             				//var email=;
			 	             				var len=response.length-1;
			 	             				var email = response.substring(2, len-1);
			 	             				console.log("email_id: "+email);
			 	             				
			 	             				
			 	             				if(paswd.length>8)
			 	             				{
			 	             				$.ajax({
					 	            			/*url: "locahost:5000",
					 	           				type: "POST",
					 	           				data: {email:email,password:paswd},
					 	        				dataType: "json",
					 	            			 success: function(response) {
					 	             			if(response=="done")
					 	             					alert("Check your email: "+email);
					 			        		else
					 			        			 alert("Fai
					 			      			error: functioled");
					 			        		},n(error_msg){
					 			      					alert("Failed Error");
					 			      				console.log(error_msg);
					 			      			}*/
					 			      			url: "PHPMailer-master/phpmailer_s.php",	
					 			      			//url: "test.php",
					 	           				type: "POST",
					 	           				data: {email:email,password:paswd},
					 	        				
					 	            			 success: function(response) {
					 	            			 	console.log("final:"+response);
					 	             			if(response=="done")
					 	             					alert("Check your email: "+email);
					 			        		else
					 			        			alert("Failed Error");
					 			      				
					 			        		},
					 			      			error: function(error_msg){
					 			      			}
					 			      		});
			 	             				}
			 	             				else
			 	             				{
			 	             					alert("Password should be atleast 8 characters");
			 	             				}
			 	             				
			 	             				
				 	             		}
				 	             		else
				 	             		{
				 	             			alert("Invalid user_id/email");
				 	             		}		
			 	             		},
			 	             		error : function(error_msg){
			 	             	console.log(error_msg);
			 	             }		 
			 	             		
			 	             		
			 	          });
				}
				else
				{
						alert(paswd)

				}
			 	             		
			 	             	
			 	             	
		}

	</script>


	<style>
  .iconDetails {
 margin-left:1%;
float:left;
}
.container2 {
    width:100%;
    height:auto;
    padding:1%;
}
body
{
	background-color: #fff;
}

</style>
</head>
<body >

<div>

          <div class='container2'>
        <div>
            <img src='transparent logo.png' class='iconDetails'>
        </div>
    <div style='margin-left:100px;'>
<h1><font size="7" color="black" face="Segoe Print"><b>SEEK MY STUFF</b></font></h1>  <br>
</div>
</div>
<br><br> <br>       
	<ul class="nav">
		<div>
				<?php
					if (isset($_SESSION['u_id'])) {
						echo '<form action="includes/logout.inc.php" method="POST">
							<li><button type="submit" name="submit">Logout</button></li>
						</form>';
					} else {

						echo '<li><button type="button" data-toggle="modal" data-target="#myModal">Login</button></li>';

						echo '<div class="modal fade" id="myModal" role="dialog">
				    <div class="modal-dialog">
				    
				      <!-- Modal content-->
				      <div class="modal-content">
				        <div class="modal-header">
				          <button type="button" class="close" data-dismiss="modal">&times;</button>
				          <h4 class="modal-title">Login</h4>
				        </div>
				        <div class="modal-body">
				          <form action="includes/login.inc.php" method="POST">
							<input type="text" id="uid" name="uid" placeholder="Username/e-mail">
							<input type="password" id="pwd" name="pwd" placeholder="Password">
							<br><br><br>
							<center><button type="submit" name="submit">Login</button></center>
							<br>
							
						</form>
				        </div>
				        
				      <div class="modal-footer" id="m_footer">
				        <button type="button" id="forgot" class="btn btn-default" onclick=reset(this)>Forgot Password</button>
				        </div>
				      </div>
				      </div>
				      </div>';

						echo '<li><button onclick="signin()">Sign up</button></li>';
					}
				?>
			</div>
		</ul>
	</div>
