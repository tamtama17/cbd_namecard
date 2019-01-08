<?php
include('conn.php');
if (isset($_POST['newLP'])) {
	$com_id = $_POST['com_id'];
	$l_process = $_POST['l_process'];
	$bf_id = $_POST['bf_id'];

	$qadd = "INSERT INTO licensed(l_process, bf_id, com_id) VALUES ('$l_process', '$bf_id', '$com_id');";
	if (mysqli_query($conn, $qadd)) {
		session_start();
		$_SESSION['flag'] = 1;
		header('location:com_detail?com_id='.$com_id);
	} else {
		die(mysqli_error($conn));
	}

	mysqli_close($conn);
}
?>