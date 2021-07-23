<?php

if($_POST){
    require('Tech.php');
    $obj=new Tech;
    if(!isset($_SESSION['custid'])){
        header('location:tech_login.php');
    }

$id = $_SESSION['custid'];
$user_details = $obj->update_profile($_POST, $id);


}else{
    header('location:tech_login.php');

}





//Note: $_POST is the summary of all the posts. post'name', post 'description' etc.
// $id is used cos if you dont log in, you can get to this page. and the id is 
//used to know the people that logged in.

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
	<title>Auto-care || update</title>
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
					<h5 class="mt-2 text-center"><a href="user.php " class="dashboard-bg">DASHBOARD</a></h5>
					<img src="<?php if($user_details['tech_avatar']!=''){
						 echo"images/".$user_details['tech_avatar'];
						}else{
						echo"images/avatar_male.png";

						 } ?>"
					class="rounded-circle avatar ml-2" height="100" width="120" alt="">

					<h5 class="mt-2 ml-2 mb-5"><i class="fas fa-user-edit "></i>&nbsp;Hi <?php echo $user_details['tech_firstname']?></h5>

					<p><a href="tech_dashboard.php" class="text-secondary"><i class="far fa-calendar-check pr-4"></i>Available Orders</a></p>
					<p><a href="tech_pending.php" class="text-secondary"><i class="fas fa-toggle-on pr-3"></i>Pending Orders</a></p>
					<p><a href="tech_completed.php" class="text-secondary"><i class="fas fa-align-left pr-4"></i>Completed Orders</a></p>
					<p><a href="tech_profile.php" class="text-secondary"><i class="fas fa-cog pr-4  "></i>Edit Profile</a></p>
					<p><a href="tech_upload.php" class="text-secondary"><i class="fas fa-cog pr-4  "></i>Change photo</a></p>

					<p><a href="tech_logout.php" class="text-secondary"><i class="fas fa-adjust pr-4 pb-md-5 mb-md-5"></i>Logout</a></p>



				</div>
				<div class=" col-9 mx-5">
                <div class="card">
				<h1 class="text-center font-weight-lighter mt-5">updates</h1>
   
        <div class="card-body">
        
                <table class="table table-striped mt-2  table-hover">
                    <tr>
                        <th>First Name</th><td><?php echo $user_details['tech_firstname']; ?></td>
                    </tr>
                    <tr>
                        <th>Last Name</th><td><?php echo $user_details['tech_lastname']; ?></td>
                    </tr>
                    <tr>
                        <th>Email</th><td><?php echo $user_details['tech_email']; ?></td>
                    </tr>
                    <tr>
                        <th>Phone</th><td><?php echo $user_details['tech_contact']; ?></td>
                    </tr>
                    
                    <tr>
                        <th>Gender</th><td><?php echo $user_details['gender']; ?></td>
                    </tr>

					<tr>
                        <th>Address</th><td><?php echo $user_details['tech_address']; ?></td>
                    </tr>
                    <tr>
                        <td colspan="2" class="text-right"><a class='btn nav-bg text-light' href='tech_profile.php'>Edit</a></td>
                    </tr>
                </table>
        </div>
				</div>
			</div>

			</div>
		</div>
</body>
</html>
