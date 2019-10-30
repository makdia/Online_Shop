<?php
include("../includes/db.php");
$user=$_SESSION['customer_email'];
$get_customer="select * from customers where customer_email='$user'";
$run_customer=mysqli_query($con,$get_customer);
$row_customer=mysqli_fetch_array($run_customer);
$c_id=$row_customer['customer_id'];	
$image=$row_customer['customer_image'];	
?>

<div id="change_password">
	<h3 style="text-align:center;padding:10px;padding-bottom:15px;font:italic bold 20px Georgia, serif;">Change Your Profile Picture</h3>
	<form method="post" action="" enctype="multipart/form-data">
		<label style="float:left;">Your Current Profile:</label>
		<?php  if (empty($image)) { ?>
		<label style="float:left;"><img src="customer_images/makdia.png" width="100px" height="100px" style="margin-left:20px;margin-top:8px;"/> </label>
		<?php } 
		else { ?>
		<label style="float:left;"><img src="customer_images/<?php echo $image;?>" width="100px" height="100px" style="margin-left:20px;margin-top:8px;"/> </label>
		<?php } ?>
		</br></br></br></br></br></br>
		<label style="float:left;">Choose a new profile:</label>
		<p><input type="file" name="c_image" required style="width:99.5%;margin-top:8px;font-size:15px;font-family:raleway;"></p>
		<input id="change_pass_submit" type="submit" name="update" value="Upload Profile Picture"/>
	</form>
</div>


<?php
if(isset($_POST['update'])) {
	$customer_id=$c_id;
	$c_image=$_FILES['c_image']['name'];
	$c_image_tmp=$_FILES['c_image']['tmp_name'];
	move_uploaded_file($c_image_tmp,"customer_images/$c_image");
	$update_c="update customers set customer_image='$c_image' where customer_id='$customer_id'";
	$run_update=mysqli_query($con,$update_c);
	if($run_update) {
		echo "<script>alert('Profile Picture has been Uploaded successfully!!')</script>";	
		echo "<script>window.open('my_account.php','_self')</script>";	
	}
	else {
		echo "<script>alert('Profile Picture not Uploaded')</script>";
	}
}
?>
