<?php

include('../User.php');
$obj = new User();
$user_details=$obj->get_details($_SESSION['custid']);

?>
<!DOCTYPE html>
<html lang="en">
<meta charset="utf-8">
<head>
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width,initial-scale=1.0">
	<meta name="keyword" content="Auto-care,car servicing maintenance and repair, order and book to fix appointments">
	<meta name="description" content="Auto-care,car servicing maintenance and repairs,  its a platform where people can book appointments to fix and service their cars anytime anywhere">
	<meta name="author" content="Ogundele babatunde Stephen">
	<title>Auto-care || payment</title>
	<link rel="stylesheet" href="../css/bootstrap.min.css">
	<link rel="stylesheet" href="../css/animate.css">
	<link rel="stylesheet" type="text/css" href="../icons/css/all.min.css">
	<link rel="stylesheet" type="text/css" href="../main.css">
	<script src="js/jquery-3.5.1.min.js"></script>

<style type="text/css">
	

</style>
</head>
<body>

	<?php include('../light_header.php');?>
    
    <div class="container-fluid ">
			<div class="row h-100">
				<div class="col-2 text-white dashboard-bg mt-2  ">
					<h5 class="mt-2 text-center"><a href="user_dashboard.php" class="dashboard-bg">DASHBOARD</a></h5>
					<img src="../images/hero.png" class="rounded-circle avatar ml-5" height="100" alt="">

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
				<div class=" col-10 mt-5">
				<div class="text-center bg-success p-5  mb-5">
                <h1 class='display-4 font-weight-lighter'>Payment Successful</h1>
                <p class="paid"><i class="far fa-thumbs-up  fa-10x"></i></p>
                <h3>Thank you <?php echo $user_details['customer_fname']?></h3>
                <p class="">kindly check your email for payment receipts</p>
                </div> 
                
                </div>
            </div>
        </div>

    </body>
</html>