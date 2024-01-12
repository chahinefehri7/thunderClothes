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
        .Back{
            width: 100px;
            padding: 20px 10px;
            border-radius: 10px;
            background-color: #212121; 
            color: #f1f1f1;
            border: none;
        }
    </style>
</head>
<body>
    
</body>
</html>
<?php 

include 'connect-db.php';

$email = $_POST['email'];
$passw = $_POST['passw'];

$req = ("SELECT * FROM `clients` WHERE email =  '$email' && password = '$passw'") or die('query Failed');



$res = mysqli_query($conn , $req);
$rows = $res->fetch_assoc();
if(mysqli_num_rows($res) > 0){
    setcookie("userPhoneNumber" , $rows["phoneNumber"]);
    if($_COOKIE["itemGameScore"]<1){
        $itemScore = 0;
        setcookie("itemGameScore" , $itemScore , time() +60 * 60 * 24 * 30);
    }
}else{
    echo('<h1>Your Email or password are wrong </br> please try again</h1>');
}
header('location:index.html');
?>