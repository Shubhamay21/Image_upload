<?php
include('conn.php');
   if ($_SERVER["REQUEST_METHOD"] == "POST")
    {
        $name = $_POST['name']; 
        $email = $_POST['email']; 
        $password = $_POST['password']; 
        $file_upload = $_FILES['file_upload']; 
        $path = "images/";
        $traget_file = $path.$_FILES['file_upload']['name'];
        if(move_uploaded_file($_FILES['file_upload']['tmp_name'],$traget_file)== TRUE)
        {
            $sql = "INSERT INTO img_table (name, email,password,images)
            VALUES ('$name','$email','$password','$traget_file')";
            $result = mysqli_query($conn,$sql);
            header("location:login.php");
        }else
        {
            echo "file is not uploaded!";
        }
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Image-Upload</title>
    <style>
        #wrapper{

            width: 60%;
            height:500px;
            margin: 20px auto;
            border-radius:20px;
            border: 2px solid #dad7d7;
            background-color:white;

            }

            form{

            width: 50%;

            margin: 20px auto;

            }

            form div{

            margin-top: 5px;

            }

            img{

            float: left;

            margin: 5px;

            width: 280px;

            height: 120px;

            }

            #img_div{

            width: 70%;

            padding: 5px;

            margin: 15px auto;

            border: 1px solid #dad7d7;

            }

            #img_div:after{

            content: "";

            display: block;

            clear: both;

            }
            input[type="text"]
            {
                padding: 8px 40px;
                border-radius:5px;
                margin:6px 0px;
            }
            input[type="email"]
            {
                padding: 8px 40px;
                border-radius:5px;
                margin:6px 0px;
            }
            input[type="password"]
            {
                padding: 8px 40px;
                border-radius:5px;
                margin:6px 0px;
            }
            input[type="file"]
            {
                /* padding: 5px 40px; */
                /* border-radius:5px; */
                margin:6px 0px;
                /* padding: 5px 70px; */
            }
            button
            {
                padding: 4px 40px;
                /* border-radius:5px; */
                /* margin:6px 0px; */
            }
            label{
                font-weight:550;
                
       
            }
            h2
            {
                text-align:center;
            }
            body{
                background-color:whitesmoke;
            }

    </style>
</head>

<body>

    <div id="wrapper">
        <h2>Image Upload In Php</h2>
        <form method="POST" action="" enctype="multipart/form-data">        
        <div><label>Name:</label><br>
            <input type="text" name="name" size="40" placeholder="Enter Your Name" />
        </div>
        <div><label>Email:</label><br>
            <input type="email" name="email" size="40"  placeholder="Enter Your Email"/>
        </div>
        <div><label>Password:</label><br>
            <input type="password" name="password" size="40"  placeholder="Enter Your Password" />
        </div>
        <div><label>Images:</label><br>
          <input type="file" name="file_upload"  value="" />    
        </div><br>
        <div>
            <button type="submit" name="uploadfile">Upload</button>
        </div>
        </form>
        <div>
     </div>
    </div>
    
</body>
</html>
