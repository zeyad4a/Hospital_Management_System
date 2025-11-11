<?php
session_start();
$connect = new mysqli("localhost", "root", "", "hms");
if ($connect->connect_error) {
    die("Connection failed: " . $connect->connect_error);
}

if (isset($_SESSION['id'])) {
  $id = intval($_SESSION['id']); // Defult ID
  $sqlup = "UPDATE employ SET employ_statue = 0 WHERE id = $id";
    $connect->query($sqlup);
} else {
    // لو مفيش session id
    error_log("Logout attempted without session id");
}

session_destroy();
header("location:/HMS/Final_Project/Project_UI/Doctor/index.php");
exit;
?>
