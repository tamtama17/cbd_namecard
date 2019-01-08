<?php
include('conn.php');
if (isset($_POST['newJH'])) {
	$per_id = $_POST['per_id'];
	$com_id = $_POST['com_id'];
	$tgl_jabat = $_POST['tgl_jabat'];
	$per_position_baru = $_POST['per_position_baru'];
	$per_department_baru = $_POST['per_department_baru'];

	if ($com_id != NULL) {
		echo "$com_id<br>";
	} else {
		$com_name = $_POST['com_name'];
		$qnewcom = "INSERT INTO company(com_name) VALUES ('$com_name');";
		if (mysqli_query($conn, $qnewcom)) {
			$com_id = mysqli_insert_id($conn);
		} else {
			die("Error description: " . mysqli_error($conn));
		}
	}

	if ($tgl_jabat == NULL) {
		$qinsert = "INSERT INTO job_history(per_id, com_id_baru, per_position_baru, per_department_baru) VALUES ('$per_id', '$com_id', '$per_position_baru', '$per_department_baru')";
	} else {
		$qinsert = "INSERT INTO job_history(per_id, com_id_baru, per_position_baru, per_department_baru, tgl_jabat) VALUES ('$per_id', '$com_id', '$per_position_baru', '$per_department_baru', '$tgl_jabat')";
	}
	if (mysqli_query($conn, $qinsert)) {
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
}
?>