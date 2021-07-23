<?php

require('User.php');
$obj = new User;

//session_start();
if(!isset($_SESSION['custid'])){
  header('location:index.php');
}

$user_details = $obj->get_details($_SESSION['custid']);
 
// echo"<pre>";
//    print_r($user_details);
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
		<?php include('dark_header.php');?>

		<div class="container-fluid ">
			<div class="row">
				<div class="col-2 text-white dashboard-bg mt-2  ">
					<h5 class="mt-2 text-center"><a href="user_dashboard.php" class="dashboard-bg">DASHBOARD</a></h5>
					<img src="<?php if($user_details['cust_avatar_img']!=''){
						 echo"images/".$user_details['cust_avatar_img'];
						}else{
						echo"images/avatar_male.png";

						 } ?>"
					class="rounded-circle avatar ml-4" height="100" width="120" alt="">

					<h5 class="mt-2 ml-2 mb-5"><i class="fas fa-user-edit "></i>&nbsp;Hi <?php echo $user_details['customer_fname']?></h5>

					<p class="text-secondary"><i class="fas fa-user-check pr-3"></i>User ID</a></p>
					<p><a href="appointment.php" class="text-secondary"><i class="far fa-calendar-check pr-4"></i>Appointments</a></p>
					<p><a href="user_completed.php" class="text-secondary"><i class="fas fa-align-left pr-4"></i>Completed Orders</a></p>
					<p><a href="order.php" class="text-secondary"><i class="fas fa-toggle-on pr-3"></i>Order status</a></p>
					<p><a href="plan.php" class="text-secondary"><i class="fas fa-align-left pr-4"></i>Plan & subscription</a></p>
					<p><a href="profile.php" class="text-secondary"><i class="fas fa-cog pr-4  "></i>Profile</a></p>
					<p><a href="upload.php" class="text-secondary"><i class="fas fa-cog pr-4  "></i>Change photo</a></p>

					<p><a href="logout.php" class="text-secondary"><i class="fas fa-adjust pr-4 pb-md-5 mb-md-5"></i>Logout</a></p>
				</div>
				<div class=" ml-3 col-9">
					<h2 class="col text-center my-3 font-weight-light display-4 ">Track ...</h2>
					<p class="bg-light col p-3" id="active">Active &nbsp;<i class="fas fa-toggle-on pr-4"></i></p>
					<div class="row bg-light mt-3 mx-0 h-100 px-4 ">
						<div class="col col-md-5 mt-5 px-5">
							<h1 class="col col font-weight-lighter">Know where your <br>Technician is.</h1>
							<h4 class="col col font-weight-lighter mt-1">Call Engr <?php echo $user_details['tech_firstname']?> 
							<?php echo $user_details['tech_contact']?></h4>
							<!-- call :<?php echo $val['tech_firstname'] . "+234".$val['tech_contact']; ?> -->
							<br>
							<br>
							<button type="" onclick="document.location.href='user_dashboard.php'"class="btn btn-outline-secondary ml-2 ">Cancel Order</button>
						</div>
						<div class="col col-md-5 mt-5 ">
							<img src="images/map.png" class="col mt-3" alt="">
						</div>
					</div>
				</div>
			</div>
		</div>

</body>
</html>

</body>
</html>
