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
    $array_counter = mysqli_fetch_array($query);
    $update_visitor_counter = $array_counter['counter'];
}
else{
    $select_counter = "select counter from visitor";
    $query = mysqli_query($mydbconnection,$select_counter);
    $array_counter = mysqli_fetch_array($query);
    $update_visitor_counter = $array_counter['counter'];
}
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <title>MY PAGE</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
        <style>
        body{
            background-color:#A20A3A;
        }
        hr{
            border:2px solid white;
        }
        .toptitle{
            background-color: #3D1558;
        }
        ul
        {
            list-style-type: none;
        }
        *a{
            text-decoration: none;
            text-decoration-line: none;
        }
        </style>
        <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    </head>
    <body>
    <div class="toptitle text-center text-white">
    <dl>
  <dt>MY COLLAGE PAGE</dt>
  <dd>.........</dd>
    </dl>
    </div>
    <marquee class="text-white font-weight-bold">
    WELCOME TO MY COLLAGE PAGE  I HOPE YOU ALL FINE ! STAY HOME  & STAY SAFE !!   IF YOU NEED TO LEAVE YOUR HOUSE, WEAR A MASK !!!
    </marquee>   
    <hr>   
<div class="btn-group-justified text-center mx-5 my-5 py-3 px-3">
<a href="r4r.php"><button type="button" class="btn my-2 btn-outline-primary text-white">R4R</button></a>
<a href="https://singleshope.000webhostapp.com/"><button type="button" class="btn my-2 btn-outline-primary text-white">Single Shop</button></a>
<a href="about_me.php"><button type="button" class="btn my-2 btn-outline-primary text-white">About Me</button></a>
<div class="dropdown">
  <button class="btn btn-outline-primary text-white dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
    Uske Number
  </button>
  <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
    <a class="dropdown-item" href="raila/">Raila Wale</a>
    <a class="dropdown-item" href="sangam/">Sangam Wale</a>
  </div>
</div>
</div>
<hr>
<div class="mt-5">
  <div class="text-white my-1 text-center">
  <h6>Site Visitors</h6>
<p>This Week : <span class="text-warning">Not Ready</span></p>
<p>This Month : <span class="text-warning">Not Ready</span></p>
<p>Total : <?php echo $update_visitor_counter; ?></p>
</div>
</div>
<footer class="mt-5 text-center toptitle text-white">
<h3>This Site Create & Design By lal chand  :) </h3>
<a href="index.php" class="btn btn-success bg-light text-dark mb-3">www.mypage.com</a>
</footer>
</body>
</html>