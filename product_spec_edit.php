<?php
include('conn.php');
if (isset($_POST['editSp'])) {
	$shp_id = $_POST['shp_id'];
	$com_id = $_POST['com_id'];
	$hasil_produksi = $_POST['hasil_produksi'];
	$jenis_produksi = $_POST['jenis_produksi'];
	$spesifikasi = $_POST['spesifikasi'];
	$standar_produk = $_POST['standar_produk'];
	$sertifikat = $_POST['sertifikat'];
	$tkdn = $_POST['tkdn'];
	$kapasitas = $_POST['kapasitas'];

	$qupdate = "UPDATE hasil_produk SET hasil_produksi='$hasil_produksi',jenis_produksi='$jenis_produksi',spesifikasi='$spesifikasi',standar_produk='$standar_produk',sertifikat='$sertifikat',tkdn='$tkdn',kapasitas='$kapasitas',com_id='$com_id' WHERE shp_id = '$shp_id';";
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