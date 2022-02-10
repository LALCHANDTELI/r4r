<?php
include 'connection.php';
error_reporting(0);
session_start();
if(!isset($_SESSION['username']))
{
   header('location:landlord.php') ;
}


$account = $_GET['account'];
$home_aadhar = $_SESSION['aadhar'];
$delete = "delete from landlord where landlord_table = '$account'";
$query = mysqli_query($mydbconnection,$delete);
$table_delete = "DROP TABLE $account";
$query2 = mysqli_query($mydbconnection,$table_delete);
$dir = "landlord_images";
rmdir(landlord_images.'/'.$home_aadhar);
header('location:admin-home.php') ;
?>