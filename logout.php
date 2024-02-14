<?php

include "connect-db.php";


// delete the cookies
setcookie('userPhoneNumber' , FALSE);
setcookie('orderName' , FALSE);
setcookie('orderPrice' , FALSE);
setcookie('itemGameScore' , FALSE);
setcookie('cardName' , FALSE);


// loading page
// echo '<meta http-equiv="refresh" content="2;url=index.html">';
// echo '<progress max=100><strong>Progress: 60%
// done.</strong></progress><br>'

header("location:index.html");

?>