<div id="change_password">     
	<h3 style="text-align:center;padding:10px;font:italic bold 20px Georgia, serif;">Change your Password</h3>
	<form method="post" action="" enctype="multipart/form-data">
		<label style="float:left;">Enter Old Password:</label>
		<input type="password" name="current_pass" placeholder="**********" required style="width:99.5%;padding:10px;margin-top:8px;padding-left:5px;font-size:20px;font-family:raleway;">
		<label style="float:left;">Enter new Password:</label>
		<input type="password" name="new_pass" placeholder="**********" required style="width:99.5%;padding:10px;margin-top:8px;padding-left:5px;font-size:20px;font-family:raleway;">
		<label style="float:left;">Enter new Password again:</label>
		<input type="password" name="new_pass_again" placeholder="**********" required style="width:99.5%;padding:10px;margin-top:8px;padding-left:5px;font-size:20px;font-family:raleway;">
		<input id="change_pass_submit" type="submit" name="change_pass" value="Change Password"/>
	</form>
</div>



<?php
include("../includes/db.php");
if(isset($_POST['change_pass'])) {
	$user=$_SESSION['customer_email'];
	$current_pass=$_POST['current_pass'];	
	$new_pass=$_POST['new_pass'];	
	$new_again=$_POST['new_pass_again'];	
	$sel_pass="select * from customers where customer_email='$user' AND customer_pass='$current_pass'";
	$run_pass=mysqli_query($con,$sel_pass);
	$check_pass=mysqli_num_rows($run_pass);
	if($check_pass==0) {
		echo "<script>alert('Your Current Password is Wrong')</script>";
		exit();	
}
else if($new_pass!=$new_again) {
	echo "<script>alert('New password do not match')</script>";	
	exit();
}
else {
	$update_pass="update customers set customer_pass='$new_pass' where customer_email='$user'";
	$run_update=mysqli_query($con,$update_pass);
	echo "<script>alert('Your password has been Updated successfully!!!')</script>";	
	echo "<script>window.open('my_account.php','_self')</script>";	
	exit();
}
}
?>















