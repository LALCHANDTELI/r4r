<?php
include 'connection.php';
include 'links.php';
error_reporting(0);
session_start();
if(!isset($_SESSION['table_id']))
{
   header('location:landlord.php') ;
}
$hometname = $_GET['tables'];
$_SESSION['landlord_home_tables'] = $hometname;
?>
<title>R4R ADMIN</title>
<ul class="nav nav-pills mt-3 border rounded bg-primary nav-justified ">
        <li class="nav-item">
            <a id="link" class="nav-link active" href="admin-home.php">Admin Home</a>
        </li>
        <li class="nav-item">
        <a class="text-white nav-link bg-success">Rooms Count : <?php echo " ___";  ?></a>
        </li>
    </ul>
    <div class="nav nav-pills nav-justified">
    <h5 class="text-left  nav-item"><a class="nav-link text-white" href="block.php?block_tables=<?php echo $hometname; ?>">Block</a></h5>
    <h5 class="text-right nav-item"><a class="nav-link text-white" href="unblock.php?unblock_tables=<?php echo $hometname; ?>">Unblock</a></h5>
    </div>
<?php
$home_select_query = "select * from $hometname";
$home_select_query_fire = mysqli_query($mydbconnection,$home_select_query);
$home_select_query_array = mysqli_fetch_array($home_select_query_fire);
$home_number_of_row = mysqli_num_rows($home_select_query_fire);
?>
<div class="container-fluid">
<div class="row">
<?php
if($home_number_of_row<=0){
    ?>



    <div class="container col-lg-4 col-md-6 col-sm-12 col-12">
              <div class="card mt-3" >
              <h3 class="text-center text-dark text-uppercase mt-3">rooms not available now !</h3>
                </div>
              </div>
              </div>
              </div>
    <?php
}
if($home_number_of_row>0){
$home_tb_id = 1;
$home_id = 1;

    while($home_number_of_row!=0){
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
        $home_date = $home2_select_query_array['reg_date'];
        $post_id= $home2_select_query_array['id'];

        
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
      <h4 class="text-right"><a href="delete_admin.php?id_delete_post_by_admin=<?php echo $post_id ; ?>&hometname=<?php echo $hometname ; ?>" data-toggle="tooltip" data-placement="top" title="Delete"><i class=" fa fa-trash" aria-hidden="true"></i></a></h4>
    </div>
  </div>
  </div>
  <?php
        $home_id ++;
        $home_tb_id ++;
        $  --;
    }
?>
    </div>
    </div>
    <?php
}

?>