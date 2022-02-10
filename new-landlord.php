<?php
error_reporting(0);
session_start();
include 'connection.php';
?>
<!doctype html>
<html lang="en">
  <head>
  <?php
include 'links.php';
include 'header.php';
    ?>
<title>R4R NEW LANDLORD</title>
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
        <form action="new-landlord.php" method="post">
        <div class="form-group">
    <table class="new-landlord table table-sm table-dark">
  <thead>
      <th colspan="2">
     <h3 class="text-center">Registration</h3>
     </th>
  </thead>
  <?php
  if(isset($_SESSION['account-not-ready']))
  {
      ?>
      <div class="text-center rounded border text-center text-body bg-warning">
      <h3 class="mt-3">data not inserted. try again!</h3>
      </div>
      <?php
          unset($_SESSION['account-not-ready']);
  }
  if(isset($_SESSION['account-not-password']))
  {
      ?>
      <div class="text-center rounded border text-center text-body bg-warning">
      <h3 class="mt-3">password dose not match. both password must be same :) </h3>
      </div>
      <?php
          unset($_SESSION['account-not-password']);
  }
  if(isset($_SESSION['account-not-aadhar']))
  {
      ?>
      <div class="text-center rounded border text-center text-body bg-warning">
      <h3 class="mt-3">someone already registered with this aadhar number</h3>
      </div>
      <?php
          unset($_SESSION['account-not-aadhar']);
  }
  if(isset($_SESSION['account-not-Correct']))
  {
      ?>
      <div class="text-center rounded border text-center text-body bg-warning">
      <h3 class="mt-3">Please Enter Correct Aadhar/contact Number :) </h3>
      </div>
      <?php
          unset($_SESSION['account-not-Correct']);
  }

  
  ?>
  <tbody>
    <tr>
      <th scope="row"> <label>Full Name:</label></th>
      <td>
    <input type="text" name="fullname" class="form-control" autocomplete="off" placeholder="Enter Full Name" required/></td>
    </tr>
    

    <tr>
      <th scope="row"> <label>E-mail:</label></th>
      <td>
    <input type="email" name="mail" class="form-control" autocomplete="off"  placeholder="Enter Email" required/></td>
    </tr>
    <tr>
      <th scope="row"> <label>Aadhar Number:</label></th>
      <td>
    <input type="number" name="aadhar" class="form-control" placeholder="12 Digit Aadhar Number" required/></td>
    </tr>
    <tr>
      <th scope="row"> <label>Permanent Address:</label></th>
      <td>
      <textarea type="text" name="address" class="form-control" placeholder="Enter Permanent Address" required ></textarea>
    </td>
    </tr>
    <tr>
      <th scope="row"> <label>Contact:</label></th>
      <td>
    <input type="number" name="contact" class="form-control" autocomplete="off" placeholder="Enter Contact" required/></td>
    </tr>
    <tr>
      <th scope="row"> <label>Gender:</label></th>
      <td>
    <input type="radio" name="gender" value="male"  required/> Male<br>
    <input type="radio" name="gender" value="female"/> Female

</td>
    </tr>
    <tr>
      <th scope="row"> <label>Password:</label></th>
      <td>
    <input type="password" name="password" class="form-control" placeholder="Enter Password" required/></td>
    </tr>
    <tr>
      <th scope="row"> <label>Confirm Password:</label></th>
      <td>
    <input type="password" name="cpassword" class="form-control" placeholder="Re Enter Password" required/></td>
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

    <?php
include 'footer.php';
?>
</body>
</html>
<?php

if(isset($_POST['submit']))
{
$fullname = $_POST['fullname'];
$mail = $_POST['mail'];
$aadhar = $_POST['aadhar'];
$address = $_POST['address'];
$contact = $_POST['contact'];
$gender = $_POST['gender'];
$password = $_POST['password'];
$cpassword = $_POST['cpassword'];
$numlength = mb_strlen($contact);
$aadharlength = mb_strlen($aadhar);
$name = $fullname[0];
$tname = $name.$aadhar;
if($numlength==10 && $aadharlength==12){
  $selectquery = "select aadhar from landlord where aadhar = '$aadhar'";
  $selectqueryfire = mysqli_query($mydbconnection,$selectquery);
  $numofrow = mysqli_num_rows($selectqueryfire);
  if($numofrow<=0){
    if($password === $cpassword){
      $c_password = password_hash($cpassword,PASSWORD_BCRYPT);
      $insertquery = "insert into landlord (fullname,email,aadhar,address,contact,gender,password,landlord_table) values('$fullname','$mail','$aadhar','$address','$contact','$gender','$c_password','$tname')" ;
  $inserqueryfire = mysqli_query($mydbconnection,$insertquery);
  if($inserqueryfire){
     
          $sql = " CREATE TABLE $tname (
 id INT(255) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
 full_name VARCHAR(255) DEFAULT '$fullname' NOT NULL ,
 photo1 VARCHAR(255) NOT NULL,
 photo2 VARCHAR(255) NOT NULL,
 photo3 VARCHAR(255) NOT NULL,
 facility VARCHAR(255) NOT NULL,
 rate VARCHAR(255) NOT NULL,
 special VARCHAR(255),
 meeting_time VARCHAR(255) NOT NULL,
 full_address VARCHAR(255) DEFAULT '$address' NOT NULL,
 gender VARCHAR(255) DEFAULT '$gender' NOT NULL,
 contact VARCHAR(255) DEFAULT '$contact' NOT NULL,
 reg_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP)";


if ($mydbconnection->query($sql) === TRUE) {
  mkdir("landlord_images/".$aadhar);
  $_SESSION['account-ready']= "account-ready";
  ?>
      <script>
        location.replace("landlord.php");
      </script>
      <?php

} else {
    echo "Error creating table: " . $mydbconnection->error;
}
         
  }
  else{
    $_SESSION['account-not-ready']= "account-not-ready";
    ?>
    <script>
        location.replace("new-landlord.php");
    </script>
    <?php
  }

    }
    else{
      $_SESSION['account-not-password']= "account-not-password";
      ?>
        <script>
            location.replace("new-landlord.php");
        </script>
        <?php
    }

  }
  else{
    $_SESSION['account-not-aadhar']= "account-not-aadhar";
    ?>
    <script>
        location.replace("new-landlord.php");
    </script>
    <?php
  }

}
else{
  $_SESSION['account-not-Correct']= "account-not-Correct";
  ?>
    <script>
        location.replace("new-landlord.php");
    </script>
    <?php

}


}


?>