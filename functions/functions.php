<?php
$con = mysqli_connect("localhost","root","","ecommerce");
if(mysqli_connect_errno()) 
{
	echo "Failed to connect MySQL:".mysqli_connect_errno();
}


//for add to cart
function cart() {
	if(isset($_GET['add_cart']) && (isset($_SESSION['customer_email']))) {
		global $con;
		$product_id=$_GET['add_cart'];
		$email=$_SESSION['customer_email'];
		$get_pro = "select * from products where products_id='$product_id'";
		$run_pro = mysqli_query($con, $get_pro);
		$row_pro=mysqli_fetch_array($run_pro);
		$pro_price=$row_pro['products_price'];
		$quantity=1;
		$insert_product_cart="insert into cart (p_id,customer_email,qty,price) values ('$product_id','$email','$quantity','$pro_price')";
		$run_product_cart = mysqli_query($con, $insert_product_cart);
		if($run_product_cart) {
			echo"<script>alert('Your Item Has been Added To Cart!')</script>";
			echo"<script>window.open('all_products.php','_self')</script>";
		}
	}
	if(isset($_GET['add_cart']) && (!isset($_SESSION['customer_email']))) {
		echo"<script>alert('Please login to your account for shopping cart!!!')</script>";
		echo"<script>window.open('customer_login.php','_self')</script>";
	}	
}   


//for showing user cart list
function getUserOwnCart(){
		

} 



//for total no of ADS
function total_items() {
	global $con;
	$get_items="select * from products";
	$run_items=mysqli_query($con,$get_items);
	$count_items=mysqli_num_rows($run_items);
	echo $count_items;

}
//for total no of users
function total_users() {
	global $con;
	$get_items="select * from customers";
	$run_items=mysqli_query($con,$get_items);
	$count_items=mysqli_num_rows($run_items);
	echo $count_items;
}
//for total no of cats
function total_cats() {
	global $con;
	$get_items="select * from categories";
	$run_items=mysqli_query($con,$get_items);
	$count_items=mysqli_num_rows($run_items);
	echo $count_items;
}
//for total no of brands
function total_brands() {
	global $con;
	$get_items="select * from brands";
	$run_items=mysqli_query($con,$get_items);
	$count_items=mysqli_num_rows($run_items);
	echo $count_items;

}


//for showing login user profile pic and his name
function user_profile_pic_name() {
	global $con;
	$user=$_SESSION['customer_email'];
	$get_img="select * from customers where customer_email='$user'";
	$run_img=mysqli_query($con,$get_img);
	$row_img=mysqli_fetch_array($run_img);
	$c_image=$row_img['customer_image'];
	$c_name=$row_img['customer_name'];
	//if user has no profile pic then doing this task
	if (empty($c_image)) {
		echo "<a href='customer/my_account.php' id='profile_pic_link'><img src='customer/customer_images/makdia.png' style='width:30px;height:30px;'/> $c_name</a>";
	}
	//if user has profile pic then doing this task
	else { 
		echo "<a href='customer/my_account.php' id='profile_pic_link'><img src='customer/customer_images/$c_image' style='width:30px;height:30px;'/> $c_name</a>";
	}
}

//for showing user profile pic and his name and login and logout option in my_account.php
function user_profile_pic_name_login_logout() {
    global $con;
	$user=$_SESSION['customer_email'];
	$get_img="select * from customers where customer_email='$user'";
	$run_img=mysqli_query($con,$get_img);
	$row_img=mysqli_fetch_array($run_img);
	$c_image=$row_img['customer_image'];
	$c_name=$row_img['customer_name'];	
	if (empty($c_image)) {
		echo "<a href='my_account.php' id='profile_pic_link'><img src='customer_images/makdia.png' style='width:30px;height:30px;'/> $c_name</a>";
	}
	else { 
		echo "<a href='my_account.php' id='profile_pic_link'><img src='customer_images/$c_image' style='width:30px;height:30px;'/> $c_name</a>";
	}
	if(!isset($_SESSION['customer_email'])) {
		echo "<a href='../customer_login.php'>Login</a>";
	}
	else {
		echo "<a href='logout.php'>Logout</a>";
	}
}




