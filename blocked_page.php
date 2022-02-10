<?php
error_reporting(0);
session_start();
if(!isset($_SESSION['block_name']))
{
   header('location:index.php') ;
}
include 'connection.php';
include 'links.php';

$name = $_SESSION['block_name'];
?>
<title>BLOCKED</title>
<div class="card mx-3 mt-3" >
          <h4 class="rounded border card-title bg-warning my-3 text-center text-uppercase text-dark">Blocked</h4>
        
<div class="card-body text-center">
              <h4><?php echo $name;  ?></h4>
              <p class="card-text">your account is block by admin. if you want to open it again then contact to admin!</p>
              </div>
</div>

    <?php
unset($_SESSION['block_name']);
?>
