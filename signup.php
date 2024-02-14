<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Abril+Fatface&family=DM+Serif+Display&family=Dela+Gothic+One&family=Gabarito:wght@400;500;900&family=Josefin+Sans:wght@200;300;400;500&family=Libre+Bodoni&family=Montserrat:wght@400;600;700;800;900&family=Noto+Serif+Display:ital,wght@0,100;0,700;0,800;0,900;1,900&family=Oxygen&family=Pacifico&family=Pixelify+Sans:wght@500&family=Playfair+Display:ital,wght@0,800;1,400;1,500;1,800&family=Poppins:wght@200;500;800;900&family=Prompt:wght@300;500;800;900&family=Roboto&family=Sacramento&family=Sono:wght@400;500&family=Young+Serif&display=swap" rel="stylesheet">
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
        div{
            width: 100%;
            height: 80vh;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
        }
        div p{
            font-family: 'prompt';
            font-weight: lighter;
        }
        div h1{
            font-family: 'Josefin Sans';
            font-size: 60px;
        }
        div button{
            padding:10px 20px;
            font-family: 'prompt';
            background-color: #212121;
            color: #f1f1f1;
            border-radius: 50px;
            border: none;
            margin-top: 20px;
            cursor: pointer;
        }
    </style>
</head>
<body>
    
</body>
</html>
<?php 

include 'connect-db.php';

$name = $_POST['name'];
$lastName = $_POST['lastName'];
$email = $_POST['email'];
$passw = $_POST['passw'];
$state = $_POST['state'];
$adresse = $_POST['adresse'];
$phoneNumber = $_POST['phoneNumber'];


$req = ("SELECT * FROM `clients` WHERE email =  '$email' && password = '$passw'") or die('query Failed');//testing the email and the password if it exists in the data base
$req2 = ("INSERT INTO clients VALUES('$name','$lastName','$state','$adresse','$email','$passw',$phoneNumber)") or die("query Failed");//inserting values
$req3 = ("SELECT * FROM `clients` WHERE phoneNumber =  $phoneNumber") or die('query Failed'); // searching for the phone number if it exists in the data base

$res = mysqli_query($conn , $req);
$res3 = mysqli_query($conn , $req3);
if(mysqli_num_rows($res) > 0){
    echo '
        <div>
            <h1>your email is already exist</h1>
            <p>sorry the email that you use are already exists in thunder data base</p>
            <a href="signin.html"><button>Go Back</button></a>
        </div>
    ';
}else{
    if(mysqli_num_rows($res3)>0){
        echo '
            <div>
                <h1>the Phone Number is already exist</h1>
                <p>sorry the phoneNumber that you use are already exists Please trye again</p>
                <a href="signin.html"><button>Go Back</button></a>
            </div>
        ';
    }else{
        $res = mysqli_query($conn , $req2);
        $rows = $res->fetch_assoc();
        setcookie("userPhoneNumber" , $rows["phoneNumber"]);
        echo '
            <div>
                <h1 class="wlecom">Welcom to thunder ' . $name . '</h1>
                <a href="index.html"><button>Go Back</button></a>
            </div>
        ';
    }
}




?>