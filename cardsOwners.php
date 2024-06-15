<?php

    include "connect-db.php";

    if($_COOKIE["userPhoneNumber"]==""){
        header("location:signin.html");
    }
    if (isset($_GET["cardName"])){
        $cardName = $_GET["cardName"];
        $userPhoneNumber = $_COOKIE["userPhoneNumber"];
        $req = "SELECT * FROM `clients` WHERE phoneNumber=$userPhoneNumber";
        $res = mysqli_query($conn,$req);
        $rows = $res->fetch_assoc();
        $userName = $rows['name'];
        $userLastName = $rows['lastName'];
        $userFullName = $userName.' '.$userLastName;
        $req2 = "SELECT * FROM `cardscollection` WHERE cardName='$cardName'";
        $res2 = mysqli_query($conn,$req2);
        $rows2 = $res2->fetch_assoc();
        $cardRarity = $rows2['cardRarity'];
    }

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="shortcut icon" type="x-icon" href="images/logo.png">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Abril+Fatface&family=DM+Serif+Display&family=Dela+Gothic+One&family=Gabarito:wght@400;500;900&family=Josefin+Sans:wght@200;300;400;500&family=Libre+Bodoni&family=Montserrat:wght@400;600;700;800;900&family=Noto+Serif+Display:ital,wght@0,100;0,700;0,800;0,900;1,900&family=Oxygen&family=Pacifico&family=Pixelify+Sans:wght@500&family=Playfair+Display:ital,wght@0,800;1,400;1,500;1,800&family=Poppins:wght@200;500;800;900&family=Prompt:wght@300;500;800;900&family=Roboto&family=Sacramento&family=Sono:wght@400;500&family=Young+Serif&display=swap" rel="stylesheet">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Card Owners</title>
    <link rel="stylesheet" href="style.css">
    <style>
        *{
            margin: 0;
            padding: 0;
        }
        body{
            overflow-x: hidden;
        }
        /* header style */
        header{
            display: flex;
            align-items: center;
            justify-content: center;
            font-family: 'prompt';
            background-color:#fffffff1;
            width: 100%;
            height: 70px;
        }
        header div{
            width: 90%;
            display: flex;
            align-items: center;
        }
        header a{
            text-decoration: none;
            color: black;
        }
        header h1{
            font-family: 'Gabarito';
        }
        .newsBar{
            width: 100%;
            height: 20px;
            font-family: 'prompt';
            background-color: #1D1FB8;
            text-align: center;
            padding: 10px 0;
            color: #FAFDFF;
            overflow: hidden;
        }
        .newsBar p{
            animation:slideUp 5s 3s ease-out 4;
        }
        .container{
            width:100%;
            height: fit-content;
            display: flex;
            align-items: center;
            position: relative;
            flex-wrap: wrap;
        }
        .container div{
            width: 49.5%;
            height: 100%;
        }
        .card-image{
            position: relative;
            display: flex;
            justify-content: center;
            align-items: center;
            min-width: 550px;
        }
        .card-image img{
            width: 60%;
            min-width: 400px;
            height:90%;
            border-radius: 20px;
            object-fit: cover;
        }
        .card-owners{
            display: flex;
            justify-content: center;
            align-items: center;
            border-left: 1px solid gray;
        }
        .card-owners div{
            width: 90%;
            height: 90%;
        }
        .card-owners nav{
            margin: 10px 0 20px 0;
        }
        .card-owners nav h1{
            font-family: 'josefin sans';
        }
        .card-owners nav p{
            font-family: prompt;
            font-weight: 200;
        }
        .owners{
            font-family: prompt;
            font-size: 13px;
            font-weight: lighter;
            margin: 30px;
            /* overflow: scroll; */
        }
        .rarity-icon{
            width: 20px;
            height: 20px;
        }
        .theUser{
            color:#1D1FB8;
            font-weight:bolder;
        }
        @media (max-width:1090px) {
            .container{
                width: 100%;
                align-items: center;
                justify-content: center;
            }
            #cardImage{
                width: 50%;
                background-color: blue;
            }
            #cardImage img{
                width: 0;
                height: 300px;
            }
            #cardOwners{
                width: 100%;
                background-color: red;
            }
            .card-image img{
                width: 50%;
                height:500px;
            }
            .card-owners{
                width: 80%;
                border: none;
            }
        }
    </style>
</head>
<body>
<div class="newsBar"><p>thunder Clothes</p><br><p>Coming soon!</p></div>
    <header>
       <div>
            <a href="index.html"><h1>thunder</h1></a>
       </div>
    </header>
    <div class="container">
        <div class="card-image" id="cardImage">
            <?php echo '<img src="images/'.$cardName.'.png">';?>
        </div>
        <div class="card-owners" id="cardOwners">
            <div>
                <nav>
                    <?php echo '<h1>'.$cardName .' Card Owners </h1>'; ?>
                    <?php echo '<p>card rarity :'.$cardRarity.'</p>'?>
                    <?php echo '<img src="images/'.$cardRarity.'.png" alt="" class="rarity-icon">';?>
                </nav>
                <hr>
                <div class="owners">
                    <ul>
                        <?php
                            $req3 = "SELECT * FROM `cardscollection` WHERE cardName='$cardName'";
                            $res3 = mysqli_query($conn,$req2);
                            while($rowsOwners = $res3->fetch_assoc()){
                                if($rowsOwners['cardOwner'] ==$userFullName){
                                    echo('<li class="theUser">' . $rowsOwners['cardOwner']. '</li>');
                                }else{
                                    echo('<li>' . $rowsOwners['cardOwner']. '</li>');
                                }
                                
                            }
                        ?>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</body>
</html>