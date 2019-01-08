<?php
include('conn.php');
if (isset($_POST['torDel'])) {
	$com_id = $_POST['com_id'];
	$to_id = $_POST['to_id'];

	$qdelete = "DELETE FROM to_revenue WHERE to_id = '$to_id';";
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