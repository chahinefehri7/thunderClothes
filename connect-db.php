<?php

$conn = new mysqli('localhost','root','','thunder-db');

if($conn->connect_error){
    die('Connection Faild'.$conn->connect_error);
}

?>