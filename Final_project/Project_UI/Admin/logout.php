<?php
session_start();
$connect = new mysqli("localhost", "root", "", "hms");
if ($connect->connect_error) {
  die("Connection failed: " . $connect->connect_error);
}
$sqlup = "UPDATE employ SET employ_statue = 0 where id = " . $_SESSION['id'] . "";
$connect->query($sqlup);
session_destroy();
header("location: /zeyad/Final_Project/admin-log/index.php");
exit;
?>