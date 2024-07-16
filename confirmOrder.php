<?php

include "connect-db.php";




if (isset($_GET["userPhoneNumber"])){
    $userPhoneNumber = $_GET["userPhoneNumber"];
    $req = "SELECT * FROM `orders` WHERE phoneNumber=$userPhoneNumber";
    $res = mysqli_query($conn,$req);
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
        .container{
            width: 100%;
            height:100vh;
            display:flex;
            flex-direction:column;
            justify-content:center;
            align-items:center;
            text-align:center;
        }
        .container img{
            height:300px;
            width: auto;
            object-fit:cover;
            margin-left:70px;
            margin-bottom:30px;
        }
        .container h1{
            font-size:80px;
            font-family:'josefin sans';
        }
        .container p{
            font-size:20px;
            font-family:'Outfit';
        }
        .container button{
            font-size:15px;
            font-family:'Outfit';
            padding:15px 20px;
            margin:20px 5px;
            border:none;
            border-radius:50px;
            cursor: pointer;
            transition:0.7s;
        }
        .container button:hover{
            padding:15px 30px;
        }
    </style>
</head>
<body>
    <?php
        if(mysqli_num_rows($res)<1){
            echo '
                <div class="container">
                    <img src="images/nothing-found.png">
                    <h1>Nothing Found</h1>
                    <p>Your cart is empty go fill it with some art work to wear</p>
                    <nav> <a href="user.php"><button>Go back</button></a><a href="store.html"><button style="background-color:#1D1FB8; color:white;">Go Shopping</button></a></nav>
                </div>
    
            ';
        }else{

            // selecting everything from orders cart
            $reqCart = ("SELECT * FROM `orders` WHERE phoneNumber = $userPhoneNumber");
            $resCart = mysqli_query($conn , $req);


            while($cartRows = $resCart->fetch_assoc()){
                $cartOrderName = $cartRows['orderName'];
                $cartOrderSize = $cartRows['size'];
                // selecting everything from the confirmed orders
                $reqConfirmedOrders = ("SELECT * FROM `completed-orders` WHERE phoneNumber = $userPhoneNumber AND orderName='$cartOrderName' AND size='$cartOrderSize'");
                $resConfirmedOrders = mysqli_query($conn , $reqConfirmedOrders);
                //taking the number of rows to count on
                $rowsNumber = mysqli_num_rows($resConfirmedOrders);
                if($rowsNumber>0){
                    $confirmedRows = $resConfirmedOrders->fetch_assoc();
                    $confirmedOrderName = $confirmedRows['orderName'];
                    $confirmedOrderSize = $confirmedRows['size'];

                    //cart orders price and quantity
                    $cartOrderQuantity = $cartRows['quantity'];
                    $cartOrderPrice = $cartRows['price'];
                    // confirmed order price and quantity
                    $confirmedOrderQuantity = $confirmedRows['quantity'];
                    $confirmedOrderPrice = $confirmedRows['price'];
                    
                    // updating the price and quantity of the repetetive cart order
                    
                    $newConfirmedOrderQuantity = $cartOrderQuantity+$confirmedOrderQuantity;//updating quantity

                    //updating price
                    // cutting the actual price to convert it into a float number
                    $theConfirmedPrice = explode("D" , $confirmedOrderPrice);
                    $theCartPrice = explode("D" , $cartOrderPrice);

                    $theConfirmedPrice = $theConfirmedPrice[0];
                    $theCartPrice = $theCartPrice[0];
                    // converting the price to a float
                    $theConfirmedPrice = (float)$theConfirmedPrice;
                    $theCartPrice = (float)$theCartPrice;

                    // calculating the total of the prices
                    $newConfirmedOrderPrice = $theConfirmedPrice+$theCartPrice;
                    // converting the total price to a string and concat it with "DT"
                    $newConfirmedOrderPrice = (string)$newConfirmedOrderPrice ." DT";

                    //setting a new date
                    $date = date("Y-m-d");

                    //updating the confirmed orders
                    $reqUpdate = ("UPDATE `completed-orders` SET `quantity`=".$newConfirmedOrderQuantity.",`price`='".$newConfirmedOrderPrice."',`date`='".$date."' WHERE phoneNumber=".$userPhoneNumber." and `orderName`='".$confirmedOrderName."' and `size`='".$confirmedOrderSize."'");
                    $resUpdate = mysqli_query($conn , $reqUpdate);
                }else{
                    $cartOrderQuantity = $cartRows['quantity'];
                    $cartOrderPrice = $cartRows['price'];
                    $name = $cartRows['name'];
                    $lastName = $cartRows['lastName'];
                    $adresse = $cartRows['adresse'];
                    $phoneNumber = $cartRows['phoneNumber'];
                    // date
                    $date = date("Y-m-d");

                    // inserting orders into confirmed orders
                    $reqInserting = "INSERT INTO `completed-orders` (name,lastName,adresse,phoneNumber,orderName,size,quantity,price,date) 
                    values('$name','$lastName','$adresse',$phoneNumber,'$cartOrderName','$cartOrderSize',$cartOrderQuantity,'$cartOrderPrice' ,'$date')";
                    $Insertingresult = mysqli_query($conn , $reqInserting);
                }
            }

            // deleting orders from the cart after moving them to the confirmed orders
            $reqDeleteOrders = "DELETE FROM `orders` WHERE phoneNumber=$userPhoneNumber";
            $resultDeleteOrders = mysqli_query($conn , $reqDeleteOrders);


            echo '
            <div class="container">
                <img src="images/done.png">
                <h1>Thanks For Shopping</h1>
                <p>Thanks for shopping, happy that you helped spreading artistic wok <br> to the world</p>
                <nav> <a href="user.php"><button>Go back</button></a><a href="store.html"><button style="background-color:#1D1FB8; color:white;">Go Shopping</button></a></nav>
            </div>

        ';
        }
    
    ?>
</body>
</html>