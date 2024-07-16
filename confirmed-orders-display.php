<?php
    include 'connect-db.php';
    if($_COOKIE['userPhoneNumber']==""){
        header("location:signin.html");
    }
    $userphoneNumber = $_COOKIE['userPhoneNumber'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Bungee&family=Cinzel:wght@400..900&family=Dancing+Script:wght@400..700&family=Danfo&family=EB+Garamond:ital,wght@0,400..800;1,400..800&family=Josefin+Sans:ital,wght@0,100..700;1,100..700&family=Lora:ital,wght@0,400..700;1,400..700&family=Open+Sans:ital,wght@0,300..800;1,300..800&family=Orelega+One&family=Oswald:wght@200..700&family=Outfit:wght@100..900&family=PT+Serif:ital,wght@0,400;0,700;1,400;1,700&family=Playfair+Display:ital,wght@0,400..900;1,400..900&family=Prompt:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Raleway:ital,wght@0,100..900;1,100..900&family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&family=Sacramento&family=Sedan+SC&family=Tajawal:wght@200;300;400;500;700;800;900&family=Yatra+One&display=swap" rel="stylesheet">
    <link rel="shortcut icon" type="x-icon" href="images/logo.png">
    <title>confirmed orders</title>
    <style>
        *{
            margin:0;
            padding:0;
        }
        .line{
            position: relative;
            width: 100%;
            height: fit-content;
            display: flex;
            flex-direction: row;
            font-family: 'Josefin Sans';
            justify-content: space-evenly;
            align-items: center;
            margin: 30px 0;
        }
        .line nav h4{
            font-size: 18px;
        }
        .line nav p{
            width: 120px;
            height: 26px;
            max-width: 120px;
            overflow-x: hidden;
            overflow-x: scroll;
            font-family: prompt;
            /* max-width: 80px; */
        }
        .line nav p::-webkit-scrollbar{
            visibility: hidden;
            width: 1px;
            height: 2px;
            border-radius: 10px;
            background-color: lightgray;
        }
        .line img{
            width: 100px;
            height: 100px;
            cursor: pointer;
        }
        .delete{
            position:relative;
            width: 50px;
            height: 50px;
            background-color: red;
            border: none;
            border-radius: 10px;
            cursor: pointer;
        }
        .delete img{
            width:20px;
            height: 20px;
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50% , -50%);
        }
        header{
            width: 100%;
            height:100px;
            display:flex;
            justify-content:center;
            align-items:center;
            border-bottom:1px solid lightgray;
        }
        .title{
            font-family: 'Gabarito';
            font-family:arial;
        }
        .div-bar{
            width: 90%;
            height:fit-content;
            margin: 5%;
        }
        .div-bar h1{
            font-family:'josefin sans';
        }
        .div-bar p{
            font-family:outfit;
        }
        a{
            text-decoration:none;
            color:black;
        }
        .back{
            width: 30px;
            height:auto;
            position:absolute;
            top:5%;
            left:5%;
        }
        @media (max-width:600px) {
            .line{
                flex-direction: column;
                text-align: center;
                width: 100%;
            }
        }
    </style>
</head>
<body>
    <header>
        <a href="user.php"><h2><l class="title">Thunder</l><i>Clothes</i></h2></a>
    </header>
    <div class="div-bar">
        <h1>Your Confirmed Orders</h1>
        <p>here where you can find your confirmed orders and the products that we will deliver to you</p>
    </div>
    <a href="user.php"><img src="images/home.png" alt="back" class="back"></a>
    <?php

        $reqt = ("SELECT * FROM `completed-orders` WHERE phoneNumber = $userphoneNumber");
        $reslt = mysqli_query($conn , $reqt);

        $id = 0;
        while($rows = $reslt->fetch_assoc()){
            echo '
            <div class="line hidden" id="' . $id . '">
                <nav class="order"><img src="images/' . $rows["orderName"] . '.png"></nav>
                <nav class="orderName"><p>' . $rows["orderName"] . '</p></nav>
                <nav><p>' . $rows["size"] . '</p></nav>
                <nav><p>' .  $rows["quantity"] . '</p></nav>
                <nav><p>' . $rows["price"] . '</p></nav>
                <nav class="delete"><a href="deleteConfirmedOrder.php?deletedCart='. $rows["orderName"] . '&deletesize='. $rows["size"] . '&Quantity=' .$rows["quantity"]. '"><img src="images/delete.png"></a></nav>
            </div>
            <hr class="hidden">
            ';
            $id = $id+1;
        }
    ?>
</body>
</html>