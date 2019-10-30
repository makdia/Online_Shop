<?php
session_start();
include("../functions/functions.php");
if(!isset($_SESSION['user_email'])) {
	echo"<script>window.open('login.php?not_admin=This service is only for Admin!! If you are an Admin then Logged in by using your Email and Password.','_self')</script>";
}
else {
?>
<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>
        <div class="grid_10">
            <div class="box round first grid">
                <h2>Inbox</h2>
                <div class="block">        
                    <table class="data display datatable" id="example">
					<thead>
						<tr>
							<th>Serial No.</th>
							<th>E-mail</th>
							<th>Message</th>
							<th>Action</th>
						</tr>
					</thead>
					<tbody>
					<?php
$get_c="select * from message";
$run_c=mysqli_query($con,$get_c);
$i=0;
while($row_c=mysqli_fetch_array($run_c)) {
		$c_id=$row_c['txt_id'];	
		$c_name=$row_c['name'];	
		$c_email=$row_c['customer_email'];	
		$c_subject=$row_c['subject'];
		$i++;
		
?>
						<tr class="odd gradeX">
							
							<td><?php echo $i; ?></td>
					<td><?php echo $c_email; ?></td>
					<td><?php echo $c_subject; ?></td>
							<td><a href="delete_message.php?delete_c=<?php echo $c_id;?>">Delete</a></td>
</tr> <?php } ?>
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

<?php 
} 
?>
