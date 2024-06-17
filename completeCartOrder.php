<?php

include 'connect-db.php';
if($_COOKIE['userPhoneNumber']==""){
    header("location:signin.html");
}
$userphoneNumber = $_COOKIE['userPhoneNumber'];
$findUserRq = "SELECT * FROM `clients` WHERE phoneNumber=$userphoneNumber";
$findUserResult = mysqli_query($conn,$findUserRq);
if(mysqli_num_rows($findUserResult)<1){
    setcookie("userPhoneNumber" , "");
    header("location:userNotFound.html");
}
$req = ("SELECT * FROM `orders` WHERE phoneNumber = $userphoneNumber");
$res = mysqli_query($conn , $req);

$reqName = ("SELECT `name` FROM `clients` WHERE phoneNumber = $userphoneNumber");
$resName = mysqli_query($conn , $reqName);

while($order=$res->fetch_assoc()){
    $name = $order["name"];
    $lastName = $order["lastName"];
    $adress = $order["adresse"];
    $email = $order["Email"];
    $productName = $order["orderName"];
    $size = $order["size"];
    $quantity = $order["quantity"];
    $price = $order["price"];
    $date = $order["date"];
    $confirmReq = "INSERT INTO `confirmedorders` values(`$name`,`$lastName`,`$adress`,`$email`,`$userphoneNumber`,`$productName`,`$size`,$quantity,`$price`,`$date`)";
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
    <link rel="shortcut icon" type="x-icon" href="images/logo.png">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Bungee&family=Cinzel:wght@400..900&family=Dancing+Script:wght@400..700&family=Danfo&family=EB+Garamond:ital,wght@0,400..800;1,400..800&family=Josefin+Sans:ital,wght@0,100..700;1,100..700&family=Lora:ital,wght@0,400..700;1,400..700&family=Open+Sans:ital,wght@0,300..800;1,300..800&family=Orelega+One&family=Oswald:wght@200..700&family=Outfit:wght@100..900&family=PT+Serif:ital,wght@0,400;0,700;1,400;1,700&family=Playfair+Display:ital,wght@0,400..900;1,400..900&family=Prompt:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Raleway:ital,wght@0,100..900;1,100..900&family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&family=Sacramento&family=Sedan+SC&family=Tajawal:wght@200;300;400;500;700;800;900&family=Yatra+One&display=swap" rel="stylesheet">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Confirmed Success</title>
    <style>
        *{
            padding:0;
            margin:0;
        }
        @font-face {
            font-family: 'helvetica';
            src: url(fonts/Helvetica-Bold.ttf);
        }
        .thanks-for-your-order{
            width: 90%;
            height:70vh;
            padding:5%;
            display:flex;
            flex-direction:column;
            justify-content:center;
            align-items:center;
        }
        .thanks-for-your-order h1{
            font-family:'helvetica';
            font-size:60px;
            font-weight:bold;
        }
        .thanks-for-your-order p{
            font-family:'Outfit';
            font-size:15px;
            font-weight:400px;
        }
        .thanks-for-your-order a{
            width:100%;
            text-decoration:none;
            text-align:center;
            display:flex;
            justify-content:center;
            align-items:center;
        }
        .thanks-for-your-order button{
            font-family:"outfit";
            padding:15px 20px;
            border-radius:50px;
            background-color:#1D1FB8;
            color: #F1F1F1;
            border:none;
            margin:10px 0;
            cursor: pointer;
            transition:0.7s;
            display:flex;
            justify-content:center;
            align-items:center;
        }
        .thanks-for-your-order button:hover{
            background-color:#C1C1C1;
        }
        .thanks-for-your-order img{
            width: 25%;
            height:auto;
        }
    </style>
</head>
<body>
    <?php
    $req2 = ("SELECT * FROM `orders` WHERE phoneNumber = $userphoneNumber");
    $res2 = mysqli_query($conn , $req2);
    $order=$res2->fetch_assoc();
        echo "
        <div class='thanks-for-your-order'>
            <a href='aroundTheWorld.html'><img src='images/aroundtheworldicon.png'></a>
            <h1>Thanks For Your services!<h1>
            <p>Thanks ".$order['name']." for your services, the products that you ordered will be with you after six days or less.</p>
            <a href='aroundTheWorld.html'><button>A Trip Around The World</button></a>
        </div>
        ";
    ?>
</body>
</html>