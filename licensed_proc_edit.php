<?php
include('conn.php');
if (isset($_POST['editLp'])) {
	$l_id = $_POST['l_id'];
	$com_id = $_POST['com_id'];
	$l_process = $_POST['l_process'];
	$bf_id = $_POST['bf_id'];

	$qupdate = "UPDATE licensed SET l_process='$l_process',bf_id='$bf_id',com_id='$com_id' WHERE l_id = '$l_id';";
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