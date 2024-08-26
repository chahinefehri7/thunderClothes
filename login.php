<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="shortcut icon" type="x-icon" href="images/logo.png">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Bungee&family=Cinzel:wght@400..900&family=Dancing+Script:wght@400..700&family=Danfo&family=EB+Garamond:ital,wght@0,400..800;1,400..800&family=Josefin+Sans:ital,wght@0,100..700;1,100..700&family=Lora:ital,wght@0,400..700;1,400..700&family=Open+Sans:ital,wght@0,300..800;1,300..800&family=Orelega+One&family=Oswald:wght@200..700&family=Outfit:wght@100..900&family=PT+Serif:ital,wght@0,400;0,700;1,400;1,700&family=Playfair+Display:ital,wght@0,400..900;1,400..900&family=Prompt:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Raleway:ital,wght@0,100..900;1,100..900&family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&family=Sacramento&family=Sedan+SC&family=Tajawal:wght@200;300;400;500;700;800;900&family=Yatra+One&display=swap" rel="stylesheet">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        *{
            padding: 0;
            margin: 0;
        }
        .welcomBack{
            width: 100%;
            height: 300px;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            text-align: center;
            padding-top: 10%;
        }
        .welcomBack h1{
            font-size: 80px;
            font-family: 'Josefin Sans';
            margin: 10px;
        }
        .welcomBack p{
            font-family: 'prompt';
            color: gray;
            letter-spacing: 10px;
        }
        .welcomBack button{
            padding: 15px 20px;
            border: none;
            border-radius: 50px;
            font-family: 'prompt';
            font-weight: 600;            
            color: aliceblue;
            margin-top: 30px;
            background-color: #1D1FB8;
            cursor: pointer;
        }
        .wrongInfo{
            width: 100%;
            height: 100vh;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            font-family: 'Josefin Sans';
            font-size: 20px;
            text-align: center;
        }
        .wrongInfo p{
            font-family: 'prompt';
            font-weight: lighter;
            color: #212121;
            font-size: 15px;
            margin: 15px 0;
            width: 400px;
        }
        .wrongInfo a{
            color: #1D1FB8;
            font-weight: bold;
        }
        .wrongInfo button{
            padding: 10px 30px;
            border: none;
            border-radius: 50px;
            color: aliceblue;
            background-color: #1D1FB8;
            font-family: 'Josefin Sans';
            cursor: pointer;
        }
        @media (max-width:600px) {
            .welcomBack{
                margin-top: 40%;
            }
        }
    </style>
</head>
<body>
<?php

include 'connect-db.php';

$email = $_POST['email'];
$passw = $_POST['passw'];

$req = ("SELECT * FROM `clients` WHERE email =  '$email' and password = '$passw'") or die('query Failed');

$res = mysqli_query($conn , $req);
$rows = $res->fetch_assoc();
if(mysqli_num_rows($res) > 0){
    echo '<div class="welcomBack">
        <h1>Welcom Back ' . $rows["name"]. ' </h1>
        <p>Take a Look on thunder New Collection</p>
        <a href="index.html"><button>Continue Shopping</button></a>
    </div>';

    setcookie("userPhoneNumber" , $rows["phoneNumber"]);
    // header('location:index.html');
}
else{
    echo 
    '<div class="wrongInfo">
        <h1>Your Email or password are wrong </br> please try again ! </h1>
        <p>You may entered the Wrong information please try again or <a href="signin.html">I dont hav an account</a></p>
        <a href="login.html"><button>Try again</button></a>
    </div>';
}

?>
</body>
</html>

