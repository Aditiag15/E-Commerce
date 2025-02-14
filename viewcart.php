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
$sql_result = mysqli_query($conn,"select * from cart join product on cart.pid=product.pid where cart.userid=$_SESSION[userid]");
$total=0;
// loop sql_result and fetch 1 dbrow at a time till dbrow is not empty
while($dbrow=mysqli_fetch_assoc($sql_result)){
    $total+=$dbrow['price'];
   echo "<div class='pdt-container'>
            <div class='name'>$dbrow[name]</div>
            <div class='price'>$dbrow[price]</div>
            <img src='$dbrow[impath]'>
            <div class='detail'>$dbrow[detail]</div>
            <div class='d-flex justify-content-center gap-4'>
            <a href='deletecart.php?cartid=$dbrow[cartid]'>
                <button class='btn btn-warning'>Remove From Cart</button>
            </a>    
            </div>    
         </div>";
 }

 echo "<div class='display-2 m-2'>
            <a href='../../vendor/vieworder.php?userid=<?php echo $_SESSION[userid]; ?>'>
            <button class='btn btn-danger'>Next</button>
            </a>
 
       </div>" ;
?>
