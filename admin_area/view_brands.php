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
                <h2>List of all brands</h2>
                <div class="block">        
                    <table class="data display datatable" id="example">
					<thead>
						<tr>
							<th>Serial No.</th>
							<th>Brand Name</th>
							<th>Action</th>
						</tr>
					</thead>
					<tbody>
						<?php
							$get_brand="select * from brands";
							$run_brand=mysqli_query($con,$get_brand);
							$i=0;
							while($row_brand=mysqli_fetch_array($run_brand)) {
								$brand_id=$row_brand['brand_id'];	
								$brand_title=$row_brand['brand_title'];	
								$i++;
						?>
						<tr class="odd gradeX">
							<td><?php echo $i;?></td>
							<td><?php echo $brand_title;?></td>
							<td><a href="edit_brand.php?edit_brand=<?php echo $brand_id;?>">Edit</a> || <a href="delete_brand.php?delete_brand=<?php echo $brand_id;?>">Delete</a></td>
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


