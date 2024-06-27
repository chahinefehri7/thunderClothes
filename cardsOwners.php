<?php

    include "connect-db.php";

    if($_COOKIE["userPhoneNumber"]==""){
        header("location:signin.html");
    }
    if (isset($_GET["cardName"])){
        $cardName = $_GET["cardName"];
        $cardRarity = $_GET["rarity"];
        $lock = $_GET["lock"];
        $userPhoneNumber = $_COOKIE["userPhoneNumber"];
        
        $req = "SELECT * FROM `clients` WHERE phoneNumber=$userPhoneNumber";
        $res = mysqli_query($conn,$req);
        $rows = $res->fetch_assoc();

        $userName = $rows['name'];
        $userLastName = $rows['lastName'];
        $userFullName = $userName.' '.$userLastName;

        $req2 = "SELECT * FROM `cardscollection` WHERE cardName='$cardName'";
        $res2 = mysqli_query($conn,$req2);
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
            height: 90vh;
        }
        .card-image{
            position: relative;
            display: flex;
            justify-content: center;
            align-items: center;
        }
        .card-img{
            width: 60%;
            min-width: 400px;
            height:90%;
            border-radius: 20px;
            object-fit: cover;
            box-shadow:0 0 20px 2px #212121;
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
        .blur{
            filter: blur(5px);
        }
        .graybackground{
            position:absolute;
            display:flex;
            justify-content:center;
            align-items:center;
            width: 100%;
            height: 100%;
            background-color: #212121;            
            opacity: 0.7;
            z-index: 99;
        }
        #lockIcon{
            width: 30px;
            height:30px
        }
        @media (max-width:1090px) {
            .container{
                width: 100%;
                align-items: center;
                justify-content: center;
            }
            #cardImage{
                width: 50%;
            }
            .card-img{
                width: 100%;
                height: 90%;
            }
            #cardOwners{
                width: 100%;
            }
            .card-owners{
                width: 80%;
                border: none;
            }
        }
        @media(max-width:600px){
            #cardImage{
                position:relative;
                width: 90%;
                border-radius:20px;
                overflow:hidden;
                box-shadow:0 0 20px 2px #212121;
            }
            .card-img{
                width: 100%;
                height:100%;
            }
            #lockIcon{
                width: 20px;
                height:auto;
                object-fit:cover;
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
            <?php 
                if($lock=='unlocked'){
                    echo '<img src="images/'.$cardName.'.png" class="card-img hidden3">';
                }else{
                    echo '<img src="images/'.$cardName.'.png" class="card-img hidden3 blur"><nav class="graybackground"><img src="images/lockIcon.png" alt="lock" id="lockIcon"></nav>';
                }
            ?>
        </div>
        <div class="card-owners" id="cardOwners">
            <div>
                <nav>
                    <?php 
                        echo '<h1>'.$cardName .' Card Owners </h1>';
                        echo '<p>card rarity :'.$cardRarity.'</p>';
                        echo '<img src="images/'.$cardRarity.'.png" alt="" class="rarity-icon">';
                    ?>
                </nav>
                <hr>
                <div class="owners">
                    <ul>
                        <?php
                            $req3 = "SELECT * FROM `cardscollection` WHERE cardName='$cardName'";
                            $res3 = mysqli_query($conn,$req3);
                            if(mysqli_num_rows($res3)>0){
                                while($rowsOwners = $res3->fetch_assoc()){
                                    if($rowsOwners['cardOwner'] ==$userFullName){
                                        echo('<li class="theUser">' . $rowsOwners['cardOwner']. '</li>');
                                    }else{
                                        echo('<li>' . $rowsOwners['cardOwner']. '</li>');
                                    }
                                    
                                }
                            }else{
                                echo '<p style="margin-left:-5%;">No Owners For This Card, <br>You Might Be The First Owner of '.$cardName.' Card.</p>';
                            }
                        ?>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <script src="js.js"></script>
</body>
</html>