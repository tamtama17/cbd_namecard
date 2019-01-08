<?php
$host = "localhost";
$user = "root";
$password = "";
$dbname = "namecard";

$conn = mysqli_connect($host, $user, $password, $dbname);

if (!$conn) {
	die("error in connection");
}
?>