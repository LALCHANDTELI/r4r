<?php
include 'connection.php';
error_reporting(0);
session_start();
if(!isset($_SESSION['landlord_home_tables'])){
    header('location:index.php') ;
}
$landlord_table = $_GET['unblock_tables'];
$update = "UPDATE landlord set status = 'Active'  where landlord_table = '$landlord_table'";
$query = mysqli_query($mydbconnection,$update);
header('location:admin-home.php') ;
?>