<?php
session_start();
include('conn.php');
if (isset($_POST['com_new'])) {
	$com_name = $_POST['com_name'];
	echo $com_name."<br>";
	$com_email = $_POST['com_email'];
	echo $com_email."<br>";
	$com_website = $_POST['com_website'];
	echo $com_website."<br>";

	$com_address = $_POST['com_address'];
	echo $com_address."<br>";
	$com_city = $_POST['com_city'];
	echo $com_city."<br>";
	$com_postal_code = $_POST['com_postal_code'];
	echo $com_postal_code."<br>";
	$com_country = $_POST['com_country'];
	echo $com_country."<br>";
	$com_phone = $_POST['com_phone'];
	echo $com_phone."<br>";
	$com_fax = $_POST['com_fax'];
	echo $com_fax."<br>";

	$plant_address = $_POST['plant_address'];
	echo $plant_address."<br>";
	$plant_city = $_POST['plant_city'];
	echo $plant_city."<br>";
	$plant_postal_code = $_POST['plant_postal_code'];
	echo $plant_postal_code."<br>";
	$plant_country = $_POST['plant_country'];
	echo $plant_country."<br>";
	$plant_phone = $_POST['plant_phone'];
	echo $plant_phone."<br>";
	$plant_fax = $_POST['plant_fax'];
	echo $plant_fax."<br>";

	$npwp1 = $_POST['npwp1'];
	$npwp2 = $_POST['npwp2'];
	$npwp3 = $_POST['npwp3'];
	$npwp4 = $_POST['npwp4'];
	$npwp5 = $_POST['npwp5'];
	$npwp6 = $_POST['npwp6'];
	if ($npwp1 != NULL && $npwp2 != NULL && $npwp3 != NULL && $npwp4 != NULL && $npwp5 != NULL && $npwp6 != NULL) {
		$npwp = $npwp1.".".$npwp2.".".$npwp3.".".$npwp4."-".$npwp5.".".$npwp6;
	} else {
		$npwp = NULL;
	}
	echo $npwp."<br>";

	$akta_awal_no = $_POST['akta_awal_no'];
	echo $akta_awal_no."<br>";
	$akta_awal_tgl = $_POST['akta_awal_tgl'];
	echo $akta_awal_tgl."<br>";
	$akta_awal_notaris = $_POST['akta_awal_notaris'];
	echo $akta_awal_notaris."<br>";
	$akta_awal_kota = $_POST['akta_awal_kota'];
	echo $akta_awal_kota."<br>";

	$akta_akhir_no = $_POST['akta_akhir_no'];
	echo $akta_akhir_no."<br>";
	$akta_akhir_tgl = $_POST['akta_akhir_tgl'];
	echo $akta_akhir_tgl."<br>";
	$akta_akhir_notaris = $_POST['akta_akhir_notaris'];
	echo $akta_akhir_notaris."<br>";
	$akta_akhir_kota = $_POST['akta_akhir_kota'];
	echo $akta_akhir_kota."<br>";

	$saham_indo = $_POST['saham_indo'];
	echo $saham_indo."<br>";
	$saham_asing = $_POST['saham_asing'];
	echo $saham_asing."<br>";

	$bs_id = $_POST['bs_id'];
	echo $bs_id."<br>";
	if ($bs_id != NULL) {
		echo "bs_idnya : ".$bs_id."<br>";
	} else {
		$new_bs = $_POST['new_bs'];
		echo $new_bs."<br>";

		$qbs_baru = "INSERT INTO bussiness_services(bs_name) VALUES ('$new_bs')";
		if (mysqli_query($conn, $qbs_baru)) {
			$bs_id = mysqli_insert_id($conn);

			$ccl_check = $_POST['ccl_check'];
			echo $ccl_check."<br>";
			$lp_check = $_POST['lp_check'];
			echo $lp_check."<br>";
			$ps_check = $_POST['ps_check'];
			echo $ps_check."<br>";
			$ec_check = $_POST['ec_check'];
			echo $ec_check."<br>";
			$da_check = $_POST['da_check'];
			echo $da_check."<br>";
			$exp_check = $_POST['exp_check'];
			echo $exp_check."<br>";
			$op_check = $_POST['op_check'];
			echo $op_check."<br>";
			$tor_check = $_POST['tor_check'];
			echo $tor_check."<br>";
			$additional_table = $_POST['additional_table'];
			echo $additional_table."<br>";

			$qinsdt = "INSERT INTO detil_tabel(bs_id, ccl_check, lp_check, ps_check, ec_check, da_check, exp_check, op_check, tor_check, additional_table) VALUES ('$bs_id', '$ccl_check', '$lp_check', '$ps_check', '$ec_check', '$da_check', '$exp_check', '$op_check', '$tor_check', '$additional_table')";
			mysqli_query($conn, $qinsdt);
		} else{
			die(mysqli_error($conn));
		}
	}

	$qins = "INSERT INTO company (com_name, com_address, com_city, com_country, com_postal_code, com_phone, com_fax, plant_address, plant_city, plant_country, plant_postal_code, plant_phone, plant_fax, com_website, com_email, npwp, saham_indo, saham_asing, akta_awal_no, akta_awal_tgl, akta_awal_notaris, akta_awal_kota, akta_akhir_no, akta_akhir_tgl, akta_akhir_notaris, akta_akhir_kota, bs_id) VALUES ('$com_name', '$com_address', '$com_city', '$com_country', '$com_postal_code', '$com_phone', '$com_fax', '$plant_address', '$plant_city', '$plant_country', '$plant_postal_code', '$plant_phone', '$plant_fax', '$com_website', '$com_email', '$npwp', '$saham_indo', '$saham_asing', '$akta_awal_no', '$akta_awal_tgl', '$akta_awal_notaris', '$akta_awal_kota', '$akta_akhir_no', '$akta_akhir_tgl', '$akta_akhir_notaris', '$akta_akhir_kota', '$bs_id');";

	if (mysqli_query($conn, $qins)) {
		$com_id = mysqli_insert_id($conn);
		if (!empty($_POST['com_bf'])) {
			echo "bs_idnya :<br>";
			foreach ($_POST['com_bf'] as $bf_idnya) {
				echo $bf_idnya."<br>";
				$qbfins = "INSERT INTO com_bf_relation (com_id, bf_id) VALUES ('$com_id', '$bf_idnya');";
				mysqli_query($conn, $qbfins);
			}
			echo "<br>";
		}
		if (!empty($_POST['dir_name'])) {
			$dir_name = $_POST['dir_name'];
			$dir_position = $_POST['dir_position'];
			$n = count($_POST['dir_name']);
	 		if (count($_POST['dir_position'])) {
				$n = count($_POST['dir_position']);
			}
			for ($i=0; $i < $n; $i++) {
				if ($dir_name[$i] != NULL) {
					$per_dir = $i + 1;
					echo "namanya : $dir_name[$i]<br>";
					$qcek = "SELECT per_id FROM personal WHERE per_full_name = '$dir_name[$i]'";
					$cekrun = mysqli_query($conn,$qcek);
					$jumlah = mysqli_num_rows ($cekrun);
					echo "jumlah data : $jumlah<br>";
					if ($jumlah == 0) {
						echo "ga ada datanya, jadinya bikin baru<br>";
						$insper = "INSERT INTO personal(com_id, per_full_name, per_position, per_dir) VALUES ('$com_id', '$dir_name[$i]', '$dir_position[$i]', '$per_dir')";
						mysqli_query($conn, $insper);
					} elseif ($jumlah == 1) {
						echo "ada datanya, tinggal benerin perdirnya<br>";
						$hasil = mysqli_fetch_assoc($cekrun);
						$per_id = $hasil['per_id'];
						$updateper = "UPDATE personal SET per_dir='$per_dir' WHERE per_id = '$per_id'";
						mysqli_query($conn, $updateper);
					} elseif ($jumlah > 1) {
						echo "There are more than one personal data like ".$dir_name.". Please check the personal data.<br><br>";
					}
				}
			}
		}

		$target_dir = "file/".$com_id."/";
		if (!file_exists($target_dir)) {
			mkdir($target_dir);
		}
		if ($_FILES["org_chart"]["error"] == 0) {
			$file_org_chart = $_FILES["org_chart"]["name"];
			$tmpoc = explode(".", $file_org_chart);
			$extension_org_chart = end($tmpoc);
			$org_chart_filename= time()."_".$com_id."_org_chart.".$extension_org_chart;
			$target_file = $target_dir . $org_chart_filename;
			if (move_uploaded_file($_FILES["org_chart"]["tmp_name"], $target_file)) {
				$qupfileorg = "UPDATE company SET org_chart='$org_chart_filename' WHERE com_id = '$com_id';";
				mysqli_query($conn, $qupfileorg);
			} else{
				echo "Something error while uploading your file. Please try again.<br>";
			}
		} elseif ($_FILES["org_chart"]["error"] != 4) {
			echo "Error uploading organization chart file.<br>";
			echo "Return Code: " . $_FILES["org_chart"]["error"] . "<br>";
		}

		if ($_FILES["finance_capability"]["error"] == 0) {
			$file_finance_cap = $_FILES["finance_capability"]["name"];
			$tmpfc = explode(".", $file_finance_cap);
			$extension_finance_cap = end($tmpfc);
			$finance_cap_filename= time()."_".$com_id."_finance_capability.".$extension_finance_cap;
			$target_file = $target_dir . $finance_cap_filename;
			if (move_uploaded_file($_FILES["finance_capability"]["tmp_name"], $target_file)) {
				$qupfilefc = "UPDATE company SET finance_capability='$finance_cap_filename' WHERE com_id = '$com_id';";
				mysqli_query($conn, $qupfilefc);
			} else{
				echo "Something error while uploading your file. Please try again.<br>";
			}
		} elseif ($_FILES["finance_capability"]["error"] != 4) {
			echo "Error uploading financial capability file.<br>";
			echo "Return Code: " . $_FILES["finance_capability"]["error"] . "<br>";
		}
	} else{
		die(mysqli_error($conn));
	}

	$_SESSION['flag'] = 1;
	header('location:comlist');
	mysqli_close($conn);
}
?>