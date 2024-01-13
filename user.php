<?php

include 'connect-db.php';
if($_COOKIE['userPhoneNumber']==""){
    header("location:signin.html");
}
$userphoneNumber = $_COOKIE['userPhoneNumber'];
$req = ("SELECT * FROM `orders` WHERE phoneNumber = $userphoneNumber");
$res = mysqli_query($conn , $req);

$reqName = ("SELECT `name` FROM `clients` WHERE phoneNumber = $userphoneNumber");
$resName = mysqli_query($conn , $reqName);

$clientName = $resName->fetch_assoc();
$orderNbrRows = $res->fetch_assoc();
$ordersN = mysqli_num_rows($res);

while($rows2 = $res->fetch_assoc()){
    $orderName = $rows2["orderName"];    // taking the order Name
    $orderSize = $rows2["size"];         //taking the order size

    $reqt2 = ("SELECT * FROM `orders` WHERE phoneNumber = $userphoneNumber and orderName ='$orderName' and size ='$orderSize'");   //selecting the repetetive orders
    $res2 = mysqli_query($conn,$reqt2);

    $quantity =  mysqli_num_rows($res2);    //counting the repetetive orders

    $maxOrderQuantity = 0;
    $ordersQuantity = 0;
    if($quantity>1){
        while($quantityRows = $res2->fetch_assoc()){
            if($quantityRows["quantity"]>$maxOrderQuantity){
                $maxOrderQuantity = $quantityRows["quantity"];
            }
            $ordersQuantity = $ordersQuantity + $quantityRows["quantity"];
        }

        $updateQuantity = "UPDATE `orders` SET quantity = $ordersQuantity WHERE phoneNumber = $userphoneNumber and orderName ='$orderName' and size ='$orderSize' LIMIT 1";
        $updateQuantityResult = mysqli_query($conn,$updateQuantity);

    // updating total privce
    
        // cutting the actual price to convert it to an integer
        $thePrice = $rows2["price"];
        $thePrice = explode("D" , $thePrice);
        $thePrice = $thePrice[0];
        // converting the price to a float
        $thePrice = (float)$thePrice;
        // calculating the total of the price
        $totalPrice = $thePrice*$ordersQuantity;
        // converting the total price to a string the concat with "DT"
        $totalPrice = (string)$totalPrice ." DT";

        // updating total price query
        $updatePrice = "UPDATE `orders` SET price = '$totalPrice' WHERE phoneNumber = $userphoneNumber and orderName ='$orderName' and size ='$orderSize' LIMIT 1";
        $updatePriceResult = mysqli_query($conn,$updatePrice);

        $reqt3 = ("SELECT * FROM `orders` WHERE phoneNumber = $userphoneNumber and orderName ='$orderName' and size ='$orderSize'");   //selecting the repetetive orders
        $res3 = mysqli_query($conn,$reqt2);

        while($quantityRows2 = $res3->fetch_assoc()){
            if($quantityRows2["quantity"]<$ordersQuantity){

                $deletedQuantity = $quantityRows2["quantity"];
                $deleteQuery = "DELETE FROM `orders` WHERE `orders`.`phoneNumber` = $userphoneNumber AND `orders`.`orderName` = '$orderName' AND `orders`.`size` = '$orderSize' AND `orders`.quantity = $deletedQuantity LIMIT 1";
                $deleteResult = mysqli_query($conn,$deleteQuery);
                $ordersN= $ordersN-1;
            }
        }
    }
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Abril+Fatface&family=DM+Serif+Display&family=Dela+Gothic+One&family=Gabarito:wght@400;500;900&family=Josefin+Sans:wght@200;300;400;500&family=Libre+Bodoni&family=Montserrat:wght@400;600;700;800;900&family=Noto+Serif+Display:ital,wght@0,100;0,700;0,800;0,900;1,900&family=Oxygen&family=Pacifico&family=Pixelify+Sans:wght@500&family=Playfair+Display:ital,wght@0,800;1,400;1,500;1,800&family=Poppins:wght@200;500;800;900&family=Prompt:wght@300;500;800;900&family=Roboto&family=Sacramento&family=Sono:wght@400;500&family=Young+Serif&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
    <title>Profile</title>
    <style>
        .title{
            width: 100%;
            height: 20%;
            text-align: center;
            margin:35px 0;
        }
        .title h1{
            font-family: 'Josefin Sans';
            font-size: 50px;
        }
        .title p{
            font-family: 'Prompt';
            color: gray;
            font-weight: lighter;
        }
        .orders{
            margin: 100px 0;
        }
        .orders hr{
            width: 95%;
            margin: 0 2.5%;
        }
        .line{
            position: relative;
            width: 100%;
            height: fit-content;
            display: flex;
            flex-direction: row;
            font-family: 'Josefin Sans';
            justify-content: space-evenly;
            align-items: center;
            margin: 30px 0;
        }
        .line nav h4{
            font-size: 18px;
        }
        .line nav p{
            width: 120px;
            height: 26px;
            max-width: 120px;
            overflow-x: hidden;
            overflow-x: scroll;
            font-family: prompt;
            font-weight: lighter;
            /* max-width: 80px; */
        }
        .line nav p::-webkit-scrollbar{
            visibility: hidden;
            width: 1px;
            height: 2px;
            border-radius: 10px;
            background-color: lightgray;
        }
        .line img{
            width: 100px;
            height: 100px;
            cursor: pointer;
        }
        .delete{
            position:relative;
            width: 50px;
            height: 50px;
            background-color: red;
            border: none;
            border-radius: 10px;
            cursor: pointer;
        }
        .delete img{
            width:20px;
            height: 20px;
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50% , -50%);
        }
        .ordersNumber{
            color: gray;
            font-family: prompt;
            margin: 10px;
            font-size: 13px;
            font-weight: lighter;
        }
        .thunderCard-div{
            width: 100%;
            height: 150px;
            display: flex;
            align-items: center;
            justify-content: start;
        }
        .thunderCard-div nav{
            width: 100px;
            height: 100%;
            margin: 0 10px;
        }
        .thunderCard-div nav img{
            width: 100%;
            height: 100%;
            object-fit: cover;
            border: none;
            border-radius: 10px;
            transition: 0.5s;
        }
        .thunderCard-div nav img:hover{
            transform: scale(1.02);
            cursor: pointer;
        }
        .hidden3{
            transform: translateX(-50px);
            opacity: 0;
            filter: blur(4px);
            transition: 1s;
        }
        .show3{
            transform: translateX(0);
            opacity: 1;
            filter: blur(0px);
            transition: 0.7s 0.3s;
        }
        #grayBackground{
            background-color: #212121;
            opacity: 0.5;
            width: 100%;
            height: 100vh;
            position: fixed;
            top: 0;
            left: 0;
            opacity: 0.5;
            visibility: hidden;
            z-index: 97;
        }
        #cardDiscription{
            width:50%;
            height: 500px;
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50% , -50%);
            background-color: aliceblue;
            display: flex;
            border: none;
            border-radius: 10px;
            visibility: hidden;
            z-index: 98;
            padding: 10px 20px;
        }
        #cardDiscription nav{
            width: 50%;
            height: 100%;
            position: relative;
        }
        #cardDiscription nav:nth-child(1) img{
            width: 95%;
            height: auto;
            border-radius: 10px;
            object-fit: cover;
        }
        #cardDiscription nav:nth-child(1){
            display: flex;
            justify-content: center;
            align-items: center;
        }
        #cardDiscription nav:nth-child(2){
            width: 45%;
            height: 95%;
            margin: 2.5% 0;
            border-left: 1px solid lightgray;
            padding: 0 2.5%;
        }
        #cardDiscription nav:nth-child(2) h4{
            font-family: 'Josefin Sans';
            font-size: 20px;
            margin: 10% 0 0 0;
        }
        #cardDiscription nav:nth-child(2) nav{
            width: 100%;
            display: flex;
            justify-content: space-between;
            align-items: flex-end;
            height: fit-content;
        }
        #cardDiscription nav:nth-child(2) nav img{
            width: 20px;
            height: 20px;
            margin-bottom: 5px;
            z-index: 99;
            cursor: pointer;
        }
        #cardDiscription-p{
            width: 90%;
            font-family: 'prompt';
            font-size: 13px;
            font-weight: lighter;
            color: lightgray;
            margin: 10px 0 0 0;
        }
        #cardDiscription-p:hover{
            transition: 0.7s;
            color: #212121;
        }
        #closeCardsDiscription{
            width: 15px;
            height: 15px;
            z-index: 99;
            cursor: pointer;
        }
        #moreOptions{
            width: 30px;
            height: 30px;
            margin: 0 0 0 20px;
            cursor: pointer;
            visibility: hidden;
        }
        @media (max-width:600px) {
            header ul li{
                visibility: hidden;
            }
            #moreOptions{
                visibility: visible;
            }
            #thunderCard-div{
                overflow-x: scroll;
            }
            .line{
                flex-direction: column;
                text-align: center;
                width: 100%;
            }
            .order img{
                width: 100%;
                height: auto;
            }
            .orderName{
                font-size: 20px;
                font-weight: bolder;
            }
            .delete{
                margin: 30px 0 0 0;
            }
            #cardDiscription{
                padding: 20px 10px;
            }
        }
        @media (max-width:800px) {
            #cardDiscription{
                flex-direction: column;
                width: 90%;
            }
            #cardDiscription nav{
                width: 100%;
                height: 50%;
                padding: 10px 0;
            }
            #cardDiscription nav:nth-child(1){
                position: relative;
            }
            #cardDiscription nav:nth-child(1) img{
                width: 90%;
                height: 100%;
            }
            #cardDiscription nav:nth-child(2){
                width: 90%;
                height: 50%;
            }
        }
        #moreOptions-container{
            width:90%;
            height: 90vh;
            padding: 5vh 5%;
            position: fixed;
            top: 0;
            right: -100% ;
            background-color: aliceblue;
            z-index: 99;
            transition: 0.7s;
        }
        #moreOptions-container a{
            color: #212121;
            text-decoration: none;
        }
        #moreOptions-container h1{
            font-family: 'Gabarito';
            font-size: 50px;
        }
        #moreOptions-container ul{
            list-style: none;
            font-family: prompt;
            font-size: 20px;
            width: 100%;
        }
        #moreOptions-container ul li{
            padding:10px 0;
            margin: 5px 0;
        }
        .header2-nav{
            width: 100%;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        .header2-nav img{
            width: 25px;
            height: 25px;
        }
        @media (max-width:800px) {
            .thunderCard-div{
                justify-content: center;
            }
        }
    </style>
</head>
<body>
<div class="newsBar"><p>thunder Clothes</p><br><p>Your Cart</p></div>
<div id="grayBackground"></div>
    <header>
        <div>
             <a href="index.html"><h1>thunder</h1></a>
             <ul>
                 <a href="store.html"><li>Store</li></a>
                 <a href="newCollection.html"><li>new Collections</li></a>
                 <a href="aboutus.html"><li>About us</li></a>
                 <a href="signin.html"><li>Sign up</li></a>
                 <a href="user.php"><li><img src="images/user.png" alt="your Profile" class="profile"></li></a>
                 <img src="images/dots.png" alt="more" id="moreOptions">
             </ul>
        </div>
     </header>
     <div id="moreOptions-container">
         <nav class="header2-nav"><a href="index.html"><h1>thunder</h1></a><img src="images/close.png" alt="close" id="closeMoreOptions"></nav>
             <ul>
                 <a href="store.html"><li>Store</li></a>
                 <a href="newCollection.html"><li>new Collections</li></a>
                 <a href="aboutus.html"><li>About us</li></a>
                 <a href="signin.html"><li>Sign up</li></a>
                 <a href="user.php"><img src="images/user.png" alt="your Profile" class="profile"></a>
             </ul>
     </div>
    <main>
        <?php
            $cardsQuery = "SELECT * FROM `fidelity card` WHERE phoneNumber=$userphoneNumber";
            $cardsResult = mysqli_query($conn,$cardsQuery);

            echo "<div class='title'><h1>Welcom Back " . $clientName["name"] . "</h1><p>This is your Cart</p></div>";
            
            echo "<div class='thunderCard-div'>";
                 while($YourCards = $cardsResult->fetch_assoc()){
                    echo "
                    <nav class='card hidden3'> 
                    <img src='images/" . $YourCards["cardName"]. ".png' alt='thunder card' id='" . $YourCards['cardName'] . "' onclick='openCard(this)'>
                    </nav>
                    ";
                }  
            echo"
            </div>";
            echo "<p class='ordersNumber'>Number of Orders : " . $ordersN . "</p>";
        ?>
        <div id="cardDiscription">
            <nav><img src="" id="cardDiscriptionImg"></nav>
            <nav>
                <nav>
                    <h4 id="cardName"></h4><img src="images/close.png" alt="close" id="closeCardsDiscription">
                </nav>
                <p id="cardDiscription-p">

                </p>
            </nav>
        </div>
        <hr>
        <div class="orders">
            <?php

                $reqt = ("SELECT * FROM `orders` WHERE phoneNumber = $userphoneNumber");
                $reslt = mysqli_query($conn , $reqt);
                
                $id = 0;
                while($rows = $reslt->fetch_assoc()){
                    echo '
                    <div class="line hidden" id="' . $id . '">
                        <nav class="order"><img src="images/' . $rows["orderName"] . '.png"></nav>
                        <nav class="orderName"><p>' . $rows["orderName"] . '</p></nav>
                        <nav><p>' . $rows["size"] . '</p></nav>
                        <nav><p>' .  $rows["quantity"] . '</p></nav>
                        <nav><p>' . $rows["price"] . '</p></nav>
                        <nav class="delete"><a href="deleteCart.php?deletedCart='. $rows["orderName"] . '&deletesize='. $rows["size"] . '&Quantity=' .$rows["quantity"]. '"><img src="images/delete.png"></a></nav>
                    </div>
                    <hr class="hidden">
                    ';
                    $id = $id+1;
                }
            ?>
        </div>
    </main>
</body>
<script>

    var cardDiscription = document.getElementById('cardDiscription');
    var grayBackground = document.getElementById('grayBackground');
    var cardTitle = document.getElementById('cardName');
    var cardDiscriptionP = document.getElementById('cardDiscription-p');
    var closeMoreOptions = document.getElementById('closeMoreOptions');
        var moreOptions = document.getElementById('moreOptions-container');
        var moreOptionsOpenBtn = document.getElementById('moreOptions');
        moreOptionsOpenBtn.addEventListener('click' , function(){
            moreOptions.style.right = "0%"
        })
        closeMoreOptions.addEventListener('click' , function(){
            moreOptions.style.right = "-100%"
        })

    function openCard(card){

        var cardImg = document.getElementById('cardDiscriptionImg');

        var cardName = card.id;
        cardTitle.innerText = cardName;
        var cardSrc = "images/"+cardName+".png";

        cardDiscription.style.visibility = "visible";
        grayBackground.style.visibility = "visible";

        cardImg.src = cardSrc;

        switch(cardName){
            case "On the Wall" :cardDiscriptionP.innerText = '"on the wall" collection is coming soon. you can pick this card and see what thunder can gives you Like a mestery card. keep this card and thunder will gives you many benefits when "On the Wall" collection is coming out stay tuned';break;
            case "threads" :cardDiscriptionP.innerText = 'threads card gives you 10% offre on threads collections. and if you got this card you get threds Stickers and FreeThreads Poster';break;
            case "its lit" :cardDiscriptionP.innerText = 'a great opertunity with 5% on all "its lit" collections from 1 to 4 and 10% if you order more than tow "its lit" shirts. + Its Lit Stickers';break;
            case "thunder Rock" :cardDiscriptionP.innerText = 'thunder Rock collection is coming soon. you can pick this card and see what thunder can gives you Like a mestery card';break;
        }


    }
    var closeCardsDiscription = document.getElementById('closeCardsDiscription');
        closeCardsDiscription.addEventListener('click' , function(){
        cardDiscription.style.visibility = "hidden";
        grayBackground.style.visibility= "hidden";
    })





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
</script>
<script src="js.js"></script>

</html>