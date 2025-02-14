<?php
 
$uname=$_POST['username'];
$upass=$_POST['password'];
$utype=$_POST['usertype'];

// $conn = new mysqli("hostname" , "username" , "password" , "database name",port);
// connecting database with backend
// $conn = new mysqli("localhost" , "root" , "" , "acme24_jun",3306);
include "connection.php";
$sql_status = mysqli_query( $conn, "insert into user (username,password,usertype) values('$uname','$upass','$utype')");

if($sql_status){
    echo "Signup is successful";
}
else{
    echo "Error while inserting:";
    echo mysqli_error($conn);
}

?>