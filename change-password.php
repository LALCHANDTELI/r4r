<?php
include 'connection.php';
include 'links.php';
error_reporting(0);
session_start();
if(!isset($_SESSION['username']))
{
   header('location:landlord.php') ;
}
?>
<title>R4R ADMIN</title>
<div class="card bg-dark mt-5 container container-fluids">
    <div class="card-body">
<div class="container text-white">
  <h2>Password Changing...</h2>
  <form  method="post">
    <div class="form-group">
      <label>Username:</label>
      <input type="text"  class="form-control" required autocomplete="off" placeholder="Enter username" name="username">
    </div>
    <div class="form-group">
      <label>Password:</label>
      <input type="password" class="form-control" required autocomplete="off" placeholder="Enter password" name="password">
    </div>
    <button type="submit" name="submit" class="btn btn-primary">Change</button>
  </form>
</div>
</div>
</div>
<?php
if(isset($_POST['submit'])){
$username = $_POST['username'];
$password = $_POST['password'];
$adminoldid = $_GET['change'];
$c_password = password_hash($password,PASSWORD_BCRYPT);
$password_id = $_SESSION['password_id'];
$update = "UPDATE admin set id = 1 , username = '$username' , password = '$c_password' where id = $adminoldid";
$query = mysqli_query($mydbconnection,$update);
if($query){
    $_SESSION['username'] = $username;
    $_SESSION['changed'] = "changed";
    header('location:admin-home.php');
}else{
    $_SESSION['not-change'] = "not-change";
    header('location:admin-home.php');
}
}
?>