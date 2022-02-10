<?php
session_start();
include 'connection.php';
error_reporting(0);
if(!isset($_COOKIE['visitor_counts']))
{
    $count = "counter";
    setcookie('visitor_counts',$count, time() + (3 * 365 * 24 * 60 * 60), "/"  );
    $update_counter = "UPDATE visitor set counter =  counter + 1 where id = '1'";
    $query = mysqli_query($mydbconnection,$update_counter);
}
?>
<!doctype html>
<html lang="en">
  <head>
<title>About Me</title>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
<style>
body{
  background-image: url("images/mypage.jpg");
  background-size: cover;
}

</style>
  </head>
  <body>
<section>
<ul class="nav nav-pills nav-justified bg-secondary border rounded mt-3 ">
        <li class="nav-item">
            <a class="nav-link active" href="index.php">Admin</a>
        </li>
    </ul>
    <section>
<div class="container col-lg-4 col-md-6 col-sm-12 col-12">
    <div class="card mx-3 mt-3 text-white border rounded" >
    <img class="card-img-top d-block w-100" src="images/admin-lal chand1.jpg" alt="admin-lal_chand" style="width:100%">
    <div class="card-body border  text-center bg-info">
    <p class="card-text">Nothing is over until you stop trying.</p>
    <br>
    <p class="card-text">
hiii friends my name is lal chand.<br>
i'm student of computer science.
<br>
my b tech is running in sangam university.</p><br>
<br>
<div class="border rounded card-text bg-success card-text">
<p class="mt-3">if you any doubt/query/suggestion about this site contact me on mail.<a class="text-white" href="mailto:lalchandteli13@gmail.com"><br>lalchandteli13@gmail.com</a></p>
</div>
     </div>
     </div>    
     </div>   
    </section>
<footer class="text-center mt-3 bg-dark text-white">
<h3>This Site Create & Design By lal chand  :) </h3>
  <a href="index.php" class="btn btn-success bg-light text-dark mb-3">www.mypage.com</a>
</footer>
</body>
</html> 