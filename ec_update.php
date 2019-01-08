<?php
include('conn.php');
if (isset($_POST['editEC'])) {
	$com_id = $_POST['com_id'];
	$jum_e_process_wni = $_POST['jum_e_process_wni'];
	$jum_e_process_wna = $_POST['jum_e_process_wna'];
	$jum_e_civil_wni = $_POST['jum_e_civil_wni'];
	$jum_e_civil_wna = $_POST['jum_e_civil_wna'];
	$jum_e_piping_wni = $_POST['jum_e_piping_wni'];
	$jum_e_piping_wna = $_POST['jum_e_piping_wna'];
	$jum_e_instrument_wni = $_POST['jum_e_instrument_wni'];
	$jum_e_instrument_wna = $_POST['jum_e_instrument_wna'];
	$jum_e_electrical_wni = $_POST['jum_e_electrical_wni'];
	$jum_e_electrical_wna = $_POST['jum_e_electrical_wna'];
	$jum_e_mechanical_wni = $_POST['jum_e_mechanical_wni'];
	$jum_e_mechanical_wna = $_POST['jum_e_mechanical_wna'];
	$jum_e_rotary_package_machinary_wni = $_POST['jum_e_rotary_package_machinary_wni'];
	$jum_e_rotary_package_machinary_wna = $_POST['jum_e_rotary_package_machinary_wna'];
	$jumlah_project_management_wni = $_POST['jumlah_project_management_wni'];
	$jumlah_project_management_wna = $_POST['jumlah_project_management_wna'];
	$jumlah_project_planning_control_wni = $_POST['jumlah_project_planning_control_wni'];
	$jumlah_project_planning_control_wna = $_POST['jumlah_project_planning_control_wna'];
	$jumlah_procurement_wni = $_POST['jumlah_procurement_wni'];
	$jumlah_procurement_wna = $_POST['jumlah_procurement_wna'];
	$jumlah_construction_management_wni = $_POST['jumlah_construction_management_wni'];
	$jumlah_construction_management_wna = $_POST['jumlah_construction_management_wna'];
	$jumlah_qc_wni = $_POST['jumlah_qc_wni'];
	$jumlah_qc_wna = $_POST['jumlah_qc_wna'];

	$qupdate = "UPDATE company SET jum_e_process_wni='$jum_e_process_wni',jum_e_process_wna='$jum_e_process_wna',jum_e_civil_wni='$jum_e_civil_wni',jum_e_civil_wna='$jum_e_civil_wna',jum_e_piping_wni='$jum_e_piping_wni',jum_e_piping_wna='$jum_e_piping_wna',jum_e_instrument_wni='$jum_e_instrument_wni',jum_e_instrument_wna='$jum_e_instrument_wna',jum_e_electrical_wni='$jum_e_electrical_wni',jum_e_electrical_wna='$jum_e_electrical_wna',jum_e_mechanical_wni='$jum_e_mechanical_wni',jum_e_mechanical_wna='$jum_e_mechanical_wna',jum_e_rotary_package_machinary_wni='$jum_e_rotary_package_machinary_wni',jum_e_rotary_package_machinary_wna='$jum_e_rotary_package_machinary_wna',jumlah_project_management_wni='$jumlah_project_management_wni',jumlah_project_management_wna='$jumlah_project_management_wna',jumlah_project_planning_control_wni='$jumlah_project_planning_control_wni',jumlah_project_planning_control_wna='$jumlah_project_planning_control_wna',jumlah_procurement_wni='$jumlah_procurement_wni',jumlah_procurement_wna='$jumlah_procurement_wna',jumlah_construction_management_wni='$jumlah_construction_management_wni',jumlah_construction_management_wna='$jumlah_construction_management_wna',jumlah_qc_wni='$jumlah_qc_wni',jumlah_qc_wna='$jumlah_qc_wna' WHERE com_id = '$com_id';";
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