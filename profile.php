<?php
include("conn.php");
session_start();
                    
if(isset($_SESSION['id']) && isset($_SESSION['username']) && isset($_SESSION['img_upload']))
{ 
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <?php
        if(!isset($_COOKIE)) {
            foreach($_COOKIE  AS $a=> $key)
            {
                echo "Cookie named '" . $a . "' is not set!";
                echo "Cookie img name '" . $key . "' is not set!";
               
            }
        } else { 
            foreach($_COOKIE  AS $a=> $key)
            {
             echo "Cookie '" . $a . "' is set!<br>";
            echo "Cookie '" . $key . "' is set!<br>";
            }
    }
?>
    <title>Document</title>
</head>
<body>
    <h4>Profile Dashboard</h4>
    <h4>Welcome User: <?php echo $_SESSION['username']?> <img src="<?php echo $_SESSION['img_upload']?>" width="120" height="60" style="margin:-25px 10px"></h4>
    <!-- <h4>Welcome Id: <?php echo $_SESSION['id']?></h4> -->
    <button><a href="logout.php" style="text-decoration:none; color:black;">Logout</button>
    
</body>
</html>
<?php
}
else
{
    echo "<h1>Invalid Page Please Login First!</h1>";
    echo "<a href='login.php'>Login Page</a>";

}

?>