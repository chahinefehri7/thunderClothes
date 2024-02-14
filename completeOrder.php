<?php
include "connect-db.php";

$orderName = $_COOKIE['orderName'];
$orderPrice = $_COOKIE['orderPrice'];
$size = $_COOKIE['size'];
$quantity = $_COOKIE['quantity'];

$name = $_POST["name"];
$lastName = $_POST["lastName"];
$adresse = $_POST["adresse"];
$phoneNumber = $_POST["phoneNumber"];
$date = date("Y-m-d");

// converting the total price to a string the concat with "DT"
$orderPrice = (string)$orderPrice ." DT";

$req = "INSERT INTO `orders` (name,lastName,adresse,phoneNumber,orderName,size,quantity,price,date) values('$name','$lastName','$adresse',$phoneNumber,'$orderName','$size',$quantity,'$orderPrice' ,'$date')";
$result = mysqli_query($conn , $req);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Abril+Fatface&family=DM+Serif+Display&family=Dela+Gothic+One&family=Gabarito:wght@400;500;900&family=Josefin+Sans:wght@200;300;400;500;600;700&family=Libre+Bodoni&family=Montserrat:wght@400;600;700;800;900&family=Noto+Serif+Display:ital,wght@0,100;0,700;0,800;0,900;1,900&family=Orelega+One&family=Outfit:wght@100;200;300;400;500;700;800;900&family=Oxygen&family=Pacifico&family=Pixelify+Sans:wght@400;500;700&family=Playfair+Display:ital,wght@0,800;1,400;1,500;1,800&family=Poppins:wght@200;500;800;900&family=Prompt:wght@200;300;500;600;700;800;900&family=Roboto&family=Sacramento&family=Sono:wght@400;500&family=Young+Serif&display=swap" rel="stylesheet">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thanks</title>
    <style>
        *{
            margin: 0;
            padding: 0;
        }
        body{
            background-image: url(images/cardborder.png);
            background-position: center;
            background-size: fill;
        }
        .container{
            width: 100%;
            height: 100vh;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            text-align: center;
        }
        .container h1{
            font-family: "josefin sans";
            font-size: 60px;
            margin: 5px 0;
        }
        .container p{
            width: 70%;
            font-family: 'Outfit';
            font-size: 20px;
            font-weight: 200;
            color: gray;
        }
        .container nav{
            width: fit-content;
            display: flex;
            justify-content: center;
            align-items: center;
        }
        .btn{
            width: 100px;
            padding: 15px 10px;
            border: none;
            border-radius: 50px;
            font-family: prompt;
            color: aliceblue;
            background-color: #1D1FB8;
            margin: 20px 5px;
            cursor: pointer;
        }
        .noThanks{
            width: 100px;
            padding: 15px 10px;
            border: 1px solid gray;
            border-radius: 50px;
            font-family: prompt;
            color: gray;
            background:none;
            margin: 20px 5px;
            cursor: pointer;
        }
    </style>
</head>
<body>
    <?php
    if($result){
        echo "
            <div class='container'>
                <h1>Thanks $name for Visiting Us</h1>
                <p>wanna be one of the Thunder Comunity Sign up Now!</p>
                <nav>
                    <a href='signin.html'><button class='btn'>Sign Up</button></a>
                    <a href='store.html'><button class='noThanks'>No Thanks</button></a>
                </nav>                
            </div>
        "
        ;
    }
    ?>
</body>
</html>