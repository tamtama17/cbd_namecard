<?php
include('conn.php');
if (isset($_POST['delExp'])) {
	$p_id = $_POST['p_id'];
	$com_id = $_POST['com_id'];

	$qdelete = "DELETE FROM pengalaman WHERE p_id = '$p_id';";
	if (mysqli_query($conn, $qdelete)) {
		session_start();
		$_SESSION['flag'] = 1;
		header('location:com_detail?com_id='.$com_id);
	} else {
		die(mysqli_error($conn));
	}

	mysqli_close($conn);
}
?>