<!DOCTYPE html>
<html>
<head>
	<?php
	include('head.php');
	?>
</head>
<body>
	<?php
	include('conn.php');
	if (isset($_POST['section'])) {
		$com_id = $_POST['com_id'];

		$qbf = "SELECT bf.* FROM company c LEFT JOIN com_bf_relation cbf USING(com_id) JOIN bussiness_fields bf USING(bf_id) WHERE c.com_id = '$com_id';";
		$qbfrun = mysqli_query($conn,$qbf);
		$thisbf = array_fill(1, 10, 'uncheck');

		$qdir_com = "SELECT * FROM personal WHERE com_id = '$com_id' AND per_dir>0 ORDER BY per_dir ASC;";
		$qdir_comrun = mysqli_query($conn,$qdir_com);

		$qcom = "CALL datacom('$com_id');";
		$qrun = mysqli_query($conn,$qcom);
		$result = mysqli_fetch_assoc($qrun);
		$bs_id = $result['bs_id'];
		$jum_e_process_wni = $result['jum_e_process_wni'];
		$jum_e_process_wna = $result['jum_e_process_wna'];
		$jum_e_civil_wni = $result['jum_e_civil_wni'];
		$jum_e_civil_wna = $result['jum_e_civil_wna'];
		$jum_e_piping_wni = $result['jum_e_piping_wni'];
		$jum_e_piping_wna = $result['jum_e_piping_wna'];
		$jum_e_instrument_wni = $result['jum_e_instrument_wni'];
		$jum_e_instrument_wna = $result['jum_e_instrument_wna'];
		$jum_e_electrical_wni = $result['jum_e_electrical_wni'];
		$jum_e_electrical_wna = $result['jum_e_electrical_wna'];
		$jum_e_mechanical_wni = $result['jum_e_mechanical_wni'];
		$jum_e_mechanical_wna = $result['jum_e_mechanical_wna'];
		$jum_e_rotary_package_machinary_wni = $result['jum_e_rotary_package_machinary_wni'];
		$jum_e_rotary_package_machinary_wna = $result['jum_e_rotary_package_machinary_wna'];
		$jumlah_project_management_wni = $result['jumlah_project_management_wni'];
		$jumlah_project_management_wna = $result['jumlah_project_management_wna'];
		$jumlah_project_planning_control_wni = $result['jumlah_project_planning_control_wni'];
		$jumlah_project_planning_control_wna = $result['jumlah_project_planning_control_wna'];
		$jumlah_procurement_wni = $result['jumlah_procurement_wni'];
		$jumlah_procurement_wna = $result['jumlah_procurement_wna'];
		$jumlah_construction_management_wni = $result['jumlah_construction_management_wni'];
		$jumlah_construction_management_wna = $result['jumlah_construction_management_wna'];
		$jumlah_qc_wni = $result['jumlah_qc_wni'];
		$jumlah_qc_wna = $result['jumlah_qc_wna'];
	?>
	<div style="padding: 20px;">
		<strong><h1><?php echo $result['com_name']; ?></h1></strong>
		<hr class="my-4">
		<div>
			<div>
				<h5><strong>Head Office</strong></h5>
				<div class="row">
					<div style="float: left; width: 100px; margin-left: 15px;">
						Address
					</div>
					<div style="float: left; width: 20px; text-align: center;">
						:
					</div>
					<div class="col">
						<?php
						echo $result['com_address'];
						if ($result['com_address'] != NULL && $result['com_city'] != NULL) {
							echo ", ";
						}
						echo $result['com_city']." ".$result['com_postal_code'];
						if (($result['com_city'] != NULL || $result['com_postal_code']) && $result['com_country'] != NULL) {
							echo ", ";
						}
						echo $result['com_country'];
						?>
					</div>
				</div>
				<div class="row">
					<div style="float: left; width: 100px; margin-left: 15px;">
						Phone/Fax
					</div>
					<div style="float: left; width: 20px; text-align: center;">
						:
					</div>
					<div class="col">
						<?php
						echo $result['com_phone'];
						if ($result['com_fax'] != NULL) {
							echo "/".$result['com_fax'];
						}
						?>
					</div>
				</div>
				<br>
				<h5><strong>Plant Office</strong></h5>
				<div class="row">
					<div style="float: left; width: 100px; margin-left: 15px;">
						Address
					</div>
					<div style="float: left; width: 20px; text-align: center;">
						:
					</div>
					<div class="col">
						<?php
						echo $result['plant_address'];
						if ($result['plant_address'] != NULL && $result['plant_city'] != NULL) {
							echo ", ";
						}
						echo $result['plant_city']." ".$result['plant_postal_code'];
						if (($result['plant_city'] != NULL || $result['plant_postal_code']) && $result['plant_country'] != NULL) {
							echo ", ";
						}
						echo $result['plant_country'];
						?>
					</div>
				</div>
				<div class="row">
					<div style="float: left; width: 100px; margin-left: 15px;">
						Phone/Fax
					</div>
					<div style="float: left; width: 20px; text-align: center;">
						:
					</div>
					<div class="col">
						<?php
						echo $result['plant_phone'];
						if ($result['plant_fax'] != NULL) {
							echo "/".$result['plant_fax'];
						}
						?>
					</div>
				</div>
				<br>
				<div class="row">
					<div class="col"><h5><strong>General Info</strong></h5></div>
				</div>
				<div class="row">
					<div class="col">
						<div class="row">
							<div style="float: left; width: 150px; margin-left: 15px;">
								Website
							</div>
							<div style="float: left; width: 20px; text-align: center;">
								:
							</div>
							<div class="col">
								<?php echo $result['com_website']; ?>
							</div>
						</div>
						<div class="row">
							<div style="float: left; width: 150px; margin-left: 15px;">
								E-mail
							</div>
							<div style="float: left; width: 20px; text-align: center;">
								:
							</div>
							<div class="col">
								<?php echo $result['com_email']; ?>
							</div>
						</div>
						<div class="row">
							<div style="float: left; width: 150px; margin-left: 15px;">
								NPWP
							</div>
							<div style="float: left; width: 20px; text-align: center;">
								:
							</div>
							<div class="col">
								<?php echo $result['npwp']; ?>
							</div>
						</div>
						<div class="row">
							<div style="float: left; width: 150px; margin-left: 15px;">
								Organization Chart
							</div>
							<div style="float: left; width: 20px; text-align: center;">
								:
							</div>
							<div class="col">
								<?php
								if ($result['org_chart'] != NULL) {
								?>
								<a href='<?php echo "file/".$com_id."/".$result['org_chart'] ?>' download="">Attached File</a>
								<?php
								} else {
									echo "No file attached";
								}
								?>
								</div>
						</div>
						<div class="row">
							<div style="float: left; width: 150px; margin-left: 15px;">
								Financial Capability
							</div>
							<div style="float: left; width: 20px; text-align: center;">
								:
							</div>
							<div class="col">
								<?php
								if ($result['finance_capability'] != NULL) {
								?>
								<a href='<?php echo "file/".$com_id."/".$result['finance_capability'] ?>' download="">Attached File</a>
								<?php
								} else {
									echo "No file attached";
								}
								?>
							</div>
						</div>
					</div>
					<div class="col">
						<div class="row">
							<div style="float: left; width: 130px; margin-left: 15px;">
								Bussiness Service
							</div>
							<div style="float: left; width: 20px; text-align: center;">
								:
							</div>
							<div class="col">
								<?php echo $result['bs_name']; ?>
							</div>
						</div>
						<div class="row">
							<div style="float: left; width: 130px; margin-left: 15px;">
								Bussiness Fields
							</div>
							<div style="float: left; width: 20px; text-align: center;">
								:
							</div>
							<div class="col">
								<?php
								while ($bfnya = mysqli_fetch_assoc($qbfrun)) {
									$idnya = $bfnya['bf_id'];
									$thisbf[$idnya] = "checked";
									echo "- ".$bfnya['bf_name']."<br>";
								}
								?>
							</div>
						</div>
					</div>
				</div>
				<br>
				<div class="row">
					<div class="col"><h5><strong>Company Status</strong></h5></div>
				</div>
				<div class="row">
					<div style="float: left; width: 230px; margin-left: 15px;">
						Notarial Deed of Establishment
					</div>
						<div style="float: left; width: 20px; text-align: center;">
						:
						</div>
					<div class="col">
						<?php
						$tgl_akta_awal = NULL;
						if ($result['akta_awal_tgl'] != '0000-00-00' && $result['akta_awal_tgl'] != NULL && $result['akta_awal_no'] != NULL && $result['akta_awal_no'] != '0' && $result['akta_awal_notaris'] != NULL && $result['akta_awal_kota'] != NULL) {
							$tgl_akta_awal = date("j F Y", strtotime($result['akta_awal_tgl']));
							echo "Akta Pendirian No. ".$result['akta_awal_no']." tanggal ".$tgl_akta_awal." oleh ".$result['akta_awal_notaris']." di ".$result['akta_awal_kota'].".";
						} else{
							echo "No data";
						}
						?>
					</div>
				</div>
				<div class="row">
					<div style="float: left; width: 230px; margin-left: 15px;">
						Notarial Deed of Change
					</div>
					<div style="float: left; width: 20px; text-align: center;">
						:
					</div>
					<div class="col">
						<?php
						$tgl_akta_akhir = NULL;
						if ($result['akta_akhir_tgl'] != '0000-00-00' && $result['akta_akhir_tgl'] != NULL && $result['akta_akhir_no'] != NULL && $result['akta_akhir_no'] != '0' && $result['akta_akhir_notaris'] != NULL && $result['akta_akhir_kota'] != NULL) {
							$tgl_akta_akhir = date("j F Y", strtotime($result['akta_akhir_tgl']));
							echo "Akta Perubahan Terakhir No. ".$result['akta_akhir_no']." tanggal ".$tgl_akta_akhir." oleh ".$result['akta_akhir_notaris']." di ".$result['akta_akhir_kota'].".";
						} else{
							echo "No data";
						}
						?>
					</div>
				</div>
				<div class="row" style="padding-top: 5px;">
					<div class="col">
						- Director Composition
						<br>
						<ul>
							<?php
							if (mysqli_num_rows($qdir_comrun) > 0) {
								while ($dir_com = mysqli_fetch_assoc($qdir_comrun)) {
								?>
								<li><?php echo $dir_com['per_position']; ?> : <?php echo $dir_com['per_full_name']; ?></li>
								<?php
								}
							} else{
								echo "No Data";
							}
							?>
						</ul>
					</div>
					<div class="col">
						<div class="row">
							<div class="col">- Shareholder</div>
						</div>
						<div class="row">
							<div style="float: left; width: 120px; margin-left: 30px;">
								- National Share
							</div>
							<div style="float: left; width: 15px; text-align: center;">
								:
							</div>
							<div class="col">
								<?php
								if ($result['saham_indo'] != NULL) {
									echo $result['saham_indo']." %";
								}
								?>
							</div>
						</div>
						<div class="row">
							<div style="float: left; width: 120px; margin-left: 30px;">
								- Foreign Share
							</div>
							<div style="float: left; width: 15px; text-align: center;">
								:
							</div>
							<div class="col">
								<?php
								if ($result['saham_asing'] != NULL) {
									echo $result['saham_asing']." %";
								}
								?>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<hr class="my-4">
		<?php
			mysqli_next_result($conn);
		?>

		<?php
		if (isset($_POST['ccl_check'])) {
		?>
		<div id="cclDiv">
			<h5><strong>Corporate Certificate/License</strong></h5>
			<table class="table-sm">
				<thead>
					<tr>
						<th width="35%" style="vertical-align: middle;">Certification/License</th>
						<th width="10%" style="vertical-align: middle;">Code</th>
						<th width="35%" style="vertical-align: middle;">Classification</th>
						<th style="vertical-align: middle;">Qualification</th>
				</thead>
				<tbody>
					<?php
					$qcer = "SELECT * FROM certificate WHERE com_id = '$com_id' ORDER BY c_name;";
					$qcerrun = mysqli_query($conn,$qcer);
					$span=1;
					$namanya = NULL;
					if (mysqli_num_rows($qcerrun) > 0) {
						while ($cer = mysqli_fetch_assoc($qcerrun)) {
							if ($cer['c_name'] != $namanya) {
								$namanya = $cer['c_name'];
								$qcount = "SELECT COUNT(c_name) as jumlah FROM certificate WHERE c_name='$namanya' AND com_id = '$com_id';";
								$qcountr = mysqli_query($conn,$qcount);
								$count = mysqli_fetch_assoc($qcountr);
								$span = $count['jumlah'];
					?>
					<tr>
						<td rowspan="<?php echo $span; ?>"><?php echo $cer['c_name']; ?></td>
						<td><?php echo $cer['c_code']; ?></td>
						<td><?php echo $cer['c_classification']; ?></td>
						<td><?php echo $cer['c_qualification']; ?></td>
					</tr>
					<?php
							} else {
					?>
					<tr>
						<td><?php echo $cer['c_code']; ?></td>
						<td><?php echo $cer['c_classification']; ?></td>
						<td><?php echo $cer['c_qualification']; ?></td>
					</tr>
					<?php
							}
						}
					} else{
						echo "<tr><td colspan='4'><center>No Data</center></td></tr>";
					}
					?>
				</tbody>
			</table>
		</div>
		<?php
		}

		if (isset($_POST['lp_check'])) {
		?>
		<div id="lDiv">
			<h5><strong>Licensed Processes</strong></h5>
			<table class="table-sm">
				<thead>
					<tr>
						<th width="6%" style="vertical-align: middle;">No</th>
						<th style="vertical-align: middle;">Process Name</th>
						<th width="35%" style="vertical-align: middle;">Bussiness Field</th>
					</tr>
				</thead>
				<tbody>
					<?php
					$qlicense = "SELECT * FROM licensed l JOIN bussiness_fields bf USING(bf_id) WHERE l.com_id = '$com_id';";
					$qlicenser = mysqli_query($conn,$qlicense);
					if (mysqli_num_rows($qlicenser) > 0) {
						$i = 0;
						while ($license = mysqli_fetch_assoc($qlicenser)) {
							$i++;
					?>
					<tr>
						<td style="text-align: center;"><?php echo $i; ?></td>
						<td><?php echo $license['l_process']; ?></td>
						<td><?php echo $license['bf_name']; ?></td>
					</tr>
					<?php
						}
					} else{
						echo "<tr><td colspan='2'><center>No Data</center></td></tr>";
					}
					?>
				</tbody>
			</table>
		</div>
		<?php
		}

		if (isset($_POST['ps_check'])) {
		?>
		<div id="shpDiv">
			<h5><strong>Product Spesification</strong></h5>
			<table class="table-sm">
				<thead>
					<tr>
						<th width="15%" style="vertical-align: middle;">Product Name</th>
						<th width="15%" style="vertical-align: middle;">Product Type</th>
						<th style="vertical-align: middle;">Spesification</th>
						<th width="15%" style="vertical-align: middle;">Product Standard</th>
						<th width="15%" style="vertical-align: middle;">Product Certificate</th>
						<th width="7%" style="vertical-align: middle;">TKDN (%)</th>
						<th width="13%" style="vertical-align: middle;">Capacity</th>
					</tr>
				</thead>
				<tbody>
					<?php
					$qshp = "SELECT * FROM hasil_produk WHERE com_id = '$com_id';";
					$qshprun = mysqli_query($conn,$qshp);
					if (mysqli_num_rows($qshprun) > 0) {
						while ($shp = mysqli_fetch_assoc($qshprun)) {
					?>
					<tr>
						<td><?php echo $shp['hasil_produksi']; ?></td>
						<td><?php echo $shp['jenis_produksi']; ?></td>
						<td><?php echo $shp['spesifikasi']; ?></td>
						<td><?php echo $shp['standar_produk']; ?></td>
						<td><?php echo $shp['sertifikat']; ?></td>
						<td style="text-align: center;"><?php echo $shp['tkdn']; ?></td>
						<td><?php echo $shp['kapasitas']; ?></td>
					</tr>
					<?php
						}
					} else{
						echo "<tr><td colspan='7'><center>No Data</center></td></tr>";
					}
					?>
				</tbody>
			</table>
		</div>
		<?php
		}

		if (isset($_POST['ec_check'])) {
		?>
		<div id="ecDiv">
			<h5><strong>Employee Composition</strong></h5>
			<table class="table-sm">
				<thead>
					<tr>
						<th rowspan="2" style="vertical-align: middle;">Department</th>
						<th rowspan="2" style="vertical-align: middle;">Sub Department</th>
						<th width="20%" colspan="2" style="vertical-align: middle;">Number of Employee</th>
					</tr>
					<tr>
						<th width="10%" style="vertical-align: middle;">WNI</th>
						<th width="10%" style="vertical-align: middle;">WNA</th>
					</tr>
				</thead>
				<tbody>
					<tr>
						<td style="vertical-align: middle;" rowspan="7">Engineering</td>
						<td>Process</td>
						<td style="text-align: center;">
							<?php
							if ($jum_e_process_wni != 0 && $jum_e_process_wni != NULL) {
								echo $jum_e_process_wni;
							} else{
								echo "-";
							}
							?>
						</td>
						<td style="text-align: center;">
							<?php
							if ($jum_e_process_wna != 0 && $jum_e_process_wna != NULL) {
								echo $jum_e_process_wna;
							} else{
								echo "-";
							}
							?>
						</td>
					</tr>
					<tr>
						<td>Civil</td>
						<td style="text-align: center;">
							<?php
							if ($jum_e_civil_wni != 0 && $jum_e_civil_wni != NULL) {
								echo $jum_e_civil_wni;
							} else{
								echo "-";
							}
							?>
						</td>
						<td style="text-align: center;">
							<?php
							if ($jum_e_civil_wna != 0 && $jum_e_civil_wna != NULL) {
								echo $jum_e_civil_wna;
							} else{
								echo "-";
							}
							?>
						</td>
					</tr>
					<tr>
						<td>Piping</td>
						<td style="text-align: center;">
							<?php
							if ($jum_e_piping_wni != 0 && $jum_e_piping_wni != NULL) {
								echo $jum_e_piping_wni;
							} else{
								echo "-";
							}
							?>
						</td>
						<td style="text-align: center;">
							<?php
							if ($jum_e_piping_wna != 0 && $jum_e_piping_wna != NULL) {
								echo $jum_e_piping_wna;
							} else{
								echo "-";
							}
							?>
						</td>
					</tr>
					<tr>
						<td>Instrument</td>
						<td style="text-align: center;">
							<?php
							if ($jum_e_instrument_wni != 0 && $jum_e_instrument_wni != NULL) {
								echo $jum_e_instrument_wni;
							} else{
								echo "-";
							}
							?>
						</td>
						<td style="text-align: center;">
							<?php
							if ($jum_e_instrument_wna != 0 && $jum_e_instrument_wna != NULL) {
								echo $jum_e_instrument_wna;
							} else{
								echo "-";
							}
							?>
						</td>
					</tr>
					<tr>
						<td>Electrical</td>
						<td style="text-align: center;">
							<?php
							if ($jum_e_electrical_wni != 0 && $jum_e_electrical_wni != NULL) {
								echo $jum_e_electrical_wni;
							} else{
								echo "-";
							}
							?>
						</td>
						<td style="text-align: center;">
							<?php
							if ($jum_e_electrical_wna != 0 && $jum_e_electrical_wna != NULL) {
								echo $jum_e_electrical_wna;
							} else{
								echo "-";
							}
							?>
						</td>
						</tr>
					<tr>
						<td>Mechanical</td>
						<td style="text-align: center;">
							<?php
							if ($jum_e_mechanical_wni != 0 && $jum_e_mechanical_wni != NULL) {
								echo $jum_e_mechanical_wni;
							} else{
								echo "-";
							}
							?>
						</td>
						<td style="text-align: center;">
							<?php
							if ($jum_e_mechanical_wna != 0 && $jum_e_mechanical_wna != NULL) {
								echo $jum_e_mechanical_wna;
							} else{
								echo "-";
							}
							?>
						</td>
					</tr>
					<tr>
						<td>Rotary, Package & Machine</td>
						<td style="text-align: center;">
							<?php
							if ($jum_e_rotary_package_machinary_wni != 0 && $jum_e_rotary_package_machinary_wni != NULL) {
								echo $jum_e_rotary_package_machinary_wni;
							} else{
								echo "-";
							}
							?>
						</td>
						<td style="text-align: center;">
							<?php
							if ($jum_e_rotary_package_machinary_wna != 0 && $jum_e_rotary_package_machinary_wna != NULL) {
								echo $jum_e_rotary_package_machinary_wna;
							} else{
								echo "-";
							}
							?>
						</td>
					</tr>
					<tr>
						<td colspan="2">Project Management</td>
						<td style="text-align: center;">
							<?php
							if ($jumlah_project_management_wni != 0 && $jumlah_project_management_wni != NULL) {
								echo $jumlah_project_management_wni;
							} else{
								echo "-";
							}
							?>
						</td>
						<td style="text-align: center;">
							<?php
							if ($jumlah_project_management_wna != 0 && $jumlah_project_management_wna != NULL) {
								echo $jumlah_project_management_wna;
							} else{
								echo "-";
							}
							?>
						</td>
					</tr>
					<tr>
						<td colspan="2">Project Planning & Control</td>
						<td style="text-align: center;">
							<?php
							if ($jumlah_project_planning_control_wni != 0 && $jumlah_project_planning_control_wni != NULL) {
								echo $jumlah_project_planning_control_wni;
							} else{
								echo "-";
							}
							?>
						</td>
						<td style="text-align: center;">
							<?php
							if ($jumlah_project_planning_control_wna != 0 && $jumlah_project_planning_control_wna != NULL) {
								echo $jumlah_project_planning_control_wna;
							} else{
								echo "-";
							}
							?>
						</td>
					</tr>
					<tr>
						<td colspan="2">Procurement</td>
						<td style="text-align: center;">
							<?php
							if ($jumlah_procurement_wni != 0 && $jumlah_procurement_wni != NULL) {
								echo $jumlah_procurement_wni;
							} else{
								echo "-";
							}
							?>
						</td>
						<td style="text-align: center;">
							<?php
							if ($jumlah_procurement_wna != 0 && $jumlah_procurement_wna != NULL) {
								echo $jumlah_procurement_wna;
							} else{
								echo "-";
							}
							?>
						</td>
					</tr>
					<tr>
						<td colspan="2">Construction Management</td>
						<td style="text-align: center;">
							<?php
							if ($jumlah_construction_management_wni != 0 && $jumlah_construction_management_wni != NULL) {
								echo $jumlah_construction_management_wni;
							} else{
								echo "-";
							}
							?>
						</td>
						<td style="text-align: center;">
							<?php
							if ($jumlah_construction_management_wna != 0 && $jumlah_construction_management_wna != NULL) {
								echo $jumlah_construction_management_wna;
							} else{
								echo "-";
							}
							?>
						</td>
					</tr>
					<tr>
						<td colspan="2">Quality Control</td>
						<td style="text-align: center;">
							<?php
							if ($jumlah_qc_wni != 0 && $jumlah_qc_wni != NULL) {
								echo $jumlah_qc_wni;
							} else{
								echo "-";
							}
							?>
						</td>
						<td style="text-align: center;">
							<?php
							if ($jumlah_qc_wna != 0 && $jumlah_qc_wna != NULL) {
								echo $jumlah_qc_wna;
							} else{
								echo "-";
							}
							?>
						</td>
					</tr>
				</tbody>
			</table>
		</div>
		<?php
		}

		if (isset($_POST['da_check'])) {
		?>
		<div id="daDiv">
			<h5><strong>Tools</strong></h5>
			<table class="table-sm" id="kpjTable">
				<thead>
					<tr>
						<th width="17%" style="vertical-align: middle;">Name</th>
						<th width="17%" style="vertical-align: middle;">Brand/Type</th>
						<th width="7%" style="vertical-align: middle;">Quantity</th>
						<th width="8%" style="vertical-align: middle;">Production Year</th>
						<th width="8%" style="vertical-align: middle;">Condition</th>
						<th width="12%" style="vertical-align: middle;">Ownership Status</th>
						<th width="21%" style="vertical-align: middle;">Tech Description</th>
						<th style="vertical-align: middle;">Attached File</th>
					</tr>
				</thead>
				<tbody>
					<?php
					$qda = "SELECT * FROM alat WHERE com_id = '$com_id';";
					$qdarun = mysqli_query($conn,$qda);
					if (mysqli_num_rows($qdarun) > 0) {
						while ($da = mysqli_fetch_assoc($qdarun)) {
							$a_id = $da['a_id'];
					?>
					<tr>
						<td><?php echo $da['a_name']; ?></td>
						<td><?php echo $da['merk_type']; ?></td>
						<td style="text-align: center;"><?php echo $da['jumlah']; ?></td>
						<td style="text-align: center;"><?php echo $da['tahun_pembuatan']; ?></td>
						<td><?php echo $da['kondisi']; ?></td>
						<td><?php echo $da['status_kepemilikan']; ?></td>
						<td><?php echo $da['tech_desc']; ?></td>
						<td>
							<?php
							if ($da['a_file'] != NULL) {
							?>
							<a href='<?php echo "file/".$com_id."/".$da['a_file'] ?>' download="">Download File</a>
							<?php
							} else {
								echo 'No attached file';
							}
							?>
						</td>
					</tr>
					<?php
						}
					} else{
						echo "<tr><td colspan='8'><center>No Data</center></td></tr>";
					}
					?>
				</tbody>
			</table>
		</div>
		<?php
		}

		if (isset($_POST['exp_check'])) {
		?>
		<div id="expDiv">
			<h5><strong>Experience List</strong></h5>
			<table class="table-sm" id="kpjTable">
				<thead>
					<tr>
						<th style="vertical-align: middle;">Project Name</th>
						<th width="7%" style="vertical-align: middle;">Work Scope</th>
						<th width="15%" style="vertical-align: middle;">Location</th>
						<th width="5%" style="vertical-align: middle;">Year</th>
						<th width="15%" style="vertical-align: middle;">Client</th>
						<th width="10%" style="vertical-align: middle;">Project Fields</th>
						<th width="7%" style="vertical-align: middle;">Onshore/<br>Offshore</th>
						<th width="10%" style="vertical-align: middle;">Capacity</th>
						<th width="10%" style="vertical-align: middle;">Project Value</th>
					</tr>
				</thead>
				<tbody>
					<?php
					$qexp = "SELECT * FROM pengalaman WHERE com_id = '$com_id' AND p_status = 'finish';";
					$qexprun = mysqli_query($conn,$qexp);
					if (mysqli_num_rows($qexprun) > 0) {
						while ($exp = mysqli_fetch_assoc($qexprun)) {
					?>
					<tr>
						<td><?php echo $exp['nama_proyek']; ?></td>
						<td><?php echo $exp['lingkup_pekerjaan']; ?></td>
						<td><?php echo $exp['lokasi']; ?></td>
						<td style="text-align: center;"><?php echo $exp['periode']; ?></td>
						<td><?php echo $exp['client']; ?></td>
						<td><?php echo $exp['p_field']; ?></td>
						<td><?php echo $exp['on_off_shore']; ?></td>
						<td><?php echo $exp['capacity']; ?></td>
						<td><?php echo $exp['p_cost']; ?></td>
					</tr>
					<?php
						}
					} else{
						echo "<tr><td colspan='9'><center>No Data</center></td></tr>";
					}
					?>
				</tbody>
			</table>
		</div>
		<?php
		}

		if (isset($_POST['op_check'])) {
		?>
		<div id="opDiv">
			<h5><strong>Ongoing Project</strong></h5>
			<table class="table-sm" id="kpjTable">
				<thead>
					<tr>
						<th style="vertical-align: middle;">Project Name</th>
						<th width="7%" style="vertical-align: middle;">Work Scope</th>
						<th width="15%" style="vertical-align: middle;">Location</th>
						<th width="5%" style="vertical-align: middle;">Year</th>
						<th width="15%" style="vertical-align: middle;">Client</th>
						<th width="10%" style="vertical-align: middle;">Project Fields</th>
						<th width="7%" style="vertical-align: middle;">Onshore/<br>Offshore</th>
						<th width="10%" style="vertical-align: middle;">Capacity</th>
						<th width="10%" style="vertical-align: middle;">Project Value</th>
					</tr>
				</thead>
				<tbody>
					<?php
					$qop = "SELECT * FROM pengalaman WHERE com_id = '$com_id' AND p_status = 'ongoing';";
					$qoprun = mysqli_query($conn,$qop);
					if (mysqli_num_rows($qoprun) > 0) {
						while ($op = mysqli_fetch_assoc($qoprun)) {
					?>
					<tr>
						<td><?php echo $op['nama_proyek']; ?></td>
						<td><?php echo $op['lingkup_pekerjaan']; ?></td>
						<td><?php echo $op['lokasi']; ?></td>
						<td style="text-align: center;"><?php echo $op['periode']; ?></td>
						<td><?php echo $op['client']; ?></td>
						<td><?php echo $op['p_field']; ?></td>
						<td><?php echo $op['on_off_shore']; ?></td>
						<td><?php echo $op['capacity']; ?></td>
						<td><?php echo $op['p_cost']; ?></td>
					</tr>
					<?php
						}
					} else{
						echo "<tr><td colspan='9'><center>No Data</center></td></tr>";
					}
					?>
				</tbody>
			</table>
		</div>
		<?php
		}

		if (isset($_POST['tor_check'])) {
		?>
		<div id="torDiv">
			<h5><strong>Turn Over Revenue</strong></h5>
			<table class="table-sm" id="torTable">
				<thead>
					<tr>
						<th width="6%" style="vertical-align: middle;">No</th>
						<th width="15%" style="vertical-align: middle;">Year</th>
						<th style="vertical-align: middle;">Project Value</th>
					</tr>
				</thead>
				<tbody>
					<?php
					$qtor = "SELECT * FROM to_revenue WHERE com_id = '$com_id';";
					$qtorrun = mysqli_query($conn,$qtor);
					if (mysqli_num_rows($qtorrun) > 0) {
						$x=1;
						while ($tor = mysqli_fetch_assoc($qtorrun)) {
					?>
					<tr>
						<td style="text-align: center;"><?php echo $x++; ?></td>
						<td style="text-align: center;"><?php echo $tor['to_year']; ?></td>
						<td style="text-align: right;"><?php echo $tor['to_value']; ?></td>
					</tr>
					<?php
						}
					} else{
						echo "<tr><td colspan='3'><center>No Data</center></td></tr>";
					}
					?>
				</tbody>
			</table>
		</div>
		<?php
		}
		if (isset($_POST['additional_table'])) {
		?>
		<div id="add_div">
			<h5><strong>Additional Detail</strong></h5>
			<table class="table-sm" id="add_table">
				<thead>
					<tr>
						<th width="20%" style="vertical-align: middle;">Item</th>
						<th style="vertical-align: middle;">Description</th>
					</tr>
				</thead>
				<tbody>
					<?php
					$qadd_det = "SELECT * FROM additional_detail WHERE com_id = '$com_id';";
					$qadd_detrun = mysqli_query($conn,$qadd_det);
					if (mysqli_num_rows($qadd_detrun) > 0) {
						while ($add_det = mysqli_fetch_assoc($qadd_detrun)) {
					?>
					<tr>
						<td><?php echo $add_det['item']; ?></td>
						<td><?php echo $add_det['description']; ?></td>
					</tr>
					<?php
						}
					} else{
						echo "<tr><td colspan='2'><center>No Data</center></td></tr>";
					}
					?>
				</tbody>
			</table>
		</div>
		<?php
		}
		?>
	</div>
	<style type="text/css">
		th {
			text-align: center;
		}
		table {
			width:100%;
			max-width:100%;
			margin-bottom:1rem;
			border-collapse: collapse;
		}
		table, th, td {
			border: 1px solid black;
		}
	</style>
	<script type="text/javascript">
		$( document ).ready(function() {
			window.print();
		});
	</script>
	<?php
	}
	mysqli_close($conn);
	?>
</body>
</html>