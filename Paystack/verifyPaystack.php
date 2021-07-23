<?php

//var_dump($_REQUEST);
//get reference
$reference = $_GET['reference'];
//create obj of subscription class
include('../User.php');

$obj = new User;
// $col= $obj->get_appointment($_SESSION['custid']);

// echo"<pre>";
// print_r($col);
// echo"</pre>";
// echo $col['order_id'];
//access verify payment method

$customer_id = $_SESSION['custid'];
//$ord_id = $col['order_id'];
$output = $obj->verifyPaystack($reference,$customer_id);
//var_dump($output);
if($output->data->status=='success'){
    $amount = $output->data->amount /100;
    $trans_date =$output->data->paid_at;
    $payment_status ='paid';
    $payment_mode = 'Paystack';
    //insert into subscription table
$obj->insertPayment($customer_id,$order_id, $amount,$payment_status,$reference,$trans_date,$payment_mode);
}else{
    // redirect to failed page
}

?>