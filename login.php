<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
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
    if($_COOKIE["itemGameScore"]<1){
        $itemScore = 0;
        setcookie("itemGameScore" , $itemScore , time() +60 * 60 * 24 * 30);
    }
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

