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
                <h2>Add New Category</h2>
               <div class="block copyblock"> 
                 <form method="post" action="" enctype="multipart/form-data">
                    <table class="form">					
                        <tr>
                            <td>
                                <input type="text" name="new_cat"   required placeholder="Enter Category Name..." class="medium" />
                            </td>
                        </tr>
						<tr> 
                            <td>
                                <input type="submit" name="add_cat" value="Add Category"/>
                            </td>
                        </tr>
                    </table>
                    </form>
                </div>
            </div>
        </div>
<?php include 'inc/footer.php';?>




<?php
if(isset($_POST['add_cat'])) {
	$new_cat=$_POST['new_cat'];
	$d=date("Y/m/d");
	$insert_cat="insert into categories (cat_title,cat_date) values ('$new_cat','$d')";
	$run_cat=mysqli_query($con,$insert_cat);
	if($run_cat) {
		echo"<script>alert('New Category Has been inserted!')</script>";
		echo"<script>window.open('view_cats.php','_self')</script>";
	}
}
} 
?>