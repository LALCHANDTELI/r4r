<?php
error_reporting(0);
include 'connection.php';
session_start();
?>

<head>
  <?php
include 'links.php';
include 'header.php';
    ?>
<title>R4R STUDENT</title>
  </head>
  <ul class="nav nav-pills nav-justified com">
        <li class="nav-item">
            <a id="link" class="nav-link" href="r4r.php">Home</a>
        </li>
        <li class="nav-item">
            <a class="nav-link active" href="home.php">Login As Student</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="landlord.php">Login As Landlord</a>
        </li>
        <li class="nav-item">
            <a id="link" class="nav-link" href="admin.php">Login As Admin</a>
        </li>
    </ul>
    <div class="mt-3">
    <ul class="nav nav-pills nav-justified com">
        <li class="nav-item">
            <a id="link" class="nav-link text-white bg-success text-center text-uppercase border round border-warning">Rooms Counter  <?php $rooms_count = $_SESSION['rooms_count']; echo $rooms_count; ?></a>
        </li>
    </ul>
    </div>
    <?php
$id=1;
$home_id = 1;
$select = "select * from landlord";
$query = mysqli_query($mydbconnection,$select);
$rows = mysqli_num_rows($query);
?>
            <div class="container-fluid">
        <div class="row">
        <?php
        if($rows<=0){
          $_SESSION['rooms_count'] = 0;
?>
<div class="container col-lg-4 col-md-6 col-sm-12 col-12">
          <div class="card mt-3" >
          <h4 class="card-title bg-warning my-3 text-center text-uppercase text-dark"><?php echo "not available any room";  ?></h4>
        
          <div class="carousel-item active">
              <img class="card-img-top d-block w-100" src="images/visit_again.jpg" alt="rooms not available" style="width:100%">
    
            </div>
            <div class="card-body">
              <p class="card-text bg-danger text-center text-white text-uppercase">rooms not available right now !</p>
            </div>
          </div>
          </div>
<?php
        }
        $rooms_count=0;
        $_SESSION['rooms_count'] = 0;
while($rows>0){
    $select1 = "select * from landlord where id = $id";
    $query1 = mysqli_query($mydbconnection,$select1);
    $array1 = mysqli_fetch_array($query1);
    $table = $array1['landlord_table'];
    while($table==""){
    $id ++;
    $select1 = "select * from landlord where id = $id";
    $query1 = mysqli_query($mydbconnection,$select1);
    $array1 = mysqli_fetch_array($query1);
    $table = $array1['landlord_table'];
    }
    $status = $array1['status'];
     if($table!="" && $status=="Active"){
        $home_select_query = "select * from $table";
        $home_select_query_fire = mysqli_query($mydbconnection,$home_select_query);
        $home_select_query_array = mysqli_fetch_array($home_select_query_fire);
        $home_number_of_row = mysqli_num_rows($home_select_query_fire);
        if($home_number_of_row>0){
        $home_tb_id = 1;
            while($home_number_of_row!=0 ){
                $home2_select_query = "select * from $table  where id = $home_tb_id";
                $home2_select_query_fire = mysqli_query($mydbconnection,$home2_select_query);
                $home2_select_query_array = mysqli_fetch_array($home2_select_query_fire);
                $home_full_name = $home2_select_query_array['full_name'];
                while($home_full_name==""){
                    $home_tb_id ++;
                    $home2_select_query = "select * from $table  where id = $home_tb_id";
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
            
        ?>
                
          <div class="container col-lg-4 col-md-6 col-sm-12 col-12">
          <div class="card mt-3" >
          <h4 class="card-title bg-warning my-3 text-center text-uppercase text-dark"><?php echo $home_full_name ?></h4>
          <div id="<?php echo $home_id ?>" class="carousel slide" data-ride="carousel">
          <div class="carousel-inner">
        
          <div class="carousel-item active">
              <img class="card-img-top d-block w-100" src="<?php echo $home_photo1 ?>" alt="First slide" style="width:100%">
            </div>
        
            <div class="carousel-item">
              <img class="card-img-top d-block w-100" src="<?php echo $home_photo2 ?>" alt="Second slide" style="width:100%">
            </div>
        
            <div class="carousel-item">
              <img class="card-img-top d-block w-100" src="<?php echo $home_photo3 ?>" alt="Third slide"  style="width:100%">
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
              <h4>Rate Per Month :</h4>
              <p class="card-text"><?php echo $home_rate  ?></p>
              <h4>Address :</h4>
              <p class="card-text"><?php echo $home_full_address  ?></p>
              <h4>Contact :</h4>
              <p class="card-text"><?php echo $home_contact  ?></p>
              <h4>Meeting Time :</h4>
              <p class="card-text"><?php echo $home_meeting_time  ?></p>
              <h4>Comments :</h4>
              <p class="card-text"><?php echo $home_special  ?></p>
            </div>
          </div>
          </div>
          <?php
                $home_id ++;
                $home_tb_id ++;
                $home_number_of_row --;
                $rooms_count ++;
                $_SESSION['rooms_count']=$rooms_count;
            }
            
        }else{
            
            ?>
            <div class="container col-lg-4 col-md-6 col-sm-12 col-12">
          <div class="card mt-3" >
          <h4 class="card-title bg-warning my-3 text-center text-uppercase text-dark"><?php echo $name = $array1['fullname'];  ?></h4>
        
          <div class="carousel-item active">
              <img class="card-img-top d-block w-100" src="images/not-available.jpg" alt="rooms not-available" style="width:100%">
    
            </div>
            <div class="card-body">
              <h4>Facilities :</h4>
              <p class="card-text"><?php echo "*********"  ?></p>
              <h4>Rate Per Month :</h4>
              <p class="card-text"><?php echo "*********"  ?></p>
              <h4>Address :</h4>
              <p class="card-text"><?php echo "*********"  ?></p>
              <h4>Contact :</h4>
              <p class="card-text"><?php echo "*********"  ?></p>
              <h4>Meeting Time :</h4>
              <p class="card-text"><?php echo "*********"  ?></p>
              <p class="card-text bg-danger text-center text-white text-uppercase">rooms not available from <?php echo $name = $array1['fullname'];  ?> right now </p>
            </div>
          </div>
          </div>
        <?php
        }
        
    
     }
      
$id ++;
$rows --;

}
?>
            </div>
            </div>
            <?php
include 'footer.php';
?>