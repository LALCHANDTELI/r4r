<?php
include 'connection.php';
error_reporting(0);
session_start();
if(!isset($_SESSION['landlord_home_tables'])){
    header('location:index.php') ;
}
$landlord_table = $_GET['block_tables'];
$update = "UPDATE landlord SET status = 'Blocked' WHERE landlord_table = '$landlord_table'";
$query = mysqli_query($mydbconnection,$update);
header('location:admin-home.php');
?>