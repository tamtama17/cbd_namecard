<?php
include('conn.php');
if (isset($_POST['torAdd'])) {
	$com_id = $_POST['com_id'];
	$to_year = $_POST['to_year'];
	$to_value = $_POST['to_value'];

	$qadd = "INSERT INTO to_revenue(to_year, to_value, com_id) VALUES ('$to_year', '$to_value', '$com_id')";
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