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




<div class="grid_10">
    <div class="box round first grid">
        <h2>Add New Product</h2>
        <div class="block">               
         <form action="" method="post" enctype="multipart/form-data">
            <table class="form">
               
                <tr>
                    <td>
                        <label>Name</label>
                    </td>
                    <td>
                        <input type="text" name="product_title" placeholder="Enter Product Name..." class="medium" required/>
                    </td>
                </tr>
				<tr>
                    <td>
                        <label>Category</label>
                    </td>
                    <td>
				      <select id="select" name="product_cat" required>
                            <option>Select a Category</option>
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
                        <select id="select" name="product_brand" required>
                            <option>Select a Brand</option>
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
						<?php echo "Add somethings like the following:"."<br>"."Brand:"."<br>"."Features:"."<br>"."Model:"."<br>"."Authenticity:"."<br>"."Others details:";?>
						</textarea>
                    </td>
                </tr>
				<tr>
                    <td>
                        <label>Price</label>
                    </td>
                    <td>
                        <input type="text" name="product_price" placeholder="Enter Price..." class="medium" required/>
                    </td>
                </tr>
            
                <tr>
                    <td>
                        <label>Upload Image</label>
                    </td>
                    <td>
                        <input type="file" name="product_image" required/>
                    </td>
                </tr>
				
				<tr>
                    <td>
                        <label>Product Condition</label>
                    </td>
                    <td>
                       <input type="text" name="product_keywords" placeholder="Enter Product Condition..." class="medium" required/> 
                    </td>
                </tr>

				<tr>
                    <td></td>
                    <td>
                        <input type="submit" name="insert_post" Value="Post your product" />
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
if(isset($_POST['insert_post'])) {
	$product_title=$_POST['product_title'];	
	$product_cat=$_POST['product_cat'];
	$product_brand=$_POST['product_brand'];	
	$product_price=$_POST['product_price'];	
	$product_desc=$_POST['product_desc'];	
	$product_keywords=$_POST['product_keywords'];	
	$product_email=$_SESSION['customer_email'];
	$product_image=$_FILES['product_image']['name'];	
	$product_image_tmp=$_FILES['product_image']['tmp_name'];
	$d=date("Y/m/d");
	move_uploaded_file($product_image_tmp,"product_images/$product_image");
	$insert_product="insert into products(products_cat,products_brand,products_title,products_price,products_desc,products_image,products_keywords,products_email,products_date)values('$product_cat','$product_brand','$product_title','$product_price','$product_desc','$product_image','$product_keywords','$product_email','$d')";	
	$insert_pro=mysqli_query($con,$insert_product);
	if($insert_pro) {
		echo"<script>alert('Your Product Has been inserted!')</script>";
		echo"<script>window.open('view_products.php','_self')</script>";
	}
}
?>

<?php } ?>

