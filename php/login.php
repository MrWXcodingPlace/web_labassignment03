<?php
if(isset($_POST["submit"])) {
    include "dbconnect.php";
    $email = $_POST["email"];
    $password = $_POST["password"];
    $sqllogin = "SELECT * FROM tbl_user WHERE user_email = '$email' AND user_password = '$password'";
    $stmt = $conn->prepare($sqllogin);
    $stmt ->execute();
    $number_of_rows = $stmt->fetchColumn();

    if($number_of_rows > 0) {
        session_start();
        $_SESSION["sessionid"] = session_id();
        $_SESSION["email"] = $email ;
        echo "<script>alert('Login Success');</script>";
        echo "<script> window.location.replace('index.php')</script>";
    } else {
        echo "<script>alert('Login Failed');</script>";
        echo "<script> window.location.replace('login.php')</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/login.css">
    <link rel="stylesheet" href="https://unpkg.com/boxicons@latest/css/boxicons.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">  
    <link rel="stylesheet" href="../css/basic_layout.css">
    <link rel="stylesheet" href="../css/login.css">
    <script src="../js/login.js"></script>
    <title>Document</title>
    
</head>
<body onload="loadCookies()">
    <!-- Navbar -->
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
        <div class="login-form">
            <div class="content">
                <h1>Login Form</h1>
                <form action="login.php" method="post" name="loginForm">
                    <div>
                        <label for="email">Email</label><br>
                        <input type="email" id="idemail" name="email" required>
                    </div>

                    <div>
                        <label for="password">Password</label><br>
                        <input type="password" id="idpass" name="password" required>
                    </div>

                    <div>
                        <input type="checkbox" name="remember" id="idreme" value="remember" onClick="rememberMe()">
                        <label for="remember">Remember me</label><br>
                    </div>

                    <div>
                        <input type="submit" name="submit" value="Login">
                    </div>
                </form>
                <div>
                    <p class="psw">
                        Forgot <a href="#">password?</a>
                    </p>
                    <p>
                        <span>New User ?</span> 
                        <a href="register.php" target="_self"><b>Sign Up</b></a>
                    </p>
                </div>
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