<?php
error_reporting(0);
session_start();
if(!isset($_SESSION['fullname']))
{
   header('location:landlord.php') ;
}
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
            <a id="link" class="nav-link" href="index.php">Home</a>
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

    <ul class="nav nav-pills mt-3 border rounded bg-success nav-justified ">
        <li class="nav-item">
            <h3 class="text-uppercase text-white nav-link">
            <?php
           echo  $_SESSION['fullname'];
            ?>
            </h3>
        </li>
    </ul>

    <ul class="nav nav-pills mt-3 bg-dark nav-justified ">
        <li class="nav-item">
            <a id="link" class="text-white nav-link" href="landlord-home.php">Landlord Home</a>
        </li>
        <li class="nav-item">
            <a id="link" class="text-white nav-link active" href="newroom.php">Add New Room</a>
        </li>
        <li class="nav-item">
            <a id="link" class="text-white nav-link" href="logout.php">Log Out</a>
        </li>
    </ul>

    <div class="mt-5 mb-5 container ">           
  <table class="border border-success table table-sm table-dark align-content-center text-center">
  <form action="" method="post" enctype="multipart/form-data">
  <div class="form-group">
    <thead>
      <tr>
        <th><h2 class="text-white">NEW ROOM</h2></th>
      </tr>
    </thead>
    <?php
if(isset($_SESSION['no']))
{
    ?>
    <div class="text-center rounded border text-center text-body bg-warning">
    <h3 class="mt-3">data not inserted. try again!</h3>
    </div>
    <?php
        unset($_SESSION['no']);
}

    ?>
    <tbody>
    <tr>
    <th class="text-left">Photos :</th>
    </tr>
      <tr>
        <td>Photo : 1 <input required type="file" name="photo1" value=""></td>
      </tr>
      <tr>
        <td>Photo : 2 <input required type="file" name="photo2" value=""></td>
      </tr>
      <tr>
        <td>Photo : 3 <input required type="file" name="photo3" value=""></td>
      </tr>
      <tr>
      <th class="text-left">Facilities :</th>
      </tr>
<tr>
<td><input type="checkbox" required  name="letbath" value="Letbath"> Letbath *</td>
</tr>
<tr>
<td><input type="checkbox" required  name="electricity" value="Electricity"> Electricity *</td>
</tr>
<tr>
<td><input type="checkbox" required  name="water" value="Water"> Water *</td>
</tr> 
<tr>
<td><input type="checkbox"  name="bed" value="Bed & Quilt"> Bed & Quilt</td>
</tr> 
<tr>
<th class="text-left">Rate Per Month :</th>
</tr> 
<tr>
<td><select id="rate" name="rate" required>
<option selected value="">Select Rate</option>
  <option value="1000-1500">1000-1500</option>
  <option value="1500-2000">1500-2000</option>
  <option value="2000-2500">2000-2500</option>
  <option value="2500-3000">2500-3000</option>
  <option value="Above 3000">Above 3000</option>
</select></td>
</tr>   
<tr>
<th class="text-left">Meeting/Calling Time :</th>
</tr>
<tr>
<td><input type="radio" required  name="time" value="Morning"> Morning</td>
</tr>
<tr>
<td><input type="radio"  name="time" value="afternoon"> Afternoon</td>
</tr>
<tr>
<td><input type="radio"  name="time" value="evening"> Evening</td>
</tr>
<tr>
<td><input type="radio"  name="time" value="any time"> Any time</td>
</tr>
<tr>
<th class="text-left">Special/Comments :</th>
</tr>
<tr>
<td><textarea placeholder="type your comments..." rows="3" cols="30" name="special"></textarea></td>
</tr>
<tr>
<th class="text-right"><input class="align-content-center text-center btn btn-success" type="submit" name="submit" value="Submit"></th>
</tr>
    </tbody>
   </div>
    </form>
  </table>
</div>

    <?php
include 'footer.php';
?>
</body>
</html> 



<?php









if(isset($_POST['submit'])){
$aadhar = $_SESSION['aadhar'];
$photo1 = $_FILES['photo1'];
$photo1_name = $photo1['name'];
$photo1_tmp_name = $photo1['tmp_name'];

$photo2 = $_FILES['photo2'];
$photo2_name = $photo2['name'];
$photo2_tmp_name = $photo2['tmp_name'];

$photo3 = $_FILES['photo3'];
$photo3_name = $photo3['name'];
$photo3_tmp_name = $photo3['tmp_name'];

$faci1 = $_POST['letbath'];
$faci2 = $_POST['electricity'];
$faci3 = $_POST['water'];
$faci4 = $_POST['bed'];
$faci = $faci1." ".$faci2." ".$faci3." ".$faci4." ";
$rate = $_POST['rate'];
$special = $_POST['special'];
$time = $_POST['time'];
$fname = $_SESSION['fullname'];
$name = $fname[0];
$tname = $name.$aadhar;

$photo1_select = "select * from $tname";
$photo1_query = mysqli_query($mydbconnection,$photo1_select);
$photo1_rows = mysqli_num_rows($photo1_query);
$photo1_id = 1;
while($photo1_rows>0){
  $photo1_select1 = "select * from $tname where id = $photo1_id";
  $photo1_query1 = mysqli_query($mydbconnection,$photo1_select1);
  $photo1_array = mysqli_fetch_array($photo1_query1);
  $photos1_name = $photo1_array['photo1'];
  while($photos1_name==""){
    $photo1_id ++;
    $photo1_select1 = "select * from $tname where id = $photo1_id";
  $photo1_query1 = mysqli_query($mydbconnection,$photo1_select1);
  $photo1_array = mysqli_fetch_array($photo1_query1);
  $photos1_name = $photo1_array['photo1'];
  }
  $photos2_name = $photo1_array['photo2'];
  $photos3_name = $photo1_array['photo3'];
 
if($folder1==$photos1_name){
  
}
if($folder2==$photos2_name){
  
}
if($folder3==$photos3_name){
  
}


  $photo1_id ++;
  $photo1_rows --;
}



$folder1 = "landlord_images/$aadhar/".$photo1_name;
$folder2 = "landlord_images/$aadhar/".$photo2_name;
$folder3 = "landlord_images/$aadhar/".$photo3_name;

$insert_query = "INSERT INTO $tname (photo1 , photo2 , photo3 , facility , rate , special , meeting_time ) VALUES ('$folder1','$folder2','$folder3','$faci','$rate','$special','$time')";
$inser_query_fire = mysqli_query($mydbconnection,$insert_query);
if($inser_query_fire){


move_uploaded_file($photo1_tmp_name,$folder1);


move_uploaded_file($photo2_tmp_name,$folder2);



move_uploaded_file($photo3_tmp_name,$folder3);



$_SESSION['yes']= "data inserted.";
  ?>
  <script>
      location.replace("landlord-home.php");
  </script>
  <?php

}
else{
$_SESSION['no']= "data not inserted.";
  ?>
  <script>
      location.replace("newroom.php");
  </script>
  <?php
}


}



?>