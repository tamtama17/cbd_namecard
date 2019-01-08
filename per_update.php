<?php
include('conn.php');
if (isset($_POST['editdata'])) {
	$per_id = $_POST['per_id'];
	$first_name = $_POST['first_name'];
	$last_name = $_POST['last_name'];
	$born_place = $_POST['born_place'];
	$born_date = $_POST['born_date'];
	$sex = $_POST['sex'];
	$religion = $_POST['religion'];
	$latest_education = $_POST['latest_education'];
	$address = $_POST['address'];
	$per_position = $_POST['per_position'];
	$per_department = $_POST['per_department'];
	$per_phone1 = $_POST['per_phone1'];
	$per_phone2 = $_POST['per_phone2'];
	$per_phone3 = $_POST['per_phone3'];
	$com_id = $_POST['com_id'];
	$per_email = $_POST['per_email'];

	$full_name = $first_name." ".$last_name;

	$filename=$_FILES["foto"]["name"];
	$tmp = explode(".", $filename);
	$extension=end($tmp);
	$newfilename= time()."_".$per_id.".".$extension;
	$target_dir = "profile_pictures/";
	$target_file = $target_dir . $newfilename;
	$uploadOk = 1;

	if ($_FILES["foto"]["error"] == 0) {
		$qper = "CALL dataper('$per_id');";
		$qrun = mysqli_query($conn,$qper);
		$result = mysqli_fetch_assoc($qrun);
		if ($result['per_profile_picture'] != NULL) {
			$file_lama = $target_dir.$result['per_profile_picture'];
			unlink("$file_lama");
		}
		mysqli_next_result($conn);
		if (move_uploaded_file($_FILES["foto"]["tmp_name"], $target_file)) {
			$qupdate = "UPDATE personal SET com_id = '$com_id', per_full_name = '$full_name', per_first_name = '$first_name', per_last_name = '$last_name', born_place = '$born_place', born_date = '$born_date', sex = '$sex', religion = '$religion', latest_education = '$latest_education', address = '$address', per_profile_picture = '$newfilename', per_position = '$per_position', per_department = '$per_department', per_phone1 = '$per_phone1', per_phone2 = '$per_phone2', per_phone3 = '$per_phone3', per_email = '$per_email' WHERE per_id = '$per_id';";
		} else{
			echo "Something error while uploading your file. Please try again.<br>";
		}
	} elseif ($_FILES["foto"]["error"] == 4) {
			$qupdate = "UPDATE personal SET com_id = '$com_id', per_full_name = '$full_name', per_first_name = '$first_name', per_last_name = '$last_name', born_place = '$born_place', born_date = '$born_date', sex = '$sex', religion = '$religion', latest_education = '$latest_education', address = '$address', per_position = '$per_position', per_department = '$per_department', per_phone1 = '$per_phone1', per_phone2 = '$per_phone2', per_phone3 = '$per_phone3', per_email = '$per_email' WHERE per_id = '$per_id';";
	} else{
		echo "Error uploading file.<br>";
		echo "Return Code: " . $_FILES["foto"]["error"] . "<br>";
	}

	if (mysqli_query($conn, $qupdate)) {
		header('location:per_detail?per_id='.$per_id);
	} else{
		die(mysqli_error($conn));
	}
	mysqli_close($conn);
}
?>