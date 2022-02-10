<?php
session_start();
session_destroy();
setcookie('aadharcookie','', time() - 3600 );
setcookie('passwordcookie','',  time() - 3600 );
header('location:landlord.php'); 
?>