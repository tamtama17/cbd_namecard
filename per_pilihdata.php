<?php
session_start();
include('conn.php');
if (isset($_POST['save'])) {
	$n = $_POST['n'];
	$x = $_POST['x'];
	$berhasil = 0;
	$total = 0;
	for ($i=0; $i < $n; $i++) {
		echo $i."<br>";
		if (!empty($_POST['existdata'][$i]) && !empty($_POST['newdata'][$i])) {
			$total++;
			echo "22nya dicentang<br>";

			$per_full_name = $_POST['full_name'][$i];
			$per_first_name = $_POST['first_name'][$i];
			$per_last_name = $_POST['last_name'][$i];
			$per_position = $_POST['per_position'][$i];
			$per_department = $_POST['per_department'][$i];
			$com_name = $_POST['com_name'][$i];
			$per_phone1 = $_POST['per_phone1'][$i];
			$per_phone2 = $_POST['per_phone2'][$i];
			$per_phone3 = $_POST['per_phone3'][$i];
			$per_email = $_POST['per_email'][$i];
					
			$com_id = NULL;

			$qcek = "SELECT com_id FROM company WHERE com_name = '$com_name'";
			$cekrun = mysqli_query($conn,$qcek);
			$jumlah = mysqli_num_rows ($cekrun);
			if ($jumlah == 0) {
				$com_address = $_POST['com_address'][$i];
				$com_city = $_POST['com_city'][$i];
				$com_postal_code = $_POST['com_postal_code'][$i];
				$com_country = $_POST['com_country'][$i];
				$inscom = "INSERT INTO company(com_name, com_address, com_city, com_postal_code, com_country) VALUES ('$com_name', '$com_address', '$com_city', '$com_postal_code', '$com_country')";
				if (mysqli_query($conn, $inscom)) {
					$com_id = mysqli_insert_id($conn);
				}
			} elseif ($jumlah == 1) {
				$hasil = mysqli_fetch_assoc($cekrun);
				$com_id = $hasil['com_id'];
			} elseif ($jumlah > 1) {
				echo "There are more than one company data like ".$com_name.". Please check the company data.<br><br>";
			}

			$qins = "INSERT INTO personal(com_id, per_full_name, per_first_name, per_last_name, per_position, per_department, per_phone1, per_phone2, per_phone3, per_email) VALUES ('$com_id', '$per_full_name', '$per_first_name', '$per_last_name', '$per_position', '$per_department', '$per_phone1', '$per_phone2', '$per_phone3', '$per_email')";
			if (mysqli_query($conn, $qins)) {
				$berhasil++;
			}

			for ($j=0; $j < $x[$i]; $j++) {
				$per_id = $_POST['per_id'][$i][$j];
				if (empty($_POST['existdata'][$i][$j])) {
					$ada = 0;
					$cek = "CALL dataper('$per_id');";
					$qrun = mysqli_query($conn,$cek);
					$result = mysqli_fetch_assoc($qrun);
					if ($result['per_profile_picture'] != NULL) {
						$target_dir = "profile_pictures/";
						$file_lama = $target_dir.$result['per_profile_picture'];
						$ada = 1;
					}
					mysqli_next_result($conn);
					$qper = "CALL per_del('$per_id');";
					if (mysqli_query($conn,$qper)) {
						if ($ada == 1) {
							unlink("$file_lama");
						}
					} else{
						die(mysqli_error($conn));
					}
					mysqli_next_result($conn);
				}
			}
			echo "<br>";
		} elseif (empty($_POST['existdata'][$i]) && !empty($_POST['newdata'][$i])) {
			$total++;
			echo "exist gak centang, new centang<br>";
			for ($j=0; $j < $x[$i]; $j++) {
				$per_id = $_POST['per_id'][$i][$j];
				$ada = 0;
				$cek = "CALL dataper('$per_id');";
				$qrun = mysqli_query($conn,$cek);
				$result = mysqli_fetch_assoc($qrun);
				if ($result['per_profile_picture'] != NULL) {
					$target_dir = "profile_pictures/";
					$file_lama = $target_dir.$result['per_profile_picture'];
					$ada = 1;
				}
				mysqli_next_result($conn);
				$qper = "CALL per_del('$per_id');";
				if (mysqli_query($conn,$qper)) {
					if ($ada == 1) {
						unlink("$file_lama");
					}
				} else{
					die(mysqli_error($conn));
				}
				mysqli_next_result($conn);
			}

			$per_full_name = $_POST['full_name'][$i];
			$per_first_name = $_POST['first_name'][$i];
			$per_last_name = $_POST['last_name'][$i];
			$per_position = $_POST['per_position'][$i];
			$per_department = $_POST['per_department'][$i];
			$com_name = $_POST['com_name'][$i];
			$per_phone1 = $_POST['per_phone1'][$i];
			$per_phone2 = $_POST['per_phone2'][$i];
			$per_phone3 = $_POST['per_phone3'][$i];
			$per_email = $_POST['per_email'][$i];
					
			$com_id = NULL;

			$qcek = "SELECT com_id FROM company WHERE com_name = '$com_name'";
			$cekrun = mysqli_query($conn,$qcek);
			$jumlah = mysqli_num_rows ($cekrun);
			if ($jumlah == 0) {
				$com_address = $_POST['com_address'][$i];
				$com_city = $_POST['com_city'][$i];
				$com_postal_code = $_POST['com_postal_code'][$i];
				$com_country = $_POST['com_country'][$i];
				$inscom = "INSERT INTO company(com_name, com_address, com_city, com_postal_code, com_country) VALUES ('$com_name', '$com_address', '$com_city', '$com_postal_code', '$com_country')";
				if (mysqli_query($conn, $inscom)) {
					$com_id = mysqli_insert_id($conn);
				}
			} elseif ($jumlah == 1) {
				$hasil = mysqli_fetch_assoc($cekrun);
				$com_id = $hasil['com_id'];
			} elseif ($jumlah > 1) {
				echo "There are more than one company data like ".$com_name.". Please check the company data.<br><br>";
			}

			$qins = "INSERT INTO personal(com_id, per_full_name, per_first_name, per_last_name, per_position, per_department, per_phone1, per_phone2, per_phone3, per_email) VALUES ('$com_id', '$per_full_name', '$per_first_name', '$per_last_name', '$per_position', '$per_department', '$per_phone1', '$per_phone2', '$per_phone3', '$per_email')";
			if (mysqli_query($conn, $qins)) {
				$berhasil++;
			}
		} else {
			echo "22nya ga centang, kalo ga exist doang centang<br>";
		}
		echo "<br>";
	}

	if ($berhasil == $total && $total > 0) {
		$_SESSION['flag'] = 3;
	} else if($berhasil == 0) {
		$_SESSION['flag'] = 6;
	} else if($berhasil < $total){
		$_SESSION['flag'] = 4;
	}
	
	header('location:./');
	mysqli_close($conn);
}
?>