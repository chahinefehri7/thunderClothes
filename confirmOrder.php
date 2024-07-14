<?php

include "connect-db.php";




if (isset($_GET["userPhoneNumber"])){
    $userPhoneNumber = $_GET["userPhoneNumber"];

    $req = "SELECT * FROM `orders` WHERE phoneNumber=$userPhoneNumber";
    $res = mysqli_query($conn,$req);

    // $rows = $res->fetch_assoc();
    // $fullUserName = $rows['name'] ." ".$rows['lastName'];
    // $req2 = "SELECT * FROM `cardscollection` WHERE ownerPhoneNumber=$userPhoneNumber and cardName='$cardName'";
    // $res2 = mysqli_query($conn,$req2);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" type="x-icon" href="images/logo.png">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Bungee&family=Cinzel:wght@400..900&family=Dancing+Script:wght@400..700&family=Danfo&family=EB+Garamond:ital,wght@0,400..800;1,400..800&family=Josefin+Sans:ital,wght@0,100..700;1,100..700&family=Lora:ital,wght@0,400..700;1,400..700&family=Open+Sans:ital,wght@0,300..800;1,300..800&family=Orelega+One&family=Oswald:wght@200..700&family=Outfit:wght@100..900&family=PT+Serif:ital,wght@0,400;0,700;1,400;1,700&family=Playfair+Display:ital,wght@0,400..900;1,400..900&family=Prompt:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Raleway:ital,wght@0,100..900;1,100..900&family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&family=Sacramento&family=Sedan+SC&family=Tajawal:wght@200;300;400;500;700;800;900&family=Yatra+One&display=swap" rel="stylesheet">
    <title>Complete Order</title>
    <style>
        *{
            margin:0;
            padding:0;
        }
        body{
            background-image: url();
        }
        .nothing-found{
            width: 100%;
            height:100vh;
            display:flex;
            flex-direction:column;
            justify-content:center;
            align-items:center;
            text-align:center;
        }
        .nothing-found img{
            height:300px;
            width: 300px;
            object-fit:cover;
            margin-left:70px;
        }
        .nothing-found h1{
            font-size:80px;
            font-family:'josefin sans';
        }
        .nothing-found p{
            font-size:20px;
            font-family:'Outfit';
        }
        .nothing-found button{
            font-size:15px;
            font-family:'Outfit';
            padding:15px 20px;
            margin:20px 5px;
            border:none;
            border-radius:50px;
            cursor: pointer;
            transition:0.7s;
        }
        .nothing-found button:hover{
            padding:15px 30px;
        }
    </style>
</head>
<body>
    <?php
        if(mysqli_num_rows($res)<1){
            echo '
                <div class="nothing-found">
                    <img src="images/nothing-found.png">
                    <h1>Nothing Found</h1>
                    <p>Your cart is empty go fill it with some art work to wear</p>
                    <nav> <a href="user.php"><button>Go back</button></a><a href="store.html"><button style="background-color:#1D1FB8; color:white;">Go Shopping</button></a></nav>
                </div>
    
            ';
        }else{
            echo 'sahit ya nayek';
        }
    
    ?>
</body>
</html>