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
                <h2>List of all orders</h2>
                <div class="block">
				<div class="cartoption">		
			
			    	
					
					<?php 	
	$j=0;
	$same_customer="";
	$get_customer="select * from product_order";
	$run_customer=mysqli_query($con,$get_customer);
	$count_customer=mysqli_num_rows($run_customer);
	if($count_customer==0) {
		echo "<h3 style='font:italic bold 20px Georgia, serif;font-size: 0.8em;padding-top:20px;margin-left:400px;float:center;'>You don't have any orders!!!</h3>";
		
	}
	while($row_customer=mysqli_fetch_array($run_customer)){
		$order_customer_email=$row_customer['customer_email'];
		if ($order_customer_email==$same_customer){}
		else if ($order_customer_email!=$same_customer){	
			$j++;
			?>
			<div class="cartpage">
			<h2 style="float:left;border-bottom: 1px solid #ddd;margin-bottom: 20px;width: 141px;font: italic bold 18px Georgia, serif;">Order No:-<?php echo $j; ?></h2>
			
			<?php
			$get_img="select * from customers where customer_email='$order_customer_email'";
			$run_img=mysqli_query($con,$get_img);
			$row_img=mysqli_fetch_array($run_img);
			$c_name=$row_img['customer_name'];
			$c_email=$row_img['customer_email'];
			$c_country=$row_img['customer_country'];
			$c_city=$row_img['customer_city'];
			$c_contact=$row_img['customer_contact'];
			$c_address=$row_img['customer_address'];		
			$i=0;?>
			<h2 style="float:right;text-align:center;border-bottom: 1px solid #ddd;margin-right:300px;margin-bottom: 20px;width: 350px;font: italic bold 15px Georgia, serif;">
			<?php echo "<p style='padding:0px;margin:0px;'><b>Name:$c_name</b></p>
				<p style='padding:0px;margin:0px;'><b>Email:$c_email</b></p>
				<p style='padding:0px;margin:0px;'><b>Contact:$c_contact</b></p>";?>
			</h2>
			
				<table class="tblone">
							<tr>
								<th width="5%">S.N.</th>
								<th width="20%">Product Name</th>
								<th width="15%">Image</th>
								<th width="15%">Price</th>
								<th width="25%">Quantity</th>
								<th width="20%">Total Price</th>
							</tr>
						<?php
						$get_order="select * from product_order where customer_email='$c_email'";
						$run_order=mysqli_query($con,$get_order);
						$total=0;
						while($row_order=mysqli_fetch_array($run_order)) {
							$order_id=$row_order['p_id'];	
							$order_qty=$row_order['qty'];	
							$order_price=$row_order['price'];	
							$get_pro_order="select * from products where products_id='$order_id'";
							$run_pro_order=mysqli_query($con,$get_pro_order);
							$row_pro_order=mysqli_fetch_array($run_pro_order);	
							$pro_title=$row_pro_order['products_title'];	
							$pro_image=$row_pro_order['products_image'];
							$pro_exact_price=$row_pro_order['products_price'];
							$i++;
							$total+=$order_price;?>
							<tr>
													<td><?php echo $i; ?></td>
													<td><?php echo $pro_title; ?></td>
													<td><img src="product_images/<?php echo $pro_image;?>" /></td>
													<td>Tk. <?php echo $pro_exact_price; ?></td>
													<td><?php echo $order_qty; ?></td>
													<td><?php echo $order_price; ?></td>

							</tr>
				<?php   }  ?>
						</table>
						<table style="float:right;text-align:left;" width="28%">
							<tr>
								<th>Sub Total :</th>
								<td>TK.<?php echo $total; ?></td>
							</tr>
							
								</table>
												
											
							
								
								
							
					
    	</div>  	
			<div class="shopping" style="margin-bottom: 50px;">
						
						<div class="shopright" style="float:center;margin-left:400px;">
							<a href="view_orders.php?delete_order=<?php echo $c_email;?>"> <img src="../images/check.png" alt="" style="width:200px;"/></a>
						</div>
			</div> <?php } ?>
				<?php $same_customer=$c_email; } ?>	
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
if(isset($_GET['delete_order'])) {
		$delete_customer_order=$_GET['delete_order'];
		$delete_cart_order="delete from product_order where customer_email='$delete_customer_order'";
		$run_delete=mysqli_query($con,$delete_cart_order);
		if($run_delete) {
			echo"<script>alert('This User Ordered Has been Delivered Successfully!')</script>";
			echo"<script>window.open('view_orders.php','_self')</script>";
		}
}
?>



<?php  } ?>