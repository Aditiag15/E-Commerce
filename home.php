<html>
    <head>
        <style>
            .pdt-container{
                background-color: bisque;
                display: inline-block;
                margin: 10px;
                padding: 10px;
                width: 300px;
                height: fit-content;
            }
            img{
                width: 100%;
                height: 230px;
            }
            .name{
                font-size: 24px;
                font-weight: bold;
                color: blueviolet;
            }
            .price{
                color: brown;
                font-size: 26px;
            }
            .price::after{
                content="Rs";
                font-size: 16px;
            }
        </style>
    </head>
</html>



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
if($_SESSION["usertype"]!="Customer"){
    echo "Forbidden Access";
    die;
}
include "../shared/connection.php";
include "menu.html";
$sql_result = mysqli_query($conn,"select * from product");

// loop sql_result and fetch 1 dbrow at a time till dbrow is not empty
while($dbrow=mysqli_fetch_assoc($sql_result)){
   echo "<div class='pdt-container'>
            <div class='name'>$dbrow[name]</div>
            <div class='price'>$dbrow[price]</div>
            <img src='$dbrow[impath]'>
            <div class='detail'>$dbrow[detail]</div>
            <div class='d-flex justify-content-center gap-4'>
            <a href='addcart.php?pid=$dbrow[pid]'>
                <button class='btn btn-warning'>Add to Cart</button>
            </a>    
            </div>    
         </div>";
 }

?>

