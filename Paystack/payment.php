<?php

include('../User.php');
    // echo"<pre>";
    // print_r($_SERVER);
    // echo"</pre>";
$obj = new User();
   
if (!isset($_SESSION['custid'])) {
    //header('location:../index.php');
}
    $customer_id = $_SESSION['custid'];
    $col= $obj->get_appointment($_SESSION['custid']);

    $user_details = $obj->get_details($_SESSION['custid']);
  

    //at first its GET, when submitted it return error, cos it has been posted as it needs parameter
    if ($_SERVER['REQUEST_METHOD']=='POST') {
        //make reference to intialized paystack method
        $output =$obj->initializePaystack($_POST['order_id'],$_POST['email'],$_POST['amount']);
        //gives the authorization url link / callbackurl *need to confirm
        // echo"<pre>";
        // print_r($output);
        // echo"</pre>";
        $authorization_url = $output->data->authorization_url;

        header("location: $authorization_url");
    }

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
					<h5 class="mt-2 text-center"><a href="../user_dashboard.php" class="dashboard-bg">DASHBOARD</a></h5>
					<img src="../images/hero.png" class="rounded-circle avatar ml-5" height="100" alt="">

					<h5 class="mt-2 ml-2 mb-5"><i class="fas fa-user-edit "></i>&nbsp;Hi <?php echo $user_details['customer_fname']?></h5>

					<p class="text-secondary"><i class="fas fa-user-check pr-3"></i>User ID</a></p>
					<p><a href="../appointment.php" class="text-secondary"><i class="far fa-calendar-check pr-4"></i>Appointments</a></p>
					<p><a href="./user_completed.php" class="text-secondary"><i class="fas fa-align-left pr-4"></i>Completed Orders</a></p>
					<p><a href="../order.php" class="text-secondary"><i class="fas fa-toggle-on pr-3"></i>Order status</a></p>
					<p><a href="../plan.php" class="text-secondary"><i class="fas fa-align-left pr-4"></i>Plan & subscription</a></p>
					<p><a href="../profile.php" class="text-secondary"><i class="fas fa-cog pr-4  "></i>Profile</a></p>
					<p><a href="../upload.php" class="text-secondary"><i class="fas fa-cog pr-4  "></i>Change photo</a></p>

					<p><a href="../logout.php" class="text-secondary"><i class="fas fa-adjust pr-4 pb-md-5 mb-md-5"></i>Logout</a></p>



				</div>
				<div class=" col-10 mt-5">
				<h1 class="text-center font-weight-lighter mb-5">Payment</h1> 
                
                    <form action="" id="paymentForm" class='px-5 mx-auto mx-5' method="POST">
                    <!-- this form contained required parameters or field by paystack -->
                    

                        <div class="form-group">
                            <label for="order_id">Order_id </label>
                            <input type="text" id="order" name="order_id" placeholder=""class="form-control" value="" required />
                        </div>

                        <div class="form-group">
                            <label for="email">Email Address</label>
                            <input type="email" id="email-address"name="email" class="form-control" required />
                        </div>
                        
                        <div class="form-group">
                            <label for="amount">&#8358; 10,000 Consultation Fee </label>
                            <input type="text" id="amount"  name="amount" value="&#8358;100000000"class="form-control" placeholder="&#8358;10000" required />
                        </div>
                        <div class="form-submit">
                            <button type="submit" class="btn btn-lg nav-bg text-white" onclick="payWithPaystack()"> Pay </button>
                        </div>
                    </form>
                </div>
                
            </div>
        </div>
        

        </script>
    </body>
</html>