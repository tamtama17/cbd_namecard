<?php
session_start();
include('conn.php');
$per_id = $_GET['per_id'];
$ada = 0;
$cek = "CALL dataper('$per_id');";
$qrun = mysqli_query($conn,$cek);
$result = mysqli_fetch_assoc($qrun);
if ($result['per_profile_picture'] != NULL) {
	$target_dir = "profile_pictures/";
	$file_lama = $target_dir.$result['per_profile_picture'];
	$ada = 1;
}
mysqli_next_result($conn);
$qper = "CALL per_del('$per_id');";
if (mysqli_query($conn,$qper)) {
	if ($ada == 1) {
		unlink("$file_lama");
		echo "delete fotonya<br>";
	}
	$_SESSION['flag'] = 2;
	header('location:./');
} else{
	die(mysqli_error($conn));
}
mysqli_close($conn);
?>