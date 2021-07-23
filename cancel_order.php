<?php
//require('Orders.php');
include ('user.php');
$obj= new User();


$col= $obj->cancel_order($_GET['order_id']);
header("Location:appointment.php?msg=<div class='alert alert-success'>order cancelled</div>")
?>

		

</body>
</html>