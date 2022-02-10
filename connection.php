<?php
$dbhost = "localhost";
$dbuser = "id13308335_lalchand";
$dbpassword = "@dbpasswordLAL13";
$dbname = "id13308335_r4r";
$mydbconnection = mysqli_connect($dbhost,$dbuser,$dbpassword,$dbname);

if($mydbconnection)
{
    alert("you are online")
}
else
{
    ?>
    <script>
        alert("you are offline now");
    </script>
    
    <?php

}

?>