<?php

include "connect-db.php";

if($_COOKIE["userPhoneNumber"]==""){
    header("location:signin.html");
}
if (isset($_GET["cardName"])){
    $cardName = $_GET["cardName"];
    $cardRarity = $_GET["rarity"];
    $userPhoneNumber = $_COOKIE["userPhoneNumber"];
    $req = "SELECT * FROM `clients` WHERE phoneNumber=$userPhoneNumber";
    $res = mysqli_query($conn,$req);
    $rows = $res->fetch_assoc();
    $fullUserName = $rows['name'] ." ".$rows['lastName'];
    $req2 = "SELECT * FROM `cardscollection` WHERE ownerPhoneNumber=$userPhoneNumber and cardName='$cardName'";
    $res2 = mysqli_query($conn,$req2);
}
$AlreadyHavetheCard="";
// if(mysqli_num_rows($res2)>0){
//     $AlreadyHavetheCard = "You already have this Card";
// }else{
//     $insertNewCard = "INSERT INTO `cardscollection`(`cardName`, `cardRarity`, `cardOwner`, `ownerPhoneNumber`) VALUES('$cardName','$cardRarity','$fullUserName',$userPhoneNumber)";
//     $insertNewCardResult = mysqli_query($conn,$insertNewCard);
// }
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
    <link rel="stylesheet" href="style.css">
    <title>Your Cards</title>
    <style>
        body{
            scroll-behavior: smooth;
        }
        img{
            cursor: pointer;
        }
        main{
            width: 100%;
            height: fit-content;
            margin-top: 50px;
        }
        #container{
            width: 100%;
            height: 100%;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
        }
        #container div{
            width: 48%;
            height: 100%;
            padding: 0 2%;
            position: relative;
        }
        #container div img:nth-child(1){
            width: 100%;
            height: 100%;
            object-fit: cover;
            border-radius: 20px;
        }
        #container div:nth-child(2){
            width: 48%;
            padding: 20px 0;
        }
        #container div:nth-child(2) h2{
            font-family: 'Josefin Sans';
            font-size: 40px;
            margin: 5px 0;
        }
        small{
            font-family: prompt;
            font-weight: lighter;
            color: gray;
        }
        h2{
            font-family: "josefin sans";
            margin: 5px 0;
            margin-top: 10px;
        }
        .cardRarity{
            display:flex;
            font-family: prompt;
            font-weight: 300;
            font-size: 18px;
            letter-spacing: 1px;
            align-items: center;
        }
        .cardOwner{
            display:flex;
            font-family: prompt;
            font-weight: 300;
            font-size: 18px;
            letter-spacing: 1px;
            align-items: center;
        }
        .cardOwner a{
            font-size: 10px;
        }
        .rarityIcon{
            width: 20px;
            height: 20px;
            margin: 10px 0;
        }
        #cardName{
            font-size: 40px;
        }
        hr{
            margin: 20px 0;
            color: lightgray;
        }
        .sizes{
            position: relative;
            width: 70%;
            margin: 20px 10px;
            display: flex;
            justify-content: space-between;
            transition:all 0.7s;
        }
        .sizes nav{
            position: relative;
            min-width:55px;
            min-height: 55px;
            border: 2px solid #212121;
            display: flex;
            justify-content: center;
            align-items: center;
            font-family: 'Josefin Sans';
            cursor: pointer;
        }
        .sizes input{
            opacity: 0;
            width:55px;
            height:55px;
            position: absolute;
            cursor: pointer;
            z-index: 2;
            transition: 0.7s;
        }
        .sizesLabel{
            position: relative;
            width:100%;
            height:100%;
            display: flex;
            justify-content: center;
            align-items: center;
            font-family: 'Josefin Sans';
            cursor: pointer;
            transition: 0.7s;
        }
        input[type="radio"]:checked + .sizesLabel{
            background-color: #212121;
            color: aliceblue;
            border: none;
        }
        #quantity{
            width: 130px;
            height: 40px;
            margin: 10px 0;
            text-align: center;
            outline: none;
            font-size: 18px;
        }
        #quantity::-webkit-inner-spin-button,
        #quantity::-webkit-outer-spin-button{
            -webkit-appearance: none;
        }
        .button{
            width: 100%;
            padding: 20px 0 ;
            font-family: 'Josefin Sans';
            margin: 2px 0;
            background-color: #212121;
            border: none;
            text-align: center;
            font-size: 20px;
        }
        .button:nth-of-type(1){
            margin-top: 20px;
            background-color: #ffff;
            color: #212121;
            border: 2px solid #212121;
            cursor:no-drop;
        }
        .button:nth-of-type(2){
            background-color: #212121;
            color: aliceblue;
            border: none;
            cursor: pointer;
        }
        .shirt-discription{
            font-family: 'Josefin Sans';
            color: gray;
            margin-top: 25px;
        }
        h4{
            font-family: 'Josefin Sans';
            margin: 20px 0 5px 0;
        }
        l{
            text-decoration: line-through;
            color: lightgray;
        }
        #emailBtn{
            padding: 15px 20px;
            width: 90px;
            height: fit-content;
            background-color: #1D1FB8;
            color: #FAFDFF;
            font-family: 'prompt';
            border: none;
            border-radius: 50px;
            margin: 10px;
            cursor: pointer;
            display: flex;
            justify-content: center;
            align-items: center;
        }
        .Other-products{
            width: 90%;
            height: fit-content;
            margin: 50px 5%;
            /* background-color: #212121; */
            border-radius: 20px;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            text-align: center;
            color: #212121;
            transition: 0.5s;
        }
        .Other-products h3{
            font-family: "josefin sans";
            font-size: 80px;
        }
        .Other-products p{
            font-family: "prompt";
            font-weight: 300;
            font-size: 25px;
        }
        .Coming-soon{
            width: 100%;
            height: fit-content;
            padding: 30px 0;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
        }
        .Coming-soon img{
            width: 500px;
            height: 500px;
            min-width: 500px;
            max-width: 500px;
            min-height: 500px;
            max-height: 500px;
            border-radius: 20px;
            object-fit: cover;
        }
        .Coming-soon div{
            margin: 5% 0;
        }
        .Coming-soon nav{
            padding: 10px;
            width: 100%;
            text-align: start;
        }
        .Coming-soon nav p{
            font-family: "prompt";
            font-weight: lighter;
            font-size: 12px;
            margin: 0;
            padding: 0;
        }
        .error{
            width: 100%;
            height:fit-content;
            display:flex;
            flex-direction:column;
            justify-content:center;
            align-items:center;
            margin-bottom:100px;
        }
        .error img{
            width: 20%;
            height:auto;
            margin-bottom:50px;
        }
        .error h1{
            font-family:"josefin sans";
            font-size:50px;
        }
        .error p{
            font-family:'Outfit';
        }
        .cardsOwnersLink{
            font-family:'Outfit';
            color:#212121;
            margin-top:15px;
            font-size:15px;
        }
        .cards{
            margin:0px;
            margin-top:30px;
            width: 90%;
            height: 390px;
            display: flex;
            flex-wrap: wrap;
            justify-content: space-evenly;
            align-items:center;
            position: relative;
        }
        .card{
            width:24%;
            min-width: 250px;
            height: 100%;
            border-radius: 20px;
            display: flex;
            justify-content: center;
            align-items: center;
            position: relative;
            overflow: hidden;
            margin: 10px 0;
            transition: 0.7s;
        }
        .card:hover{
            transition: 0.5s 0s;
            transform: scale(1.03);
        }
        .locked{
            width: 10px;
            height:auto;
            display: block;
            z-index: 1;
        }
        .cardImg{
            width: 100%;
            height: 100%;
            object-fit: cover;
        }
        .graybackground{
            position: absolute;
            width: 100%;
            height: 100%;
            background-color: #212121;            
            opacity: 0.7;
        }
        .cardDiscription{
            position:absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50% , -50%);
            text-align: center;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            color: #FAFDFF;
        }
        .cardName{
            font-family: 'josefin sans';
            font-size:25px;
            font-weight: 900;
            margin: 20px 0 10px 0;
        }
        .cardP{
            font-size: 10px;
            font-family: 'prompt';
            font-weight: 300;
        }
        p{
            font-weight:400;
        }
        @media (max-width:900px) {
            #container{
                flex-direction: column;
                height: fit-content;
                align-items: flex-start;
            }
            .Other-products h3{
                font-family: "josefin sans";
                font-size: 50px;
            }
            .Other-products p{
                font-family: "prompt";
                font-weight: 300;
                font-size: 25px;
            }
            .Coming-soon div{
                width: 100%;
                display: flex;
                flex-direction: column;
                justify-content: center;
                align-items: center;
                margin: 10% 0;
            }
            .Coming-soon img{
                width: 100%;
                height: 400px;
                min-width: 90%;
                max-width: 90%;
                min-height: 400px;
                max-height: 400px;
                height: auto;
            }
            .Coming-soon nav{
                padding: 10px 0;
                width: 100%;
                text-align: center;
            }
            #container div img:nth-child(1){
                width: 100%;
                height:auto;
                object-fit: cover;
            }
            #container div:nth-child(2){
                width: 96%;
                padding: 20px 2%;
            }
            #container div{
                width: 96%;
                padding: 2%;
                height:fit-content;
            }
            .sizes{
                width: 90%;
                margin:5% 0;
            }
            header ul{
                visibility: hidden;
            }
        }
    </style>
