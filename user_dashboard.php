<?php

require('User.php');
$obj = new User;

//session_start();
if(!isset($_SESSION['custid'])){
  header('location:index.php');
}

$user_details = $obj->get_details($_SESSION['custid']);
// echo"<pre>";
// print_r($user_details);
// echo"</pre>";
?>


<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width,initial-scale=1.0">
	<meta name="keyword" content="Auto-care,car servicing maintenance and repair, order and book to fix appointments">
	<meta name="description" content="Auto-care,car servicing maintenance and repairs,  its a platform where people can book appointments to fix and service their cars anytime anywhere">
	<meta name="author" content="Ogundele babatunde Stephen">
	<title>Auto-care || Home</title>
	<link rel="stylesheet" href="css/bootstrap.min.css">
	<link rel="stylesheet" href="css/animate.css">
	<link rel="stylesheet" type="text/css" href="icons/css/all.min.css">
	<link rel="stylesheet" type="text/css" href="main.css">
	<script src="js/jquery-3.5.1.min.js"></script>

</head>
<body>
		<!--nav-->
		<?php include('light_header.php');?>
		
		<div class="container-fluid ">
			<div class="row">
				<div class="col-2 text-white dashboard-bg mt-2  ">
					<h5 class="mt-2 text-center"><a href="#" class="dashboard-bg">DASHBOARD</a></h5>
					<img src="<?php if($user_details['cust_avatar_img']!=''){
						 echo"images/".$user_details['cust_avatar_img'];
						}else{
						echo"images/avatar_male.png";

						 } ?>"
					class="rounded-circle avatar ml-4" height="100" width="120" alt="">

					<h5 class="mt-2 ml-2 mb-5"><i class="fas fa-user-edit "></i>&nbsp;Hi <?php echo $user_details['customer_fname'];?></h5>

					<p class="text-secondary"><i class="fas fa-user-check pr-3"></i>User ID</a></p>
					<p><a href="appointment.php" class="text-secondary"><i class="far fa-calendar-check pr-4"></i>Appointments</a></p>
					<p><a href="user_completed.php" class="text-secondary"><i class="fas fa-align-left pr-4"></i>Completed Orders</a></p>
					<p><a href="order.php" class="text-secondary"><i class="fas fa-toggle-on pr-3"></i>Order status</a></p>
					<p><a href="plan.php" class="text-secondary"><i class="fas fa-align-left pr-4"></i>Plan & subscription</a></p>
					<p><a href="profile.php" class="text-secondary"><i class="fas fa-cog pr-4  "></i>Profile</a></p>
					<p><a href="Paystack/payment.php" class="text-secondary"><i class="fas fa-cog pr-4  "></i>Payment</a></p>
					<p><a href="upload.php" class="text-secondary"><i class="fas fa-cog pr-4  "></i>Change photo</a></p>

					<p><a href="logout.php" class="text-secondary"><i class="fas fa-adjust pr-4 pb-md-5 mb-md-5"></i>Logout</a></p>
				</div>
				<div class="col-10">
					<div class="col">
						<h1 class="display-4 mt-3 mb-3 ml-5 pl-5 pr-0 mr-0 text-center">Where are you?</h1>
						
						<div class="row">
							<div class="col-3 mt-5 h-100">
								<span toggle="#loc" class="fas fa-map-marker-alt mb-n5 "></span>

							<form action="request.php" method="POST">
								<input type='hidden' name='custid' value='<?php echo $_SESSION['custid']; ?>'>
								<input type="text" name="location" class="form-control border-secondary" value="" placeholder="Enter address">
								
								<input type="text" name="issue"  class=" mt-1 mb-2 border-secondary form-control " value="" placeholder="vehicle issues:">

								<button type="" class="btn btn-outline-secondary nav-bg text-white mb-2 form-control">Request now</button><br>
								<button type="" class="btn btn-outline-secondary nav-bg text-white  form-control ">Schedule later</button>
							</form>
							</div>
							<div class="col-9 mt-0">
								<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3963.1173822407136!2d3.3847235140944436!3d6.632340723730152!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x103b9372e060fcd9%3A0xdd5d698149e0afd1!2s7%20Gbelegbo%20St%2C%20Olowora%2C%20Lagos!5e0!3m2!1sen!2sng!4v1612008712605!5m2!1sen!2sng"
								 width="400" height="400" frameborder="0" style="border:0;" allowfullscreen="" class="col  frame text-center" aria-hidden="false" tabindex="0"></iframe>
								<!-- <img src="images/cityy.jpg" class="img-fluid col h-75" alt=""> -->
							</div>
						</div>
					</div>
					
					
				</div>

			</div>
		</div>
</body>
</html>
