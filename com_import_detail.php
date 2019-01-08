<?php
session_start();
include('conn.php');
require('excel_reader.php');

if (isset($_POST['submit_detail'])) {
	$com_id = $_POST['com_id'];
	$bs_id = $_POST['bs_id'];
	$berhasil = 0;
	$total = 0;
	$target = basename($_FILES["fileExcel"]["name"]);
	move_uploaded_file($_FILES["fileExcel"]["tmp_name"], $target);

	$data = new Spreadsheet_Excel_Reader($_FILES["fileExcel"]["name"], false);

	$bcertif = $data->rowcount($sheet_index=0);
	for ($i=3; $i<=$bcertif ; $i++) {
		$c_name = $data->val($i, 2, 0);
		if ($c_name != NULL) {
			$total++;
			$c_code = $data->val($i, 3, 0);
			$c_classification = $data->val($i, 4, 0);
			$c_qualification = $data->val($i, 5, 0);

			$qinscer = "INSERT INTO certificate(c_name, c_code, c_classification, c_qualification, com_id) VALUES ('$c_name','$c_code','$c_classification','$c_qualification','$com_id');";
			if (mysqli_query($conn, $qinscer)) {
				$berhasil++;
			}
		}
	}

	if ($bs_id == 3) {
		$blicense = $data->rowcount($sheet_index=1);
		for ($i=4; $i<=$blicense ; $i++) {
			$l_process = $data->val($i, 2, 1);
			if ($l_process != NULL) {
				$total++;
				$bf_id = NULL;
				$bf_name = $data->val($i, 3, 1);
				if ($bf_name == 'Refinery Plant') {
					$bf_id = 1;
				} elseif ($bf_name == 'Gas Processing Plant') {
					$bf_id = 2;
				} elseif ($bf_name == 'Mid Stream') {
					$bf_id = 3;
				} elseif ($bf_name == 'Petrochemical Plant') {
					$bf_id = 4;
				} elseif ($bf_name == 'Utility Plant') {
					$bf_id = 5;
				} elseif ($bf_name == 'Offsite Plant') {
					$bf_id = 6;
				} elseif ($bf_name == 'Common') {
					$bf_id = 7;
				} elseif ($bf_name == 'Gas to Liquid Plant') {
					$bf_id = 8;
				} elseif ($bf_name == 'Modular Unit') {
					$bf_id = 9;
				} elseif ($bf_name == 'Power Generation Plant') {
					$bf_id = 10;
				}

				$qinsl = "INSERT INTO licensed(l_process, bf_id, com_id) VALUES ('$l_process','$bf_id','$com_id');";
				if (mysqli_query($conn, $qinsl)) {
					$berhasil++;
				}
			}
		}
	}

	$barishp = $data->rowcount($sheet_index=2);
	for ($i=3; $i<=$barishp ; $i++) {
		$hasil_produksi = $data->val($i, 2, 2);
		if ($hasil_produksi != NULL) {
			$total++;
			$jenis_produksi = $data->val($i, 3, 2);
			$spesifikasi = $data->val($i, 4, 2);
			$standar_produk = $data->val($i, 5, 2);
			$sertifikat = $data->val($i, 6, 2);
			$tkdnhp = $data->val($i, 7, 2);
			$kapasitas = $data->val($i, 8, 2);

			$qinshp = "INSERT INTO hasil_produk(hasil_produksi, jenis_produksi, spesifikasi, standar_produk, sertifikat, tkdn, kapasitas, com_id) VALUES('$hasil_produksi', '$jenis_produksi', '$spesifikasi', '$standar_produk', '$sertifikat', '$tkdnhp', '$kapasitas', '$com_id');";
			if (mysqli_query($conn, $qinshp)) {
				$berhasil++;
			}
		}
	}

	$barisec = $data->rowcount($sheet_index=3);
	for ($i=3; $i<=$barisec ; $i++) {
		$department = $data->val($i, 2, 3);
		if ($department == 'Engineering') {
			$subd = $data->val($i, 3, 3);
			if ($subd == 'Process') {
				$jum_e_process_wni = $data->val($i, 4, 3);
				if ($jum_e_process_wni != NULL) {
					$total++;
					$qinsec = "UPDATE company SET jum_e_process_wni='$jum_e_process_wni' WHERE com_id = '$com_id';";
					if (mysqli_query($conn, $qinsec)) {
						$berhasil++;
					}
				}
				$jum_e_process_wna = $data->val($i, 5, 3);
				if ($jum_e_process_wna != NULL) {
					$total++;
					$qinsec = "UPDATE company SET jum_e_process_wna='$jum_e_process_wna' WHERE com_id = '$com_id';";
					if (mysqli_query($conn, $qinsec)) {
						$berhasil++;
					}
				}
			} elseif ($subd == 'Civil') {
				$jum_e_civil_wni = $data->val($i, 4, 3);
				if ($jum_e_civil_wni != NULL) {
					$total++;
					$qinsec = "UPDATE company SET jum_e_civil_wni='$jum_e_civil_wni' WHERE com_id = '$com_id';";
					if (mysqli_query($conn, $qinsec)) {
						$berhasil++;
					}
				}
				$jum_e_civil_wna = $data->val($i, 5, 3);
				if ($jum_e_civil_wna != NULL) {
					$total++;
					$qinsec = "UPDATE company SET jum_e_civil_wna='$jum_e_civil_wna' WHERE com_id = '$com_id';";
					if (mysqli_query($conn, $qinsec)) {
						$berhasil++;
					}
				}
			} elseif ($subd == 'Piping') {
				$jum_e_piping_wni = $data->val($i, 4, 3);
				if ($jum_e_piping_wni != NULL) {
					$total++;
					$qinsec = "UPDATE company SET jum_e_piping_wni='$jum_e_piping_wni' WHERE com_id = '$com_id';";
					if (mysqli_query($conn, $qinsec)) {
						$berhasil++;
					}
				}
				$jum_e_piping_wna = $data->val($i, 5, 3);
				if ($jum_e_piping_wna != NULL) {
					$total++;
					$qinsec = "UPDATE company SET jum_e_piping_wna='$jum_e_piping_wna' WHERE com_id = '$com_id';";
					if (mysqli_query($conn, $qinsec)) {
						$berhasil++;
					}
				}
			} elseif ($subd == 'Instrument') {
				$jum_e_instrument_wni = $data->val($i, 4, 3);
				if ($jum_e_instrument_wni != NULL) {
					$total++;
					$qinsec = "UPDATE company SET jum_e_instrument_wni='$jum_e_instrument_wni' WHERE com_id = '$com_id';";
					if (mysqli_query($conn, $qinsec)) {
						$berhasil++;
					}
				}
				$jum_e_instrument_wna = $data->val($i, 5, 3);
				if ($jum_e_instrument_wna != NULL) {
					$total++;
					$qinsec = "UPDATE company SET jum_e_instrument_wna='$jum_e_instrument_wna' WHERE com_id = '$com_id';";
					if (mysqli_query($conn, $qinsec)) {
						$berhasil++;
					}
				}
			} elseif ($subd == 'Electrical') {
				$jum_e_electrical_wni = $data->val($i, 4, 3);
				if ($jum_e_electrical_wni != NULL) {
					$total++;
					$qinsec = "UPDATE company SET jum_e_electrical_wni='$jum_e_electrical_wni' WHERE com_id = '$com_id';";
					if (mysqli_query($conn, $qinsec)) {
						$berhasil++;
					}
				}
				$jum_e_electrical_wna = $data->val($i, 5, 3);
				if ($jum_e_electrical_wna != NULL) {
					$total++;
					$qinsec = "UPDATE company SET jum_e_electrical_wna='$jum_e_electrical_wna' WHERE com_id = '$com_id';";
					if (mysqli_query($conn, $qinsec)) {
						$berhasil++;
					}
				}
			} elseif ($subd == 'Mechanical') {
				$jum_e_mechanical_wni = $data->val($i, 4, 3);
				if ($jum_e_mechanical_wni != NULL) {
					$total++;
					$qinsec = "UPDATE company SET jum_e_mechanical_wni='$jum_e_mechanical_wni' WHERE com_id = '$com_id';";
					if (mysqli_query($conn, $qinsec)) {
						$berhasil++;
					}
				}
				$jum_e_mechanical_wna = $data->val($i, 5, 3);
				if ($jum_e_mechanical_wna != NULL) {
					$total++;
					$qinsec = "UPDATE company SET jum_e_mechanical_wna='$jum_e_mechanical_wna' WHERE com_id = '$com_id';";
					if (mysqli_query($conn, $qinsec)) {
						$berhasil++;
					}
				}
			} elseif ($subd == 'Rotary, Package & Machine') {
				$jum_e_rotary_package_machinary_wni = $data->val($i, 4, 3);
				if ($jum_e_rotary_package_machinary_wni != NULL) {
					$total++;
					$qinsec = "UPDATE company SET jum_e_rotary_package_machinary_wni='$jum_e_rotary_package_machinary_wni' WHERE com_id = '$com_id';";
					if (mysqli_query($conn, $qinsec)) {
						$berhasil++;
					}
				}
				$jum_e_rotary_package_machinary_wna = $data->val($i, 5, 3);
				if ($jum_e_rotary_package_machinary_wna != NULL) {
					$total++;
					$qinsec = "UPDATE company SET jum_e_rotary_package_machinary_wna='$jum_e_rotary_package_machinary_wna' WHERE com_id = '$com_id';";
					if (mysqli_query($conn, $qinsec)) {
						$berhasil++;
					}
				}
			}
		} elseif ($department == 'Project Management') {
			$jumlah_project_management_wni = $data->val($i, 4, 3);
			if ($jumlah_project_management_wni != NULL) {
				$total++;
				$qinsec = "UPDATE company SET jumlah_project_management_wni='$jumlah_project_management_wni' WHERE com_id = '$com_id';";
				if (mysqli_query($conn, $qinsec)) {
					$berhasil++;
				}
			}
			$jumlah_project_management_wna = $data->val($i, 5, 3);
			if ($jumlah_project_management_wna != NULL) {
				$total++;
				$qinsec = "UPDATE company SET jumlah_project_management_wna='$jumlah_project_management_wna' WHERE com_id = '$com_id';";
				if (mysqli_query($conn, $qinsec)) {
					$berhasil++;
				}
			}
		} elseif ($department == 'Project Planning & Control') {
			$jumlah_project_planning_control_wni = $data->val($i, 4, 3);
			if ($jumlah_project_planning_control_wni != NULL) {
				$total++;
				$qinsec = "UPDATE company SET jumlah_project_planning_control_wni='$jumlah_project_planning_control_wni' WHERE com_id = '$com_id';";
				if (mysqli_query($conn, $qinsec)) {
					$berhasil++;
				}
			}
			$jumlah_project_planning_control_wna = $data->val($i, 5, 3);
			if ($jumlah_project_planning_control_wna != NULL) {
				$total++;
				$qinsec = "UPDATE company SET jumlah_project_planning_control_wna='$jumlah_project_planning_control_wna' WHERE com_id = '$com_id';";
				if (mysqli_query($conn, $qinsec)) {
					$berhasil++;
				}
			}
		} elseif ($department == 'Procurement') {
			$jumlah_procurement_wni = $data->val($i, 4, 3);
			if ($jumlah_procurement_wni != NULL) {
				$total++;
				$qinsec = "UPDATE company SET jumlah_procurement_wni='$jumlah_procurement_wni' WHERE com_id = '$com_id';";
				if (mysqli_query($conn, $qinsec)) {
					$berhasil++;
				}
			}
			$jumlah_procurement_wna = $data->val($i, 5, 3);
			if ($jumlah_procurement_wna != NULL) {
				$total++;
				$qinsec = "UPDATE company SET jumlah_procurement_wna='$jumlah_procurement_wna' WHERE com_id = '$com_id';";
				if (mysqli_query($conn, $qinsec)) {
					$berhasil++;
				}
			}
		} elseif ($department == 'Construction Management') {
			$jumlah_construction_management_wni = $data->val($i, 4, 3);
			if ($jumlah_construction_management_wni != NULL) {
				$total++;
				$qinsec = "UPDATE company SET jumlah_construction_management_wni='$jumlah_construction_management_wni' WHERE com_id = '$com_id';";
				if (mysqli_query($conn, $qinsec)) {
					$berhasil++;
				}
			}
			$jumlah_construction_management_wna = $data->val($i, 5, 3);
			if ($jumlah_construction_management_wna != NULL) {
				$total++;
				$qinsec = "UPDATE company SET jumlah_construction_management_wna='$jumlah_construction_management_wna' WHERE com_id = '$com_id';";
				if (mysqli_query($conn, $qinsec)) {
					$berhasil++;
				}
			}
		} elseif ($department == 'Quality Control') {
			$jumlah_qc_wni = $data->val($i, 4, 3);
			if ($jumlah_qc_wni != NULL) {
				$total++;
				$qinsec = "UPDATE company SET jumlah_qc_wni='$jumlah_qc_wni' WHERE com_id = '$com_id';";
				if (mysqli_query($conn, $qinsec)) {
					$berhasil++;
				}
			}
			$jumlah_qc_wna = $data->val($i, 5, 3);
			if ($jumlah_qc_wna != NULL) {
				$total++;
				$qinsec = "UPDATE company SET jumlah_qc_wna='$jumlah_qc_wna' WHERE com_id = '$com_id';";
				if (mysqli_query($conn, $qinsec)) {
					$berhasil++;
				}
			}
		}
	}

	$barisda = $data->rowcount($sheet_index=4);
	for ($i=3; $i<=$barisda ; $i++) {
		$a_name = $data->val($i, 2, 4);
		if ($a_name != NULL) {
			$total++;
			$merk_type = $data->val($i, 3, 4);
			$jumlah = $data->val($i, 4, 4);
			$tahun_pembuatan = $data->val($i, 5, 4);
			$kondisi = $data->val($i, 6, 4);
			$status_kepemilikan = $data->val($i, 7, 4);
			$tech_desc = $data->val($i, 8, 4);

			$qinsa = "INSERT INTO alat(a_name, merk_type, jumlah, tahun_pembuatan, kondisi, status_kepemilikan, tech_desc, com_id) VALUES('$a_name', '$merk_type', '$jumlah', '$tahun_pembuatan', '$kondisi', '$status_kepemilikan', '$tech_desc', '$com_id');";
			if (mysqli_query($conn, $qinsa)) {
				$berhasil++;
			}
		}
	}

	$barisdp = $data->rowcount($sheet_index=5);
	for ($i=3; $i<=$barisdp ; $i++) {
		$nama_proyek = $data->val($i, 2, 5);
		if ($nama_proyek != NULL) {
			$total++;
			$lingkup_pekerjaan = $data->val($i, 3, 5);
			$lokasi = $data->val($i, 4, 5);
			$periode = $data->val($i, 5, 5);
			$client = $data->val($i, 6, 5);
			$p_field = $data->val($i, 7, 5);
			$on_off_shore = $data->val($i, 8, 5);
			$capacity = $data->val($i, 9, 5);
			$p_cost = $data->val($i, 10, 5);

			$qinsdp = "INSERT INTO pengalaman(nama_proyek, lingkup_pekerjaan, lokasi, periode, client, p_field, capacity, on_off_shore, p_cost, p_status, com_id) VALUES ('$nama_proyek','$lingkup_pekerjaan','$lokasi','$periode','$client','$p_field','$capacity','$on_off_shore','$p_cost','finish','$com_id');";
			if (mysqli_query($conn, $qinsdp)) {
				$berhasil++;
			}
		}
	}

	$barisop = $data->rowcount($sheet_index=6);
	for ($i=3; $i<=$barisop ; $i++) {
		$nama_proyek = $data->val($i, 2, 6);
		if ($nama_proyek != NULL) {
			$total++;
			$lingkup_pekerjaan = $data->val($i, 3, 6);
			$lokasi = $data->val($i, 4, 6);
			$periode = $data->val($i, 5, 6);
			$client = $data->val($i, 6, 6);
			$p_field = $data->val($i, 7, 5);
			$on_off_shore = $data->val($i, 8, 5);
			$capacity = $data->val($i, 9, 5);
			$p_cost = $data->val($i, 10, 5);

			$qinsop = "INSERT INTO pengalaman(nama_proyek, lingkup_pekerjaan, lokasi, periode, client, p_field, capacity, on_off_shore, p_cost, p_status, com_id) VALUES ('$nama_proyek','$lingkup_pekerjaan','$lokasi','$periode','$client','$p_field','$capacity','$on_off_shore','$p_cost','ongoing','$com_id');";
			if (mysqli_query($conn, $qinsop)) {
				$berhasil++;
			}
		}
	}

	$baristor = $data->rowcount($sheet_index=7);
	for ($i=3; $i<=$baristor ; $i++) {
		$to_year = $data->val($i, 2, 7);
		if ($to_year != NULL) {
			$total++;
			$to_value = $data->val($i, 3, 7);

			$qinstor = "INSERT INTO to_revenue(to_year, to_value, com_id) VALUES ('$to_year','$to_value','$com_id');";
			if (mysqli_query($conn, $qinstor)) {
				$berhasil++;
			}
		}
	}

	if ($berhasil == $total && $total > 0) {
		$_SESSION['flag'] = 2;
	} else if($berhasil == 0) {
		$_SESSION['flag'] = 3;
	} else if($berhasil < $total) {
		$_SESSION['flag'] = 4;
	}
	
	header('location:com_detail?com_id='.$com_id);

	unlink($_FILES["fileExcel"]["name"]);
	mysqli_close($conn);
}
?>