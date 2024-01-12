<?php

include 'connect-db.php';

$req = ("SELECT * FROM `clients`");

$res = mysqli_query($conn , $req);



?>




<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Abril+Fatface&family=DM+Serif+Display&family=Dela+Gothic+One&family=Gabarito:wght@400;500;900&family=Josefin+Sans:wght@200;300;400;500&family=Libre+Bodoni&family=Montserrat:wght@400;600;700;800;900&family=Noto+Serif+Display:ital,wght@0,100;0,700;0,800;0,900;1,900&family=Oxygen&family=Pacifico&family=Pixelify+Sans:wght@500&family=Playfair+Display:ital,wght@0,800;1,400;1,500;1,800&family=Poppins:wght@200;500;800;900&family=Prompt:wght@300;500;800;900&family=Roboto&family=Sacramento&family=Sono:wght@400;500&family=Young+Serif&display=swap" rel="stylesheet">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>THUNDER</title>
    <style>
        .line{
            position: relative;
            width: 100%;
            height: fit-content;
            display: flex;
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
            width: 20px;
            height: auto;
            position: absolute;
            top: -24px;
            right: 30px;
            cursor: pointer;
        }
        hr{
            width: 96%;
            margin: 0 2%;
        }
        #grayBackGround{
            visibility: hidden;
            width: 100%;
            height: 100vh;
            position: fixed;
            top: 0;
            left: 0;
            background-color: #212121;
            opacity: 0.4;
            z-index: 90;
        }
        #options{
            visibility: hidden;
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50% , -50%);
            width: 480px;
            height: 250px;
            border-radius: 20px;
            border: none;
            background-color: aliceblue;
            text-align: center;
            z-index: 99;
            font-family:'Josefin Sans';
            padding: 50px 20px;
        }
        #options h1{
            margin-bottom: 20%;
        }
        #options button{
            width: 100%;
            margin: 4px 0%;
            font-family: prompt;
            background-color: blue;
            padding: 20px;
            border: none;
            border-radius: 10px;
            color: #f1f1f1;
            font-size: 18px;
            cursor: pointer;
        }
        #options img{
            width: 20px;
            height: 20px;
            position: absolute;
            top: 20px;
            right: 20px;
            cursor: pointer;

        }
        #options button:nth-child(4){
            background-color: red;
        }
    </style>
</head>
<body>
    <div class="newsBar"><p>thunder Clothes</p></div>
    <div class="line">
        <nav><h4>Name</h4></nav>
        <nav><h4>Last Name</h4></nav>
        <nav><h4>State</h4></nav>
        <nav><h4>Adresse</h4></nav>
        <nav><h4>Email</h4></nav>
        <nav><h4>Password</h4></nav>
        <nav><h4>Phone Number</h4></nav>
    </div>
    <div id="grayBackGround"></div>
    <div id="options">
        <img src="images/close.png" id="close">
        <h1>More options</h1>
        <button id="update">Update</button>
        <button id="delete">Delete</button>
    </div>
    <hr>
    <?php

        $id = 1;
        while($rows = $res->fetch_assoc()){
            echo "
            <div class='line' id=". $id .">
            <img src='images/dots.png' id='more'>
                <nav><p>" . $rows["name"] . "</p></nav>
                <nav><p>" . $rows["lastName"] . "</p></nav>
                <nav><p>" . $rows["state"] . "</p></nav>
                <nav><p>" . $rows["adresse"] . "</p></nav>
                <nav><p>" . $rows["Email"] . "</p></nav>
                <nav><p>" . $rows["password"] . "</p></nav>
                <nav><p>" . $rows["phoneNumber"] . "</p></nav>
            </div>
            <hr>
            ";
            $id = $id+1;
        }
    ?>


<script>
    var closeTab = document.getElementById("close");
    var grayBackGround = document.getElementById("grayBackGround");
    var options  = document.getElementById('options');
    var more = document.getElementById('more');

    closeTab.addEventListener('click' , function(){
        grayBackGround.style.visibility = "hidden";
        options.style.visibility = "hidden";
    })
    more.addEventListener('click' , function(){
        grayBackGround.style.visibility = "visible";
        options.style.visibility = "visible";
    })
</script>
</body>
</html>