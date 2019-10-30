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
                <h2>Add New Brand</h2>
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
								<select id="select" name="categories_of_type" required>
									<option>Select the category</option>
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
                                <input type="text" name="new_brand"  required placeholder="Enter Brand Name..." class="medium" />
                            </td>
                        </tr>
						<tr> 
                            <td>
                                <input type="submit" name="add_brand" value="Add Brand">
                            </td>
                        </tr>
                    </table>
                    </form>
                </div>
            </div>
        </div>
<?php include 'inc/footer.php';?>		




<?php
if(isset($_POST['add_brand'])) {
	$type_cat=$_POST['categories_of_type'];
	$new_brand=$_POST['new_brand'];
	$d=date("Y/m/d");
	$insert_brand="insert into brands (brand_title,cat_id,type_date) values ('$new_brand','$type_cat','$d')";
	$run_brand=mysqli_query($con,$insert_brand);
	if($run_brand) {
		echo"<script>alert('A New Brand Has been inserted!')</script>";
		echo"<script>window.open('view_brands.php','_self')</script>";
	}
}
} 
?>