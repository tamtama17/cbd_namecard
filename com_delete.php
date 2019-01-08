<?php
session_start();
include('conn.php');
$com_id = $_GET['com_id'];
$qcom = "SELECT org_chart, finance_capability FROM company WHERE com_id = '$com_id';";
$qcomrun = mysqli_query($conn,$qcom);
$result = mysqli_fetch_assoc($qcomrun);
$target_dir = "file/".$com_id."/";

$qbs_id = "SELECT bs_id FROM company WHERE com_id = '$com_id';";
$qbs_idrun = mysqli_query($conn,$qbs_id);
$bs_id = mysqli_fetch_assoc($qbs_idrun);
$bs_idnya = $bs_id['bs_id'];

$qda = "SELECT * FROM alat WHERE com_id = '$com_id';";
$qdarun = mysqli_query($conn,$qda);
if (mysqli_num_rows($qdarun) > 0) {
	while ($da = mysqli_fetch_assoc($qdarun)) {
		if ($da['a_file'] != NULL) {
			$da_file_lama = $target_dir.$da['a_file'];
			unlink($da_file_lama);
		}
	}
}

$qcomdel = "CALL com_del('$com_id');";
if (mysqli_query($conn,$qcomdel)) {
	if (file_exists($target_dir)) {
		if ($result['org_chart'] != NULL) {
			$file_lama_org = $target_dir.$result['org_chart'];
			unlink("$file_lama_org");
		}
		if ($result['finance_capability'] != NULL) {
			$file_lama_fc = $target_dir.$result['finance_capability'];
			unlink("$file_lama_fc");
		}
		rmdir($target_dir);
	}
	if ($bs_idnya>6) {
		$qcek = "SELECT COUNT(com_id) AS jumlah FROM company WHERE bs_id = '$bs_idnya';";
		$qcekrun = mysqli_query($conn,$qcek);
		$cek = mysqli_fetch_assoc($qcekrun);
		$jumlah = $cek['jumlah'];
		if ($jumlah<1) {
			$qdelbs = "DELETE FROM bussiness_services WHERE bs_id = '$bs_idnya'";
			if (!mysqli_query($conn,$qdelbs)) {
				die(mysqli_error($conn));
			}
		}
	}
	$_SESSION['flag'] = 2;
	header('location:comlist');
} else{
	die(mysqli_error($conn));
}
mysqli_close($conn);
?>