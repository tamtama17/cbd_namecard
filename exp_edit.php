<?php
include('conn.php');
if (isset($_POST['editExp'])) {
	$p_id = $_POST['p_id'];
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

	$qupdate = "UPDATE pengalaman SET nama_proyek='$nama_proyek',lingkup_pekerjaan='$lingkup_pekerjaan',lokasi='$lokasi',periode='$periode',client='$client',p_field='$p_field',capacity='$capacity',on_off_shore='$on_off_shore',p_cost='$p_cost',com_id='$com_id' WHERE p_id = '$p_id';";
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