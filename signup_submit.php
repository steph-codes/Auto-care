<?php
require('user.php');
$fname = strip_tags(trim($_POST['fname']));
$lname= strip_tags(trim($_POST['lname']));
$mail = strip_tags(trim($_POST['email']));
$password = trim($_POST['pwd']);
$phone = strip_tags(trim($_POST['phone']));


$obj = new user();
$obj->register($fname,$lname,$mail,$password,$phone);//$fname,$lname,$mail,$password,$phone
$check= $obj->register($fname,$lname,$mail,$password,$phone);
if($check){
    $_SESSION['custid'] = $check;
header('location:user_dashboard.php');
}else{
    header('location:index.php?');
}

//  header('location:index.php?msg=try again');
?>