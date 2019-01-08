<?php
session_start();
include('conn.php');
if (isset($_POST['add_ad'])) {
	$com_id = $_POST['com_id'];
	$item = $_POST['item'];
	$description = $_POST['description'];

	$qadd = "INSERT INTO additional_detail(item, description, com_id) VALUES ('$item', '$description', '$com_id')";
	if (mysqli_query($conn, $qadd)) {
		$_SESSION['flag'] = 1;
		header('location:com_detail?com_id='.$com_id);
	} else {
		die(mysqli_error($conn));
	}

	mysqli_close($conn);
}
?>