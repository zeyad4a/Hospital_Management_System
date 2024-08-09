<?php
session_start();
    $connect = new mysqli("localhost", "root", "", "hms");
    if ($connect->connect_error) {
        die("Connection failed: " . $connect->connect_error);
    }
$error = "";

// if (isset($_POST['submit'])) {
//     $email = $_POST['email'];
//     $password = $_POST['password'];

//     $sql = "SELECT role FROM `employ` WHERE `email` = '$email' AND `password` = '$password'";
//     $result = $connect->query($sql);

//     if ($result->num_rows > 0) {
//         $row = $result->fetch_assoc();
//         $userRole = $row['role'];
//         $_SESSION['role'] = $userRole;
//         $_SESSION['username'] = $username;
//         $_SESSION['logged_in'] = true;
//         $user = $_SESSION['username'];
//         $user_statue = 1;
//         $log = "insert into userlog 
//           (`username` ,`statue` ,`id` )
//     value ('$user','$user_statue','" . $_SESSION['id'] . "')";

//         if ($_SESSION['role'] === 'System Admin') {
//             header("location: ../Project_UI/Super Admin/super-dashboard.php");
//         } else if ($_SESSION['role'] === 'Admin') {
//             header("location: ../Project_UI/Admin/admin-dashboard.php");
//         } else if ($_SESSION['role'] === 'User') {
//             header("location: ../Project_UI/User/new_appoint.php");
//         }
//     } else {
//         $user =  $_POST['email'];
//         $user_statue = 1;
//         // mysqli_query($connect, "insert into userlog(username,uid,status) values('" . $user. "','".$_SESSION['id']."','$user_statue')");

//         echo "<script>alert(' Email Or Password IS Wrong ');</script>";
//     }
//     $connect->close();
// }

// if (isset($_POST['submit'])) {
//     $email = $_POST['email'];
//     $password = $_POST['password'];
//     $ret = mysqli_query($connect, "SELECT * FROM users WHERE email = '$email' AND 	password = '$password'");
//     $num = mysqli_fetch_array($ret);
//     if ($num > 0) {
//         $_SESSION['login'] = $_POST['email'];
//         $_SESSION['id'] = $num['id'];
//         header('location: ../Project_UI/Paitent/html/Dashboard.php');
//         exit();
//     } else {
//         echo
//         "<script>alert('Email or Password Is Wrong');
//         window.location.href = '/zeyad/Final_Project/done-patint/index.php';</script>";
//         exit();
//     }
// }



if (isset($_POST['submit'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];

    
    
    $ret = mysqli_query($connect, "SELECT * FROM `employ` WHERE `email` = '$email' AND `password` = '$password'");
    $num = mysqli_fetch_array($ret);
    if ($num > 0) {
        $_SESSION['role'] = $num['role'];
        $_SESSION['login'] = $_POST['email'];
        $_SESSION['id'] = $num['id'];
        $_SESSION['username'] = $num['username'];
        $sql = mysqli_query($connect, "UPDATE `employ` SET `employ_statue` = 1 where `email` =  '$email' ");
        if ($_SESSION['role'] === 'System Admin') {
            header("location: ../Project_UI/Super Admin/super-dashboard.php");
        } else if ($_SESSION['role'] === 'Admin') {
            header("location: ../Project_UI/Admin/admin-dashboard.php");
        } else if ($_SESSION['role'] === 'User') {
            header("location: ../Project_UI/User/new_appoint.php");
        }

        $sqlup = "UPDATE employ SET employ_statue = 1 where id = " . $_SESSION['id'] . "";
        $connect->query($sqlup);

        $date = date("Y-m-d");
        $sqlup = "UPDATE employ SET updationDate = '$date' where id = " . $_SESSION['id'] . "";
        $connect->query($sqlup);
    }
     else {
        $user =  $_POST['email'];
        $user_statue = 1;
        // mysqli_query($connect, "insert into userlog(username,uid,status) values('" . $user. "','".$_SESSION['id']."','$user_statue')");

        echo "<script>alert(' Email Or Password IS Wrong ');</script>";
    }
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link rel="stylesheet" href="./org.css">
    <title>Login Page</title>
</head>

<body>

    <div class="container">
        <div class="form-container sign-in" style="transform:translateY(-30px)">
            <form method="post">
                <h1>Sign In</h1>
                <input type="text" name="email" placeholder="email">
                <input type="password" name="password" placeholder="Password">
                <a href="#"><b>Forget Your Password?</b></a>
                <button name="submit">Sign In</button>
            </form>
        </div>
    </div>
</body>

</html>