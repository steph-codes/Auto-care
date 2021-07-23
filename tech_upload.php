<?php
//session_start();
require('Tech.php');
$obj = new Tech ;

if(!isset($_SESSION['custid'])){
  header('location:tech_login.php');
}
$user_details = $obj->get_details($_SESSION['custid']);
$msg ='' ;


if($_POST || $_FILES){ //if($_FILES)
//$_FILES is like the $_POST array,$_FILES is used for files or img, post is used for input text then session is the $id , both are used as parameters
$msg = $obj->upload($_FILES,$_SESSION['custid']);

}

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
				<div class="col-2 text-white nav-bg mt-2  ">
					<h5 class="mt-2 text-center"><a href="tech_dashboard.php" class="text-white">DASHBOARD</a></h5>
					<img src="<?php if($user_details['tech_avatar']!=''){
						 echo"images/".$user_details['tech_avatar'];
						}else{
						echo"images/avatar_male.png";

						 } ?>"
					class="rounded-circle dark-avatar ml-2" height="100" width="120" alt="">

					<h5 class="mt-2 ml-2 mb-5"><i class="fas fa-user-edit "></i>Hi,&nbsp;Engr <?php echo $user_details['tech_firstname'];?></h5>

					
					<p><a href="tech_dashboard.php" class="text-secondary"><i class="far fa-calendar-check pr-4"></i>Available Orders</a></p>
					<p><a href="tech_pending.php" class="text-secondary"><i class="fas fa-toggle-on pr-3"></i>Pending Orders</a></p>
					<p><a href="tech_completed.php" class="text-secondary"><i class="fas fa-align-left pr-4"></i>Completed Orders</a></p>
					<p><a href="tech_profile.php" class="text-secondary"><i class="fas fa-cog pr-4  "></i>Edit Profile</a></p>
					<p><a href="tech_upload.php" class="text-secondary"><i class="fas fa-cog pr-4  "></i>Change photo</a></p>

					<p><a href="tech_logout.php" class="text-secondary"><i class="fas fa-adjust pr-4 pb-md-5 mb-md-5"></i>Logout</a></p>
				</div>

        <div class="col-10">
					<div class="col">
            <h1 class="mt-4">Upload Picture</h1>
			<?php if($msg != ''){ echo  '<div class="alert alert-info">'.$msg.'</div>';}?>
            <form method="post" action="" enctype="multipart/form-data"> 
              <input type='file' class=""form-control" name="pic">
              <button class="btn nav-bg  text-light" name="btn">Upload</button>
            </form>
          </div>
        </div>
			</div>
    </div>
      
      
    
    <!-- /#page-content-wrapper -->

  <!-- /#wrapper -->

  <!-- Bootstrap core JavaScript -->
  <script src="vendor/jquery/jquery.min.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- Menu Toggle Script -->
  <script>
    $("#menu-toggle").click(function(e) {
      e.preventDefault();
      $("#wrapper").toggleClass("toggled");
    });
  </script>

</body>

</html>
