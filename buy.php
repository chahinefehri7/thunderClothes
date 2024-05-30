<?php

include "connect-db.php";
?>
<?php

$orderName = $_COOKIE['orderName'];
$orderPrice = $_COOKIE['orderPrice'];
$userPhoneNumber = $_COOKIE['userPhoneNumber'];
$size = $_POST["size"];
$quantity = $_POST["quantity"];
// cutting the actual price to convert it to an integer
$thePrice = $orderPrice;
$thePrice = explode("D" , $thePrice);
$thePrice = $thePrice[0];
// converting the price to a float
$thePrice = (float)$thePrice;
// calculating the total of the price
$totalPrice = $thePrice*$quantity;

setcookie("quantity" , $quantity);
setcookie("size" , $size);
setcookie("orderPrice" , $totalPrice);



if($userPhoneNumber==""){
    header("location:completeOrderInformations.php");
}else{
    $productName = $orderName;
    $price = $orderPrice;
    $size = $_POST['size'];
    $quantity = $_POST['quantity'];
    
    // cutting the actual price to convert it to an integer
    $thePrice = $price;
    $thePrice = explode("D" , $thePrice);
    $thePrice = $thePrice[0];
    // converting the price to a float
    $thePrice = (float)$thePrice;
    // calculating the total of the price
    $totalPrice = $thePrice*$quantity;
    // checking thunder cards
    // if he got a card matches the product we gives him an offre
    $CardRq = "SELECT * FROM `fidelity card` WHERE phoneNumber=$userPhoneNumber";
    $CardRes = mysqli_query($conn,$CardRq);
    while($CardRows = $CardRes->fetch_assoc()){
        if($CardRows['persontage']!='unknown'){
            $persontage = $CardRows['persontage'];
            $persontage = explode("%" , $persontage);
            $persontage = $persontage[0];
            $persontage = (float)$persontage;
            $CardName = $CardRows['cardName'];
            if($CardName." عقد" == $orderName || $CardName." عقد New" == $orderName){
                $totalPrice = $totalPrice - ($totalPrice * $persontage)/100;
            }else{
                if($CardName." thunder" == $orderName || $CardName." thunder 2" == $orderName || $CardName." thunder 3" == $orderName || $CardName." thunder 4" == $orderName){
                    $itsLitOrdersNumber = 0;
                    $itsLitOrdersNumberReq = "SELECT * FROM `orders` WHERE phoneNumber=$userPhoneNumber";
                    $itsLitOrdersNumberResult = mysqli_query($conn,$itsLitOrdersNumberReq);
                    while($itsLitOrdersNumberRows = $itsLitOrdersNumberResult->fetch_assoc()){
                        $TheOrderName=$itsLitOrdersNumberRows["orderName"];
                        if($CardName." thunder" == $TheOrderName || $CardName." thunder 2" == $TheOrderName || $CardName." thunder 3" == $TheOrderName || $CardName." thunder 4" == $TheOrderName){
                            $itsLitOrdersNumber = $itsLitOrdersNumber+$itsLitOrdersNumberRows['quantity'];
                        }
                    }
                    if($itsLitOrdersNumber>=2){
                        $totalPrice = $totalPrice - ($totalPrice * ($persontage*2))/100;
                    }else{
                        $totalPrice = $totalPrice - ($totalPrice * $persontage)/100;
                    }
                }
            }
        }
    }
    
    
    // converting the total price to a string the concat with the word "DT" so it became "(price)DT"
    $totalPrice = (string)$totalPrice ." DT";
    
    $req1 = "SELECT * FROM `clients` WHERE phoneNumber=$userPhoneNumber";
    $res1 = mysqli_query($conn,$req1);
    
    $rows = $res1->fetch_assoc();
    $name = $rows["name"];
    $lastName = $rows["lastName"];
    $adresse = $rows["adresse"];
    $email = $rows["Email"];
    $phoneNumber = $rows["phoneNumber"];
    $date = date("Y-m-d");
    
    $req2 = ("INSERT INTO `orders`  values('$name','$lastName','$adresse','$email',$phoneNumber,'$productName','$size',$quantity,'$totalPrice','$date')");
    $res2 = mysqli_query($conn,$req2);
    
    header("location: store.html");
}

?>