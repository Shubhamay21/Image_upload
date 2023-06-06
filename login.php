<?php
include("conn.php");
session_start();
$email_msg= "";    
$pass_msg= ""; 
$msg="";
$email ="";
$pass = "";
$user_cookie="";
$img_cookie = "";


if ($_SERVER["REQUEST_METHOD"] == "POST")
{
    $validEmail="/^[a-zA-Z0-9._-]+@[a-zA-Z0-9-]+\.[a-zA-Z.]{2,5}$/";
    $pass_upper= "/([A-Z]+)/";
    $pass_lower= "/([a-z]+)/";
    $pass_special= "/([\W]+)/";
    $pass_digit= "/([\d]+)/";

    function test_input($data)
    {
       $data = trim($data);
       $data = stripslashes($data);
       $data = htmlspecialchars($data);
       return $data;
    }
        $email = $_POST["email"];
        if (empty($email))
        {
            $email_msg = "Your Email is required";
        }
        else
        {
            $email = test_input($_POST["email"]);
           
            if (!preg_match($validEmail,$email)) {

                $email_msg = "Your Email address is incorrect";
            }
        }
        $pass = $_POST["pass"];
        if (empty($pass))
        {
            $pass_msg = "Your Password is required";
        }
        elseif (!preg_match($pass_upper,$pass) || !preg_match($pass_lower,$pass) || !preg_match($pass_digit,$pass) || !preg_match($pass_special,$pass) ) {
           
            $msg ="Password does not meet Required!";
        }
        else
        {    
            if (isset($_POST['submit'])) {
                // Check user is exist in the database
                $query= "SELECT * FROM img_table WHERE email='$email' AND password='$pass'";
                // print_r($query);
                $result = mysqli_query($conn, $query);
                // print_r($result);
                $rows = mysqli_num_rows($result);
                if($rows == 1)
                {
                    while($row=mysqli_fetch_assoc($result))
                    {
                    // var_dump($row);
                            if ($row['password'] == $pass) {
                                // var_dump($row);
                                $_SESSION['username'] = $row['name'];
                                $_SESSION['id'] = $row['id'];
                                $_SESSION['img_upload'] = $row['images'];
                                $user_cookie =  $row['name'];
                                $img_cookie = $row['images'];
                                setcookie($user_cookie,$img_cookie,time()+(60), "/");
                    
                                header("location:profile.php");
                            }   
                    }
                }else
                {
                    $msg = "Please Enter Valid Email Address";
                }
               
            }
        }
    
    }


    // echo $email;
    // echo $pass;
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous"> -->
    <style>
        body
        {
            background-color:darkseagreen;
        }
        input[type="email"]
        {
            padding:10px 100px;
            margin:10px 0px;
            border-radius: 5px;
        }
        input[type="password"]
        {
            padding:10px 100px;
            margin:10px 0px;
            border-radius: 5px;
            
        }
        input[type="submit"]
        {
            padding:7px 270px;
            margin:10px 0px;
            border-radius: 5px;
            
        }
        .form-fill
        {
            margin: 0 60px;
        }
        .container
        {
            margin: 40px 310px;
        }
        h2{
            
            margin: 25px 150px;
            color:white;

        }
    </style>
</head>
<body>
    <div class="container">
        <h2 class="ml-50px">Login-Form</h2>
        <div>
            <form method="POST">
                <div class="form-fill">
                <span class="error" style="color: white;" aria-live="polite"><h3><?php echo $msg?></h3></span><br/>

                    <label for="email" class="form-group"><b>Email Id:</b><br/>
                        <input type="email" class="form-control" name="email" id="email" size="50" placeholder="Enter Your Email ID.." >
                        <span class="error" style="color: white;" aria-live="polite"><?php echo $email_msg?></span>

                    </label><br/><br/>
                    <label for="pass" class="form-group"><b>Password:</b><br/>
                        <input type="password" class="form-control" id="pass" name="pass" size="50" placeholder="Enter Your Password.." >
                        <span class="error" style="color: white;" aria-live="polite"><?php echo $pass_msg ?></span>

                    </label><br/><br/>
                    <input type="submit" name="submit">
                </div>
            </form>
        </div>
    </div>
</body>
</html>