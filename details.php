<?php
session_start();
include("includes/db.php");
include("functions/functions.php");
?>
<!DOCTYPE HTML>
<head>
<title>Store Website</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
<link href="css/style.css" rel="stylesheet" type="text/css" media="all"/>
<link href="css/menu.css" rel="stylesheet" type="text/css" media="all"/>
<script src="js/jquerymain.js"></script>
<script src="js/script.js" type="text/javascript"></script>
<script type="text/javascript" src="js/jquery-1.7.2.min.js"></script> 
<script type="text/javascript" src="js/nav.js"></script>
<script type="text/javascript" src="js/move-top.js"></script>
<script type="text/javascript" src="js/easing.js"></script> 
<script type="text/javascript" src="js/nav-hover.js"></script>
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
				<a href="index.php"><img src="images/logo.png" alt="" /></a>
			</div>
			  <div class="header_top_right">
			    <div class="search_box">
				    <form method="get" action="result.php" enctype="multipart/form-data">
				    	<input type="text" name="user_query" value="Search for Products" onfocus="this.value = '';" onblur="if (this.value == '') {this.value = 'Search for Products';}"><input type="submit" name="search" value="SEARCH">
				    </form>
				</div>
			    <div class="shopping_cart">
					<div class="cart">
						<a href="all_products.php" title="View my shopping cart" rel="nofollow">
								<span class="cart_title">Total Products:</span>
								<span class="no_product">(<?php total_items();?>)</span>
							</a>
						</div>
			      </div>
		   <div class="login">
		       <?php 
				if(!isset($_SESSION['customer_email'])) {
					echo "   "."<a href='customer_login.php'>Login</a>";
				}
				else {
					echo "   "."<a href='customer/logout.php'>Logout</a>";
				}?>
			</div>
		 <div class="clear"></div>
	 </div>
	 <div class="clear"></div>
 </div>
<div class="menu">
	<ul id="dc_mega-menu-orange" class="dc_mm-orange">
	  <li><a href="index.php">Home</a></li>
	  <li><a href="all_products.php">All Ads</a></li>
	  <li><a href="customer/my_account.php">My Account</a></li>
	  <li> 
		<?php 
			if(!isset($_SESSION['customer_email'])) {
				echo "   "."<a href='customer_login.php'>Shopping cart</a>";
			}
			else {
				echo "   "."<a href='customer/my_account.php?insert_product'>Shopping cart</a>";
			}?>				
	  </li>
	  <li class="dropdown"><a class="dropdown-toggle" data-toggle="dropdown" href="#">Categories <span class="caret"></span></a>
        <ul class="dropdown-menu">
		<?php global $con;
			$get_cats = "select * from categories";
			$run_cats = mysqli_query($con,$get_cats);
			while($row_cats=mysqli_fetch_array($run_cats)) {
				$cat_id = $row_cats['cat_id'];
				$cat_title = $row_cats['cat_title'];
			echo "<li><a href='test.php?cat=$cat_id'>$cat_title</a></li>";
			} ?>
        </ul>
      </li>
	  <li class="dropdown"><a class="dropdown-toggle" data-toggle="dropdown" href="#">Brands <span class="caret"></span></a>
        <ul class="dropdown-menu">
		<?php 
			$get_brand_pro = "select * from brands";
			$run_brand_pro = mysqli_query($con,$get_brand_pro);
			while($row_brand_pro=mysqli_fetch_array($run_brand_pro)) {
				$brand_id=$row_brand_pro['brand_id'];		
				$brand_title=$row_brand_pro['brand_title'];
				echo "<li><a href='test.php?brand=$brand_id'>$brand_title</a></li>";
			}
		?>
		</ul>
      </li>
	  <li><a href="customer/contact.php">Contact</a></li>
	<div class="clear"></div>
    </ul>	
</div>	
				
	

<?php cart(); ?>




 <div class="main">
    <div class="content">
    	<div class="section group">
				<div class="cont-desc span_1_of_2">
					<?php
						if(isset($_GET['pro_id'])) {
							$product_id=$_GET['pro_id'];
							$get_pro = "select * from products where products_id='$product_id'";
							$run_pro = mysqli_query($con, $get_pro);
							while($row_pro=mysqli_fetch_array($run_pro)) {
								$pro_id=$row_pro['products_id'];	
								$pro_title=$row_pro['products_title'];
								$pro_price=$row_pro['products_price'];	
								$pro_image=$row_pro['products_image'];
								$pro_cat=$row_pro['products_cat'];	
								$pro_brand=$row_pro['products_brand'];
								$pro_desc=$row_pro['products_desc'];
								$pro_condition=$row_pro['products_keywords'];
								$pro_email=$row_pro['products_email'];
								$pro_seen=$row_pro['products_seen'];
								$seen_no=$pro_seen+1;
								$get_cats = "select * from categories where cat_id='$pro_cat'";
								$run_cats = mysqli_query($con,$get_cats);
								$row_cats=mysqli_fetch_array($run_cats);
								$cat_title = $row_cats['cat_title'];
								$get_brand_pro = "select * from brands where brand_id='$pro_brand'";
								$run_brand_pro = mysqli_query($con,$get_brand_pro);
								$row_brand_pro=mysqli_fetch_array($run_brand_pro);		
								$brand_title=$row_brand_pro['brand_title'];
								echo "<div class='grid images_3_of_2'>
								<img src='admin_area/product_images/$pro_image' alt='' />
								</div>
								<div class='desc span_3_of_2'>";
								echo "<p style='margin-right:15px;color:#1E90FF;font:italic bold 20px Georgia, serif;'><b>No of views: $seen_no</b></p>";
								$update_product="update products set products_seen='$seen_no' where products_id='$product_id'";	
								$run_product=mysqli_query($con,$update_product);
								echo "<h2>$pro_title</h2>
								<p>$pro_desc</p>					
								<div class='price'>
									<p>Price:$ <span>$pro_price</span></p>
									<p>Category: <span>$cat_title</span></p>
									<p>Brand:<span>$brand_title</span></p>
								</div>
								<div class='add-cart'>
								<div class='buysubmit' style='width:75px;'><span><a href='index.php?add_cart=$pro_id' style='color:#ffff;'>Add to cart</a></span></div>
								</div>";
							}
						}
						//getBrandPro();
						?>
			</div>
	</div>
	<div class="rightsidebar span_3_of_1">
		<h2>CATEGORIES</h2>
		<ul>
		<?php 
		global $con;
		$get_cats = "select * from categories";
		$run_cats = mysqli_query($con,$get_cats);
		while($row_cats=mysqli_fetch_array($run_cats)) {
			$cat_id = $row_cats['cat_id'];
			$cat_title = $row_cats['cat_title'];
		     echo "<li><a href='test.php?cat=$cat_id'>$cat_title</a></li>";
		} ?>
		</ul>
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
							<li><span>+880-1840-392204</span></li>
							<li><span>+880-1874-265983</span></li>
						</ul>
						<div class="social-icons">
							<h4>Follow Us</h4>
					   		  <ul>
							      <li class="facebook"><a href="https://www.facebook.com" target="_blank"> </a></li>
							      <li class="twitter"><a href="https://www.twitter.com" target="_blank"> </a></li>
							      <li class="googleplus"><a href="https://www.plus.google.com" target="_blank"> </a></li>
							      <li class="contact"><a href="https://www.gmail.com" target="_blank"> </a></li>
							      <div class="clear"></div>
						     </ul>
   	 					</div>
				</div>
			</div>
			<div class="copy_right">
				<p>All rights Reseverd to Makdia Hussain</a> </p>
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





					
						