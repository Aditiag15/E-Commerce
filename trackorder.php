<?php
session_start();
if (!isset($_SESSION["login_status"])) {
    echo "Login is Skipped";
    die;
}
if ($_SESSION["login_status"] == false) {
    echo "Unauthorized Attempt";
    die;
}
if ($_SESSION["usertype"] != "Customer") {
    echo "Forbidden Access";
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
        <div style="font-family: 'Roboto', sans-serif; color: rgba(0,0,0,0.7); font-weight: 700; font-size: 15pt">My Orders</div><br><br>
        <table class="order_table">
            <thead>
                <tr>
                    <th>Image</th>
                    <th>Title</th>
                    <th>Price</th>
                    <th>Quantity</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($arr)) { ?>
                    <?php foreach ($arr as $prodd) { ?>
                        <tr>
                            <td>
                                <?php
                                       include "../shared/connection.php";
                                        $sql_result = mysqli_query($conn,"select * from cart join product on cart.pid=product.pid where cart.userid=$_SESSION[userid]");
                                        while($dbrow=mysqli_fetch_assoc($sql_result)){
                                          echo "<img  src='$dbrow[impath]'>";
                                     }
                                ?>
                            </td>



                            <td><?php echo htmlspecialchars($prodd['detail'] ?? 'No Title'); ?></td>
                            <td>Rs. <?php echo number_format($prodd['price'] ?? 0, 2); ?></td>
                            <td><?php echo htmlspecialchars($prodd['qty'] ?? 1); ?></td>
                            <td>
                                <?php
                                $status = $prodd['status'] ?? 0;
                                switch ($status) {
                                    case 0:
                                        echo 'Processing';
                                        break;
                                    case 1:
                                        echo 'Shipped';
                                        break;
                                    case 2:
                                        echo 'Delivered';
                                        break;
                                    default:
                                        echo 'Unknown Status';
                                }
                                ?>
                            </td>
                        </tr>
                    <?php } ?>
                <?php } else { ?>
                    <tr>
                        <td colspan="6" style="text-align: center;">No orders found.</td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
 </div>

</body>
</html>
