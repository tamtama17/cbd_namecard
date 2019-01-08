<?php
include('conn.php');
if (isset($_POST['deleteSp'])) {
	$shp_id = $_POST['shp_id'];
	$com_id = $_POST['com_id'];

	$qdelete = "DELETE FROM hasil_produk WHERE shp_id = '$shp_id';";
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