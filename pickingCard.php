<?php

include "connect-db.php";
if($_COOKIE["userPhoneNumber"]==""){
    header("location:signin.html");
}
if (isset($_GET["pickedCard"])){
    $pickedCard = $_GET["pickedCard"];
    $persontage = $_GET["persontage"];
    $userPhoneNumber = $_COOKIE["userPhoneNumber"];
    $req = "SELECT * FROM `clients` WHERE phoneNumber=$userPhoneNumber";
    $res = mysqli_query($conn,$req);
    $rows = $res->fetch_assoc();

    $req2 = "SELECT * FROM `fidelity card` WHERE phoneNumber=$userPhoneNumber";
    $res2 = mysqli_query($conn,$req2);
    $sameCardRepeated = 0;
    while($rows2 = $res2->fetch_assoc()){
        if($rows2["cardName"]==$pickedCard){
            $sameCardRepeated++;
        }
    }
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Bungee&family=Cinzel:wght@400..900&family=Dancing+Script:wght@400..700&family=Danfo&family=EB+Garamond:ital,wght@0,400..800;1,400..800&family=Josefin+Sans:ital,wght@0,100..700;1,100..700&family=Lora:ital,wght@0,400..700;1,400..700&family=Open+Sans:ital,wght@0,300..800;1,300..800&family=Orelega+One&family=Oswald:wght@200..700&family=Outfit:wght@100..900&family=PT+Serif:ital,wght@0,400;0,700;1,400;1,700&family=Playfair+Display:ital,wght@0,400..900;1,400..900&family=Prompt:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Raleway:ital,wght@0,100..900;1,100..900&family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&family=Sacramento&family=Sedan+SC&family=Tajawal:wght@200;300;400;500;700;800;900&family=Yatra+One&display=swap" rel="stylesheet">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Your Card</title>
    <style>
        @font-face {
            font-family: "DrukWide";
            src: url(fonts/DrukWideBold.ttf);
        }
        @font-face {
            font-family: "outward";
            src: url(fonts/outward-block-webfont.ttf);
        }
        *{
            margin: 0;
            padding: 0;
        }
        .hidden{
            transform: translateY(125px);
            opacity: 0;
            filter: blur(4px);
            transition: all 1s;
        }
        .show{
            transform: translateX(0);
            opacity: 1;
            filter: blur(0px);
            transition: 0.7s;
        }
        .hidden:nth-child(1){
            transition-delay:0.2s;
        }
        .hidden:nth-child(2){
            transition-delay:0.5s;

        }
        .hidden:nth-child(3){
            transition-delay:0.7s;
        }
        .hidden2{
            transform: translateY(100px);
            opacity: 0;
            filter: blur(4px);
            transition: 1s;
        }
        .show2{
            transform: translateY(0);
            opacity: 1;
            filter: blur(0px);
            transition: 0.7s 0.3s;
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
            font-family:'Outfit';
            font-weight: 500;
            font-size:12px;
            color: #C1C1C1;
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
        /* cards you won */
        .cards-you-own-container{
            width: 90%;
            height:fit-content;
            padding:0px 5%;
            text-align:center;
            margin:150px 0;
        }
        .cards-you-own-container h1{
            font-family:'DrukWide';
            font-size:30px;
            margin-bottom:50px;
        }
        .cards-you-own{
            width: 100%;
            height:fit-content;
            display:flex;
            justify-content:space-evenly;
            align-items:center;
            flex-wrap:wrap;
        }
        .cards-you-own div{
            width: 400px;
            height: 600px;
            position:relative;
            overflow:hidden;
            border-radius:25px;
            background:red;
        }
        .cards-you-own div img{
            width: 100%;
            height: 100%;
            object-fit:cover;
        }
        .cards-info{
            position:absolute;
            width: 100%;
            height:100%;
            display:flex;
            flex-direction:column;
            justify-content:center;
            align-items:center;
            color:#F1F1F1;
            z-index: 99;
            background-color: #1218157a;
            top:50%;
            left:50%;
            transform:translate(-50% , -50%);
            transition:0.7s;
            opacity: 0;
        }
        .cards-info h3{
            font-size:50px;
            font-family:"josefin sans";
        }
        .cards-info p{
            font-family:'Roboto';
        }
        .cards-info:hover{
            transition:0.7s;
            opacity: 1;
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
                $unvalid = true; // card expiration unvalid variable
                // checking if the card has been repeated multiple times
                if($sameCardRepeated>0){
                    echo '
                    <div class="pickedCard-div2">
                        <h1>Sorry '. $rows["name"] . '</h1>
                        <p>You cant Pick The Same Card Twice</p>
                    </div>';
                    return 0;
                }else{
                    // checking if the card expiration is valid with the date or not
                        $req4 = "SELECT * FROM `fidelity card` WHERE phoneNumber=$userPhoneNumber";
                        $res4 = mysqli_query($conn,$req4);
                        while($rows2 = $res4->fetch_assoc()){
                            $date = $rows2["date"];
                            $expiration = $rows2["expiration"];
                            if($date>$expiration){
                                $unvalid = false;
                            }else{
                                $unvalid = true;
                                break;
                            }

                        }
                    }
                    if(mysqli_num_rows($res2)>0 && $unvalid){
                        echo '
                        <div class="pickedCard-div2">
                            <h1>Sorry '. $rows["name"] . '</h1>
                            <p>You already have a card You cant pick more than one until ' . $expiration . '</p>
                        </div>';
                    }else{
                        echo '<img src="images/cardborder.png" class="cardBorder">
                        <img src="images/cardborder2.png" class="cardBorder2">';

                        $name = $rows['name'];
                        $lastName = $rows['lastName'];
                        $date = new DateTime();
                        $date = $date->format('Y-m-d');
                        $unvalidity = '2 month';
                        $expiration = new DateTime('last day of next month +' . $unvalidity);
                        $expiration = $expiration->format('Y-m-d');

                        $req3 = "INSERT INTO `fidelity card` values('$name' , '$lastName' , $userPhoneNumber , '$pickedCard' ,'$persontage', '$date' , '$expiration')";
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
        <div class="cards-you-own-container">
            <?php
                $OwnCardsReq = "SELECT * FROM `fidelity card` WHERE phoneNumber=$userPhoneNumber";
                $OwnCardsRes = mysqli_query($conn,$OwnCardsReq);
            ?>
            <h1>CARDS YOU OWN</h1>
            <nav class="cards-you-own">
                <?php

                    while($OwnCardsRows = $OwnCardsRes->fetch_assoc()){
                        echo'
                        <div class="hidden">
                            <img src="images/'. $OwnCardsRows["cardName"].'.png" alt="card img">
                            <nav class="cards-info">
                                <h3>'.$OwnCardsRows["cardName"].'</h3>
                                <p>You Own it in '.$OwnCardsRows['date'].'</p>
                                <p>This Cards Expires On '.$OwnCardsRows["expiration"].'</p>
                            </nav>
                        </div>';
                    }
                ?>
            </nav>
        </div>
    </div>

    <script>
        // first observer for elements animation
        const observer = new IntersectionObserver(entries =>{
            entries.forEach((entry) =>{
                if (entry.isIntersecting){
                    entry.target.classList.add('show');
                }else{
                    entry.target.classList.remove('show');
                }
            });
        });

        const hiddenElements = document.querySelectorAll('.hidden');
        hiddenElements.forEach((el) => observer.observe(el));

        // second observer for other elements animation
        const observer2 = new IntersectionObserver(entries =>{
            entries.forEach((entry) =>{
                if (entry.isIntersecting){
                    entry.target.classList.add('show2');
                }else{
                    entry.target.classList.remove('show2');
                }
            });
        });

        const hiddenElements2 = document.querySelectorAll('.hidden2');
        hiddenElements2.forEach((el) => observer2.observe(el));
        // third observer for elements animation key frame
        const observer3 = new IntersectionObserver(entries =>{
            entries.forEach((entry) =>{
                if (entry.isIntersecting){
                    entry.target.classList.add('show3');
                }else{
                    entry.target.classList.remove('show3');
                }
            });
        });

        const hiddenElements3 = document.querySelectorAll('.hidden3');
        hiddenElements3.forEach((el) => observer3.observe(el));
        // third observer for the left sliding elements  check the css for it
        const observer4 = new IntersectionObserver(entries =>{
            entries.forEach((entry) =>{
                if (entry.isIntersecting){
                    entry.target.classList.add('show4');
                }else{
                    entry.target.classList.remove('show4');
                }
            });
        });

        const hiddenElements4 = document.querySelectorAll('.hidden4');
        hiddenElements4.forEach((el) => observer4.observe(el));


    </script>
</body>
</html>