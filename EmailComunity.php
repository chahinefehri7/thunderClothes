<?php

include "connect-db.php";

$email = $_POST["sendUsEmail"];
$req = "INSERT INTO `emailcomunity` values('$email')";
$result = mysqli_query($conn,$req);
header("location:index.html");

?>