<html>
    <head>
        <style>
            .pdt-container{
                background-color: bisque;
                display: inline-block;
                margin: 10px;
                padding: 10px;
                width: 300px;
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
            
            .price:after{
                content: "Rs";
                font-size: 16px;
            }
        </style>
    </head>
</html>


<?php
include "menu.html";
// $conn=new mysqli("localhost","root","","acme24_jun","3306");
include "../shared/connection.php";

session_start();
$sql_result = mysqli_query($conn,"select * from product where owner=$_SESSION[userid]");

// loop sql_result and fetch 1 dbrow at a time till dbrow is not empty
while($dbrow=mysqli_fetch_assoc($sql_result)){
   echo "<div class='pdt-container'>
            <div class='name'>$dbrow[name]</div>
            <div class='price'>$dbrow[price]</div>
            <img src='$dbrow[impath]'>
            <div class='detail'>$dbrow[detail]</div>
            <div class='d-flex justify-content-center gap-4'>
                <button class='btn btn-warning'>Edit</button>
                <button class='btn btn-danger'>Delete</button>
            </div>    
         </div>";
 }
?>