<?php
$host = 'localhost';
$username = 'root';
$password = '';
$dbname = 'hms';
$connect = new mysqli($host , $username , $password , $dbname );
if ($connect->connect_error) {
    die("Connection failed: " . $connect->connect_error);
}

?>
