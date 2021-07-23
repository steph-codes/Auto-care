<?php

include ('Tech.php');
$obj= new Tech();


$col= $obj->tech_cancel_pending_order($_GET['order_id']);
header("Location:tech_pending.php");

?>

		

</body>
</html>