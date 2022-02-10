<?php
session_start();
include 'connection.php';
error_reporting(0);
?>


<!doctype html>
<html lang="en">
  <head>
    <?php
include 'links.php';
include 'header.php';
    ?>
    <title>R4R ADMIN</title>
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
            <a class="nav-link" href="landlord.php">Login As Landlord</a>
        </li>
        <li class="nav-item">
            <a id="link" class="nav-link active" href="admin.php">Login As Admin</a>
        </li>
    </ul>



<form action="" method="post">
<div class="container container-fluids">
  <h2 class="text-center about mt-3 mb-2">Admin Login</h2>
  <?php
if(isset($_SESSION['new-admin']))
{
    ?>
    <div class="text-center rounded border text-center text-body bg-success">
    <h3 class="mt-3">new username and password set. you can login now :)</h3>
    </div>
    <?php
        unset($_SESSION['new-admin']);
}

    ?>
  <div class="card container container-fluids">
    <div class="card-body">
      <p class="card-text"><div class="form-group">
    <label>Username:</label>
    <input type="text" class="form-control" placeholder="Enter Your Username" autocomplete="off" name="admin-username" required>
  </div></p>
  <p class="card-text"><div class="form-group">
    <label>Password:</label>
    <input type="password" class="form-control" placeholder="Enter Your Password" name="admin-password" required>
  </div></p>
  <p class="card-text"><button type="submit" name="submit" class="btn btn-primary">Login</button></p>
    </div>
  </div>
    </div>
    </form>
<?php
include 'footer.php';
?>
</body>
</html>



<?php
if(isset($_POST['submit'])){
  $username = $_POST['admin-username'];
  $password = $_POST['admin-password'];

  $selectquery = "select * from admin";
  $selectqueryfire = mysqli_query($mydbconnection,$selectquery);
  $selectfetcharray = mysqli_fetch_array($selectqueryfire);
  $dbusername = $selectfetcharray['username'];
  $dbpassword = $selectfetcharray['password'];
  if($dbusername == "" && $dbpassword == "")
  {
    $_SESSION['username']= $selectfetcharray['username'];
    $c_password = password_hash($password,PASSWORD_BCRYPT);
    $insert = "insert into admin (username , password) values ('$username' , '$c_password')";
    $query = mysqli_query($mydbconnection,$insert);
        $_SESSION['new-admin'] = "new-admin";
        header('location:admin.php') ;
  }
  else{

 
  $check = password_verify($password,$dbpassword);
if($check){
  if($username===$dbusername){
    $_SESSION['username']= $selectfetcharray['username'];
        ?>
        <script>
            location.replace("admin-home.php");
        </script>
        <?php
      }
}
  
else{
  ?>
<script>
    location.replace("index.php");
</script>
<?php
}
}


}?>


