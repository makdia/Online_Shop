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
if(isset($_GET['edit_pro'])) {
	$get_id=$_GET['edit_pro'];
	$get_pro="select * from products where products_id='$get_id'";
	$run_pro=mysqli_query($con,$get_pro);
	$row_pro=mysqli_fetch_array($run_pro);
	$pro_id=$row_pro['products_id'];	
	$pro_title=$row_pro['products_title'];	
	$pro_image=$row_pro['products_image'];	
	$pro_price=$row_pro['products_price'];	
	$pro_desc=$row_pro['products_desc'];	
	$pro_keywords=$row_pro['products_keywords'];	
	$pro_brand=$row_pro['products_brand'];	
	$pro_cat=$row_pro['products_cat'];	

	$get_cat = "select * from categories where cat_id='$pro_cat'";
	$run_cat = mysqli_query($con, $get_cat);
	$row_cat=mysqli_fetch_array($run_cat);
	$category_title = $row_cat['cat_title'];	
	$get_brand = "select * from brands where brand_id='$pro_brand'";		
	$run_brand = mysqli_query($con, $get_brand);
	$row_brand=mysqli_fetch_array($run_brand);		
	$brand_title = $row_brand['brand_title'];	
}
?>


<div class="grid_10">
    <div class="box round first grid">
        <h2>Update Product</h2>
        <div class="block">               
         <form action="" method="post" enctype="multipart/form-data">
            <table class="form">
               
                <tr>
                    <td>
                        <label>Name</label>
                    </td>
                    <td>
                        <input type="text" name="product_title" value="<?php echo $pro_title; ?>" class="medium" required/>
                    </td>
                </tr>
				<tr>
                    <td>
                        <label>Category</label>
                    </td>
                    <td>
						<!-- if user not given new category it takes ($pro_cat) which is the id of previous category--> 
				        <select id="select" name="product_cat" required>
                            <option value="<?php echo $pro_cat; ?>"><?php echo $category_title; ?></option>
                            <?php
								$get_cats = "select * from categories";
								$run_cats = mysqli_query($con, $get_cats);
									while($row_cats=mysqli_fetch_array($run_cats)) {
										$cat_id = $row_cats['cat_id'];
										$cat_title = $row_cats['cat_title'];
									 echo "<option value='$cat_id'>$cat_title</option>";
									}
							?>
                        </select>
                    </td>
                </tr>
				<tr>
                    <td>
                        <label>Brand</label>
                    </td>
                    <td>
						<!-- if user not given new type it takes ($pro_brand) which is the id of previous type--> 
                        <select id="select" name="product_brand" required>
							<option value="<?php echo $pro_brand; ?>"><?php echo $brand_title; ?></option>
								<?php
								$get_brands = "select * from brands";
								$run_brands = mysqli_query($con, $get_brands);
									while($row_brands=mysqli_fetch_array($run_brands)) {
										$brand_id = $row_brands['brand_id'];
										$brand_title = $row_brands['brand_title'];
									 echo "<option value='$brand_id'>$brand_title</option>";
									}
								?>
                        </select>
                    </td>
                </tr>
				
				 <tr>
                    <td style="vertical-align: top; padding-top: 9px;">
                        <label>Description</label>
                    </td>
                    <td>
                        <textarea class="tinymce" name="product_desc">
						<?php echo $pro_desc;?>
						</textarea>
                    </td>
                </tr>
				<tr>
                    <td>
                        <label>Price</label>
                    </td>
                    <td>
                        <input type="text" name="product_price" value="<?php echo $pro_price; ?>" class="medium" required/>
                    </td>
                </tr>
				<tr>
                    <td>
					</td>
					<td>
						<img src="product_images/<?php echo $pro_image;?>" width="50px" height="50px" style="float:center;"/>
					</td>
                        
                </tr>
                <tr>
                    <td>
                        <label>Upload Image</label>
                    </td>
                    <td>
						<input type="file" name="product_image"/>
                    </td>
                    
                </tr>
				
				<tr>
                    <td>
                        <label>Product Condition</label>
                    </td>
                    <td>
                       <input type="text" name="product_keywords" value="<?php echo $pro_keywords; ?>" class="medium" required/> 
                    </td>
                </tr>

				<tr>
                    <td></td>
                    <td>
                        <input type="submit" name="update_product" value="Update your product" />
                    </td>
                </tr>
            </table>
            </form>
        </div>
    </div>
</div>
<!-- Load TinyMCE -->
<script src="js/tiny-mce/jquery.tinymce.js" type="text/javascript"></script>
<script type="text/javascript">
    $(document).ready(function () {
        setupTinyMCE();
        setDatePicker('date-picker');
        $('input[type="checkbox"]').fancybutton();
        $('input[type="radio"]').fancybutton();
    });
</script>
<!-- Load TinyMCE -->
<?php include 'inc/footer.php';?>






<?php
if(isset($_POST['update_product'])) {
	$update_id=$pro_id;
	$product_title=$_POST['product_title'];	
	$product_cat=$_POST['product_cat'];
	$product_brand=$_POST['product_brand'];	
	$product_price=$_POST['product_price'];	
	$product_desc=$_POST['product_desc'];	
	$product_keywords=$_POST['product_keywords'];	
	$product_image=$_FILES['product_image']['name'];	
	$product_image_tmp=$_FILES['product_image']['tmp_name'];
	//if image file is empty then doing this task
	if(empty($product_image)) {
		$product_image=$pro_image;	
		$product_image_tmp=$_FILES['$product_image']['tmp_name'];
	}
	move_uploaded_file($product_image_tmp,"product_images/$product_image");
	$update_product="update products set products_cat='$product_cat',products_brand='$product_brand',products_title='$product_title',products_price='$product_price',products_desc='$product_desc',products_image='$product_image',products_keywords='$product_keywords' where products_id='$update_id'";	
	$run_product=mysqli_query($con,$update_product);
	if($run_product) {
		echo"<script>alert('Your Ads Has been updated successfully!')</script>";
		echo"<script>window.open('view_products.php','_self')</script>";
	}
}
}
?>


