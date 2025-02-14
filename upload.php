<?php
session_start();
$source_path=$_FILES['pdtimg']['tmp_name'];
$target_path="../shared/images/".$_FILES['pdtimg']['name'];

move_uploaded_file($source_path,$target_path);

$conn=new mysqli("localhost","root","","acme24_jun","3306");
include "../shared/connection.php";
$query="insert into product (name,price,detail,impath,owner) values('$_POST[name]',$_POST[price],'$_POST[detail]','$target_path',$_SESSION[userid])";
echo $query;

mysqli_query($conn,$query);
?>