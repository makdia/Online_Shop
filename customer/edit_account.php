<?php
include("../includes/db.php");
$nameE=$emailE=$passwordE=$countryE=$cityE=$contactE=$addressE="";
$user=$_SESSION['customer_email'];
$get_customer="select * from customers where customer_email='$user'";
$run_customer=mysqli_query($con,$get_customer);
$row_customer=mysqli_fetch_array($run_customer);

$c_id=$row_customer['customer_id'];	
$c_name=$row_customer['customer_name'];	
$c_email=$row_customer['customer_email'];
$c_pass=$row_customer['customer_pass'];	
$c_country=$row_customer['customer_country'];	
$c_city=$row_customer['customer_city'];	
$c_contact=$row_customer['customer_contact'];	
$c_address=$row_customer['customer_address'];
$email=$c_email;//for storing old email..old email is used for updating product table 
?>

<?php
if(isset($_POST['update'])) {
	$customer_id=$c_id;
	$c_name=$_POST['c_name'];	
	$c_email=$_POST['c_email'];
	$c_pass=$_POST['c_pass'];	
	$c_country=$_POST['c_country'];	
	$c_city=$_POST['c_city'];	
	$c_contact=$_POST['c_contact'];	
	$c_address=$_POST['c_address'];
	$word=str_word_count($c_address);

          if (!preg_match("/^(?=.*[A-Za-z])[A-Za-z]{4,}$/",$c_name)) {
			  $nameE = "Name must be at least 4 character EX-Makdia,Foujia";
		  }
		  
		  else{}
		  if (!preg_match("/^(?=.*[A-Za-z])(?=.*\d)[A-Za-z\d]{8,}$/",$c_pass)) {
			  $passwordE = "Password minimum 8 characters with 1 letter and 1 number";
		  }
		  else{}
          if (!filter_var($c_email, FILTER_VALIDATE_EMAIL)) {
             $emailE = "Invalid email format Ex-makdia@gmail.com";
              }
		  else{}
	      if (!preg_match("/^(?=.*[A-Za-z])[A-Za-z]{2,}$/",$c_country)) {
			  $countryE = "Your country name is wrong Ex-UK,USA,BANGLADESH";
		  }
		  else{}
		   if (!preg_match("/^(?=.*[A-Za-z])[A-Za-z]{4,}$/",$c_city)) {
			  $cityE = "Your city name is wrong";
		  }
		  else{}
		   if (!preg_match("/^(?=.*\d+-)[\d+-]{10,}$/",$c_contact)) {
			  $contactE = "Your contact must be at least 10";
		  }
		  else{}
		  
		 if ($word<3) {
			   $addressE = "Address must be at least 3 words";
		  }
	     else{}
		
		if ((preg_match("/^(?=.*[A-Za-z])[A-Za-z]{4,}$/",$c_name)) && (preg_match("/^(?=.*[A-Za-z])(?=.*\d)[A-Za-z\d]{8,}$/",$c_pass))&& (filter_var($c_email, FILTER_VALIDATE_EMAIL)) && (preg_match("/^(?=.*[A-Za-z])[A-Za-z]{2,}$/",$c_country)) && (preg_match("/^(?=.*[A-Za-z])[A-Za-z]{4,}$/",$c_city)) && (preg_match("/^(?=.*\d+-)[\d+-]{10,}$/",$c_contact))  && ($word>=3)) {
                   
		$update_c="update customers set customer_name='$c_name',customer_email='$c_email',customer_pass='$c_pass',customer_country='$c_country',customer_city='$c_city',customer_contact='$c_contact',customer_address='$c_address' where customer_id='$customer_id'";
		$run_update=mysqli_query($con,$update_c);
		$_SESSION['customer_email']=$c_email;
		//update cart,order,message,products email from these tables because customer_email is being updated
		$update_product="update products set products_email='$c_email' where products_email='$email'";
		$run_product=mysqli_query($con,$update_product);
		$update_cart="update cart set customer_email='$c_email' where customer_email='$email'";
		$run_cart=mysqli_query($con,$update_cart);
		$update_order="update product_order set customer_email='$c_email' where customer_email='$email'";
		$run_order=mysqli_query($con,$update_order);
		$update_message="update message set customer_email='$c_email' where customer_email='$email'";
		$run_message=mysqli_query($con,$update_message);
		if($run_message) {
		echo "<script>alert('Your account has been updated successfully!!')</script>";	
		echo "<script>window.open('my_account.php?your_info','_self')</script>";	
		}
		}
		}
		?>







<div id="change_password">
	<h3 style="text-align:center;padding:10px;font:italic bold 20px Georgia, serif;">Update your account</h3>
	<form method="post" action="" enctype="multipart/form-data">
		<label style="float:left;">Your Name :</label>
		<input name="c_name" value="<?php echo $c_name;?>" type="text" required style="width:99.5%;padding:10px;margin-top:8px;padding-left:5px;font-size:20px;font-family:raleway;">
		<span class="error"><?php echo $nameE;?></span><br>
		<label style="float:left;">Your Email : </label>
		<input name="c_email" value="<?php echo $c_email;?>" type="text" required style="width:99.5%;padding:10px;margin-top:8px;padding-left:5px;font-size:20px;font-family:raleway;">
		<span class="error"><?php echo $emailE;?></span><br>
		<label style="float:left;">Your Password :</label>
		<input name="c_pass" value="<?php echo $c_pass;?>" type="password" required style="width:99.5%;padding:10px;margin-top:8px;padding-left:5px;font-size:20px;font-family:raleway;">
		<span class="error"><?php echo $passwordE;?></span><br>
		<label style="float:left;">Your Country:</label>
		<input name="c_country" value="<?php echo $c_country;?>" type="text" required style="width:99.5%;padding:10px;margin-top:8px;padding-left:5px;font-size:20px;font-family:raleway;">
		<span class="error"><?php echo $countryE;?></span><br>
		<label style="float:left;">Your City:</label>
		<input name="c_city" value="<?php echo $c_city;?>" type="text" required style="width:99.5%;padding:10px;margin-top:8px;padding-left:5px;font-size:20px;font-family:raleway;">
		<span class="error"><?php echo $cityE;?></span><br>
		<label style="float:left;">Your Contact:</label>
		<input name="c_contact" value="<?php echo $c_contact;?>" type="text" required style="width:99.5%;padding:10px;margin-top:8px;padding-left:5px;font-size:20px;font-family:raleway;">
		<span class="error"><?php echo $contactE;?></span><br>
		<label style="float:left;">Your Address:</label>
		<input name="c_address" value="<?php echo $c_address;?>" type="text" required style="width:99.5%;padding:10px;margin-top:8px;padding-left:5px;font-size:20px;font-family:raleway;">
		<span class="error"><?php echo $addressE;?></span><br>
		<input id="change_pass_submit" name="update" type="submit" value="Update Account">
	</form>
</div>



