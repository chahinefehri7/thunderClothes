<?php

include "connect-db.php";


if(isset($_GET['deletedCart'])){
    $deletedCart = $_GET["deletedCart"];
    $deleteSize = $_GET["deletesize"];
    $deleteQuantity = $_GET["Quantity"];

    $phoneNumber = $_COOKIE["userPhoneNumber"];
    $req = "DELETE FROM `completed-orders` WHERE orderName ='$deletedCart' AND size= '$deleteSize' AND quantity=$deleteQuantity";
    $res = mysqli_query($conn , $req);

    // echo "Name : ". $deletedCart ." size : " . $deleteSize . " quantity : " . $deleteQuantity;
    header("location: confirmed-orders-display.php");

}

?>