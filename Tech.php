<?php

class Tech{
    public $conn;

    function __construct(){
        session_start();
        $this->conn = new mysqli("localhost","root","","automobile_repair");
    }
    public function login($email, $password){
        $encrypted=md5($password);
        $new= "SELECT * FROM technicians WHERE tech_email='$email' AND tech_password='$encrypted'";
        $result= $this->conn->query($new);
        $total = $result->num_rows;
        $id=0;
        if($total > 0){
        $data= $result->fetch_assoc();
        $id = $data['technicians_id'];
        //echo '<pre>';
       // print_r($data);
        //echo '</pre>';
        }
        return $id;
   }
    public function register($fname,$lname,$mail,$password,$phone){
        $encrypted=md5($password);
        $q= "INSERT INTO technicians SET tech_firstname='$fname',tech_lastname ='$lname',tech_email='$mail',
        tech_password ='$encrypted', tech_contact ='$phone'";
        
        $res=$this->conn->query($q);
        $id=$this->conn->insert_id;
        return $id;
        
    }
    public function logout(){
        session_destroy();
        session_unset();
        header('location:tech_login.php');
    }
    function get_details($custid){
        $q ="SELECT * FROM technicians WHERE technicians_id ='$custid'";
        $result = $this->conn->query($q);
        //$t=$result->num_row; no need cos it wont return empty data regardless.
        $data = $result->fetch_assoc();
        return $data;
        
    }
    public function tech_cancel_order($id){
        //write the query
        $q="UPDATE customer_orders  SET ord_status ='cancelled' WHERE ord_status='pending' 
        AND order_id = '$id'";
        $result= $this->conn->query($q);
        
    }
    public function tech_cancel_pending_order($id){
        //write the query
        $q="UPDATE customer_orders  SET ord_status ='cancelled' WHERE ord_status='accepted' 
        AND order_id = '$id'";
        $result= $this->conn->query($q);
        
    }
    public function tech_accept_order($id){
        //write the query
        $q="UPDATE customer_orders  SET ord_status ='accepted' WHERE ord_status='pending' 
        AND order_id = '$id'";
        $result= $this->conn->query($q);
        
    }
    //accepted orders go here
    public function get_pending($id){
        //write the query may add -> AND customer_orders.customer_id = '$id'
        $q="SELECT customer_orders.order_id,customer_orders.issues,customer_orders.address,
         customers.customer_fname,customers.customer_lname,
        customer_orders.request_date,customers.cust_contact 
        FROM customer_orders JOIN customers ON customer_orders.customer_id = customers.customer_id 
        WHERE ord_status='accepted'";
        $result= $this->conn->query($q);
        $row = array();
        while($data=$result->fetch_assoc()){
            $row[]=$data;
        }
        return $row;
    }
   
    public function get_completed($id){
        //write the query
        $q="SELECT customer_orders.order_id,customers.customer_fname,customers.customer_lname,
        customers.cust_contact,customer_orders.completion_date,customer_orders.issues,customer_orders.address
         FROM customer_orders 
        JOIN customers ON customer_orders.customer_id = customers.customer_id
        WHERE ord_status='completed'
        ";//unclear AND customer_orders.customer_id = '$id'
        $result= $this->conn->query($q);
        $row = array();
        while($data=$result->fetch_assoc()){
            $row[]=$data;
        }
        return $row;
    }
    //called on dashboard
    public function get_appointment(){
        //write the query
        $q="SELECT customer_orders.order_id,customer_orders.issues,customer_orders.address,
         customers.customer_fname,customers.customer_lname,
        customer_orders.request_date,customers.cust_contact 
        FROM
         customer_orders JOIN customers
        ON customer_orders.customer_id = customers.customer_id WHERE ord_status='pending'
        ";//unclear
        $result= $this->conn->query($q);
        $row = array();
        while($data=$result->fetch_assoc()){
            $row[]=$data;
        }
        return $row;
    }

   
    public function upload($filearray,$id){
        $tmp = $filearray['pic']['tmp_name'] ;// tmp is a temp location
        $type = $filearray['pic']['type'];
        $filename = $filearray['pic']['name'] ;
        
        $ext = pathinfo($filename, PATHINFO_EXTENSION);
        
        $newfilename =time().rand(). ".$ext";//ensure it is double quote
        $destination = "images/$newfilename";
        $size = $filearray['pic']['size'];	
        $response = "";
        
        if(strtolower($ext) =='jpeg' || strtolower($ext) =='png' || strtolower($ext)=='gif'){
            //n.b size is measured in bytes
              if($size <= 2000000000){
                  //move file from temporary location to destination
                    move_uploaded_file($tmp, $destination);
                    $q = "UPDATE technicians SET tech_avatar ='$newfilename' WHERE technicians_id='$id'";
                    $this->conn->query($q);
    
                    $response = "Successfully uploaded";
              }else{
                $response = 'File too large';
              }
        }else{
          $response = 'Please, select picture!';
        }
    return $response;
    }
    
    public function update_profile($postarray,$id){
        // $postarray is the variable for $_POST used to call $_POST from here.
        
        $fname =trim(strip_tags($postarray['fname']));  
        $lname =trim(strip_tags($postarray['lname']));      
        $phone =trim(strip_tags($postarray['phone']));
        $gender =trim(strip_tags($postarray['gender']));
        $address =trim(strip_tags($postarray['address']));
      
       $q="UPDATE technicians set tech_firstname='$fname', 
       tech_lastname='$lname', tech_contact='$phone', gender='$gender',tech_address='$address'
        where technicians_id='$id'";

       // echo $q;
        //die();
      $this->conn->query($q);
      header('location:tech_profile.php');

        if(!empty($postarray['pwd1'])){
            //If the password does not match the confirm password
            $result=['status'=>false, 'msg'=>'']; 
            if($postarray['pwd1'] != $postarray['pwd2']){
                $result['status']=false;
                $result['msg']="Your new password does not match the confirm password";

            }
            //But if it matches
            $new_pwd=md5($postarray['pwd1']);
            $p="UPDATE technicians set tech_password = '$new_pwd' where technicians_id='$id'";
            $this->conn->query($p);
            if($this->conn->error){
                $result['msg']="System error. Please retry";
            
                return $result;
            }
        }        

   }
    
    
}   