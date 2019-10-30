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
        <h2>List of all customers</h2>
        <div class="block">  
            <table class="data display datatable" id="example">
			<thead>
				<tr>
					<th>S.N.</th>
					<th>Customer Name</th>
					<th>Customer E-mail</th>
					<th>Image</th>
					<th>Action</th>
				</tr>
			</thead>
			<tbody>
			<?php
$get_c="select * from customers";
$run_c=mysqli_query($con,$get_c);
$i=0;
while($row_c=mysqli_fetch_array($run_c)) {
		$c_id=$row_c['customer_id'];	
		$c_name=$row_c['customer_name'];	
		$c_email=$row_c['customer_email'];	
		$c_image=$row_c['customer_image'];
		$i++;
		
?>
				<tr class="odd gradeX">
					<td><?php echo $i; ?></td>
					<td><?php echo $c_name; ?></td>
					<td><?php echo $c_email; ?></td>
					
					
					
					<?php
		//if user profile pic is empty then doing this task
			if (empty($c_image)) {	?>
				
				<td class="center"><img src='../customer/customer_images/<?php echo 'makdia.png';?>' style='width:30px;height:30px;padding-top:3px;'/></td>
				
			
			<?php }
		//if user profile pic is not empty then doing this task
			else { ?>
			<td class="center"><img src='../customer/customer_images/<?php echo $c_image;?>' style='width:30px;height:30px;padding-top:3px;'/></td>
				
			
			<?php } ?>
					
					<td><a href="delete_c.php?delete_c=<?php echo $c_id;?>">Delete</a></td>
				
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



