<?php
error_reporting(0);
session_start();
if(!isset($_SESSION['landlord_home_tables']))
{
   header('location:landlord.php');
}
include 'connection.php';
$home_ids = $_GET['id_delete_post_by_admin'];
$home_tables =  $_GET['hometname'];
$delete = "delete from $home_tables where id = $home_ids";
$query = mysqli_query($mydbconnection,$delete);
header('location:admin-home.php') ;
?>