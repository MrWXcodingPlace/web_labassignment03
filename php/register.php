<?php
if(isset($_POST["submit"])) {
    include "dbconnect.php";
    $username = $_POST["username"];
    $email = $_POST["email"];
    $password = $_POST["password"];
    $phonenumber = $_POST["phonenumber"];
    $homeaddress = $_POST["homeaddress"];

    $sqlinsert = "INSERT INTO tbl_user(user_name, user_email, user_password, user_phone, user_homeAddress) VALUES ('$username', '$email', '$password', '$phonenumber', '$homeaddress')";

    try {
        $conn-> exec($sqlinsert);
        if (file_exists($_FILES["fileToUpload"]["tmp_name"]) || is_uploaded_file($_FILES["fileToUpload"]["tmp_name"])) {
            $last_id = $conn->lastInsertId();
            uploadImage($last_id);
            echo "<script>alert('Success')</script>";
            echo "<script>window.location.replace('login.php')</script>";
        }
    } catch (PDOException $e) {
        echo "<script>alert('Register Failed');</script>";
        echo "<script>window.location.replace('register.php')</script>";
    }    
}

function uploadImage($filename)
{
    $target_dir = "../res/images/user_profile/";
    $target_file = $target_dir . $filename . ".png";
    move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/basic_layout.css">
    <link rel="stylesheet" href="../css/register.css">
    <script src="../js/upload-image.js">
    </script>
    <title>Document</title>

</head>
<body>
    <nav>
        <div class="logo">MyTutor</div>
        <div class="bx bx-menu" id="menu-icon"></div>
        <ul class="navbar">
            <li><a href="index.php">Home</a></li>
            <li><a href="#">Course</a></li>
            <li><a href="tutorpage.php">Tutor</a></li>
            <li><a href="#">Subscription</a></li>
            <li><a href="login.php">Login</a></li>
        </ul>
    </nav>

    <main>
        <div class="register-form">
            <div class="content">
                <form action="register.php" method="post" ">
                    <h1>Sign Up Form</h1>
                    <div class="avatar">
                        <img class="avatar-image" src="../res/images/user.png" style="height:100%"><br><br>
                        <input type="file" name="fileToUpload" onchange="previewFile()">
                    </div>
                    <br><br>
                    <div>
                        <label for="username">Username</label><br>
                        <input type="text" id="username" name="username" required>
                    </div>
                    <div>
                        <label for="email">Email</label><br>
                        <input type="email" id="email" name="email" required>
                    </div>
                    <div>
                        <label for="password">Password</label><br>
                        <input type="password" id="password" name="password" required>
                    </div>
                    <div>
                        <label for="phonenumber">Phone Number</label><br>
                        <input type="text" id="phonenumber" name="phonenumber" required>
                    </div>
                    <div>
                        <label for="homeaddress">Home Address</label><br>
                        <textarea  id="homeaddress" name="homeaddress" rows="3" cols="30" required="true">
                        </textarea>
                    </div>
                    <div>
                        <input type="checkbox" name="agreement" id="agreement" value="agree">
                        <label for="agreement">I read and agree to 
                            <a href="#" target="_blank" style="text-decoration:underline">
                                <b>Terms & Conditions</b>
                            </a>
                        </label>
                    </div>
                    <div>
                        <input type="submit" name="submit" value="Register">
                    </div>
                    <p class ="bottom-text">
                        Already have account ? <a href="login.php" target="_self"><b>Login</b></a>
                    </p>
                </form>
            </div>
        </div>
    </main>
    
    <!-- End of the page -->
    <footer>
      <p>&copy; 2022 MyTutor Inc. All rights reserved.</p>
      <div class="social-icon">
        <a href="#" class="fa fa-facebook"></a>  
        <a href="#" class="fa fa-twitter"></a>  
        <a href="#" class="fa fa-linkedin"></a>  
        <a href="#" class="fa fa-instagram"></a>  
        <a href="#" class="fa fa-youtube"></a>  
      </div>
    </footer>
    <script src="../js/navigation.js"></script>
</body>
</html>