<?php
session_start();
include("../includes/db.php"); 
include("../functions/functions.php");
if(!isset($_SESSION['customer_email'])) {
	echo"<script>window.open('../customer_login.php','_self')</script>";
}
else {
?>

<!DOCTYPE HTML>
<head>

<!--delete confirmation function-->
<script language="JavaScript" type="text/javascript">
function checkDelete(){
    return confirm('Are you sure you want to delete your account?');
}
</script>


<title>Store Website</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
<link href="../css/style.css" rel="stylesheet" type="text/css" media="all"/>
<link href="../css/menu.css" rel="stylesheet" type="text/css" media="all"/>
<link href="../css/custom.css" rel="stylesheet" type="text/css" media="all"/>


<!--<link rel="stylesheet" type="text/css" href="../admin_area/css/reset.css" media="screen" />
    <link rel="stylesheet" type="text/css" href="../admin_area/css/text.css" media="screen" />
    <link rel="stylesheet" type="text/css" href="../admin_area/css/grid.css" media="screen" />
    <link rel="stylesheet" type="text/css" href="../admin_area/css/layout.css" media="screen" />
	<link href="../admin_area/css/table/demo_page.css" rel="stylesheet" type="text/css" />-->
    <link rel="stylesheet" type="text/css" href="../admin_area/css/usernav.css" media="screen" />
	
	

<script src="../js/jquerymain.js"></script>
<script src="../js/script.js" type="text/javascript"></script>
<script type="text/javascript" src="../js/jquery-1.7.2.min.js"></script> 
<script type="text/javascript" src="../js/nav.js"></script>
<script type="text/javascript" src="../js/move-top.js"></script>
<script type="text/javascript" src="../js/easing.js"></script> 
<script type="text/javascript" src="../js/nav-hover.js"></script>
<link href='http://fonts.googleapis.com/css?family=Monda' rel='stylesheet' type='text/css'>
<link href='http://fonts.googleapis.com/css?family=Doppio+One' rel='stylesheet' type='text/css'>
<script type="text/javascript">
  $(document).ready(function($){
    $('#dc_mega-menu-orange').dcMegaMenu({rowItems:'4',speed:'fast',effect:'fade'});
  });
</script>
</head>
<body>
  <div class="wrap">
		<div class="header_top">
			<div class="logo">
				<a href="../index.php"><img src="../images/logo.png" alt="" /></a>
			</div>
			  <div class="header_top_right">
			    <div class="search_box">
				    <form method="get" action="../result.php" enctype="multipart/form-data">
				    	<input type="text" name="user_query" value="Search for Products" onfocus="this.value = '';" onblur="if (this.value == '') {this.value = 'Search for Products';}"><input type="submit" name="search" value="SEARCH">
				    </form>
					
			    </div>
			    <div class="shopping_cart">
					<div class="cart">
						<a href="../all_products.php" title="View my shopping cart" rel="nofollow">
								<span class="cart_title">Total Products:</span>
								<span class="no_product">(<?php total_items();?>)</span>
							</a>
						</div>
			      </div>
		   <div class="login">
		       <?php 
				if(!isset($_SESSION['customer_email'])) {
					echo "   "."<a href='../customer_login.php'>Login</a>";
				}
				else {
					echo "   "."<a href='logout.php'>Logout</a>";
				}?>
			</div>
		 <div class="clear"></div>
	 </div>
	 <div class="clear"></div>
 </div>
<div class="menu">
	<ul id="dc_mega-menu-orange" class="dc_mm-orange">
	  <li><a href="../index.php">Home</a></li>
	  <li><a href="../all_products.php">All Ads</a></li>
	  <li><a href="my_account.php">My Account</a></li>
	  <li> 
		<?php 
			if(!isset($_SESSION['customer_email'])) {
				echo "   "."<a href='../customer_login.php'>Shopping Cart</a>";
			}
			else {
				echo "   "."<a href='my_account.php?insert_product'>Shopping Cart</a>";
			}?>
	  </li>
	  <li class="dropdown"><a class="dropdown-toggle" data-toggle="dropdown" href="#">Categories<span class="caret"></span></a>
        <ul class="dropdown-menu">
		<?php global $con;
			$get_cats = "select * from categories";
			$run_cats = mysqli_query($con,$get_cats);
			while($row_cats=mysqli_fetch_array($run_cats)) {
				$cat_id = $row_cats['cat_id'];
				$cat_title = $row_cats['cat_title'];
			echo "<li><a href='../test.php?cat=$cat_id'>$cat_title</a></li>";
			} ?>
        </ul>
      </li>
	  <li class="dropdown"><a class="dropdown-toggle" data-toggle="dropdown" href="#">Brands<span class="caret"></span></a>
        <ul class="dropdown-menu">
		<?php 
			$get_brand_pro = "select * from brands";
			$run_brand_pro = mysqli_query($con,$get_brand_pro);
			while($row_brand_pro=mysqli_fetch_array($run_brand_pro)) {
				$brand_id=$row_brand_pro['brand_id'];		
				$brand_title=$row_brand_pro['brand_title'];
				echo "<li><a href='../test.php?brand=$brand_id'>$brand_title</a></li>";
			}
		?>
		</ul>
      </li>
	  <li><a href="contact.php">Contact</a></li>
	<div class="clear"></div>
	</ul>	
</div>

				
 <div class="main">
    <div class="content">
    	<div class="support">
  			<div class="support_desc">
  				<h3>Live Support</h3>
  				<p><span>24 hours | 7 days a week | 365 days a year &nbsp;&nbsp; Live Technical Support</span></p>
  				<p> It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters.There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which don't look even slightly believable. If you are going to use a passage of Lorem Ipsum, you need to be sure there isn't anything embarrassing hidden in the middle of text.</p>
  			</div>
  				<img src="web/images/contact.png" alt="" />
  			<div class="clear"></div>
  		</div>
    	<div class="section group">
				<div class="col span_2_of_3">
				  <div class="contact-form">
				  	<h2>Contact Us</h2>
					    <form method="post" action="" enctype="multipart/form-data">
					    	<div>
						    	<span><label>NAME</label></span>
						    	<span><input type="text" value="" name="name" required></span>
						    </div>
						    <div>
						    	<span><label>E-MAIL</label></span>
						    	<span><input type="text" value="" name="email" required></span>
						    </div>
						    <div>
						     	<span><label>MOBILE.NO</label></span>
						    	<span><input type="text" value="" name="mobile" required></span>
						    </div>
						    <div>
						    	<span><label>SUBJECT</label></span>
						    	<span><textarea name="subject" required> </textarea></span>
						    </div>
						   <div>
						   		<span><input type="submit" value="SUBMIT" name="submit"></span>
						  </div>
					    </form>
				  </div>
  				</div>
				<div class="col span_1_of_3">
      			<div class="company_address">
				     	<h2>Company Information :</h2>
						    	<p>500 Lorem Ipsum Dolor Sit,</p>
						   		<p>22-56-2-9 Sit Amet, Lorem,</p>
						   		<p>USA</p>
				   		<p>Phone:(00) 222 666 444</p>
				   		<p>Fax: (000) 000 00 00 0</p>
				 	 	<p>Email: <span>info@mycompany.com</span></p>
				   		<p>Follow on: <span>Facebook</span>, <span>Twitter</span></p>
				   </div>
				 </div>
			  </div>    	
    </div>
 </div>
</div>
   <div class="footer">
   	  <div class="wrapper">	
	     <div class="section group">
				<div class="col_1_of_4 span_1_of_4">
						<h4>Information</h4>
						<ul>
						<li><a href="#">About Us</a></li>
						<li><a href="#">Customer Service</a></li>
						<li><a href="#"><span>Advanced Search</span></a></li>
						<li><a href="#">Orders and Returns</a></li>
						<li><a href="#"><span>Contact Us</span></a></li>
						</ul>
					</div>
				<div class="col_1_of_4 span_1_of_4">
					<h4>Why buy from us</h4>
						<ul>
						<li><a href="about.html">About Us</a></li>
						<li><a href="faq.html">Customer Service</a></li>
						<li><a href="#">Privacy Policy</a></li>
						<li><a href="contact.html"><span>Site Map</span></a></li>
						<li><a href="preview-2.html"><span>Search Terms</span></a></li>
						</ul>
				</div>
				<div class="col_1_of_4 span_1_of_4">
					<h4>My account</h4>
						<ul>
							<li><a href="contact.html">Sign In</a></li>
							<li><a href="index.html">View Cart</a></li>
							<li><a href="#">My Wishlist</a></li>
							<li><a href="#">Track My Order</a></li>
							<li><a href="faq.html">Help</a></li>
						</ul>
				</div>
				<div class="col_1_of_4 span_1_of_4">
					<h4>Contact</h4>
						<ul>
							<li><span>+91-123-456789</span></li>
							<li><span>+00-123-000000</span></li>
						</ul>
						<div class="social-icons">
							<h4>Follow Us</h4>
					   		  <ul>
							      <li class="facebook"><a href="#" target="_blank"> </a></li>
							      <li class="twitter"><a href="#" target="_blank"> </a></li>
							      <li class="googleplus"><a href="#" target="_blank"> </a></li>
							      <li class="contact"><a href="#" target="_blank"> </a></li>
							      <div class="clear"></div>
						     </ul>
   	 					</div>
				</div>
			</div>
			<div class="copy_right">
				<p>Store Online BD &amp; All rights Reseverd</p>
		   </div>
     </div>
    </div>
    <script type="text/javascript">
		$(document).ready(function() {
			/*
			var defaults = {
	  			containerID: 'toTop', // fading element id
				containerHoverID: 'toTopHover', // fading element hover id
				scrollSpeed: 1200,
				easingType: 'linear' 
	 		};
			*/
			
			$().UItoTop({ easingType: 'easeOutQuart' });
			
		});
	</script>
    <a href="#" id="toTop" style="display: block;"><span id="toTopHover" style="opacity: 1;"></span></a>
</body>
</html>


<?php
if(isset($_POST['submit'])) {
	$name=$_POST['name'];	
	$email=$_POST['email'];
	$mobile=$_POST['mobile'];	
	$subject=$_POST['subject'];	
	$customer_email=$_SESSION['customer_email'];
	$insert_message="insert into message(name,email,phone,subject,customer_email)values('$name','$email','$mobile','$subject','$customer_email')";	
	$insert_txt=mysqli_query($con,$insert_message);
	if($insert_txt) {
		echo"<script>alert('Your message Has been sent!')</script>";
		echo"<script>window.open('my_account.php','_self')</script>";
	}
}
?>
<?php } ?>