//for all categories title and all of the types of these categories
function get_cat_get_type() {
	global $con;
	$get_cats = "select * from categories";
	$run_cats = mysqli_query($con,$get_cats);
	while($row_cats=mysqli_fetch_array($run_cats)) {
		$cat_id = $row_cats['cat_id'];
		$cat_title = $row_cats['cat_title'];
    echo "<div id='category_title'>$cat_title</div>";
	$get_brand_pro = "select * from brands where cat_id='$cat_id'";
	$run_brand_pro = mysqli_query($con,$get_brand_pro);
	while($row_brand_pro=mysqli_fetch_array($run_brand_pro)) {
	$brand_id=$row_brand_pro['brand_id'];		
	$brand_title=$row_brand_pro['brand_title'];
	echo "<ul id='cat_type'><li><a href='test.php?brand=$brand_id'>$brand_title</a></li></ul>";
	}
	} 
}
//for showing some of the ADS of all users that means limited ADS showing
function getPro() {
	if(!isset($_GET['cat'])) {
		if(!isset($_GET['brand'])) {
			global $con;
			$get_pro = "select * from products order by RAND() LIMIT 0,8";
			$run_pro = mysqli_query($con, $get_pro);
			while($row_pro=mysqli_fetch_array($run_pro)) {
				$pro_id=$row_pro['products_id'];	
				$pro_cat=$row_pro['products_cat'];
				$pro_brand=$row_pro['products_brand'];	
				$pro_title=$row_pro['products_title'];
				$pro_price=$row_pro['products_price'];	
				$pro_image=$row_pro['products_image'];
				echo "<div id='single_product'  class='well well-lg'>
				<h4>$pro_title</h4>
				<a href='admin_area/product_images/$pro_image' class='thumbnail'>
				<img src='admin_area/product_images/$pro_image' class='img-rounded' style='width:220px;height:180px;'/></a>
				<p><b>Price:$pro_price</b></p>
				<a class='thumbnail' href='details.php?pro_id=$pro_id' style='float:center;color:#FFA62F;font-weight:bolder;text-decoration:none;'>See Details</a>
				<a class='thumbnail' href='index.php?add_cart=$pro_id' style='float:center;color:#FFA62F;font-weight:bolder;text-decoration:none;margin-top:0px;'>Add to cart</a>
				</div>";	
		   }
		}
	}
}

//for showing all of the ADS of all users that means not limited ADS showing
function getAllPro() {
	if(!isset($_GET['cat'])) {
		if(!isset($_GET['brand'])) {
			global $con;
			$get_pro = "select * from products order by RAND()";
			$run_pro = mysqli_query($con, $get_pro);
			while($row_pro=mysqli_fetch_array($run_pro)) {
				$pro_id=$row_pro['products_id'];	
				$pro_cat=$row_pro['products_cat'];
				$pro_brand=$row_pro['products_brand'];	
				$pro_title=$row_pro['products_title'];
				$pro_price=$row_pro['products_price'];	
				$pro_image=$row_pro['products_image'];
				echo "<div id='single_product'  class='well well-lg'>
				<h4>$pro_title</h4>
				 <a href='admin_area/product_images/$pro_image' class='thumbnail'>
				<img src='admin_area/product_images/$pro_image' class='img-rounded' style='width:220px;height:180px;'/></a>
				<p><b>Price:$pro_price</b></p>
				<a class='thumbnail' href='details.php?pro_id=$pro_id' style='float:center;color:#FFA62F;font-weight:bolder;text-decoration:none;'>See Details</a>
				<a class='thumbnail' href='all_products.php?add_cart=$pro_id' style='float:center;color:#FFA62F;font-weight:bolder;text-decoration:none;margin-top:0px;'>Add to cart</a>
				</div>";	
			}
		}
	}
}

//for showing specific Users All ADS in my_account.php
function getUserOwnProduct() {
	global $con;
	$email=$_SESSION['customer_email'];
	$get_pro="select * from products where products_email='$email'";
	$run_pro=mysqli_query($con,$get_pro);
	while($row_pro=mysqli_fetch_array($run_pro)) {
	$pro_id=$row_pro['products_id'];	
	$pro_title=$row_pro['products_title'];	
	$pro_image=$row_pro['products_image'];	
	$pro_price=$row_pro['products_price'];	
	echo "<div id='single_product'  class='well well-lg'>
	<h4>$pro_title</h4>
	<a href='../admin_area/product_images/$pro_image' class='thumbnail'>
	<img src='../admin_area/product_images/$pro_image' class='img-rounded' style='width:220px;height:180px;'/></a>
	<p><b>Price:$pro_price</b></p>
	<a class='thumbnail' href='my_account.php?edit_pro=$pro_id;' style='float:left;color:#1E90FF;font-weight:bolder;text-decoration:none;'>Edit</a>
	<a class='thumbnail' href='delete_products.php?delete_pro=$pro_id;' style='float:right;color:#1E90FF;font-weight:bolder;text-decoration:none;'>Delete</a>
	</div>";		
	}
}

//for showing specific categories ADS which category is selected by users
function getCatPro() {
	if(isset($_GET['cat'])) {
		$cat_id=$_GET['cat'];	
		global $con;
		$get_cat_pro = "select * from products where products_cat='$cat_id'";
		$run_cat_pro = mysqli_query($con, $get_cat_pro);
		$count_cat_pro=mysqli_num_rows($run_cat_pro);
		if($count_cat_pro==0) {
			echo "<h2 style='padding:20px'>No ads available in this category!!!</h2>";
		}
		while($row_cat_pro=mysqli_fetch_array($run_cat_pro)) {
			$pro_id=$row_cat_pro['products_id'];	
			$pro_cat=$row_cat_pro['products_cat'];
			$pro_brand=$row_cat_pro['products_brand'];	
			$pro_title=$row_cat_pro['products_title'];
			$pro_price=$row_cat_pro['products_price'];	
			$pro_image=$row_cat_pro['products_image'];
			echo "<div id='single_product'  class='well well-lg'>
			<h4>$pro_title</h4>
			 <a href='admin_area/product_images/$pro_image' class='thumbnail'>
			<img src='admin_area/product_images/$pro_image' class='img-rounded' style='width:220px;height:180px;'/></a>
			<p><b>Price:$pro_price</b></p>
			<a class='thumbnail' href='details.php?pro_id=$pro_id' style='float:center;color:#FFA62F;font-weight:bolder;text-decoration:none;'>See Details</a>
			</div>";		
		}
	}
}	


