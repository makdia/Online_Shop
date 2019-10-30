<?php
session_start();
include("../includes/db.php");
if(!isset($_SESSION['user_email'])) {
	echo"<script>window.open('login.php?not_admin=This service is only for Admin!! If you are an Admin then Logged in by using your Email and Password.','_self')</script>";
}
else {

if(isset($_GET['edit_cat'])) {
	$cat_id=$_GET['edit_cat'];
	$get_cat="select * from categories where cat_id='$cat_id'";
	$run_cat=mysqli_query($con,$get_cat);
	$row_cat=mysqli_fetch_array($run_cat);
	$cat_id=$row_cat['cat_id'];
	$cat_title=$row_cat['cat_title'];
}
?>


<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>
        <div class="grid_10">
            <div class="box round first grid">
                <h2>Update Category</h2>
               <div class="block copyblock"> 
                 <form method="post" action="" enctype="multipart/form-data">
                    <table class="form">					
                        <tr>
                            <td>
                                <input type="text" name="new_cat" size="50" value="<?php echo $cat_title;?>"  type="text" required class="medium" />
                            </td>
                        </tr>
						<tr> 
                            <td>
                                <input type="submit" name="update_cat" value="Update Category"/>
                            </td>
                        </tr>
                    </table>
                    </form>
                </div>
            </div>
        </div>
<?php include 'inc/footer.php';?>



<?php
if(isset($_POST['update_cat'])) {
	$update_id=$cat_id;
	$new_cat=$_POST['new_cat'];
	$update_cat="update categories set cat_title='$new_cat' where cat_id='$update_id'";
	$run_cat=mysqli_query($con,$update_cat);
	if($run_cat) {
		echo"<script>alert('Category Has been updated!')</script>";
		echo"<script>window.open('view_cats.php','_self')</script>";
	}
}
} 
?>







