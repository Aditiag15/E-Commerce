<?php
echo "works";
session_start();
if (!isset($_SESSION["login_status"])) {
    echo "Login is Skipped";
    die;
}
if ($_SESSION["login_status"] == false) {
    echo "Unauthorized Attempt";
    die;
}

include "../shared/connection.php";
include "menu.html";

$sql_result = mysqli_query($conn, "SELECT cart.*, product.* FROM cart JOIN product ON cart.pid=product.pid WHERE cart.userid=$_SESSION[userid]");

if (!$sql_result) {
    die('Could not select data');
}

// Initialize $arr as an empty array
$arr = [];
while ($row = mysqli_fetch_assoc($sql_result)) {
    $arr[] = $row; // Add each row to the $arr array
}

mysqli_close($conn);
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Orders</title>
    <link rel="icon" href="image/fevicon.png">
    <link href="https://fonts.googleapis.com/css?family=Noto+Sans|Roboto:400,900" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="css/style.css">

    <style>
        .pdt-container{
            padding: 20px;
        }
        .order_table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        .order_table th, .order_table td {
            border: 1px solid #ddd;
            padding: 8px;
        }

        .order_table th {
            background-color: #f4f4f4;
            text-align: left;
        }

        .order_table img {
            max-width: 100px; /* Adjust size as needed */
            height: auto;
        }
    </style>
</head>
<body>

<div class="inner_cont2">
    <div class="container">
        <table class="order_table">
            <thead>
                <tr>
                    <th>Image</th>
                    <th>Product Name</th>
                    <th>Title</th>
                    <th>Price</th>
                    <th>Quantity</th>
                </tr>
            </thead>
            <tbody>
             <td>
            <?php
                // $conn=new mysqli("localhost","root","","acme24_jun","3306");
                include "../shared/connection.php";
                $sql_result = mysqli_query($conn,"select * from product where owner=$_SESSION[userid]");

                // loop sql_result and fetch 1 dbrow at a time till dbrow is not empty
                while($dbrow=mysqli_fetch_assoc($sql_result)){
                echo "<div class='pdt-container'>
                      <img src='$dbrow[impath]'>
                        </div>";
                }
                ?>
                </td>
             <td>
            <?php
                // $conn=new mysqli("localhost","root","","acme24_jun","3306");
                include "../shared/connection.php";
                $sql_result = mysqli_query($conn,"select * from product where owner=$_SESSION[userid]");

                // loop sql_result and fetch 1 dbrow at a time till dbrow is not empty
                while($dbrow=mysqli_fetch_assoc($sql_result)){
                echo "<div class='pdt-container'>
                            <div class='name'>$dbrow[name]</div> 
                        </div>";
                }
                ?>
                </td>
             <td>
                <?php
                // $conn=new mysqli("localhost","root","","acme24_jun","3306");
                include "../shared/connection.php";
                $sql_result = mysqli_query($conn,"select * from product where owner=$_SESSION[userid]");

                // loop sql_result and fetch 1 dbrow at a time till dbrow is not empty
                while($dbrow=mysqli_fetch_assoc($sql_result)){
                echo "<div class='pdt-container'>
                <div class='detail'>$dbrow[detail]</div>
                        </div>";
                }
                ?>
             </td>
             <td>
                <?php
                // $conn=new mysqli("localhost","root","","acme24_jun","3306");
                include "../shared/connection.php";
                $sql_result = mysqli_query($conn,"select * from product where owner=$_SESSION[userid]");

                // loop sql_result and fetch 1 dbrow at a time till dbrow is not empty
                while($dbrow=mysqli_fetch_assoc($sql_result)){
                echo "<div class='pdt-container'>
                <div class='price'>$dbrow[price]</div>
                        </div>";
                }
                ?>
             </td>
             <td>
             <?php echo htmlspecialchars($prodd['qty'] ?? 1); ?>
             </td>
            </tbody>
        </table>
    </div>
 </div>

</body>
</html>
  