<?php
session_start();
include('conn.php');
require('excel_reader.php');

if (isset($_POST['submit'])) {
	$idx = 0;
	$berhasil = 0;
	$total;
	$target = basename($_FILES["fileExcel"]["name"]);
	move_uploaded_file($_FILES["fileExcel"]["tmp_name"], $target);

	$data = new Spreadsheet_Excel_Reader($_FILES["fileExcel"]["name"], false);

	$baris = $data->rowcount($sheet_index=0);

	for ($i=3; $i<=$baris ; $i++) {
		$total++;
		$full_name = $data->val($i, 1);

		$qcekdata = "SELECT per_id FROM personal WHERE per_full_name = '$full_name'";
		$cekdatarun = mysqli_query($conn,$qcekdata);
		$jumlahp = mysqli_num_rows ($cekdatarun);
		if ($jumlahp == 0) {
			$first_name = $data->val($i, 2);
			$last_name = $data->val($i, 3);
			$com_name = $data->val($i, 4);
			$per_position = $data->val($i, 5);
			$per_department = $data->val($i, 6);

			$per_phone1 = $data->val($i, 12);
			if ($per_phone1 == NULL) {
				$per_phone1 = $data->val($i, 14);
				$per_phone2 = $data->val($i, 18);
				$per_phone3 = NULL;
				if ($per_phone1 == NULL) {
					$per_phone1 = $data->val($i, 18);
					$per_phone2 = NULL;
				}
			} else{
				$per_phone2 = $data->val($i, 14);
				$per_phone3 = $data->val($i, 18);
				if ($per_phone2 == NULL) {
					$per_phone2 = $data->val($i, 18);
					$per_phone3 = NULL;
				}
			}
			$per_email = $data->val($i, 19);
			$com_id = NULL;

			$qcek = "SELECT com_id FROM company WHERE com_name = '$com_name'";
			$cekrun = mysqli_query($conn,$qcek);
			$jumlah = mysqli_num_rows ($cekrun);
			if ($jumlah == 0) {
				$com_address = $data->val($i, 7);
				$com_city = $data->val($i, 8);
				$com_postal_code = $data->val($i, 10);
				$com_country = $data->val($i, 11);
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

			$qins = "INSERT INTO personal(com_id, per_full_name, per_first_name, per_last_name, per_position, per_department, per_phone1, per_phone2, per_phone3, per_email) VALUES ('$com_id', '$full_name', '$first_name', '$last_name', '$per_position', '$per_department', '$per_phone1', '$per_phone2', '$per_phone3', '$per_email')";
			if (mysqli_query($conn, $qins)) {
				$berhasil++;
			}
		} elseif ($jumlahp >= 1) {
			while ($result = mysqli_fetch_assoc($cekdatarun)) {
				$_SESSION['sama'][$idx]['per_id'][] = $result['per_id'];
			}
			$_SESSION['sama'][$idx]['full_name'] = $data->val($i, 1);
			$_SESSION['sama'][$idx]['first_name'] = $data->val($i, 2);
			$_SESSION['sama'][$idx]['last_name'] = $data->val($i, 3);
			$_SESSION['sama'][$idx]['com_name'] = $data->val($i, 4);
			$_SESSION['sama'][$idx]['per_position'] = $data->val($i, 5);
			$_SESSION['sama'][$idx]['per_department'] = $data->val($i, 6);

			$_SESSION['sama'][$idx]['per_phone1'] = $data->val($i, 12);
			if ($_SESSION['sama'][$idx]['per_phone1'] == NULL) {
				$_SESSION['sama'][$idx]['per_phone1'] = $data->val($i, 14);
				$_SESSION['sama'][$idx]['per_phone2'] = $data->val($i, 18);
				$_SESSION['sama'][$idx]['per_phone3'] = NULL;
				if ($_SESSION['sama'][$idx]['per_phone1'] == NULL) {
					$_SESSION['sama'][$idx]['per_phone1'] = $data->val($i, 18);
					$_SESSION['sama'][$idx]['per_phone2'] = NULL;
				}
			} else{
				$_SESSION['sama'][$idx]['per_phone2'] = $data->val($i, 14);
				$_SESSION['sama'][$idx]['per_phone3'] = $data->val($i, 18);
				if ($_SESSION['sama'][$idx]['per_phone2'] == NULL) {
					$_SESSION['sama'][$idx]['per_phone2'] = $data->val($i, 18);
					$_SESSION['sama'][$idx]['per_phone3'] = NULL;
				}
			}
			$_SESSION['sama'][$idx]['per_email'] = $data->val($i, 19);
			$_SESSION['sama'][$idx]['com_address'] = $data->val($i, 7);
			$_SESSION['sama'][$idx]['com_city'] = $data->val($i, 8);
			$_SESSION['sama'][$idx]['com_postal_code'] = $data->val($i, 10);
			$_SESSION['sama'][$idx]['com_country'] = $data->val($i, 11);
			$idx++;
		}
	}

	if ($berhasil == $total && $total > 0) {
		$_SESSION['flag'] = 3;
	} else if($berhasil == 0) {
		$_SESSION['flag'] = 5;
	} else if($berhasil < $total){
		$_SESSION['flag'] = 4;
	}
	
	header('location:./');

	unlink($_FILES["fileExcel"]["name"]);
	mysqli_close($conn);
}
?>