//for showing specific types ADS which types is selected by users
function getBrandPro() {
	if(isset($_GET['brand'])) {
		$brand_id=$_GET['brand'];	
		global $con;
		$get_brand_pro = "select * from products where products_brand='$brand_id'";
		$run_brand_pro = mysqli_query($con, $get_brand_pro);
		$count_brand_pro=mysqli_num_rows($run_brand_pro);
		if($count_brand_pro==0) {
			echo "<h2 style='padding:20px'>No ads available in this types!!!</h2>";
		}
		while($row_brand_pro=mysqli_fetch_array($run_brand_pro)) {
			$pro_id=$row_brand_pro['products_id'];	
			$pro_cat=$row_brand_pro['products_cat'];
			$pro_brand=$row_brand_pro['products_brand'];	
			$pro_title=$row_brand_pro['products_title'];
			$pro_price=$row_brand_pro['products_price'];	
			$pro_image=$row_brand_pro['products_image'];
			echo "<div id='single_product'  class='well well-lg'>
			<h4>$pro_title</h4>
			 <a href='admin_area/product_images/$pro_image' class='thumbnail'>
			<img src='admin_area/product_images/$pro_image' class='img-rounded' style='width:220px;height:180px;'/></a>
			<p><b>Price:$pro_price</b></p>
			<a class='thumbnail' href='details.php?pro_id=$pro_id' style='float:center;color:#FFA62F;font-weight:bolder;text-decoration:none;'>See Details</a>
			</div>";	
		}
	}
}


//this function shows all of the ads of a specific user by using his user_email
function getUser() {
	if(isset($_GET['user_email'])) {
		if(!isset($_GET['cat'])) {
			if(!isset($_GET['brand'])) {
				global $con;
				$user_email=$_GET['user_email'];
				$get_pro = "select * from products where  products_email='$user_email'";
				$run_pro = mysqli_query($con, $get_pro);
				while($row_pro=mysqli_fetch_array($run_pro)) {
					$pro_id=$row_pro['products_id'];	
					$pro_cat=$row_pro['products_cat'];
					$pro_brand=$row_pro['products_brand'];	
					$pro_title=$row_pro['products_title'];
					$pro_price=$row_pro['products_price'];	
					$pro_image=$row_pro['products_image'];
					echo "<div id='single_product'  class='well well-lg'>
					<h4>$pro_title</h4>
					 <a href='admin_area/product_images/$pro_image' class='thumbnail'>
					<img src='admin_area/product_images/$pro_image' class='img-rounded' style='width:220px;height:180px;'/></a>
					<p><b>Price:$pro_price</b></p>
					<a class='thumbnail' href='details.php?pro_id=$pro_id' style='float:center;color:#FFA62F;font-weight:bolder;text-decoration:none;'>See Details</a>
					</div>";
				}
			}
		}
	}		
}


//for counting new users
function user_date(){
	$pre_d=strtotime("-5 Days");
    $d=date("Y-m-d", $pre_d);
    global $con;
	$get_user_date="select * from customers where customer_date>'$d'";
	$run_date=mysqli_query($con,$get_user_date);
    $count_user=mysqli_num_rows($run_date);
	echo $count_user;
}
//for counting new categories
function cat_date(){
    $pre_d=strtotime("-5 Days");
    $d=date("Y/m/d", $pre_d);
    global $con;
	$get_cat_date="select * from categories where cat_date>'$d'";
	$run_date=mysqli_query($con,$get_cat_date);
    $count_cat=mysqli_num_rows($run_date);
	echo $count_cat;
}
//for counting new types
function type_date(){
    $pre_d=strtotime("-5 Days");
    $d=date("Y/m/d", $pre_d);
    global $con;
	$get_type_date="select * from brands where type_date>'$d'";
	$run_date=mysqli_query($con,$get_type_date);
    $count_type=mysqli_num_rows($run_date);
	echo $count_type;
}
//for counting new ads
function ads_date(){
    $pre_d=strtotime("-5 Days");
    $d=date("Y/m/d", $pre_d);
    global $con;
	$get_ads_date="select * from products where products_date>'$d'";
	$run_date=mysqli_query($con,$get_ads_date);
    $count_ads=mysqli_num_rows($run_date);
	echo $count_ads;
}
?>