<?php
include 'connect-db.php';
if($_COOKIE['userPhoneNumber']==""){
    header("location:signin.html");
}
$userphoneNumber = $_COOKIE['userPhoneNumber'];
$findUserRq = "SELECT * FROM `clients` WHERE phoneNumber=$userphoneNumber";
$findUserResult = mysqli_query($conn,$findUserRq);
if(mysqli_num_rows($findUserResult)<1){
    setcookie("userPhoneNumber" , "");
    header("location:userNotFound.html");
}
// UPDATE `cards` SET `quantity`='[value-3]' WHERE 1

// $reqCards = "SELECT * FROM `cards` ";
// $resCards =mysqli_query($conn,$reqCards);

?> 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="shortcut icon" type="x-icon" href="images/logo.png">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Abril+Fatface&family=DM+Serif+Display&family=Damion&family=Dela+Gothic+One&family=Gabarito:wght@400;500;900&family=Great+Vibes&family=Josefin+Sans:wght@200;300;400;500;600;700&family=Libre+Bodoni&family=Micro+5&family=Montserrat:wght@400;600;700;800;900&family=Noto+Serif+Display:ital,wght@0,100;0,700;0,800;0,900;1,900&family=Orelega+One&family=Outfit:wght@100;200;300;400;500;700;800;900&family=Oxygen&family=Pacifico&family=Pixelify+Sans:wght@400;500;700&family=Playfair+Display:ital,wght@0,800;1,400;1,500;1,800&family=Poppins:wght@200;500;800;900&family=Prompt:wght@200;300;500;600;700;800;900&family=Rakkas&family=Roboto&family=Sacramento&family=Sono:wght@600&family=Yatra+One&family=Young+Serif&display=swap" rel="stylesheet">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thunder Cards</title>
    <!-- <link rel="stylesheet" href="style.css"> -->
    <style>
        *{
            margin: 0;
            padding: 0;
        }
        @font-face {
            font-family: 'PPEditorialNew-Italic';
            src: url(fonts/PPEditorialNew-UltralightItalic-BF644b214ff1e9b.otf);
        }
        /* cards animation */
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
        .hidden3{
            transform: translateX(-150px);
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
        .hidden4{
            transform: translateX(-100px);
            scale: 0.7;
            opacity: 0;
            filter: blur(4px);
            transition: 1s 3s;
        }
        .show4{
            transform: translateX(0);
            scale: 1;
            opacity: 1;
            filter: blur(0px);
            transition: 1s 2.5s;
        }
        .cards div:nth-child(1){
            transition-delay: 100ms;
        }
        .cards div:nth-child(2){
            transition-delay: 200ms;
        }
        .cards div:nth-child(3){
            transition-delay: 300ms;
        }
        .cards div:nth-child(4){
            transition-delay: 400ms;
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
        header ul{
            width:fit-content;
            padding: 0 40px;
            display: flex;
            list-style: none;
            align-items: center;
            position: absolute;
            right: 0;
        }
        header ul li{
            padding: 10px 15px;
            margin: 0 10px;
            font-weight: lighter;
            transition: 0.3s;
        }
        header ul li:hover{
            transform: translateY(-3px);
        }
        .profile{
            width: 25px;
            height: 25px;
            cursor: pointer;
        }
        .title{
            width: 100%;
            height: 100vh;
            position: relative;
            margin: 20px 0;
        }
        .title img{
            width: 100%;
            height: 100%;
            object-fit: cover;
            border-radius: 50px;
        }
        .title button{
            padding: 20px 30px;
            background-color: #FAFDFF;
            color: #121815;
            font-family: 'Josefin Sans';
            border: none;
            border-radius: 50px;
            position: absolute;
            top: 90%;
            left: 50%;
            transform: translate(-50% , -50%);
            cursor: pointer;
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
        .profile{
            width: 25px;
            height: 25px;
            cursor: pointer;
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
        #moreOptions{
            width: 30px;
            height: 30px;
            margin: 0 0 0 20px;
            cursor: pointer;
            visibility: hidden;
        }
        @keyframes slideUp {
            0%{
                transform: translateY(0);
            }
            0%{
                transform: translateY(0);
            }
            20%{
                transform: translateY(-50px);
            }
            60%{
                transform: translateY(-50px);
            }
            100%{
                transform: translateY(0);
            }
            100%{
                transform: translateY(-50px);
            }
        }
        @media (max-width:800px) {
            header ul li{
                pointer-events: none;  
                display: none;
            }
            #moreOptions{
                visibility: visible;
            }
        }
        /*  */
        .container{
            width: 100%;
            height: fit-content;
            display: flex;
            flex-wrap:wrap;
            justify-content: center;
            align-items: center;
            margin-top: 25px;
        }
        .cards{
            margin:0px;
            width: 90%;
            height: 390px;
            display: flex;
            flex-wrap: wrap;
            justify-content:center;
            align-items:center;
            position: relative;
        }
        .card{
            width:300px;
            min-width: 250px;
            height:500px;
            border-radius: 20px;
            display: flex;
            justify-content: center;
            align-items: center;
            position: relative;
            overflow: hidden;
            margin: 20px;
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
            z-index: 99;
        }
        .cardImg{
            position: absolute;
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition:0.7s;
        }
        .card:hover{
            box-shadow:0 0 20px 2px #212121;
        }
        .blur{
            filter: blur(5px);
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
        .cards-pack{
            width: 80%;
            margin: 70px 5%;
            text-align: start;
        }
        .cards-pack h1{
            font-family: 'josefin sans';
            font-size: 45px;
        }
        .cards-pack p{
            font-family: 'prompt';
            font-size: 15px;
            font-weight: lighter;
        }
        hr{
            width: 80%;
            margin: 40px 5% 30px 5%;
            background-color: lightgray;
            border-color: lightgray;
        }
        /* the footer  */
        footer{
            width: 100%;
            height: 350px;
            border-top: 2px solid #121815;
            padding: 50px 0;
            margin: 100px 0 0 0;
            text-align: center;
        }
        footer h1{
            font-family: 'Poppins';
            color: #121815;
        }
        footer p{
            font-family: 'Josefin Sans';
            color: #121815;
        }
        footer div{
            width: 95%;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        footer nav{
            width: 90%;
            height:200px;
            text-align: start;
            margin: 30px 0;
            font-family:'Josefin Sans';
            padding: 20px 5%;
        }
        footer nav:nth-child(1){
            border-right: 1px solid #121815;
        }
        #sendUsEmail{
            width: 300px;
            height: 30px;
            padding:10px;
            margin:30px 10px 10px 10px;
            border: 1px solid #121815;
            background: none;
        }
        #emailBtn{
            padding: 15px 20px;
            width: 90px;
            background-color: #1D1FB8;
            color: #FAFDFF;
            font-family: 'prompt';
            border: none;
            border-radius: 50px;
            margin: 10px;
            cursor: pointer;
        }
        .socialmedia{
            width: 100%;
            height: fit-content;
            display: flex;
            flex-direction: row;
            align-items: center;
        }
        .socialmedia img{
            width: 30px;
            height: 30px;
            margin: 0 10px;
            transition: 0.5ms;
        }
        .socialmedia img:hover{
            transform: translateY(-1px);
        }
        .devId{
            width: 100%;
            height: 20px;
            padding: 5px 0;
            background-color: #121815;
            color: #FAFDFF;
            text-align:center;
        }
        .aroundtheworldicon{
            width: 120px;
        }

        .win-card{
            font-family: prompt;
            margin-left: 5%;
            color: #212121;
            /* text-decoration: none; */
        }


        /*  */
        .container nav{
            /* width:100%;
            min-width:100%;
            height:100%;
            border-radius:20px;
            margin:0 1%;
            box-shadow:0 0 20px 0 #000000;
            overflow:hidden;
            color:#000000;
            font-family:'outfit'; */
        }
        .flip-container{
            width:100%;
            height:90%;
            max-width:100%;
            position:relative;
            display:flex;
            flex-wrap:wrap;
            justify-content:center;
            align-items:center;
        }
        .the-card{
            width:300px;
            height:400px;
            position:relative;
            transform-style:preserve-3d;
            transition:all 0.5s ease;
            margin:0 5%;
            border-radius:25px;
            overflow:hidden;
            margin:20px 10px;
            box-shadow:0 0 20px 0 #000000;
            cursor:default;
        }
        .the-front{
            width:100%;
            height:100%;
            position:absolute;
            z-index: 0;
            border-radius:25px;
        }
        .the-front a{
            width:100%;
            height:100%;
            position:absolute;
        }
        .the-front img{
            width:100%;
            height:100%;
            object-fit:cover;
            border-radius:25px;
        }
        .the-back{
            width:100%;
            height:100%;
            position:absolute;
            opacity: 0;
            z-index: 10;
            transition:0.5s ease;
            border-radius:25px;
        }
        .the-back-img{
            width:100%;
            height:100%;
            object-fit:cover;
            filter: blur(4px); 
            position:absolute;
            border-radius:25px;
        }
        .the-card:hover{
            transform:rotateY(180deg);
            .the-back{
                opacity: 1;
                transform:rotateY(180deg);
            }
        }
        .the-back .p{
            width:90%;
            padding:5%;
            position:absolute;
            top:50%;
            left:50%;
            transform:translate(-50% , -50%);
            color:#FFFFFF;
            text-align:center;
            font-weight:300;
            z-index: 99;
            font-family:'outfit';
        }
        .p h1{
            font-family:'PPEditorialNew-Italic';
            font-size:5vw;
        }
        .p p{
            /* width:100%; */
            /* overflow-y:scroll; */
        }
        .locked{
            width:100%;
            height:100%;
            filter:blur(7px);
        }
        .gray-background img{
            width:30px;
            height:auto;
            object-fit:cover;
        }
        .gray-background{
            position:absolute;
            width:100%;
            height:100%;
            background-color:rgba(0, 0, 0, 0.5);
            top:0;
            left:0;
            display:flex;
            justify-content:center;
            align-items:center;
            border-radius:25px;
            overflow:hidden;
        }
        .img-rarity{
            width:20px;
            height:auto;
        }
        .card-banner{
            width: 90%;
            height:90vh;
            margin:2% 5%;
            border-radius:30px;
            overflow:hidden;
        }
        .card-banner img{
            width:100%;
            height:100%;
            object-fit:cover;
        }
    </style>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="newsBar"><p>thunder Clothes</p><br><p>New Collections</p></div>
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
                <div class="headericons">
                    <a href="user.php"><img src="images/user.png" alt="your Profile" class="profile"></a>
                    <a href="thunderCards.php"><img src="images/thunderCardsIcon.png" alt="thunder Cards" class="thunderCards"></a>
                </div>
            </ul>
    </div>    
    <a href="card.php?cardName=Its Lit&rarity=Common" class="win-card">Win a Card</a>
    <nav class="cards-pack">
        <h1>a Cards Pack!</h1>
        <p>this is a cards pack that contain the same Name but different cards Rarity</p>
    </nav>
    <div class="card-banner">
        <img src="images/Business_Card_Mockup_22.png">
    </div>
    <div class="container">
    <?php
        $allThunderCards = "SELECT * FROM `cards` ORDER BY `cards`.`cardName` DESC";
        $allThunderCardsResult = mysqli_query($conn,$allThunderCards);
        echo '<div class="flip-container">'; 
        while($AllCardsRows = $allThunderCardsResult->fetch_assoc()){
            $cardName = $AllCardsRows['cardName'];
            $cardRarity = $AllCardsRows['cardRarity'];
            $discription = $AllCardsRows['discription'];
            $reqCardCollection = "SELECT * FROM `cardscollection` WHERE `ownerPhoneNumber`=$userphoneNumber AND `cardName`='$cardName' AND `cardRarity`='$cardRarity'";
            $resultCardCollection = mysqli_query($conn,$reqCardCollection);
            $resultCardCollectionRows = mysqli_num_rows($resultCardCollection);
            echo '
                <div class="the-card">
                        <nav class="the-front">';
                            if($resultCardCollectionRows>0){
                                echo '<img src="images/'.$cardName.' '.$cardRarity.'.png">';
                            }else{
                                echo '<img src="images/'.$cardName.' '.$cardRarity.'.png" class="locked"><div class="gray-background"><img src="images/lock.png" class="img-lock"></div>';
                            }
                    echo '</nav>
                        <nav class="the-back">';
                        if($resultCardCollectionRows>0){
                            echo '
                            <a href="cardsOwners.php?cardName='.$cardName.'&rarity='.$cardRarity.'&lock=unlocked">
                                <div class="p">
                                    <img src="images/'.$cardRarity.'.png" class="img-rarity">
                                    <h1>'.$cardName.'</h1>
                                    <h5>'.$cardRarity.'</h5>
                                    <p>'.$discription.'</p>
                                </div>
                            </a>';
                        }else{
                            echo '
                            <a href="cardsOwners.php?cardName='.$cardName.'&rarity='.$cardRarity.'&lock=locked">
                                <div class="p">
                                    <img src="images/'.$cardRarity.'.png" class="img-rarity">
                                    <h1>'.$cardName.'</h1>
                                    <h5>'.$cardRarity.'</h5>
                                    <p>'.$discription.'</p>
                                </div>
                            </a>';
                        }
                        
                        echo '
                        <div class="gray-background"></div>
                        <img src="images/'.$cardName.' '.$cardRarity.'.png" class="the-backImg"">
                            
                    </nav>
                </div>';            
        }
        echo '</div>';
    ?>
    <?php
        // while($cardsRows = $resCards->fetch_assoc()){
        //     $cardName = $cardsRows['cardName'];
        //     $cardRarity = $cardsRows['cardRarity'];
        //     $cardDiscription = $cardsRows['discription'];

        //     $reqCardCollection = "SELECT * FROM `cardscollection` WHERE `ownerPhoneNumber`=$userphoneNumber AND `cardName`='$cardName' AND `cardRarity`='$cardRarity';";
        //     $resultCardCollection = mysqli_query($conn,$reqCardCollection);
        //     if(mysqli_num_rows($resultCardCollection)>0){
        //         echo'
        //             <a href="cardsOwners.php?cardName='.$cardName.'&rarity='.$cardRarity.'&lock=unlocked"><div class="card hidden3"><img class="cardImg" src="images/'.$cardName.' '.$cardRarity.'.png" alt="'.$cardName.' card"></div></a>
        //         ';
        //     }else{
        //         echo'
        //             <a href="cardsOwners.php?cardName='.$cardName.'&rarity='.$cardRarity.'&lock=locked"><div class="card hidden3"><img class="cardImg blur" src="images/'.$cardName.' '.$cardRarity.'.png" alt="'.$cardName.'"><div class="graybackground"></div><div class="cardDiscription"><img src="images/lockIcon.png" alt="lock" class="locked"><h4 class="cardName">'.$cardName.' '.$cardRarity.'</h4><p class="cardP">'.$cardDiscription.'</p></div></div></a>
        //         ';
        //     }
        // }

    ?>
    </div>
    <footer>
        <h1>Thunder Clothes</h1>
        <p>You can check our social media and stay tuned</p>
        <div>
            <nav>
                <h3>Thunder Email</h3>
                <form action="EmailComunity.php" method="post">
                    <input type="text" name="sendUsEmail" id="sendUsEmail" placeholder="Email"><br>
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
                <a href="aroundTheWorld.html"><img src="images/aroundtheworldicon.png" class="aroundtheworldicon"></a>
            </nav>
        </div>
        <nav class="devId">Made By Chahine Fehri</nav>
    </footer>
    <script>
        var closeMoreOptions = document.getElementById('closeMoreOptions');
        var moreOptions = document.getElementById('moreOptions-container');
        var moreOptionsOpenBtn = document.getElementById('moreOptions');
        moreOptionsOpenBtn.addEventListener('click' , function(){
            moreOptions.style.right = "0%"
        })
        closeMoreOptions.addEventListener('click' , function(){
            moreOptions.style.right = "-100%"
        })
        // 1st observer for elements animation
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

            // 2nd observer for other elements animation
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
            // 3rd observer for elements animation key frame
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
            // 4th observer for the left sliding elements  check the css for it
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



            var closeMoreOptions = document.getElementById('closeMoreOptions');
            var moreOptions = document.getElementById('moreOptions-container');
            var moreOptionsOpenBtn = document.getElementById('moreOptions');
            moreOptionsOpenBtn.addEventListener('click' , function(){
                moreOptions.style.right = "0%"
            })
            closeMoreOptions.addEventListener('click' , function(){
                moreOptions.style.right = "-100%"
            })
    </script>
</body>
</html>



