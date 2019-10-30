<?php
session_start();
include("../includes/db.php");
if(!isset($_SESSION['user_email'])) {
	echo"<script>window.open('login.php?not_admin=This service is only for Admin!! If you are an Admin then Logged in by using your Email and Password.','_self')</script>";
}
else {

if(isset($_GET['edit_brand'])) {
	$brand_id=$_GET['edit_brand'];
	$get_brand="select * from brands where brand_id='$brand_id'";
	$run_brand=mysqli_query($con,$get_brand);
	$row_brand=mysqli_fetch_array($run_brand);
	$brand_id=$row_brand['brand_id'];
	$brand_title=$row_brand['brand_title'];
	$brand_cat=$row_brand['cat_id'];


	$get_cat = "select * from categories where cat_id='$brand_cat'";
	$run_cat = mysqli_query($con, $get_cat);
	$row_cat=mysqli_fetch_array($run_cat);
	$category_title = $row_cat['cat_title'];	
}
?>


<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>
        <div class="grid_10">
            <div class="box round first grid">
                <h2>Update Brand</h2>
               <div class="block copyblock"> 
                 <form method="post" action="" enctype="multipart/form-data">
                    <table class="form">
						<tr>
							<td>
								<label>Select the category of this Brand :</label>
							</td>
						</tr>
						<tr>
							<td>
								<!-- if user not given new category it takes ($pro_cat) which is the id of previous category--> 
								<select id="select" name="edit_categories_of_type" required>
									<option value="<?php echo $brand_cat;?>"><?php echo $category_title; ?></option>
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
                                <input type="text" name="new_brand" size="50" value="<?php echo $brand_title;?>"   required class="medium" />
                            </td>
                        </tr>
						<tr> 
                            <td>
                                <input type="submit" name="update_brand" value="Update Brand"/>
                            </td>
                        </tr>
                    </table>
                    </form>
                </div>
            </div>
        </div>
<?php include 'inc/footer.php';?>


<?php
if(isset($_POST['update_brand'])) {
	$update_id=$brand_id;
	$new_brand=$_POST['new_brand'];
	$edit_brand_cat=$_POST['edit_categories_of_type'];
	$update_brand="update brands set brand_title='$new_brand',cat_id='$edit_brand_cat' where brand_id='$update_id'";
	$run_brand=mysqli_query($con,$update_brand);
	if($run_brand) {
		echo"<script>alert('A Brand Has been updated!')</script>";
		echo"<script>window.open('view_brands.php','_self')</script>";
	}
}
?>
<?php } ?>









 