<?php

include('User.php');
// if(!isset($_SESSION['custid'])){
//     header('location:tech_login.php');
//   }

$obj= new User;
$col= $obj->get_appointment($_SESSION['custid']);

$user_details = $obj->get_details($_SESSION['custid']);

// echo '<pre>';
// print_r($col);
// echo '<pre>';
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
			<div class="row h-100">
				<div class="col-2 text-white dashboard-bg mt-2  ">
					<h5 class="mt-2 text-center"><a href="user_dashboard.php" class="dashboard-bg">DASHBOARD</a></h5>
					<img src="images/hero.png" class="rounded-circle avatar ml-5" height="100" alt="">

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
				<h1 class="text-center font-weight-lighter mb-5">Your Orders</h1> 
				<p class='text-dark' id="message"></p>       
                <table class="table table-striped border-bottom table-hover">
				
                     <tr class="col-12">
                    <?php
						// echo"<pre>";
						// print_r($col);
						// echo"</pre>";
						echo"<tr class='bg-secondary'>
						<th class='px-3 border-left'>ORDER-ID</th>
						<th class='px-0 text-center'>PHONE</th>
						<th class='px-4'>ORDER-DATE</th>
						<th class='px-0  text-center'>DETAILS</th>
						<th class='px-0  text-center'>ADDRESS</th>
						<th class='px-4'>STATUS</th>
						<th class='border-right text-secondary'>cancel</th>
						</tr>";
                        foreach($col as $k=>$val){
                        ?>
						
						<td class="px-5 border-left" id="ord"><?php echo $val['order_id'];?></td>
                        <!-- <th class="pl-1 border-left"><?php echo $val['customer_fname']." ". $val['customer_lname']; ?></th> -->
                        <td class="px-0 "><i class="fas fa-phone-alt"></i>&nbsp;&nbsp;<?php echo $val['cust_contact']; ?></td>
						<td class="px-0"><?php echo $val['request_date']; ?></td>
						<td class="px-0"><?php echo $val['address']; ?></td>
						<td class="px-0"><?php echo $val['issues']; ?></td>
						<td>
						<a class='btn-sm nav-bg  text-white' href='#'>unassigned</a>
						</td>
                        <td class="border-right">
						<a class='btn-sm btn-danger ' id="cancel"
						 href="cancel_order.php?order_id=<?php echo $val['order_id']?>">Cancel</a>						
						
						</td>
						<!-- onclick="alert('<?php echo $val['order_id']?>')" -->
       				</tr>

				<?php
					}
				?></table>

						
						
				</div>
			</div>

		</div>
		<script src='js/jquery-3.5.1.min.js'></script>
		
    <script>
        // $(document).ready(function(){
        //     $('#cancel').click(function(){
        //         var order= $('#ord').html();
        //         var newdata = {"del_id":order};
		// 		//alert(newdata.del_id);
        //         $.ajax({
        //             url:'delete_order.php',
        //             type:'post',
        //             data:newdata,
        //             //dataType:'text',//text
        //             success:function(server){
        //                 console.log(server);
                        
        //             }
        //         })
        //     })
        // })

    </script>
</body>
</html>
