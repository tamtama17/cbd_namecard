<?php
include('conn.php');
if (isset($_POST['addCertif'])) {
	$com_id = $_POST['com_id'];
	$c_name = $_POST['c_name'];
	$c_code = $_POST['c_code'];
	$c_classification = $_POST['c_classification'];
	$c_qualification = $_POST['c_qualification'];

	$qadd = "INSERT INTO certificate(c_name, c_code, c_classification, c_qualification, com_id) VALUES ('$c_name', '$c_code', '$c_classification', '$c_qualification', '$com_id');";
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