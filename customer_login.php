<?php
session_start();
include("includes/db.php");
include("functions/functions.php");
$nameE=$emailE=$passwordE=$countryE=$cityE=$contactE=$addressE="";
$c_name=$c_email=$c_pass=$c_country=$c_city=$c_contact=$c_address="";
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
				    <form>
				    	<input type="text" value="Search for Products" onfocus="this.value = '';" onblur="if (this.value == '') {this.value = 'Search for Products';}"><input type="submit" value="SEARCH">
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


<?php
if(isset($_POST['login'])) {
	$c_email=$_POST['email'];
	$c_pass=$_POST['pass'];	
	$sel_c="select * from customers where customer_email='$c_email' AND customer_pass='$c_pass'";
	$run_c=mysqli_query($con,$sel_c);
	$check_customer=mysqli_num_rows($run_c);
	if($check_customer==0) {
		echo "<script>alert('Your Email or Password is incorrect,please try again!!')</script>";	
		//exit();
	}
	else
	if($check_customer>0) {
		$_SESSION['customer_email']=$c_email;
		echo "<script>alert('You logged in successfully!!')</script>";	
		echo "<script>window.open('customer/my_account.php','_self')</script>";	
	}
}
?>




<div class="main">
    <div class="content">
    	<div class="login_panel">
        	<h3>Existing Customers</h3>
        	<p class="note">To view your shopping cart and account details, please Sign in to your account with the form below.</p>
        	<form action="" method="post" id="member" enctype="multipart/form-data">
                	<input name="email" type="text" value="<?php echo $c_email;?>" placeholder="Username" class="field">
                    <input name="pass" type="password" value="<?php echo $c_pass;?>"  placeholder="Password" class="field">
                 
                 <!--<p class="note">If you forgot your passoword just enter your email and click <a href="#">here</a></p>-->
                    <div class="buttons"><div><button class="grey" name="login">Sign In</button></div></div>
			</form>
        </div>
		
		
<?php
if(isset($_POST['register'])) {
	$c_name=$_POST['c_name'];	
	$c_email=$_POST['c_email'];
	$c_pass=$_POST['c_pass'];
	$c_country=$_POST['c_country'];	
	$c_city=$_POST['c_city'];	
	$c_contact=$_POST['c_contact'];	
	$c_address=$_POST['c_address'];
	$d=date("Y/m/d");
	$word=str_word_count($c_address);

          if (!preg_match("/^(?=.*[A-Za-z ])[A-Za-z ]{4,}$/",$c_name)) {
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
		   if (!preg_match("/^(?=.*\d)[\d]{10,}$/",$c_contact)) {
			  $contactE = "Your contact must be at least 10";
		  }
		  else{}
		  
		 if ($word<3) {
			   $addressE = "Address must be at least 3 words";
		  }
	     else{}

           if ((preg_match("/^(?=.*[A-Za-z ])[A-Za-z ]{4,}$/",$c_name)) && (preg_match("/^(?=.*[A-Za-z])(?=.*\d)[A-Za-z\d]{8,}$/",$c_pass))&& (filter_var($c_email, FILTER_VALIDATE_EMAIL)) && (preg_match("/^(?=.*[A-Za-z])[A-Za-z]{2,}$/",$c_country)) && (preg_match("/^(?=.*[A-Za-z])[A-Za-z]{4,}$/",$c_city)) && (preg_match("/^(?=.*\d)[\d]{10,}$/",$c_contact))  && ($word>=3)) {
                   $check_customer_email="select * from customers where customer_email='$c_email'";
                   $run_customer_email=mysqli_query($con,$check_customer_email);
                   $count_customer_email=mysqli_num_rows($run_customer_email);
	                       if($count_customer_email==0) {
                                  $insert_c="insert into customers (customer_name,customer_email,customer_pass,customer_country,customer_city,customer_contact,customer_address,customer_date)
                                             values ('$c_name','$c_email','$c_pass','$c_country','$c_city','$c_contact','$c_address','$d')";
                                  $run_c=mysqli_query($con,$insert_c);

                                  $_SESSION['customer_email']=$c_email;
                                  echo "<script>alert('Account has been created successfully!!')</script>";	
                                  echo "<script>window.open('customer/my_account.php','_self')</script>";	
		
	                        }
	                       else {
	                              echo "<script>alert('Please Enter Another Email.This Email Already have Another User!!')</script>";	
                                  //echo "<script>window.open('customer_register.php','_self')</script>";		
		
	                        }
            }
    }
?>
		<div class="register_account">
    		<h3>Register New Account</h3>
    		<form action="" method="post"  enctype="multipart/form-data">
		   			 <table>
		   				<tbody>
						<tr>
						<td>
							<div>
							<input type="text"  name="c_name" value="<?php echo $c_name;?>" placeholder="Name">
							<span class="error"><?php echo $nameE;?></span><br>
							</div>
							
							<div>
							   <input type="text" value="<?php echo $c_email;?>" placeholder="E-Mail" name="c_email">
							   <span class="error"><?php echo $emailE;?></span><br>
							</div>
							
							<div>
								<input type="text" value="<?php echo $c_pass;?>" placeholder="Password" name="c_pass">
								<span class="error"><?php echo $passwordE;?></span><br>
							</div>
							<div>
								<input type="text" value="<?php echo $c_country;?>" placeholder="Country" name="c_country">
								<span class="error"><?php echo $countryE;?></span><br>
							</div>
		    			 </td>
		    			<td>
						<div>
							<input type="text" value="<?php echo $c_city;?>" placeholder="City" name="c_city">
							<span class="error"><?php echo $cityE;?></span><br>
						</div>
		    	  <div>
		          <input type="text" value="<?php echo $c_contact;?>" placeholder="Phone" name="c_contact">
				  <span class="error"><?php echo $contactE;?></span><br>
		          </div>
				  <div>
					<input type="text" value="<?php echo $c_address;?>" placeholder="Address" name="c_address">
					<span class="error"><?php echo $addressE;?></span><br>
				</div>
		    	</td>
		    </tr> 
		    </tbody></table> 
		   <div class="search"><div><button class="grey" name="register">Create Account</button></div></div>
		    <div class="clear"></div>
		    </form>
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

