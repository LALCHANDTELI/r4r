<?php
session_start();
error_reporting(0);
if(!isset($_SESSION['username']))
{
   header('location:admin.php') ;
}
include 'connection.php';
unset($_SESSION['landlord_count_id']);
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
<?php
if(isset($_SESSION['changed'])){
    ?>
    <div class="text-center rounded border text-center text-body bg-warning">
    <h3 class="mt-3">your password changed :)</h3>
    </div>
    <?php
    unset($_SESSION['changed']);
}
if(isset($_SESSION['not-change'])){
    ?>
    <div class="text-center rounded border text-center text-body bg-warning">
    <h3 class="mt-3">your dose not password change :)</h3>
    </div>
    <?php
    unset($_SESSION['not-change']);
}

?>
    <ul class="nav nav-pills mt-3 border rounded bg-success nav-justified ">
        <li class="nav-item">
            <h3 class="text-white nav-link">
            <?php
           echo  $_SESSION['username'];
            ?>
            </h3>
        </li>
    </ul>

    <ul class="nav nav-pills mt-3 bg-primary nav-justified ">
        <li class="nav-item">
            <a id="link" class="nav-link active" href="admin-home.php">Admin Home</a>
        </li>
        <li class="nav-item">
        <a class="text-white nav-link bg-success">Landlords Count : <?php $ln = $_SESSION['landlord_count']; echo $ln; ?></a>
        </li>
        <li class="nav-item">
            <a id="link" class="nav-link  text-white" href="logout.php">Log Out</a>
        </li>
    </ul>


<?php
    $selectquery1 = "select * from admin";
    $selectqueryfire1 = mysqli_query($mydbconnection,$selectquery1);
    $selectfetcharray1 = mysqli_fetch_array($selectqueryfire1);
    $adminoldid = $selectfetcharray1['id'];
$id=1;
$select = "select * from landlord";
$query = mysqli_query($mydbconnection,$select);
$rows = mysqli_num_rows($query);
?>
<div class="container-fluid">
<div class="row">
<?php  


$landlord_count = 0;
if($rows<=0){
    $_SESSION['landlord_count'] = $landlord_count = 0;
    ?>
    <div class="container col-lg-4 col-md-6 col-sm-12 col-12">
              <div class="card mt-3" >
              <h4 class="card-title bg-warning my-3 text-center text-uppercase text-dark"><?php echo "not available any landlord";  ?></h4>
                <div class="card-body">
                  <p class="card-text bg-danger text-center text-white text-uppercase">very bad !!!</p>
                </div>
              </div>
              </div>
    <?php
}
            while($rows>0){
              
                $select1 = "select * from landlord where id = $id";
                $query1 = mysqli_query($mydbconnection,$select1);
                $array1 = mysqli_fetch_array($query1);
                $fullname = $array1['fullname'];
                while($fullname==""){
                    $id ++;
                    $select1 = "select * from landlord where id = $id";
                $query1 = mysqli_query($mydbconnection,$select1);
                $array1 = mysqli_fetch_array($query1);
                $fullname = $array1['fullname'];
                }
$id = $array1['id'];               
$email = $array1['email'];
$address = $array1['address'];
$contact = $array1['contact'];
$landlord_table = $array1['landlord_table'];
$datetime = $array1['datetime'];
$status = $array1['status'];
$_SESSION['admin-id']= $array1['id'];
$_SESSION['home_tables']= $array1['landlord_table'];
$_SESSION['aadhar']= $array1['aadhar'];
$_SESSION['landlord_date']= $array1['datetime'];
$_SESSION['table_id']= $array1['landlord_table'];
$landlord_table_row_select = "select * from $landlord_table";
$landlord_table_row_query = mysqli_query($mydbconnection,$landlord_table_row_select);
$landlord_table_row = mysqli_num_rows($landlord_table_row_query);

?>
    <div class="container col-lg-4 col-md-6 col-sm-12 col-12">
              <div class="bg-dark card mt-3" >
              <h4 class="card-title mt-3 text-white text-uppercase mx-3 bg-success border round text-center"> <?php echo $fullname; ?> </h4>
                <div class="card-body align-content-center">
            






<table class="table">
    <tbody>    
      <tr class="table-primary">
      <td> ID </td><td><?php echo $id; ?> </td>
      </tr>
      <tr class="table-success">
      <td> NAME </td><td><?php echo $fullname; ?></td>
      </tr>
      <tr class="table-danger">
      <td> ADDRESS </td><td><?php echo $address; ?> </td>
      </tr>
      <tr class="table-info">
      <td> CONTACT </td><td><?php echo $contact; ?> </td>
      </tr>
      <tr class="table-primary">
      <td> E-MAIL </td><td><?php echo $email; ?> </td>
      </tr>
      <tr class="table-warning">
      <td> TABLE </td><td><a href="show-data.php?tables=<?php echo $landlord_table; ?>" data-toggle="tooltip" data-placement="top" title="Show Data"><i aria-hidden="true"></i><?php echo $landlord_table; ?></a> </td>
      </tr>
      <tr class="table-secondary">
      <td> Create Time : </td><td><?php echo $datetime; ?> </td>
      </tr>
      <tr class="table-danger">
      <td> Posts : </td><td><?php echo $landlord_table_row; ?> </td>
      </tr>
      <tr class="table-primary">
      <td> Status : </td><td><?php echo $status; ?> </td>
      </tr>
      <tr class="table-success"><td>Delete Account </td>
      <td><a href="ac-delete-admin.php?account=<?php echo $landlord_table; ?>" data-toggle="tooltip" data-placement="top" title="Delete Account"><i class=" fa fa-trash" aria-hidden="true"></i></a></td>
     </tr>
    </tbody>
  </table>




                </div>
              </div>
              </div>
    <?php
                $landlord_count ++;
                $_SESSION['landlord_count'] = $landlord_count;
                $id++;
                $rows--;
        }

        ?>
        </div>
        </div>
        <?php
    

?>


    <?php
include 'footer.php';
?>
<div class="bg-dark">
<h4 class="text-right mx-3 bg-dark text-warning">Change Password <a href="change-password.php?change=<?php echo $adminoldid; ?>" data-toggle="tooltip" data-placement="top" title="Change Password"><i class=" fa fa-key" aria-hidden="true"></i></a></h4>
</div>
</body>
</html> 