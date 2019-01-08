<?php
include('conn.php');
if (isset($_POST['newA'])) {
	$com_id = $_POST['com_id'];
	$a_name = $_POST['a_name'];
	$merk_type = $_POST['merk_type'];
	$jumlah = $_POST['jumlah'];
	$tahun_pembuatan = $_POST['tahun_pembuatan'];
	$kondisi = $_POST['kondisi'];
	$status_kepemilikan = $_POST['status_kepemilikan'];
	$tech_desc = $_POST['tech_desc'];

	$qupdate = "INSERT INTO alat(a_name, merk_type, jumlah, tahun_pembuatan, kondisi, status_kepemilikan, tech_desc, com_id) VALUES ('$a_name', '$merk_type', '$jumlah', '$tahun_pembuatan', '$kondisi', '$status_kepemilikan', '$tech_desc', '$com_id');";
	if (mysqli_query($conn, $qupdate)) {
		$a_id = mysqli_insert_id($conn);
		if ($_FILES["attached_file"]["error"] == 0) {
			$target_dir = "file/".$com_id."/";
			if (!file_exists($target_dir)) {
				mkdir($target_dir);
			}

			$tool_af = $_FILES["attached_file"]["name"];
			$temp = explode(".", $tool_af);
			$extension = end($temp);
			$tool_af_name= time()."_".$com_id."_".$a_id."_".$merk_type." ".$a_name."_file.".$extension;
			$target_file = $target_dir . $tool_af_name;

			if (move_uploaded_file($_FILES["attached_file"]["tmp_name"], $target_file)) {
				$qupfile = "UPDATE alat SET a_file='$tool_af_name' WHERE a_id = '$a_id';";
				if (mysqli_query($conn, $qupfile)) {
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