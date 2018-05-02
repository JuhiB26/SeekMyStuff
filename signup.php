<?php
	include_once 'header.php';
?>
<section class="main-container">
	<div class="main-wrapper">
		<h2>Signup</h2>
		<div>
		<form class="signup-form" action="includes/signup.inc.php" method="POST">
			<input style="border-style: solid;" type="text" name="first" placeholder="Firstname">
			<input style="border-style: solid;" type="text" name="last" placeholder="Lastname">
			<input style="border-style: solid;" type="text" name="email" placeholder="E-mail">
			<input style="border-style: solid;" type="text" name="uid" placeholder="Username">
			<input style="border-style: solid;" type="password" name="pwd" placeholder="Password">

			<button type="submit" name="submit">Sign up</button>
		</form>
	</div>
	</div>