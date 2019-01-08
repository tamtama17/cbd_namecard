<?php
session_start();
include('conn.php');
if (isset($_POST['newdata'])) {
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

	$filename=$_FILES["foto"]["name"];
	$tmp = explode(".", $filename);
	$extension=end($tmp);
	$newfilename= time()."_".$first_name." ".$last_name.".".$extension;
	$target_dir = "profile_pictures/";
	$target_file = $target_dir . $newfilename;

	if ($_FILES["foto"]["error"] == 0) {
		if (move_uploaded_file($_FILES["foto"]["tmp_name"], $target_file)) {
			$qins = "INSERT INTO personal(com_id, per_full_name, per_first_name, per_last_name, born_place, born_date, sex, religion, latest_education, address, per_profile_picture, per_position, per_department, per_phone1, per_phone2, per_phone3, per_email) VALUES ('$com_id', '$full_name', '$first_name', '$last_name', '$born_place', '$born_date', '$sex', '$religion', '$latest_education', '$address', '$newfilename', '$per_position', '$per_department', '$per_phone1', '$per_phone2', '$per_phone3', '$per_email')";
		} else{
			echo "Something error while uploading your file. Please try again.<br>";
		}
	} elseif ($_FILES["foto"]["error"] == 4) {
		$qins = "INSERT INTO personal(com_id, per_full_name, per_first_name, per_last_name, born_place, born_date, sex, religion, latest_education, address, per_position, per_department, per_phone1, per_phone2, per_phone3, per_email) VALUES ('$com_id', '$full_name', '$first_name', '$last_name', '$born_place', '$born_date', '$sex', '$religion', '$latest_education', '$address', '$per_position', '$per_department', '$per_phone1', '$per_phone2', '$per_phone3', '$per_email')";
	} else{
		echo "Error uploading file.<br>";
		echo "Return Code: " . $_FILES["foto"]["error"] . "<br>";
	}


	if (mysqli_query($conn, $qins)) {
		$_SESSION['flag'] = 1;
	} else{
		die(mysqli_error($conn));
	}
	header('location:./');
	mysqli_close($conn);
}
?>