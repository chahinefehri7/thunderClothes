<?php

include "connect-db.php";
?>
<?php


$orderName = $_COOKIE['orderName'];
$orderPrice = $_COOKIE['orderPrice'];
$userPhoneNumber = $_COOKIE['userPhoneNumber'];
if($userPhoneNumber==""){
    header("location:signin.html");
}

$productName = $orderName;
$price = $orderPrice;
$size = $_POST['size'];
$quantity = $_POST['quantity'];

// cutting the actual price to convert it to an integer
$thePrice = $price;
$thePrice = explode("D" , $thePrice);
$thePrice = $thePrice[0];
// converting the price to a float
$thePrice = (float)$thePrice;
// calculating the total of the price
$totalPrice = $thePrice*$quantity;
// converting the total price to a string the concat with "DT"
$totalPrice = (string)$totalPrice ." DT";

$req1 = "SELECT * FROM `clients` WHERE phoneNumber=$userPhoneNumber";
$res1 = mysqli_query($conn,$req1);

$rows = $res1->fetch_assoc();
$name = $rows["name"];
$lastName = $rows["lastName"];
$adresse = $rows["adresse"];
$email = $rows["Email"];
$phoneNumber = $rows["phoneNumber"];
$date = date("Y-m-d");

$req2 = ("INSERT INTO `orders`  values('$name','$lastName','$adresse','$email',$phoneNumber,'$productName','$size',$quantity,'$totalPrice','$date')");
$res2 = mysqli_query($conn,$req2);

header("location: store.html")
?>