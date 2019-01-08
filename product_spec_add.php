<?php
include('conn.php');
if (isset($_POST['newSP'])) {
	$com_id = $_POST['com_id'];
	$hasil_produksi = $_POST['hasil_produksi'];
	$jenis_produksi = $_POST['jenis_produksi'];
	$spesifikasi = $_POST['spesifikasi'];
	$standar_produk = $_POST['standar_produk'];
	$sertifikat = $_POST['sertifikat'];
	$tkdn = $_POST['tkdn'];
	$kapasitas = $_POST['kapasitas'];

	$qadd = "INSERT INTO hasil_produk(hasil_produksi, jenis_produksi, spesifikasi, standar_produk, sertifikat, tkdn, kapasitas, com_id) VALUES ('$hasil_produksi', '$jenis_produksi', '$spesifikasi', '$standar_produk', '$sertifikat', '$tkdn', '$kapasitas', '$com_id');";
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