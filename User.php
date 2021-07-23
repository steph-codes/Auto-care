<?php

class User{
    public $conn;

    function __construct(){
        session_start();
        $this->conn = new mysqli("localhost","root","","automobile_repair");
    }
    public function initializePaystack( $order_id,$email, $amount){
        $url = "https://api.paystack.co/transaction/initialize";
        $callback = "http://localhost/Auto-care/Paystack/verifyPaystack.php";
        $fields = [
            'order_id' => "$order_id",
            'email' => "$email",
            'amount' => "$amount",
            'callback_url' => $callback
        ];
        $fields_string = http_build_query($fields);//format parameters as query strings
        //open connection
        $ch = curl_init();//step1
        
        //set the url, number of POST vars, POST
        //step2 setoptions
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $fields_string);//converts them to query string that endpoint accepts postfield is the data ur sending
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            "Authorization: Bearer sk_test_67c2b4cb50d585d1992b576991862e17bdd9fb1e",//you insert ur saved token
            "Cache-Control: no-cache",
        ));//send array to curlopt_httpheader specific header
        
        //So that curl_exec returns the contents of the cURL; rather than echoing it
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        
        //step 3 execute post
        $response = curl_exec($ch);
        
    
        $errors = curl_error($ch);
        //step 4 close curl
        curl_close($ch);
        
        if($errors){
            $output = $errors;
        }
        $output =json_decode($response);

        return $output;
    }
    function verifyPaystack($reference, $customer_id){
        $url="https://api.paystack.co/transaction/verify/$reference";

        //step1: initialize curl session
        $curlsession = curl_init();
        //step2:set  the url headers
        curl_setopt($curlsession, CURLOPT_URL,$url);
        curl_setopt($curlsession, CURLOPT_CUSTOMREQUEST,'GET');
         //curlopt header has an array value, the bearer and test secret, specify cache control as well so it doesnt store the request
        curl_setopt($curlsession, CURLOPT_HTTPHEADER, array(
            "Authorization: Bearer sk_test_67c2b4cb50d585d1992b576991862e17bdd9fb1e",
            "Cache-control: no-cache",
        ));
        curl_setopt($curlsession,CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curlsession, CURLOPT_SSL_VERIFYPEER, false); 
        
        //step:3 execute curl
        $response = curl_exec($curlsession);
        $errors = curl_error($curlsession);

        //step4: close curlsession
        curl_close($curlsession);

        if($errors){
            echo $errors;
        }

        //do whatever you want
        //insert into subsrciption table
        $result = json_decode($response);       


        // echo "<pre>";
        // print_r($response);
        // echo "</pre>";

        return $result;

    }
    public function insertPayment($customer_id,$order_id, $amount,$payment_status,$reference,$trans_date,$payment_mode){
        
        //format startdate
        //$customer_id = $_SESSION['custid'];
        $trans_date = date('Y-m-d h:i:s', strtotime($trans_date));
        //write query
        $q = "INSERT into Payment(customer_id,order_id,amount,payment_status,reference,trans_date,payment_mode
        )
        VALUES('$customer_id','$order_id','$amount', '$payment_status', '$reference',
        '$trans_date', '$payment_mode')";
        //run the query
        //var_dump($q);
        //exit();
        if ($this->conn->query($q)==true) {
            //redirect to success page
            header("Location: http://localhost/Auto-care/Paystack/Payment_success.php");
        } else {
            echo $this->conn->error;
        }
    }

    //next verify paystack transaction=
    public function login($email, $password){
        $encrypted=md5($password);
        $new= "SELECT * FROM customers WHERE cust_email='$email' AND cust_pwd='$encrypted'";
        $result= $this->conn->query($new);
        $total = $result->num_rows;
        $id=0;
        if($total > 0){
        $data= $result->fetch_assoc();
        $id = $data['customer_id'];
        //echo '<pre>';
       // print_r($data);
        //echo '</pre>';
        }
        return $id;
    }
    public function cancel_order($id){
        //write the query
        $q="UPDATE customer_orders  SET ord_status ='cancelled' WHERE ord_status='pending' 
        AND order_id = '$id'";
        $result= $this->conn->query($q);
        
    }
    public function update_profile($postarray,$id){
        // $postarray is the variable for $_POST used to call $_POST from here.
        $fname =trim(strip_tags($postarray['fname']));
        $lname =trim(strip_tags($postarray['lname']));
        $phone =trim(strip_tags($postarray['phone']));
        $gender =trim(strip_tags($postarray['gender']));
        $address =trim(strip_tags($postarray['address']));
    
    $q="UPDATE customers set customer_fname='$fname', 
    customer_lname='$lname', cust_contact='$phone', gender='$gender',cust_address='$address'
        where customer_id='$id'";
        //  echo $q;
        //  die();
    $this->conn->query($q);
    header('location:profile.php');
    if(!empty($postarray['pwd1'])){
        //If the password does not match the confirm password
        $result=['status'=>false, 'msg'=>'']; 
        if($postarray['pwd1'] != $postarray['pwd2']){
            $result['status']=false;
            $result['msg']="Your new password does not match the confirm password";

        }
        //But if it matches
        $new_pwd=md5($postarray['pwd1']);
        $p="UPDATE customers set cust_pwd = '$new_pwd' where customer_id='$id'";
        $this->conn->query($p);
        if($this->conn->error){
            $result['msg']="System error. Please retry";
        
            return $result;
        }
    }   
    }
    public function get_appointment($id){
        //write the query
        $q="SELECT customer_orders.order_id,customer_orders.issues,customer_orders.address,
        customer_orders.request_date,customers.customer_fname,customers.customer_lname,customers.cust_contact 
        FROM customer_orders JOIN customers  ON customer_orders.customer_id = customers.customer_id
        WHERE ord_status='pending' AND customer_orders.customer_id ='$id'";
        $result= $this->conn->query($q);
        $row = array();
        while($data=$result->fetch_assoc()){
            $row[]=$data;
        }
        return $row;
    }
    public function get_completed($id){
        //write the query
        $q="SELECT customer_orders.order_id,customer_orders.issues,customer_orders.address,
        technicians.tech_firstname,technicians.tech_lastname,
        customer_orders.request_date,technicians.tech_contact 
        FROM customer_orders JOIN technicians ON customer_orders.technician_id = technicians.technicians_id 
        WHERE ord_status='completed' AND customer_orders.technician_id ='$id'";
        $result= $this->conn->query($q);
        $row = array();
        while($data=$result->fetch_assoc()){
            $row[]=$data;
        }
        return $row;
    }   

    
    public function register($fname,$lname,$mail,$password,$phone){
        $encrypted=md5($password);
        $str= "INSERT INTO customers SET customer_fname='$fname',customer_lname ='$lname',cust_email='$mail',
        cust_pwd ='$encrypted', cust_contact ='$phone'";
        
        $res=$this->conn->query($str);
        $id=$this->conn->insert_id;
        return $id;
    }

    public function request($issue,$location,$id){
        
        $str= "INSERT INTO customer_orders SET issues ='$issue', address ='$location', customer_id = '$id'";
        
        $res=$this->conn->query($str);
        $id=$this->conn->insert_id;
        return $id;
    }
    public function logout(){
        session_destroy();
        session_unset();
        header('location:index.php');
    }
    function get_details($custid){
        //$q ="SELECT * FROM customers   WHERE customer_id ='$custid'";
        $q="SELECT * FROM customers JOIN customer_orders
         ON customers.customer_id=customer_orders.customer_id WHERE customers.customer_id ='$custid'";
        //$q = "SELECT * FROM customers JOIN customer_orders ON customers.order_id
        // = customer_orders.order_id  WHERE customers.customer_id ='$custid'";
        $result = $this->conn->query($q);
        //$t=$result->num_row; no need cos it wont return empty data regardless.
        $data = $result->fetch_assoc();
        return $data;
        
    }
    
    //when u do a print_r of $_FILES you get the array locations.
    public function upload($filearray,$id){
        $tmp = $filearray['pic']['tmp_name'] ;// tmp is a temp location
        $type = $filearray['pic']['type'];
        $filename = $filearray['pic']['name'] ;
        
        $ext = pathinfo($filename, PATHINFO_EXTENSION);
        
        $newfilename =time().rand(). ".$ext";//ensure it is double quote
        $destination = "images/$newfilename";
        $size = $filearray['pic']['size'];	
        $response = "";
        //$allowed = array('jpeg','png','gif')
        //if(in_array($ext, $allowed)){}
        //type image not images isnt the destination but the extension or file type or format
        if(strtolower($ext) =='jpeg' || strtolower($ext) =='png' || strtolower($ext)=='gif'){
            //n.b size is measured in bytes
              if($size <= 20000000000){
                  //move file from temporary location to destination
                    move_uploaded_file($tmp, $destination);
                    $q = "UPDATE customers SET cust_avatar_img ='$newfilename' WHERE customer_id='$id'";
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
    function update_user($user_details){
        $result=['status'=>false, 'msg'=>'No update done'];

        //die(print_r($user_details));
       $fname=$user_details['fname'];
       $lname=$user_details['lname'];
       $phone=$user_details['phone'];
       $gender=$user_details['gender'];
       $custid=$user_details['custid'];

       $query="UPDATE customers set customer_fname='$fname', 
       customer_lname='$lname', cust_contact='$phone', gender='$gender'
        where customer_id='$custid'";
        //die($query);
       $res=$this->conn->query($query);
        if($this->conn->error)
        {
            $result['msg']="System Error! Please retry";
            return $result;
        }

        $result['status']=true;
        $result['msg']="Update Successful";

        //Check if he tried to update his password
        if(!empty($user_details['pwd1'])){
            //If the password does not match the confirm password 
            if($user_details['pwd1'] != $user_details['pwd2']){
                $result['status']=false;
                $result['msg']="Your new password does not match the confirm password";

            }
            //But if it matches
            $new_pw=md5($user_details['pwd1']);
            $q="UPDATE customers set cust_pwd = '$new_pw' where customer_id='$custid'";
            $this->conn->query($q);
            if($this->conn->error){
                $result['msg']="System error. Please retry";
            
                return $result;
            }

        }        
        return $result;
    }
}   