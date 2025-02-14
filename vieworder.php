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
            
            
         </div>";
 }


?>

<!DOCTYPE html>
<html>
<head>
	<title>Bag</title>
	<meta charset="UTF-8">
	<link rel="icon" href="image/fevicon.png">
	<link href="https://fonts.googleapis.com/css?family=Noto+Sans|Roboto:400,900" rel="stylesheet">
	<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="css/font-awesome.min.css">
	<link rel="stylesheet" type="text/css" href="css/style.css">

	<style type="text/css">
		
    .prod_box{
      border: 2px solid black;
      min-height: 170px;
      max-height: 170px;
      min-width: 650px;
      max-width: 650px;
      border: 1px solid rgba(0,0,0,0.1);
    }

    .price_box{
      min-width: 300px;
      max-width: 300px;
      min-height: 320px;
      border: 1px solid rgba(0,0,0,0.1);
    }
	</style>
</head>
<body>
    <div class="inner_cont2">
    <div class="container">
      <div style="font-family: 'Roboto', sans-serif; color: rgba(0,0,0,0.7); font-weight: 700; font-size: 15pt">My Shopping Bag</div><br><br>
      <div class="row">
        <div class="col-8">
          <?php
          $arr=[];
          foreach ($arr as $prodd) {
            $total = $total+($prodd["price"]*$prodd["qty"]);
            echo '<div class="prod_box">
            <div style="min-width: 120px; max-width: 120px; min-height: 100px; max-height: 100px; background: url(prod/'.$prodd["image"].'); background-position: center; display: inline-block; float: left; margin-right: 20px;"></div>

            <div style="font-weight: 700; color: rgba(0,0,0,0.7); padding-bottom: 10px; font-size: 10pt; padding-top: 10px">'.$prodd["title"].'</div>
            <div style="font-weight: 700; color: rgba(0,0,0,0.7); padding-bottom: 15px; font-size: 10pt">Rs. '.$prodd["price"].'</div>
            <div style="font-size: 10pt; padding-bottom: 10px">Size: '.$prodd["size"].' &nbsp &nbsp Quantity: '.$prodd["qty"].'</div><hr>
            <div style="font-size: 10pt; font-weight: 700"><a href="remove_item_bag.php?user='.$curr_user.'&item='.$prodd["prod_id"].'">REMOVE</a></div>
          </div><br>';
          }
          $tax =round((0.06*$total));
          $_SESSION["total_cost"]=$total+$tax;
          if($_SESSION["total_cost"]==0){
            echo "<center><img src='image/empty_cart.png' style='transform:scale(0.5)'><br><h2>The Bag is Empty</h2></center>";
          }
          ?>
        </div>
        <div class="col-4">          
          <div class="price_box" style="padding: 10px; padding-top: 10px;">            
            <div style="font-family: 'Roboto', sans-serif; color: rgba(0,0,0,0.5); font-weight: 700; font-size: 10pt">PRICE DETAILS</div>
            <br>
            <table cellpadding="0" cellspacing="0" width="95%" textalign="center" style="font-family: 'Roboto', sans-serif; color: rgba(0,0,0,0.5); font-weight: 400; font-size: 10pt; min-height: 130px"> 
              <tr>
                <td>Bag Total</td><td textalign="right">Rs. <?php echo $total;?></td>
              </tr>
              <tr>
                <td>Estimated tax</td><td textalign="right">Rs. <?php                
                echo $tax;
                ?></td>
              </tr>
              <tr>
                <td>Delivery <br><br></td><td textalign="right" style="color: green">FREE<br><br></td>
              </tr>
              <tr style="border-top: 1px solid rgba(0,0,0,0.1); font-weight: 700;">
                <td>Order Total</td><td textalign="right">Rs. <?php
                 echo $total+$tax;                    
                ?></td>
              </tr>
            </table>
            <br><br>
            <?php 
              if($_SESSION["total_cost"]!=0){
                echo '<a href="../../customer/index.php" style="text-decoration: none;"><div class="order_button" style="background: #2cd2b1; color: #fff; text-align: center; padding-top: 10px; padding-bottom: 10px; border-radius: 5px; box-shadow: 0px 10px 25px 1px rgba(0,0,0,0.1)">PLACE ORDER</div></a>';
              }
            ?>
            </div>

        </div>
      </div>

    </div>
    </div>
</body>
</html>