<?php
error_reporting(0);
session_start();
if(!isset($_SESSION['fullname']))
{
   header('location:landlord.php') ;
}
include 'connection.php';

$home_ids = $_GET['delete_post_by_landlord'];
$home_tables = $_SESSION['landlord_tables'];
$delete = "delete from $home_tables where id = $home_ids ";
$query = mysqli_query($mydbconnection,$delete);
header('location:landlord-home.php') ;
?>