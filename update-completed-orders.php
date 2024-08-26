<?php
    include 'connect-db.php';
    if($_COOKIE['userPhoneNumber']==""){
        header("location:signin.html");
    }
    $userphoneNumber = $_COOKIE['userPhoneNumber'];
?>
<?php

if(isset($_GET['updateCart'])){
    $updatedCart = $_GET["updateCart"];
    $updateSize = $_GET["updateSize"];
    $Quantity = $_GET["Quantity"];

    $phoneNumber = $_COOKIE["userPhoneNumber"];
}


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
    <title>Update Order</title>
    <style>
        *{
            margin:0;
            padding:0;
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
        .container{
            width: 90%;
            padding:0 5%;
            margin:5% 0;
        }
        .container input{
            margin:10px 0;
            padding:10px 20px;
            border:1px solid lightgray;
            border-radius:50px;
        }
        .container p{
            font-family:"Outfit";
            font-weight:300px;
        }
        .container hr{
            margin:2.5% 0;
        }
        .container button{
            padding:20px 25px;
            width: 200px;
            border:none;
            border-radius:50px;
            font-family:"Outfit";
            color:white;
            font-size:15px;
            cursor: pointer;
        }
        .dimiss{
            background-color:#C7C7C7;
        }
        .svae-changes{
            background-color:#1D1FB8;
            margin:0 10px;
        }
        .Donecontainer{
            width: 100%;
            height:100vh;
            display:flex;
            flex-direction:column;
            justify-content:center;
            align-items:center;
            text-align:center;
        }
        .Donecontainer img{
            height:300px;
            width: auto;
            object-fit:cover;
            margin-left:70px;
            margin-bottom:30px;
        }
        .Donecontainer h1{
            font-size:80px;
            font-family:'josefin sans';
        }
        .Donecontainer p{
            font-size:20px;
            font-family:'Outfit';
        }
        .Donecontainer button{
            font-size:15px;
            font-family:'Outfit';
            padding:15px 20px;
            margin:20px 5px;
            border:none;
            border-radius:50px;
            cursor: pointer;
            transition:0.7s;
        }
        .Donecontainer button:hover{
            padding:15px 30px;
        }
    </style>
</head>
<body>

    <?php
    if(isset($_POST['size'])){
        $size = $_POST['size'];
        $quantity = $_POST['quantity'];
        $quantity = (int)$quantity;
        $OrderName = $_POST['OrderName'];

        $selectPrice = "SELECT price FROM `stock` WHERE orderName='$OrderName'";
        $selectPriceRes = mysqli_query($conn , $selectPrice);

        $priceRow = $selectPriceRes->fetch_assoc();
        $price = $priceRow['price'];
        $price = explode("D" , $price);

        $price = $price[0];
        // converting the price to a float
        $price = (float)$price;
        // calculating the total of the prices
        $newPrice =  $price*$quantity;
        // converting the total price to a string and concat it with "DT"
        $newPrice = (string)$newPrice ." DT";

        $updateRequest = "UPDATE `completed-orders` SET `size`='$size',`quantity`=$quantity, price='$newPrice' WHERE `orderName`= '$OrderName' AND `phoneNumber`= $userphoneNumber";
        $updateOrder = mysqli_query($conn , $updateRequest);

        if($updateOrder){
            echo '
            <div class="Donecontainer">
                <img src="images/done.png">
                <h1>Updated Successfully</h1>
                <p>Your confirmed order have been updated to Size :'.$size.' and quantity :'.$quantity.' </p>
                <nav> <a href="confirmed-orders-display.php"><button>Go back</button></a><a href="store.html"><button style="background-color:#1D1FB8; color:white;">Go Shopping</button></a></nav>
            </div>
            ';
        }else{
            echo '
            <div class="Donecontainer">
                <img src="images/nothing found.png">
                <h1>Something Went Wrong</h1>
                <p>Ysomething went wrong please try again or later we will handle it from here</p>
                <nav> <a href="confirmed-orders-display.php"><button>Go back</button></a><a href="store.html"><button style="background-color:#1D1FB8; color:white;">Go Shopping</button></a></nav>
            </div>
            ';
        }
        
    }
    else{
        echo '
        <div class="div-bar">
            <h1>Update Your Confirmed Orders</h1>
            <p>here where you can Update your confirmed orders and the products that we will deliver to you</p>
        </div>
        <div class="line hidden">
            <nav class="order"><img src="images/' . $updatedCart . '.png"></nav>
            <nav class="orderName"><p>' . $updatedCart . '</p></nav>
            <nav><p>' . $updateSize . '</p></nav>
            <nav><p>' .  $Quantity . '</p></nav>
        </div>
        <hr class="hidden">
        <form action="update-completed-orders.php" method="post" onsubmit="return verif()">
            <div class="container">
                <input type="text" name="OrderName" value="'.$updatedCart.'" style="visibility:hidden;">
                <p>Update Size</p>
                <input type="text" name="size" id="size" value="'.$updateSize.'"><br>
                <p>Update Quantity</p>
                <input type="number" name="quantity" id="quantity"  value="'.$Quantity.'" max="5">
                <hr>
                <a href="confirmed-orders-display.php"><button class="dimiss">Dimiss</button></a>
                <button type="submit" class="svae-changes">Save Changes</button>
            </div>
        </form>
        ';
    }
    ?>

    <script>

        function verif(){
            var size = document.getElementById('size');
            var quantity = document.getElementById('quantity');

            var sizeVal = size.value;
            var quantityVal = quantity.value;
            sizeVal = sizeVal.toUpperCase();
            if(sizeVal==""){
                alert("please write your size!");
                return false;
            }
            if(quantity.value==0){
                alert("please write your quantity!");
                return false;
            }
            if(sizeVal!="XS" && sizeVal!="S" && sizeVal!="M" && sizeVal!="L" && sizeVal!="XL"){
                alert('"'+sizeVal+'" please write your size Between XS / S / M / L / XL Thaks!');
                return false;
            }
        }
    </script>
</body>
</html>