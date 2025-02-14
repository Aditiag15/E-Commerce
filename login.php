<?php
session_start();
$_SESSION['login_status']=false;
// $conn = new mysqli("localhost" , "root" , "" , "acme24_jun",3306);
include "connection.php";
$sql_result = mysqli_query($conn , "select * from user where username='$_POST[username]' and password ='$_POST[password]' and active_status=1");

// print_r($sql_result);
if($sql_result->num_rows==0){
    echo "Invalid Credentials";
    die;
}

echo "Login Success!<br>";
$dbrow = mysqli_fetch_assoc($sql_result);
print_r($dbrow);

$_SESSION['login_status']=true;
$_SESSION['userid']=$dbrow['userid'];
$_SESSION['username']=$dbrow['username'];
$_SESSION['usertype']=$dbrow['usertype'];

if($dbrow['usertype']=='Vendor'){
    header("location:../vendor/home.php");
}
else if($dbrow['usertype']=='Customer'){
    header("location:../customer/home.php");
}

?>