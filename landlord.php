<?php
error_reporting(0);
session_start();
ob_start();
include 'connection.php';
?>



<!doctype html>
<html lang="en">
  <head>
  <?php
include 'links.php';
include 'header.php';
    ?>
<title>R4R LANDLORD</title>
  </head>
  <body>
  <ul class="nav nav-pills nav-justified com">
        <li class="nav-item">
            <a id="link" class="nav-link" href="r4r.php">Home</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="home.php">Login As Student</a>
        </li>
        <li class="nav-item">
            <a class="nav-link active" href="landlord.php">Login As Landlord</a>
        </li>
        <li class="nav-item">
            <a id="link" class="nav-link" href="admin.php">Login As Admin</a>
        </li>
    </ul>


    <form action="landlord.php" method="post">
<div class="container container-fluids">
  <h2 class="text-center about mt-3 mb-2 text-uppercase">Landlord Login</h2>
  <?php
  if(isset($_SESSION['account-ready']))
  {
      ?>
      <div class="text-center rounded border text-center text-body bg-warning">
      <h3 class="mt-3">your data inserted successfully. now you can login as landlord!</h3>
      </div>
      <?php
          unset($_SESSION['account-ready']);
  }

  if(isset($_SESSION['password-change'])){
    ?>
      <div class="text-center rounded border text-center text-body bg-warning">
      <h3 class="mt-3">hiii <?php echo $_SESSION['password-change']; ?> your password is changed</h3>
      </div>
      <?php
          unset($_SESSION['password-change']);
  }


if(isset($_POST['submit']))
{
$number = $_POST['landlord-number'];
$password = $_POST['landlord-password'];
$selectquery = "select * from landlord where aadhar='$number'";
$selectqueryfire = mysqli_query($mydbconnection,$selectquery);
$selectqueryarray = mysqli_fetch_array($selectqueryfire);
$dbnumber = $selectqueryarray['aadhar'];
$dbpassword = $selectqueryarray['password'];
$dbstatus = $selectqueryarray['status'];
$db_landlord_full_name = $selectqueryarray['fullname'];
$check_pass = password_verify($password,$dbpassword);
if($number===$dbnumber&&$check_pass){
  if($dbstatus=="Blocked"){
    $_SESSION['block_name'] = $db_landlord_full_name;
    header('location:blocked_page.php') ;
  }
  $_SESSION['status']= $selectqueryarray['status'];
  $_SESSION['fullname']= $selectqueryarray['fullname'];
$_SESSION['address']= $selectqueryarray['address'];
$_SESSION['contact']= $selectqueryarray['contact'];
$_SESSION['gender']= $selectqueryarray['gender'];
$_SESSION['email']= $selectqueryarray['email'];
$_SESSION['aadhar']= $selectqueryarray['aadhar'];
$_SESSION['password']= $selectqueryarray['password'];
$_SESSION['id']= $selectqueryarray['id'];
$_SESSION['home_tables']=$selectqueryarray['landlord_table'];
if(isset($_POST['rememberme'])){
  setcookie('aadharcookie',$number, time() + (86400 * 30) );
  setcookie('passwordcookie',$password, time() + (86400 * 30) );
  
  ?>
  <script>
      location.replace("landlord-home.php");
  </script>
  <?php
}
else{
  ?>
  <script>
      location.replace("landlord-home.php");
  </script>
  <?php
}
}
else{
  ?>
  <div class="text-center rounded border text-center text-body bg-warning ">
  <h2 class="mt-3 mb-3">wrong aadhar number and password!</h2>
  </div>
  <?php
}}?>

  <div class="card container container-fluids">
    <div class="card-body">
      <p class="card-text"><div class="form-group">
    <label>Aadhar Number:</label>
    <input type="number" class="form-control" value="<?php if(isset($_COOKIE['aadharcookie'])){ echo $_COOKIE['aadharcookie']; } ?>" placeholder="Enter Aadhar Noumber" autocomplete="off" name="landlord-number" required>
  </div></p>
  <p class="card-text"><div class="form-group">
    <label>Password:</label>
    <input type="password" class="form-control" value="<?php if(isset($_COOKIE['passwordcookie'])){ echo $_COOKIE['passwordcookie']; } ?>" placeholder="Enter Password" autocomplete="off" name="landlord-password" required>
  </div></p>
  <p class="card-text"><div class="form-group form-check">
    <label class="form-check-label">
      <input name="rememberme" class="form-check-input" type="checkbox"> Remember My Password
    </label>
  </div></p>
  <p class="card-text"><button name="submit" type="submit" class="btn btn-primary">Login</button></p>
  <div class="row">
        <div class="mr-3">
<p class="card-text">
    <a href="landlord-password.php" class="btn btn-secondary mb-1">I Don't Remember My Password</a>
</p>
</div>
<div class="">
<p class="card-text">
<a href="new-landlord.php" class="btn btn-secondary">I Am A New landlord</a>
</p>
</div>
</div>
    </div>
  </div>
    </div>
    </form>


    <?php
include 'footer.php';
?>
</body>
</html>