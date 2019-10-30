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
        <h2>Product List</h2>
        <div class="block">  
            <table class="data display datatable" id="example">
			<thead>
				<tr>
					<th>Product Title</th>
					<th>Category</th>
					<th>Price</th>
					<th>Image</th>
					<th>Action</th>
				</tr>
			</thead>
			<tbody>
			<?php 	
				$get_pro="select * from products";
				$run_pro=mysqli_query($con,$get_pro);
				$i=0;
				while($row_pro=mysqli_fetch_array($run_pro)) {
					$pro_id=$row_pro['products_id'];	
					$pro_title=$row_pro['products_title'];	
					$pro_image=$row_pro['products_image'];	
					$pro_price=$row_pro['products_price'];	
					$pro_cat=$row_pro['products_cat'];
					$get_cat="select * from categories where cat_id='$pro_cat'";
					$run_cat=mysqli_query($con,$get_cat);
					$row_cat=mysqli_fetch_array($run_cat);
					$cat_title=$row_cat['cat_title'];
					$i++; 
			?>
				<tr class="odd gradeX">
					<td><?php echo $pro_title; ?></td>
					<td><?php echo $cat_title; ?></td>
					<td><?php echo $pro_price; ?></td>
					<td class="center"><img src='product_images/<?php echo $pro_image; ?>' style='width:30px;height:20px;'/></td>
					<td><a href="edit_pro.php?edit_pro=<?php echo $pro_id;?>">Edit</a> || <a href="delete_pro.php?delete_pro=<?php echo $pro_id; ?>">Delete</a></td>
				</tr>
		<?php	}   ?>
				
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