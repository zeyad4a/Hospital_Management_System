<?php
session_start();
$connect = new mysqli("localhost", "root", "", "hms");
if ($connect->connect_error) {
  die("Connection failed: " . $connect->connect_error);
}
// $sqlup = "UPDATE appointment SET employStatues = 0 where employId = " . $_SESSION['id'] . "";
// $connect->query($sqlup);
session_destroy();
header("location: ../About.php");
exit;
?>