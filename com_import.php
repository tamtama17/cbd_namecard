<?php
session_start();
include('conn.php');
require('excel_reader.php');

if (isset($_POST['submit'])) {
	$berhasil = 0;
	$total = 0;
	$target = basename($_FILES["fileExcel"]["name"]);
	move_uploaded_file($_FILES["fileExcel"]["tmp_name"], $target);

	$data = new Spreadsheet_Excel_Reader($_FILES["fileExcel"]["name"], false);

	$baris = $data->rowcount($sheet_index=0);

	for ($i=4; $i<=$baris ; $i++) {
		$total++;
		$com_name = $data->val($i, 2);

		$qcekdata = "SELECT com_id FROM company WHERE com_name = '$com_name'";
		$cekdatarun = mysqli_query($conn,$qcekdata);
		$jumlah = mysqli_num_rows ($cekdatarun);
		if ($jumlah == 0 && $com_name != NULL) {
			$com_website = $data->val($i, 3);
			$com_email = $data->val($i, 4);
			$bs_name = $data->val($i, 5);
			$bs_id = NULL;
			if ($bs_name == 'EPC') {
				$bs_id = 1;
			} elseif ($bs_name == 'Vendor') {
				$bs_id = 2;
			} elseif ($bs_name == 'Licensor') {
				$bs_id = 3;
			} elseif ($bs_name == 'Consultant') {
				$bs_id = 4;
			} elseif ($bs_name == 'Contractor') {
				$bs_id = 5;
			} elseif ($bs_name == 'Operation & Maintenance') {
				$bs_id = 6;
			}

			$com_address = $data->val($i, 6);
			$com_city = $data->val($i, 7);
			$com_country = $data->val($i, 8);
			$com_postal_code =$data->val($i, 9);
			$com_phone = $data->val($i, 10);
			$com_fax = $data->val($i, 11);

			$plant_address = $data->val($i, 12);
			$plant_city = $data->val($i, 13);
			$plant_country = $data->val($i, 14);
			$plant_postal_code = $data->val($i, 15);
			$plant_phone = $data->val($i, 16);
			$plant_fax = $data->val($i, 17);

			$npwp = $data->val($i, 18);

			$akta_awal_no = $data->val($i, 19);
			$akta_awal_tgl = $data->val($i, 20);
			$akta_awal_notaris = $data->val($i, 21);
			$akta_awal_kota = $data->val($i, 22);

			$akta_akhir_no = $data->val($i, 23);
			$akta_akhir_tgl = $data->val($i, 24);
			$akta_akhir_notaris = $data->val($i, 25);
			$akta_akhir_kota = $data->val($i, 26);

			$saham_indo = $data->val($i, 27);
			$saham_asing = $data->val($i, 28);

			$qins = "INSERT INTO company (com_name, com_address, com_city, com_country, com_postal_code, com_phone, com_fax, plant_address, plant_city, plant_country, plant_postal_code, plant_phone, plant_fax, com_website, com_email, npwp, saham_indo, saham_asing, akta_awal_no, akta_awal_tgl, akta_awal_notaris, akta_awal_kota, akta_akhir_no, akta_akhir_tgl, akta_akhir_notaris, akta_akhir_kota, bs_id) VALUES ('$com_name', '$com_address', '$com_city', '$com_country', '$com_postal_code', '$com_phone', '$com_fax', '$plant_address', '$plant_city', '$plant_country', '$plant_postal_code', '$plant_phone', '$plant_fax', '$com_website', '$com_email', '$npwp', '$saham_indo', '$saham_asing', '$akta_awal_no', '$akta_awal_tgl', '$akta_awal_notaris', '$akta_awal_kota', '$akta_akhir_no', '$akta_akhir_tgl', '$akta_akhir_notaris', '$akta_akhir_kota', '$bs_id');";
			if (mysqli_query($conn, $qins)) {
				$berhasil++;
			}
		} elseif ($jumlah > 1) {
			echo "There are more than one company data like ".$com_name.". Please check the company data.<br>";
		}
	}
	
	if ($berhasil == $total && $total > 0) {
		$_SESSION['flag'] = 3;
		header('location:comlist');
	} else if($berhasil == 0) {
		$_SESSION['flag'] = 4;
	} else if($berhasil < $total) {
		$_SESSION['flag'] = 5;
	}
	header('location:comlist');

	unlink($_FILES["fileExcel"]["name"]);
	mysqli_close($conn);
}
?>