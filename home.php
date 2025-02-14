<?php
session_start();
if(!isset($_SESSION["login_status"])){
    echo "Login is Skipped";
    die;
}
if($_SESSION["login_status"]==false){
    echo "Unauthorized Attempt";
    die;
}
if($_SESSION["usertype"]!="Vendor"){
    echo "Forbidden Access";
    die;
}
include "menu.html";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body>
    <div class="d-flex justify-content-center align-items-center vh-100">
        <form class="w-50 bg-warning p-3" action="upload.php" method="post" enctype="multipart/form-data">
            <input class="form-control mt-3" type="text" placeholder="Product name" name="name">
            <input class="form-control mt-2" type="number" placeholder="Product price" name="price">
            <textarea class="form-control mt-2" name="detail" cols="30" rows="5" placeholder="Product Description"></textarea>
            <input class="form-control mt-2" type="file" accept=".jpg , .png" name="pdtimg">

            <div class="mt-3 text-center">
                <button class="btn btn-success">Upload Product</button>
            </div>
        </form>
    </div>
</html>