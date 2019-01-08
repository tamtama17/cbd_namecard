<?php
include('conn.php');
if (isset($_POST['editTor'])) {
	$to_id = $_POST['to_id'];
	$com_id = $_POST['com_id'];
	$to_year = $_POST['to_year'];
	$to_value = $_POST['to_value'];

	$qupdate = "UPDATE to_revenue SET to_year='$to_year',to_value='$to_value',com_id='$com_id' WHERE to_id = '$to_id';";
	if (mysqli_query($conn, $qupdate)) {
		session_start();
		$_SESSION['flag'] = 1;
		header('location:com_detail?com_id='.$com_id);
	} else {
		die(mysqli_error($conn));
	}

	mysqli_close($conn);
}
?>