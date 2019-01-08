<?php
include('conn.php');
if (isset($_POST['deleteA'])) {
	$a_id = $_POST['a_id'];
	$com_id = $_POST['com_id'];

	$target_dir = "file/".$com_id."/";
	if (file_exists($target_dir)) {
		$qda = "SELECT * FROM alat WHERE a_id = '$a_id';";
		$qdarun = mysqli_query($conn,$qda);
		$result = mysqli_fetch_assoc($qdarun);
		if ($result['a_file'] != NULL) {
			$file_lama = $target_dir.$result['a_file'];
			unlink("$file_lama");
		}
	}

	$qdelete = "DELETE FROM alat WHERE a_id = '$a_id';";
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