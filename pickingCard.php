<?php

include "connect-db.php";
if($_COOKIE["userPhoneNumber"]==""){
    header("location:signin.html");
}
if (isset($_GET["pickedCard"])){
    $pickedCard = $_GET["pickedCard"];
    $userPhoneNumber = $_COOKIE["userPhoneNumber"];
    $req = "SELECT * FROM `clients` WHERE phoneNumber=$userPhoneNumber";
    $res = mysqli_query($conn,$req);
    $rows = $res->fetch_assoc();

    $req2 = "SELECT * FROM `fidelity card` WHERE phoneNumber=$userPhoneNumber";
    $res2 = mysqli_query($conn,$req2);
    $rows2 = $res2->fetch_assoc();


}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Abril+Fatface&family=DM+Serif+Display&family=Dela+Gothic+One&family=Gabarito:wght@400;500;900&family=Josefin+Sans:wght@200;300;400;500&family=Libre+Bodoni&family=Montserrat:wght@400;600;700;800;900&family=Noto+Serif+Display:ital,wght@0,100;0,700;0,800;0,900;1,900&family=Oxygen&family=Pacifico&family=Pixelify+Sans:wght@500&family=Playfair+Display:ital,wght@0,800;1,400;1,500;1,800&family=Poppins:wght@200;500;800;900&family=Prompt:wght@300;500;800;900&family=Roboto&family=Sacramento&family=Sono:wght@400;500&family=Young+Serif&display=swap" rel="stylesheet">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Your Card</title>
    <style>
        *{
            margin: 0;
            padding: 0;
        }
        .card-nav{
            width: 100%;
            height: fit-content;
            position: relative;
        }
        .pickedCard-div{
            width: 100%;
            height: fit-content;
            display: flex;
            flex-direction: column;
            align-items: center;
            padding: 3% 0;
        }
        .pickedCard-div2{
            width: 100%;
            height: fit-content;
            display: flex;
            flex-direction: column;
            align-items: center;
            padding: 10% 0;
        }
        .pickedCard-div img{
            width: 325px;
            height: 450px;
            border: none;
            border-radius: 10px;
        }
        .pickedCard-div h4{
            font-family: 'Josefin Sans';
            font-size: 20px;
            margin: 20px 0 0 0;
        }
        .pickedCard-div2 h1{
            font-family: 'Josefin Sans';
            font-size:70px;
            margin: 20px 0 0 0;
        }
        .pickedCard-div p{
            font-family: 'Roboto';
            font-weight: lighter;
            font-size:12px;
            color: gray;
            text-align: center;
            margin: 5px;
        }
        .pickedCard-div2 p{
            font-family: 'Roboto';
            font-weight: lighter;
            font-size:12px;
            color: gray;
            text-align: center;
            margin: 5px;
        }
        .backHome{
            position: absolute;
            top: 50px;
            left: 50px;
            cursor: pointer;
            z-index: 99;
        }
        .backHome img{
            width: 30px;
            height: 30px;
        }
        .cardBorder{
            position: absolute;
            width: 60%;
            height: 90vh;
            margin: 0 20%;
            object-fit: fill;
            top: 0;
            left: 0;
            z-index: -1;
        }
        .cardBorder2{
            position: absolute;
            width: 40%;
            height: 90vh;
            margin: 0 10% 0 32%;
            object-fit: fill;
            top: 0;
            left: 0;
        }
        @media (max-width:500px) {
            .backHome{
                left: 20px;
                top: 20px;
            }
            .pickedCard-div2{
                padding:30% 20px;
                align-items: start;
            }
            .pickedCard-div2 p{
                text-align: start;
                width: 80%;
                margin: 0;
                padding: 0;
            }
            .cardBorder{
                visibility: hidden;
            }
            .cardBorder2{
                visibility: hidden;
            }
        }
    </style>
</head>
<body>
    <a href="newCollection.html" class="backHome"><img src="images/home.png" alt="home"></a>
    <div>
        <nav class="card-nav">
            <?php 
                $valid = true;
                $currentDate = new DateTime();
                if($currentDate<$rows2["expiration"]){
                    $valid = false;
                }
                 if(mysqli_num_rows($res2)>0 && $valid){
                    echo '
                    <div class="pickedCard-div2">
                        <h1>Sorry '. $rows["name"] . '</h1>
                        <p>You already have a card You cant pick more than one until ' . $rows2["expiration"] . '</p>
                    </div>';
                 }else{
                    echo '<img src="images/cardborder.png" class="cardBorder">
                    <img src="images/cardborder2.png" class="cardBorder2">';

                    $name = $rows['name'];
                    $lastName = $rows['lastName'];
                    $date = new DateTime();
                    $date = $date->format('Y-m-d');
                    $validity = '1 month';
                    $expiration = new DateTime('last day of this month +' . $validity);
                    $expiration = $expiration->format('Y-m-d');

                    $req3 = "INSERT INTO `fidelity card` values('$name' , '$lastName' , $userPhoneNumber , '$pickedCard' , '$date' , '$expiration')";
                    $res3 = mysqli_query($conn,$req3);

                    echo '
                    <div class="pickedCard-div">
                        <img src="images/'.$pickedCard.'.png" alt="">
                        <h4>your thunder is ' . $pickedCard . '</h4>
                        <p>congrats '. $rows["name"] . '! <br> you are now one of the '. $pickedCard .' Members</p>
                    </div>';
                 }
            ?>
        </nav>
    </div>
</body>
</html>