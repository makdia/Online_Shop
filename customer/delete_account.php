<?php
//session_start();
include("../includes/db.php");
if(!isset($_SESSION['customer_email'])) {
	echo"<script>window.open('../customer_login.php','_self')</script>";
}
else {
	
	$user=$_SESSION['customer_email'];
	//for deleting cart,order,message of this customer
	$delete_cart="delete from cart where customer_email='$user'";
	$delete_order="delete from product_order where customer_email='$user'";
	$delete_message="delete from message where customer_email='$user'";
	
	$delete_customer="delete from customers where customer_email='$user'";
	$run_customer=mysqli_query($con,$delete_customer);
	echo "<script>alert('Your account has been deleted!!!')</script>";
	echo "<script>window.open('logout.php','_self')</script>";	
}
?>


