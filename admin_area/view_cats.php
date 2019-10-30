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
                <h2>List of all categories</h2>
                <div class="block">        
                    <table class="data display datatable" id="example">
					<thead>
						<tr>
							<th>Serial No.</th>
							<th>Category Name</th>
							<th>Action</th>
						</tr>
					</thead>
					<tbody>
					<?php
						$get_cat="select * from categories";
						$run_cat=mysqli_query($con,$get_cat);
						$i=0;
						while($row_cat=mysqli_fetch_array($run_cat)) {
							$cat_id=$row_cat['cat_id'];	
							$cat_title=$row_cat['cat_title'];	
							$i++;
						?>
						<tr class="odd gradeX">
							<td><?php echo $i;?></td>
							<td><?php echo $cat_title;?></td>
							<td><a href="edit_cat.php?edit_cat=<?php echo $cat_id;?>">Edit</a> || <a href="delete_cat.php?delete_cat=<?php echo $cat_id;?>">Delete</a></td>
						</tr>
					<?php } ?>
					</tbody>
				</table>
               </div>
            </div>
        </div>
<script type="text/javascript">
	$(document).ready(function () {
	    setupLeftMenu();

	    $('.datatable').dataTable();
	    setSidebarHeight();
	});
</script>
<?php include 'inc/footer.php';?>




<?php } ?>


