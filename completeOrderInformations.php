<?php
include "connect-db.php";

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Abril+Fatface&family=DM+Serif+Display&family=Dela+Gothic+One&family=Gabarito:wght@400;500;900&family=Josefin+Sans:wght@200;300;400;500;600;700&family=Libre+Bodoni&family=Montserrat:wght@400;600;700;800;900&family=Noto+Serif+Display:ital,wght@0,100;0,700;0,800;0,900;1,900&family=Orelega+One&family=Outfit:wght@100;200;300;400;500;700;800;900&family=Oxygen&family=Pacifico&family=Pixelify+Sans:wght@400;500;700&family=Playfair+Display:ital,wght@0,800;1,400;1,500;1,800&family=Poppins:wght@200;500;800;900&family=Prompt:wght@200;300;500;600;700;800;900&family=Roboto&family=Sacramento&family=Sono:wght@400;500&family=Young+Serif&display=swap" rel="stylesheet">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Complete Your Order</title>
</head>
<style>
    *{
        margin: 0;
        padding: 0;
    }
    .theDiv{
        width: 100%;
        height: 100vh;
        padding-top: 5%;
        background-color: white;
        display: flex;
        flex-direction: column;
        justify-content: start;        
        align-items: center;
    }
    .theDiv h1{
        font-family: 'josefin sans';
        font-size: 40px;
    }
    .theDiv form{
        width: 100%;
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
        margin: 4% 0;
    }
    .input{
        width:330px;
        padding: 20px 20px;
        border: none;
        border-radius: 20px;
        background-color: #F0EFEF;
        font-family: 'Outfit';
        font-weight: 300;
        outline: none;
        margin: 5px 0;
    }
    .already-have-acc{
        font-family: 'Outfit';
        font-weight: 200;
        color: gray;
        margin: 20px 0;
    }
    .submit{
        width: 100px;
        padding: 15px 10px;
        color: aliceblue;
        background-color: #1D1FB8;
        border: none;
        border-radius: 50px;
        font-family: 'outfit';
        outline: none;
        cursor: pointer;
    }
    .submit:hover{
        transform:translateY(-1px);
        background-color: #3033c7;
    }
    .YourOrderH1{
        font-family: 'josefin sans';
        font-size: 30px;
        margin: 20px;
    }
    .your-order{
        width: 100%;
        height: 70vh;
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: start;
    }
    .your-order img{
        width: 80%;
        height: auto;
    }
    .your-order h2{
        font-family: 'josefin sans';
        font-size: 30px;
    }
    .your-order p{
        font-family: 'outfit';
        color: gray;
        font-weight: 300;
        font-size: 20px;
    }
    @media (max-width:800px) {
        .theDiv{
            justify-content: center;
        }
        .theDiv h1{
            font-size: 25px;
            margin: 5% 0;
        }
        .input{
            width: 250px;
        }
    }
</style>
<body>
<div class="theDiv">
    <h1>Complete Your Order</h1>
    <form action="completeOrder.php" method="post" onsubmit="return verif()">
        <input type="text" name="name" id="name" class="input" placeholder="name">
        <input type="text" name="lastName" id="lastName" class="input" placeholder="lastName">
        <input type="text" name="adresse" id="adresse" class="input" placeholder="Adresse">
        <input type="number" name="phoneNumber" id="phoneNumber" class="input" placeholder="Phone Number">
        <a href="login.html" class="already-have-acc">Already have an account ?</a>
        <input type="submit" value="Submit" class="submit" id="submit">
    </form>
</div>
<hr>
<h1 class="YourOrderH1">Your Order</h1>
<div class="your-order">
    <?php
            $orderName = $_COOKIE['orderName'];
            $orderPrice = $_COOKIE['orderPrice'];

            echo "<img src='images/$orderName.png' alt=''>";
            echo "<h2>$orderName</h2>";
            echo "<p>Price $orderPrice Dt</p>";
    ?>
</div>

<script>
    function verif(){
        var name = document.getElementById('name').value;
        var lastName = document.getElementById('lastName').value;
        var state = document.getElementById('state').value;
        var adresse = document.getElementById('adresse').value;
        var phoneNumber = document.getElementById('phoneNumber').value;

        if(name==""){
            alert("Please Write Your Name");
            return false;
        }
        if(lastName==""){
            alert("Please Write Your Last Name");
            return false;
        }
        if(adresse==""){
            alert("Please Write Your Adresse");
            return false;
        }
        if(phoneNumber==0){
            alert("Please Write Your Phone Number");
            return false;
        }
        if(phoneNumber.length!=8){
            alert("Your Phone Number is Wrong please try again");
            return false;
        }
    }
</script>
</body>
</html>