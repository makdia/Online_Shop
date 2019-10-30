<?php
session_start();
include("../includes/db.php");
if(!isset($_SESSION['user_email'])) {
	echo"<script>window.open('login.php?not_admin=This service is only for Admin!! If you are an Admin then Logged in by using your Email and Password.','_self')</script>";
}
else {


?>


<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>

<div class="grid_10">
            <div class="box round first grid">
                <h2>Change Password</h2>
               <div class="block copyblock"> 
                   
	<div id="admin_password">     
	<h3 style="text-align:center;padding:10px;font:italic bold 20px Georgia, serif;">Change your Password</h3>
	<form method="post" action="" enctype="multipart/form-data">
		<label style="float:left;">Enter Old Password:</label>
		<input type="password" name="current_pass" placeholder="**********" required style="width:99.5%;padding:10px;margin-top:8px;padding-left:5px;font-size:20px;font-family:raleway;">
		<label style="float:left;">Enter new Password:</label>
		<input type="password" name="new_pass" placeholder="**********" required style="width:99.5%;padding:10px;margin-top:8px;padding-left:5px;font-size:20px;font-family:raleway;">
		<label style="float:left;">Enter new Password again:</label>
		<input type="password" name="new_pass_again" placeholder="**********" required style="width:99.5%;padding:10px;margin-top:8px;padding-left:5px;font-size:20px;font-family:raleway;">
		<input id="admin_pass_submit" type="submit" name="change_pass" value="Change Password"/>
	</form>
</div>



                </div>
            </div>
        </div>
<?php include 'inc/footer.php';?>

<?php
include("../includes/db.php");
if(isset($_POST['change_pass'])) {
	$user=$_SESSION['user_email'];
	$current_pass=$_POST['current_pass'];	
	$new_pass=$_POST['new_pass'];	
	$new_again=$_POST['new_pass_again'];	
	$sel_pass="select * from admin where user_email='$user' AND user_pass='$current_pass'";
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
	$update_pass="update admin set user_pass='$new_pass' where user_email='$user'";
	$run_update=mysqli_query($con,$update_pass);
	echo "<script>alert('Your password has been Updated successfully!!!')</script>";	
	echo "<script>window.open('index.php','_self')</script>";	
	exit();
}
}
}
?>
