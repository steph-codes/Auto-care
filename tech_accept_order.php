<?php

include ('Tech.php');
$obj= new Tech();


$col= $obj->tech_accept_order($_GET['order_id']);
header("Location:tech_dashboard.php");

?>

		

</body>
</html>