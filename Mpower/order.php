<?php //data.php
require_once("../script/config.php"); 



$fname       = $_POST['firstname'];
$lname       = $_POST['lastname'];	
$email       = $_POST['email'];
$telephone        = $_POST['telephone'];
$address    = $_POST['address'];
$city   = $_POST['city'];
$pcode       = $_POST['postcode'];
$country       = $_POST['country'];	
$state       = $_POST['state'];
$dfirstname        = $_POST['d_firstname'];
$dlastname    = $_POST['d_lastname'];
$demail  = $_POST['d_email'];
$dtelephone       = $_POST['d_telephone'];
$daddress       = $_POST['d_address'];	
$dcity      = $_POST['d_city'];
$dcountry       = $_POST['d_country'];
$dpostcode    = $_POST['d_postcode'];
$dstate  = $_POST['d_state'];
$paymentmethod = $_post['payment_method'];
$paymentstatus  =$_POST['payment_status'];




$sql="INSERT INTO `order`(`firstname`, `lastname`, `email`, `telephone`, `address`, `city`, `postcode`, `country`, `state`, `d_firstname`, `d_lastname`, `d_email`, `d_telephone`, `d_address`, `d_city`, `d_country`, `d_postcode`, `d_state`, `payment_method`, `payment_status`) VALUES  ('$fname', '$lname ', '$email','$telephone ','$address','$city','$pcode','$country','$state','$dfirstname','$dlastname','$demail','$dtelephone','$daddress','$dcity','$dcountry','$dpostcode','$dstate','$paymentmethod','$paymentstatus')";
$result = mysql_query($sql); 

// if successfully insert data into database, displays message "Successful".
if($result){
header('Location: payments.php');
}
else {
echo "ERROR";
}

// close mysql
mysql_close();
?> 