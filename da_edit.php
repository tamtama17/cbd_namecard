<?php
include('conn.php');
if (isset($_POST['editDa'])) {
	$a_id = $_POST['a_id'];
	$com_id = $_POST['com_id'];
	$a_name = $_POST['a_name'];
	$merk_type = $_POST['merk_type'];
	$jumlah = $_POST['jumlah'];
	$tahun_pembuatan = $_POST['tahun_pembuatan'];
	$kondisi = $_POST['kondisi'];
	$status_kepemilikan = $_POST['status_kepemilikan'];
	$tech_desc = $_POST['tech_desc'];

	$qupdate = "UPDATE alat SET a_name='$a_name',merk_type='$merk_type',jumlah='$jumlah',tahun_pembuatan='$tahun_pembuatan',kondisi='$kondisi',status_kepemilikan='$status_kepemilikan',tech_desc='$tech_desc' WHERE a_id = '$a_id';";
	if (mysqli_query($conn, $qupdate)) {
		if ($_FILES["attached_file"]["error"] == 0) {
			$target_dir = "file/".$com_id."/";
			if (!file_exists($target_dir)) {
				mkdir($target_dir);
			}

			$qda = "SELECT * FROM alat WHERE a_id = '$a_id';";
			$qdarun = mysqli_query($conn,$qda);
			$result = mysqli_fetch_assoc($qdarun);
			if ($result['a_file'] != NULL) {
				$file_lama = $target_dir.$result['a_file'];
			} else {
				$file_lama = NULL;
			}

			$tool_af = $_FILES["attached_file"]["name"];
			$temp = explode(".", $tool_af);
			$extension = end($temp);
			$tool_af_name= time()."_".$com_id."_".$a_id."_".$result['merk_type']." ".$result['a_name']."_file.".$extension;
			$target_file = $target_dir . $tool_af_name;

			if (move_uploaded_file($_FILES["attached_file"]["tmp_name"], $target_file)) {
				$qupfile = "UPDATE alat SET a_file='$tool_af_name' WHERE a_id = '$a_id';";
				if (mysqli_query($conn, $qupfile)) {
					if ($file_lama != NULL) {
						unlink("$file_lama");
					}
				} else {
					unlink("$target_file");
					die(mysqli_error($conn));
				}
			} else{
				echo "Something error while uploading your file. Please try again.<br>";
			}
		} elseif ($_FILES["attached_file"]["error"] != 4) {
			echo "Error uploading file.<br>";
			echo "Return Code: " . $_FILES["attached_file"]["error"] . "<br>";
		}
		session_start();
		$_SESSION['flag'] = 1;
		header('location:com_detail?com_id='.$com_id);
	} else {
		die(mysqli_error($conn));
	}

	mysqli_close($conn);
}
?>