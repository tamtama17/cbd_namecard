<?php
include('conn.php');
if (isset($_POST['editCertif'])) {
	$c_id = $_POST['c_id'];
	$com_id = $_POST['com_id'];
	$c_name = $_POST['c_name'];
	$c_code = $_POST['c_code'];
	$c_classification = $_POST['c_classification'];
	$c_qualification = $_POST['c_qualification'];

	$qupdate = "UPDATE certificate SET c_name='$c_name', c_code='$c_code', c_classification='$c_classification', c_qualification='$c_qualification' WHERE c_id = '$c_id';";
	echo "$qupdate";
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