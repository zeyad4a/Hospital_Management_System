<?php
session_start();
$connect = new mysqli("localhost", "root", "", "hms");
if ($connect->connect_error) {
  die("Connection failed: " . $connect->connect_error);
}
// $sqlup = "UPDATE appointment SET employStatues = 0 where employId = " . $_SESSION['id'] . "";
// $connect->query($sqlup);
$id = $_SESSION['id'];
$sqlup = "UPDATE doctors SET statue = 0 where id = '$id '";
$connect->query($sqlup);
session_destroy();
header("location: /zeyad/Final_Project/Project_UI/Doctor/index.php");
exit;


