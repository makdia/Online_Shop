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




	<div style="height:60px;background:#103D5F;">
		<div class="grid_12">
			<ul class="nav main">
				<li class="ic-dashboard"><a href="my_account.php?change_profile_pic"><span>Change Profile Picture</span></a> </li>
				<li class="ic-form-style"><a href="my_account.php?edit_account"><span>Edit Profile</span></a></li>
				<li class="ic-typography"><a href="my_account.php?change_pass"><span>Change Password</span></a></li>
				<li class="ic-grid-tables"><a href="my_account.php?your_info"><span>Your Info</span></a></li>
				<li class="ic-charts"><a href="my_account.php?delete_account" onclick="return checkDelete()"><span>Delete Account</span></a></li>	
			</ul>
		</div>
		<div class="clear">
		</div>
	</div>
    

<div class="main">
    <div class="content">
    	<div class="cartoption">		
			<div class="cartpage">
					<?php
						if(isset($_GET['change_profile_pic'])) {
							include("change_profile_pic.php");
						}
						else if(isset($_GET['edit_account'])) {
							include("edit_account.php");
						}
						else if(isset($_GET['change_pass'])) { 
							include("change_pass.php");
						}
						else if(isset($_GET['your_info'])) { 
							include("your_info.php");
						}
						else if(isset($_GET['delete_account'])) {
							include("delete_account.php");
						}
						?>
			</div>	
					<?php
						if ((!isset($_GET['edit_pro'])) && (!isset($_GET['change_profile_pic'])) &&  (!isset($_GET['edit_account'])) && (!isset($_GET['change_pass'])) && (!isset($_GET['your_info'])) && (!isset($_GET['delete_account']))) 
							{ ?> 
					<div class="cartpage">
						<h2>Your Cart</h2>
							<?php	$total=0;
								global $con;
								$email=$_SESSION['customer_email'];
								$check_pro = "select * from cart where customer_email='$email'";
								$run_check = mysqli_query($con, $check_pro);
								if(mysqli_num_rows($run_check)==0) {
									echo "<h3 style='font:italic bold 20px Georgia, serif;font-size: 0.8em;padding-top:20px;margin-left:400px;float:center;'>You have no item in your cart!!!</h3>";
								} 
								else { ?>
						<table class="tblone">
							<tr>
								<th width="5%">S.N.</th>
								<th width="20%">Product Name</th>
								<th width="10%">Image</th>
								<th width="15%">Price</th>
								<th width="25%">Quantity</th>
								<th width="15%">Total Price</th>
								<th width="10%">Action</th>
							</tr>
									
							            <?php 
											$i=0;
											while($row_check=mysqli_fetch_array($run_check)) {
												$cart_id=$row_check['p_id'];	
												$customer_email=$row_check['customer_email'];	
												$cart_qty=$row_check['qty'];
												$cart_pro_price=$row_check['price'];		
												$get_pro="select * from products where products_id='$cart_id'";
												$run_pro=mysqli_query($con,$get_pro);
												while($row_pro=mysqli_fetch_array($run_pro)) {	
													$pro_title=$row_pro['products_title'];	
													$pro_image=$row_pro['products_image'];	
													$pro_exact_price=$row_pro['products_price'];	
													$total+=$cart_pro_price;
													$i++;?>
													<tr>
													<td><?php echo $i; ?></td>
													<td><?php echo $pro_title; ?></td>
													<td><img src="../admin_area/product_images/<?php echo $pro_image;?>" /></td>
													<td>Tk. <?php echo $pro_exact_price; ?></td>
													<td>
													<form action="" method="post" enctype="multipart/form-data">
														<input type="number" name="qty" value="<?php echo $cart_qty;?>"/>
														<button class="buysubmit" type="submit" name="update_cart" value="<?php echo $cart_id;?>" style="padding: 3px 5px;">Update</button>
													</form>
													</td>
														<?php 
															if(isset($_POST['update_cart'])) {
																$cart_id=$_POST['update_cart'];
																$qty=$_POST['qty'];
																$total=$total*$qty;
																$check_price = "select * from products where products_id='$cart_id'";
																$run_check_price = mysqli_query($con, $check_price);
																$row_check_price=mysqli_fetch_array($run_check_price);
																$new_price=$row_check_price['products_price'];
																$new_price=$new_price*$qty;
																$update_cart_qty="update cart set qty='$qty',price='$new_price' where p_id='$cart_id' AND customer_email='$customer_email'";
																$run_cart_qty=mysqli_query($con,$update_cart_qty);
																//$update_order_qty="update product_order set qty='$qty',price='$new_price' where p_id='$cart_id' AND customer_email='$customer_email'";
																//$run_order_qty=mysqli_query($con,$update_order_qty);
																if($run_cart_qty) {
																		echo"<script>alert('Your Quantity Has been Updated Successfully!!!')</script>";
																		echo "<script>window.open('my_account.php','_self')</script>";
																}
															} ?>
															<td>Tk. <?php echo $cart_pro_price; ?></td>
															<td><?php echo"<a href='my_account.php?delete=$cart_id'>X</a>"?></td>
															</tr>
											  <?php } 
										    } ?>
						</table>
						<table style="float:right;text-align:left;" width="40%">
							<tr>
								<th>Sub Total : </th>
								<td>TK.<?php echo $total; ?></td>
							</tr>
						</table>
					<?php   } ?> 
					</div>
					<div class="shopping">
						<div class="shopleft">
							<a href="../all_products.php"> <img src="../images/shop.png" alt="" /></a>
						</div>
						<div class="shopright">
							<a href="my_account.php?payment"> <img src="../images/check.png" alt="" /></a>
						</div>
					</div>
					<?php	} ?>
		</div>  	
       <div class="clear"></div>
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
					   		  <ul><li class="facebook"><a href="https://www.facebook.com" target="_blank"> </a></li>
							      <li class="twitter"><a href="https://www.twitter.com" target="_blank"> </a></li>
							      <li class="googleplus"><a href="https://www.plus.google.com" target="_blank"> </a></li>
							      <li class="contact"><a href="https://www.gmail.com" target="_blank"> </a></li>
							      <div class="clear"></div>
						     </ul>
   	 					</div>
				</div>
			</div>
			<div class="copy_right">
				<p>All rights Reseverd to Makdia Hussain</p>
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
	$user=$_SESSION['customer_email'];
	global $con;
	if(isset($_GET['payment'])) {
		$get_pro = "select * from cart where customer_email='$user'";
		$run_pro = mysqli_query($con, $get_pro);
		if(mysqli_num_rows($run_pro)==0) {
			echo"<script>alert('You have no item in your cart!!!')</script>";
			echo "<script>window.open('my_account.php','_self')</script>";
		} 
		else { 
		while($row_pro=mysqli_fetch_array($run_pro)){
			$cart_id=$row_pro['p_id'];	
			$cart_qty=$row_pro['qty'];
			$cart_pro_price=$row_pro['price'];
			$insert_product_order="insert into product_order (p_id,customer_email,qty,price) values ('$cart_id','$user','$cart_qty','$cart_pro_price')";
			$run_product_order = mysqli_query($con, $insert_product_order);
		}	
		$delete_cart_item="delete from cart where customer_email='$user'";
		$run_delete=mysqli_query($con,$delete_cart_item);
		if($run_delete) {
			echo"<script>alert('Your Payment Has been completed Successfully!!!')</script>";
			echo "<script>window.open('my_account.php','_self')</script>";
		 }
	  }
	
}
?>



<?php
	$user=$_SESSION['customer_email'];
	global $con;
	if(isset($_GET['delete'])) {
			$delete_id=$_GET['delete']; 
			$delete_product="delete from cart where p_id='$delete_id' AND customer_email='$user'";
			$run_delete=mysqli_query($con,$delete_product);
			$delete_product_order="delete from product_order where p_id='$delete_id' AND customer_email='$user'";
			$run_delete_order=mysqli_query($con,$delete_product_order);
			if($run_delete_order) {
				echo"<script>alert('Item Has been deleted Successfully from the cart!!!')</script>";
				echo "<script>window.open('my_account.php','_self')</script>";
			}
		}
?>



<?php } ?>







