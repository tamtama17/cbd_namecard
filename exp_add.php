<?php
include('conn.php');
if (isset($_POST['new_exp'])) {
	$com_id = $_POST['com_id'];
	$nama_proyek = $_POST['nama_proyek'];
	$client = $_POST['client'];
	$lingkup_pekerjaan = $_POST['lingkup_pekerjaan'];
	$periode = $_POST['periode'];
	$p_field = $_POST['p_field'];
	$lokasi = $_POST['lokasi'];
	$on_off_shore = $_POST['on_off_shore'];
	$capacity = $_POST['capacity'];
	$p_cost = $_POST['p_cost'];
	$p_status = $_POST['p_status'];

	$qadd = "INSERT INTO pengalaman(nama_proyek, lingkup_pekerjaan, lokasi, periode, client, p_field, capacity, on_off_shore, p_cost, p_status, com_id) VALUES ('$nama_proyek', '$lingkup_pekerjaan', '$lokasi', '$periode', '$client', '$p_field', '$capacity', '$on_off_shore', '$p_cost', '$p_status', '$com_id')";
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