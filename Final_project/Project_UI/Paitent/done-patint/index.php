<?php

session_start();
    $connect = new mysqli("localhost", "root", "", "hms");
    if ($connect->connect_error) {
        die("Connection failed: " . $connect->connect_error);
    }
$error = "";

//  /* --> Create Account <-- */  //


if (isset($_POST['submit_r'])) {

    $first_name_r = $_POST['first-name'];
    $email_r = $_POST['email'];
    $password_r = $_POST['password_r'];
    $Phone = $_POST['Phone_Number'];
    $_SESSION['login'] = $_POST['email'];


  $check_email = mysqli_query($connect, "SELECT email FROM users WHERE email = '$email_r'");
  if (mysqli_num_rows($check_email) > 0) {
    echo "<script>alert('Email already exists!');</script>";
    exit();
  }
  $sql = "INSERT INTO users (fullName, email ,password ,PatientContno) VALUES ('$first_name_r', '$email_r', '$password_r', '$Phone')";

  if ($ret= mysqli_query($connect, $sql)) {
        $_SESSION['login'] = $_POST['email'];
        header('location:./index.php');

  } else {
    echo "<script>alert('Error creating account: " . mysqli_error($connect) . "');</script>";
  }

  mysqli_close($connect); 
}


//  /* --> Log In <-- */  //

if (isset($_POST['submit'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];
    $ret = mysqli_query($connect, "SELECT * FROM users WHERE email = '$email' AND 	password = '$password'");
    $num = mysqli_fetch_array($ret);
    if ($num > 0) {
        $_SESSION['login'] = $_POST['email'];
        $_SESSION['uid'] = $num['uid'];
        $_SESSION['fullName'] = $num['fullName'];
        header('location: ../html/Dashboard.php');
        exit();
    } else {
        echo
        "<script>alert('Email or Password Is Wrong');
        window.location.href = './index.php';</script>";
        exit();
    }
}

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link rel="stylesheet" href="zxc.css">
    <title>Login Page</title>
</head>

<body>
    <div class="container" id="container">
        <div class="form-container sign-in">
            <form method="POST">
                <h1>Sign In</h1>
                <div class="social-icons">
                    <a href="#" class="icon"><i class="fa-brands fa-google-plus-g"></i></a>
                    <a href="#" class="icon"><i class="fa-brands fa-facebook-f"></i></a>
                </div>
                <span>or use your email password</span>
                <input type="email" name="email" placeholder="Email"> <!--added name-->
                <input type="password" name="password" placeholder="Password"> <!--added name-->
                <a href="#">Forget Your Password?</a>
                <button name="submit">Sign In</button>
            </form>
            <?php
            if (!empty($error)) {
                echo "<p style='color: red;'>$error</p>";
            }
            ?>
        </div>
        <div class="form-container sign-up">
            <form method="post">
                <h1>Create Account</h1>
                <div class="social-icons">
                    <a href="#" class="icon"><i class="fa-brands fa-google-plus-g"></i></a>
                    <a href="#" class="icon"><i class="fa-brands fa-facebook-f"></i></a>
                </div>
                <span>or use your email for registration</span>
                <input type="text" name="first-name" placeholder="Patient Name" required> <!--added name-->
                <input type="tel" name="Phone_Number" placeholder="Phone Number" maxlength="13" minlength="11" required> <!--added name-->
                <input type="email" name="email" placeholder="Email" required> <!--added name-->
                <input type="password" name="password_r" placeholder="Password" id="passwordInput" class="pass1" required> <!--added name and id and class-->
                <div id="passwordStrength"></div> <!--added-->
                <input type="password" name="password" placeholder="Confirm Password" class="pass2" required> <!--added name and id and class-->
                <div id="confirmMessage"></div> <!--added-->
                <button name="submit_r">Sign Up</button>
            </form>
        </div>
        <div class="toggle-container">
            <div class="toggle">
                <div class="toggle-panel toggle-left">
                    <h1><b>Hello, Friend!</b></h1>
                    <p>Register with your personal details to use all of site features</p>
                    <button class="hidden" id="login">Sign In</button>
                </div>
                <div class="toggle-panel toggle-right">
                    <h1><b>Welcome Back!</b></h1>
                    <p>Enter your personal details to use all of site features</p>
                    <button class="hidden" id="register">Sign Up</button>
                </div>
            </div>
        </div>
    </div>


    <script src="main.js"></script>
</body>

</html>