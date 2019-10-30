<?php
$user=$_SESSION['customer_email'];
$get_img="select * from customers where customer_email='$user'";
$run_img=mysqli_query($con,$get_img);
$row_img=mysqli_fetch_array($run_img);
$c_name=$row_img['customer_name'];
$c_email=$row_img['customer_email'];
$c_country=$row_img['customer_country'];
$c_city=$row_img['customer_city'];
$c_contact=$row_img['customer_contact'];
$c_address=$row_img['customer_address'];?>

<div id="change_password">
	<h3 style="text-align:center;padding:10px;padding-bottom:15px;font:italic bold 20px Georgia, serif;">Your Info</h3>  
	<ul id="about_user">              
	<label style="float:left;margin-left:3px;font-size:18px;color:#FF1493;">E-mail :</label></br>				  
	<li><?php  echo "$c_email" ?></li><hr style="color: gray; height: 1px; background-color:gray;" />
	<label style="float:left;margin-left:3px;font-size:18px;color:#FF1493;">Contact-no :</label></br>
	<li><?php echo "$c_contact" ?></li><hr style="color: gray; height: 1px; background-color:gray;" />
	<label style="float:left;margin-left:3px;font-size:18px;color:#FF1493;">City :</label></br>
	<li><?php  echo "$c_city" ?></li><hr style="color: gray; height: 1px; background-color:gray;" />
	<label style="float:left;margin-left:3px;font-size:18px;color:#FF1493;">Country :</label></br>
	<li><?php echo "$c_country" ?></li><hr style="color: gray; height: 1px; background-color:gray;" />
	<label style="float:left;margin-left:3px;font-size:18px;color:#FF1493;">Address :</label></br>
	<li><?php echo "$c_address" ?></li><hr style="color: gray; height: 1px; background-color:gray;" />
	</ul>
</div>













