<?php
session_start();
include("../includes/db.php");
$nameE=$emailE=$passwordE=$cityE=$contactE=$addressE="";
$c_name=$c_email=$c_pass=$c_city=$c_contact=$c_address="";
if(!isset($_SESSION['user_email'])) {
echo"<script>window.open('login.php?not_admin=This service is only for Admin!! If you are an Admin then Logged in by using your Email and Password.','_self')</script>";
}
else {
?>
<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>

<?php
if(isset($_POST['register'])) {
	$c_name=$_POST['c_name'];	
	$c_email=$_POST['c_email'];
	$c_pass=$_POST['c_pass'];
	$c_city=$_POST['c_city'];	
	$c_contact=$_POST['c_contact'];	
	$c_address=$_POST['c_address'];
	$word=str_word_count($c_address);

          if (!preg_match("/^(?=.*[A-Za-z ])[A-Za-z ]{4,}$/",$c_name)) {
			  $nameE = "Name must be at least 4 character EX-Makdia,Foujia";
		  }
		  else{}
		  if (!filter_var($c_email, FILTER_VALIDATE_EMAIL)) {
             $emailE = "Invalid email format Ex-makdia@gmail.com";
              }
		  else{}
		  if (!preg_match("/^(?=.*[A-Za-z])(?=.*\d)[A-Za-z\d]{8,}$/",$c_pass)) {
			  $passwordE = "Password minimum 8 characters with 1 letter and 1 number";
		  }
		  else{}
		   if (!preg_match("/^(?=.*\d)[\d]{10,}$/",$c_contact)) {
			  $contactE = "Your contact must be at least 10";
		  }
		  else{}
		   if (!preg_match("/^(?=.*[A-Za-z])[A-Za-z]{4,}$/",$c_city)) {
			  $cityE = "Your city name is wrong";
		  }
		  else{}
		 if ($word<3) {
			   $addressE = "Address must be at least 3 words";
		  }
	     else{}

           if ((preg_match("/^(?=.*[A-Za-z ])[A-Za-z ]{4,}$/",$c_name)) && (filter_var($c_email, FILTER_VALIDATE_EMAIL)) && (preg_match("/^(?=.*[A-Za-z])(?=.*\d)[A-Za-z\d]{8,}$/",$c_pass)) && (preg_match("/^(?=.*\d)[\d]{10,}$/",$c_contact))  &&(preg_match("/^(?=.*[A-Za-z])[A-Za-z]{4,}$/",$c_city)) && ($word>=3)) {
                   $check_customer_email="select * from admin where user_email='$c_email'";
                   $run_customer_email=mysqli_query($con,$check_customer_email);
                   $count_customer_email=mysqli_num_rows($run_customer_email);
	                       if($count_customer_email==0) {
                                  $insert_c="insert into admin (user_email,user_pass,user_name,city,phone,address)
                                             values ('$c_email','$c_pass','$c_name','$c_city','$c_contact','$c_address')";
                                  $run_c=mysqli_query($con,$insert_c);

                                  $_SESSION['user_email']=$c_email;
                                  echo "<script>alert('Account has been created successfully!!')</script>";	
                                  echo "<script>window.open('index.php','_self')</script>";	
		
	                        }
	                       else {
	                              echo "<script>alert('Please Enter Another Email.This Email Already have Another Admin!!')</script>";	
                                  //echo "<script>window.open('customer_register.php','_self')</script>";		
		
	                        }
            }
    }
?>



        <div class="grid_10">
            <div class="box round first grid">
                <h2> Register New Account</h2>
                <div class="block">               
                <div class="register_account">
    		<h3>Register New Account</h3>
    		<form action="" method="post"  enctype="multipart/form-data">
		   			 <table>
		   				<tbody>
						<tr>
						<td>
							<div>
							<input type="text"  name="c_name" value="<?php echo $c_name;?>" placeholder="Name">
							<span class="error"><?php echo $nameE;?></span><br>
							</div>
							
							<div>
							   <input type="text" value="<?php echo $c_email;?>" placeholder="E-Mail" name="c_email">
							   <span class="error"><?php echo $emailE;?></span><br>
							</div>
							
							<div>
								<input type="text" value="<?php echo $c_pass;?>" placeholder="Password" name="c_pass">
								<span class="error"><?php echo $passwordE;?></span><br>
							</div>
							
		    			 </td>
		    			<td>
								<div>
						  <input type="text" value="<?php echo $c_contact;?>" placeholder="Phone" name="c_contact">
						  <span class="error"><?php echo $contactE;?></span><br>
						  </div>
								
			
						   
						  <div>
									<input type="text" value="<?php echo $c_city;?>" placeholder="City" name="c_city">
									<span class="error"><?php echo $cityE;?></span><br>
								</div>
						  <div>
							<input type="text" value="<?php echo $c_address;?>" placeholder="Address" name="c_address">
							<span class="error"><?php echo $addressE;?></span><br>
						</div>
						</td>
					</tr> 
		    </tbody></table> 
		   <div class="search"><div><button class="grey" name="register">Create Account</button></div></div>
		    <div class="clear"></div>
		    </form>
    	</div>  	
       <div class="clear"></div>
    </div>
 </div>
</div>
       
				</div>
            </div>
        </div>
<?php include 'inc/footer.php';?>




<?php 
} 
?>
