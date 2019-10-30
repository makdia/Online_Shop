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


<?php
$user=$_SESSION['user_email'];
$get_img="select * from admin where user_email='$user'";
$run_img=mysqli_query($con,$get_img);
$row_img=mysqli_fetch_array($run_img);
$c_name=$row_img['user_name'];
$c_email=$row_img['user_email'];
$c_city=$row_img['city'];
$c_contact=$row_img['phone'];
$c_address=$row_img['address'];?>



<div class="grid_10">
    <div class="box round first grid">
        <h2>Admin Info</h2>
            <div class="block copyblock"> 
                <div id="admin_password">
					<h3 style="text-align:center;padding:10px;padding-bottom:15px;font:italic bold 20px Georgia, serif;">Admin Info</h3>  
					<ul id="about_user">      
					<label style="float:left;margin-left:3px;font-size:18px;color:#FF1493;">Name :</label></br>
					<li><?php echo "$c_name" ?></li><hr style="color: gray; height: 1px; background-color:gray;" />
					<label style="float:left;margin-left:3px;font-size:18px;color:#FF1493;">E-mail :</label></br>				  
					<li><?php  echo "$c_email" ?></li><hr style="color: gray; height: 1px; background-color:gray;" />
					<label style="float:left;margin-left:3px;font-size:18px;color:#FF1493;">Contact-no :</label></br>
					<li><?php echo "$c_contact" ?></li><hr style="color: gray; height: 1px; background-color:gray;" />
					<label style="float:left;margin-left:3px;font-size:18px;color:#FF1493;">City :</label></br>
					<li><?php  echo "$c_city" ?></li><hr style="color: gray; height: 1px; background-color:gray;" />
					<label style="float:left;margin-left:3px;font-size:18px;color:#FF1493;">Address :</label></br>
					<li><?php echo "$c_address" ?></li><hr style="color: gray; height: 1px; background-color:gray;" />
					</ul>
				</div>
			</div>
    </div>
</div>
<?php include 'inc/footer.php';?>


<?php } ?>



















