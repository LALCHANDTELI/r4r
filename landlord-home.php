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
    <?php
$homename = $_SESSION['fullname'];
$homeaadhar = $_SESSION['aadhar'];
$homename1 = $homename[0];
$hometname = $homename1.$homeaadhar;

?>
    <ul class="nav nav-pills mt-3 border rounded bg-success nav-justified ">
        <li class="nav-item">
            <h3 class="text-uppercase text-white nav-link">
            <?php
           echo  $_SESSION['fullname'];
            ?>
            </h3>
        </li>
    </ul>
<?php
if(isset($_SESSION['yes']))
{
    ?>
    <div class="text-center rounded border text-center text-body bg-warning">
    <h3 class="mt-3">data inserted!</h3>
    </div>
    <?php
    unset($_SESSION['yes']);
}

?>
    <ul class="nav nav-pills mt-3 bg-dark nav-justified ">
        <li class="nav-item">
            <a id="link" class="nav-link active" href="landlord-home.php">Landlord Home</a>
        </li>
        <li class="nav-item">
            <a id="link" class="text-white nav-link" href="newroom.php">Add New Room</a>
        </li>
        <li class="nav-item">
            <a id="link" class="text-white nav-link" href="logout.php">Log Out</a>
        </li>
    </ul>
<?php
$home_select_query = "select * from $hometname";
$home_select_query_fire = mysqli_query($mydbconnection,$home_select_query);
$home_select_query_array = mysqli_fetch_array($home_select_query_fire);
$l_home_number_of_row = mysqli_num_rows($home_select_query_fire);
if($l_home_number_of_row>0){
    ?>
    <div class="container-fluid">
<div class="row">
<?php
$home_tb_id = 1;
$home_id = 1;
    while($l_home_number_of_row!=0){
        $home2_select_query = "select * from $hometname  where id = $home_tb_id";
        $home2_select_query_fire = mysqli_query($mydbconnection,$home2_select_query);
        $home2_select_query_array = mysqli_fetch_array($home2_select_query_fire);
        $home_full_name = $home2_select_query_array['full_name'];
        while($home_full_name==""){
            $home_tb_id ++;
            $home2_select_query = "select * from $hometname  where id = $home_tb_id";
            $home2_select_query_fire = mysqli_query($mydbconnection,$home2_select_query);
            $home2_select_query_array = mysqli_fetch_array($home2_select_query_fire);
        $home_full_name = $home2_select_query_array['full_name'];
        }
        
        $home_photo1 = $home2_select_query_array['photo1'];
        $home_photo2 = $home2_select_query_array['photo2'];
        $home_photo3 = $home2_select_query_array['photo3'];
        $home_facility = $home2_select_query_array['facility'];
        $home_rate = $home2_select_query_array['rate'];
        $home_special = $home2_select_query_array['special'];
        $home_meeting_time = $home2_select_query_array['meeting_time'];
        $home_full_address = $home2_select_query_array['full_address'];
        $home_gender = $home2_select_query_array['gender'];
        $home_contact = $home2_select_query_array['contact'];
        $_SESSION['landlord_tables']= $hometname;
        $home_date = $home2_select_query_array['reg_date'];
       $delete_landlord_post_id = $home2_select_query_array['id'];
?>
        
  <div class="container col-lg-4 col-md-6 col-sm-12 col-12">
  <div class="card mt-3"  >
  <h4 class="card-title bg-warning my-3 text-center text-uppercase text-dark"><?php echo $home_full_name ?></h4>
  <div id="<?php echo $home_id ?>" class="carousel slide" data-ride="carousel">
  <div class="carousel-inner" >

  <div class="carousel-item active">
      <img class="card-img-top d-block w-100" src="<?php echo $home_photo1 ?>" alt="First slide"  style="width:100%">
    </div>

    <div class="carousel-item">
      <img class="card-img-top d-block w-100" src="<?php echo $home_photo2 ?>" alt="Second slide"  style="width:100%">
    </div>

    <div class="carousel-item">
      <img class="card-img-top d-block w-100" src="<?php echo $home_photo3 ?>" alt="Third slide"   style="width:100%">
    </div>

    </div>
  <a class="carousel-control-prev" href="#<?php echo $home_id ?>" role="button" data-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="sr-only">Previous</span>
  </a>
  <a class="carousel-control-next" href="#<?php echo $home_id ?>" role="button" data-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="sr-only">Next</span>
  </a>
    

    </div>
    <div class="card-body">
      <h4>Facilities :</h4>
      <p class="card-text"><?php echo $home_facility  ?></p>
      <h4>Rete Per Month :</h4>
      <p class="card-text"><?php echo $home_rate  ?></p>
      <h4>Address :</h4>
      <p class="card-text"><?php echo $home_full_address  ?></p>
      <h4>Contact :</h4>
      <p class="card-text"><?php echo $home_contact  ?></p>
      <h4>Meeting Time :</h4>
      <p class="card-text"><?php echo $home_meeting_time  ?></p>
      <h4>Post Date :</h4>
      <p class="card-text"><?php echo $home_date  ?></p>
      <h4>Comments :</h4>
      <p class="card-text"><?php echo $home_special  ?></p>
      <h4 class="text-right"><a href="delete.php?delete_post_by_landlord=<?php echo $delete_landlord_post_id; ?>" data-toggle="tooltip" data-placement="top" title="Delete"><i class=" fa fa-trash" aria-hidden="true"></i></a></h4>
    </div>
  </div>
  </div>
  <?php
        $home_id ++;
        $home_tb_id ++;
        $l_home_number_of_row --;
    }
?>
    </div>
    </div>
    <?php
}else{
    ?>
    <div class="container col-lg-4 col-md-6 col-sm-12 col-12">
              <div class="card mt-3" >
              <h3 class="text-center text-dark text-uppercase mt-3">you don't enter any room's details!</h3>
                </div>
              </div>

<?php
}

?>

    <?php
include 'footer.php';
?>

<div class="bg-dark">
<h4 class="text-right mx-3 bg-dark text-warning">Delete Account <a href="delete-account.php" data-toggle="tooltip" data-placement="top" title="Delete Account"><i class=" fa fa-trash" aria-hidden="true"></i></a></h4>
</div>
</body>
</html> 