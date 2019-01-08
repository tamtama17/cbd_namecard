<?php
include('conn.php');
$jobh_id = $_GET['jobh_id'];
$per_id = $_GET['per_id'];
$qper = "DELETE FROM job_history WHERE jobh_id = '$jobh_id';";
if (mysqli_query($conn,$qper)) {
	$qcurjob = "SELECT * FROM job_history WHERE per_id = '$per_id' ORDER BY tgl_jabat DESC LIMIT 1;";
	$qcurjobr = mysqli_query($conn, $qcurjob);
	$result = mysqli_fetch_assoc($qcurjobr);
	$curcom_id = $result['com_id_baru'];
	$curposition = $result['per_position_baru'];
	$curdepartment = $result['per_department_baru'];

	$qtruejob = "UPDATE personal SET com_id='$curcom_id',per_position='$curposition',per_department='$curdepartment' WHERE per_id = '$per_id'";
	if (mysqli_query($conn, $qtruejob)) {
		header("location:per_detail?per_id=$per_id");
	}
} else{
	die(mysqli_error($conn));
}
mysqli_close($conn);
?>