</head>
<body>
    <a href="#container" id="home"></a>
    <div class="newsBar"><p>thunder Clothes</p><br><p>Coming soon!</p></div>
    <header>
       <div>
            <a href="index.html"><h1>thunder</h1></a>
            <ul>
                <a href="store.html"><li>Store</li></a>
                <a href="newCollection.html"><li>new Collections</li></a>
                <a href="aboutus.html"><li>About us</li></a>
                <a href="signin.html"><li>Sign up</li></a>
            </ul>
       </div>
    </header>
    <main>
    <?php
            if(mysqli_num_rows($res2)>0){
                $AlreadyHavetheCard = "You already have this Card";
                echo '
                    <div class="error">
                        <img src="images/nothing found.png" alt="nothing found">
                        <h1>'.$AlreadyHavetheCard.'</h1>
                        <p>You Already Win a Free Card You Need To Start Collecting Your Own</p>
                        <a href="cardsOwners.php?cardName='.$cardName.'&rarity='.$cardRarity.'&lock=unlocked" class="cardsOwnersLink">See '.$cardName.' Card Owners</a></div>
                    <hr>
                ';
            }else{
                $insertNewCard = "INSERT INTO `cardscollection`(`cardName`, `cardRarity`, `cardOwner`, `ownerPhoneNumber`) VALUES('$cardName','$cardRarity','$fullUserName',$userPhoneNumber)";
                $insertNewCardResult = mysqli_query($conn,$insertNewCard);
                echo '
                    <div id="container">
                        <div class="hidden2">
                            <small>thunder clothes</small>
                            <h2 id="cardName" name="cardNAme" class="hidden3"><?php echo $cardName; ?></h2>
                            <nav class="cardRarity hidden3"><small>Card Rarity</small><pre> </pre><p id="cardRarity" name="cardRarity">'.$cardRarity.'</p></nav>
                            <nav class="cardOwner hidden3"><small>Card Owner ' . $rows["name"] .'" "'. $rows['lastName'] .'" "' . $AlreadyHavetheCard . ' ... <br><a id="owners" href="cardsOwners.php?cardName='.$cardName.'&rarity='.$cardRarity.'&lock=unlocked"> See this Card Owners</a></small></nav>
                            <img src="images/'.$cardRarity.'.png" class="rarityIcon" id="cardRarityIcon">
                            <hr>
                        </div>
                        <div>
                            <img src="images/'.$cardName.'.png" alt="t-shirt" class="hidden" id="productimg">
                        </div>
                    </div>
                ';
            }
        ?>
        <div class="Other-products hidden">
            <nav>
                <h3>Cards you Have</h3>
                <p>these is the cards you own hope you're Taking care of them.</p>
            </nav>
            <nav class="cards">
                
                    <?php
                        $userCardsReq = "SELECT * FROM `cardscollection` WHERE `ownerPhoneNumber`=$userPhoneNumber";
                        $userCardsResult = mysqli_query($conn,$userCardsReq);
                        while($userCardsRows = $userCardsResult->fetch_assoc()){
                            echo '
                            <div class="card hidden">
                                <img class="cardImg" src="images/'.$userCardsRows['cardName'].'.png" alt="'.$userCardsRows['cardName'].'">
                            </div>';
                        }
                    ?>
            </nav>
            
        </div>
        <!-- <div class="Coming-soon">
            <div>
                <nav>
                    <h2 id="img1h2" class="hidden3">Good Health</h2>
                    <p class="hidden3" id="img1P">Good health t-shirt coming soon</p>
                </nav>
                <img src="images/good-health-mockup.png" alt="Good Health" class="hidden2" id="img1" onclick="changeImage(this)">
            </div>
        </div> -->
    </main>
    <footer>
        <h1>Thunder Clothes</h1>
        <p>You can check our social media and stay tuned</p>
        <div>
            <nav>
                <h3>Thunder Email</h3>
                <form action="EmailComunity.php" method="post" onsubmit="return emailVerif()">
                    <input type="email" name="sendUsEmail" id="sendUsEmail" placeholder="Email" ><br>
                    <input type="submit" value="submit" id="emailBtn">
                </form>
            </nav>
            <nav>
                <h3>Our Social Media</h3>
                <nav class="socialmedia">
                    <a href="#"><img src="images/facebook.png"></a>
                    <a href="#"><img src="images/instagram.png"></a>
                    <a href="#"><img src="images/twitter.png"></a>
                    <a href="#"><img src="images/tiktok.png"></a>
                </nav>
                <img src="images/aroundtheworldicon.png" style="width: 90px; height: 90px; margin-top: -30px;">
            </nav>
        </div>
        <nav class="devId">Made By Chahine Fehri</nav>
    </footer>

    <script src="js.js"></script>

    <script>

        function emailVerif(){
            var mail = document.getElementById('sendUsEmail').value;
            if(mail==""){
                alert("you have to write your email first");
                return false;
            }
            if(mail.indexOf(".")==-1){
                alert("your email is wrong try again");
                return false;
            }
        }
    </script>
    <script>
        function changeImage(product){
            var productimg = document.getElementById('productimg');
            var theProductName = document.getElementById('theProductName');

            var productId = product.id;
            var Aux;
            var AuxImg;

            productH2 = document.getElementById(productId+"h2");
            productP = document.getElementById(productId+"P");


            // changing body content
            productP.innerHTML = theProductName.innerHTML+" t-shirt Coming Soon"
            // changing the heading content
            Aux = productH2.innerHTML;
            productH2.innerHTML = theProductName.innerText;
            theProductName.innerHTML = Aux;
            home.click();
            // changing the image content
            AuxImg = productimg.src;
            productimg.src = product.src;
            product.src="";
            product.src = AuxImg;

        }
    </script>
</body>
</html>