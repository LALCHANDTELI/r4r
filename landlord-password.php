<?php
session_start();
error_reporting(0);
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

    <div class="container mt-3">
        <form action="" method="post">
        <div class="form-group">
    <table class="landlord-password table table-sm table-dark">
  <thead>
      <th colspan="2">
     <h3 class="text-center">Landlord Info</h3>
     </th>
     <?php
if(isset($_POST['submit']))
{
    $aadhar = $_POST['aadhar'];
    $email = $_POST['email'];
    $new_password = $_POST['new_password'];
    $selectquery = "select * from landlord where aadhar = '$aadhar'";
    $selectqueryfire = mysqli_query($mydbconnection,$selectquery);
    $selectqueryarray = mysqli_fetch_assoc($selectqueryfire);
    $dbaadhar = $selectqueryarray['aadhar'];
    $dbemail = $selectqueryarray['email'];
    if(($dbaadhar===$aadhar) && ($dbemail===$email))
    {
        $dbusername = $selectqueryarray['fullname'];
        $new_s_password = password_hash($new_password,PASSWORD_BCRYPT);
    $update = "UPDATE landlord set password = '$new_s_password' where aadhar = '$aadhar'";
    $query = mysqli_query($mydbconnection,$update);
    if($query){
      $_SESSION['password-change'] = $dbusername ;
      ?>
      <script>
          location.replace("landlord.php");
      </script>
      <?php
    }
  }else{
    ?>
      <div class="text-center rounded border text-center text-body bg-warning">
      <h3 class="mt-3 mb-3"><?php echo "wrong aadhar number and email"; ?></h3>
      </div>
      <?php
  }
} 

?>
  </thead>
  <tbody>
    <tr>
      <th scope="row"> <label>Aadhar Number :</label></th>
      <td>
    <input type="number" name="aadhar" class="form-control" required autocomplete="off" placeholder="12 Digit Aadhar Number"/></td>
    </tr>
    <tr>
      <th scope="row"> <label>E-mail :</label></th>
      <td>
    <input type="email" name="email" class="form-control" required autocomplete="off" placeholder=" Enter E-mail" /></td>
    </tr>
    <tr>
      <th scope="row"> <label>New Password :</label></th>
      <td>
    <input type="password" name="new_password" class="form-control" required autocomplete="off" placeholder=" Enter Password" /></td>
    </tr>
    <tr>
      <td colspan="2">
    <input type="submit" name="submit" class="form-control btn btn-success" value="Submit"/></td>
    </tr>
  </tbody>
</table>
<div>
</form>
    </div>


   
</body>
</html>


 <?php
include 'footer.php';
?>