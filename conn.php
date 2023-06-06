<?php 
$servername= "localhost";
$username = "root";
$password = "";
$db_name = "img_upload";
// $db_name2 = "exp_db";
$conn = mysqli_connect($servername, $username, $password,$db_name);
if(!$conn)
{
    die("Error Connection:".mysqli_connect_error());
}
?>