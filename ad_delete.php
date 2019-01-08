<?php
session_start();
include('conn.php');
if (isset($_POST['ad_del'])) {
	$com_id = $_POST['com_id'];
	$ad_id = $_POST['ad_id'];

	$qdelete = "DELETE FROM additional_detail WHERE ad_id = '$ad_id';";
	if (mysqli_query($conn, $qdelete)) {
		$_SESSION['flag'] = 1;
		header('location:com_detail?com_id='.$com_id);
	} else {
		die(mysqli_error($conn));
	}

	mysqli_close($conn);
}
?>