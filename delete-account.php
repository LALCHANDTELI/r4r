<?php
include 'connection.php';
error_reporting(0);
session_start();
if(!isset($_SESSION['id']))
{
   header('location:landlord.php') ;
}


$account_ids = $_SESSION['id'];
$home_tables = $_SESSION['home_tables'];
$home_aadhar = $_SESSION['aadhar'];
$delete = "delete from landlord where id = $account_ids ";
$query = mysqli_query($mydbconnection,$delete);
$table_delete = "DROP TABLE $home_tables";
$query2 = mysqli_query($mydbconnection,$table_delete);
$dir = "landlord_images";
rmdir(landlord_images.'/'.$home_aadhar);
session_destroy();
setcookie('aadharcookie','', time() - 3600 );
setcookie('passwordcookie','',  time() - 3600 );
header('location:landlord.php') ;
?>