<?php
session_start();
include("../includes/db.php");
if(!isset($_SESSION['user_email'])) {
	echo"<script>window.open('login.php?not_admin=This service is only for Admin!! If you are an Admin then Logged in by using your Email and Password.','_self')</script>";
}
else {

if(isset($_GET['delete_c'])) {
		$delete_id=$_GET['delete_c'];
		$delete_c="delete from message where txt_id='$delete_id'";
		$run_delete=mysqli_query($con,$delete_c);
		if($run_delete) {
			echo"<script>alert('Your message Has been deleted!')</script>";
			echo"<script>window.open('inbox.php','_self')</script>";
		}
}
} 
?>