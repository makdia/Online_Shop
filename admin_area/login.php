<!DOCTYPE html>
<head>
<meta charset="utf-8">
<title>Login</title>
    <link rel="stylesheet" type="text/css" href="css/stylelogin.css" media="screen" />
</head>
<body>
<div class="container">
	<section id="content">
		<form action="" method="post" enctype="multipart/form-data">
			<h1>Admin Login</h1>
			<div>
				<input type="text" placeholder="Enter your email" required="" name="email"/>
			</div>
			<div>
				<input type="password" placeholder="**********" required="" name="password"/>
			</div>
			<div>
				<input name="login" type="submit" value="Log in" />
			</div>
		</form><!-- form -->
		<div class="button">
			<a href="#">Store Online BD</a>
		</div><!-- button -->
	</section><!-- content -->
</div><!-- container -->
</body>
</html>






<?php
session_start();
include("../includes/db.php");
if(isset($_POST['login'])) {
	$email=$_POST['email'];
	$pass=$_POST['password'];
	$sel_user="select * from admin where user_email='$email' AND user_pass='$pass'";
	$run_user=mysqli_query($con,$sel_user);
	$check_user=mysqli_num_rows($run_user);
if($check_user==0) {
	echo"<script>alert('Your Password or Email is wrong,try again!')</script>";
}
else {
	$_SESSION['user_email']=$email;
	echo"<script>alert('You have successfully Logged in!')</script>";
	echo"<script>window.open('index.php','_self')</script>";
}
}
?>
