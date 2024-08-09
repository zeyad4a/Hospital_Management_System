<?php
session_start();
$connect = new mysqli("localhost", "root", "", "hms");
if ($connect->connect_error) {
    die("Connection failed: " . $connect->connect_error);
}

if (isset($_POST['submit'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];
    $ret = mysqli_query($connect, "SELECT * FROM `doctors` WHERE `docEmail` = '$email' AND `password` = '$password'");
    $num = mysqli_fetch_array($ret);
    if ($num > 0) {
        $_SESSION['login'] = $_POST['email'];
        $_SESSION['id'] = $num['id'];
        $sqlup = "UPDATE doctors SET statue = 1 where id = " . $_SESSION['id'] . " ";
        $connect->query($sqlup);
        header("location: ./doc-dashboard.php");
    } else {
        echo
        "<script>alert('Email or Password Is Wrong');
        window.location.href = '/zeyad/Final_Project/Project_UI/Doctor/index.php';</script>";
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