<!DOCTYPE html>
<html>
<head>
	<?php
	session_start();
	include('head.php');
	?>
	<style type="text/css">
	[data-role="dynamic-fields"] > .form-inline + .form-inline {
		margin-top: 0.5em;
	}

	[data-role="dynamic-fields"] > .form-inline [data-role="add"] {
		display: none;
	}

	[data-role="dynamic-fields"] > .form-inline:last-child [data-role="add"] {
		display: inline-block;
	}

	[data-role="dynamic-fields"] > .form-inline:last-child [data-role="remove"] {
		display: none;
	}
	</style>
</head>
<body style="background-color: #e9ecef;">
	<?php
	include('conn.php');
	include('navbar.php');
	?>
	<div class="jumbotron" style="padding-top: 30px;">
		<?php
		$com_id = $_GET['com_id'];
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
		<h1>Company Profile</h1>
		<hr class="my-4">
		<?php
		if (isset($_SESSION['flag'])) {
			$flag = $_SESSION['flag'];
			if ($flag == 1) {
				?>
				<div class="alert alert-success alert-dismissible fade show" role="alert">
					<strong>Success!</strong> Data has been updated!
					<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				</div>
				<?php
			}
			elseif ($flag == 2) {
				?>
				<div class="alert alert-primary alert-dismissible fade show" role="alert">
					<strong>Done!</strong> Your data has been added!
					<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				</div>
				<?php
			}
			elseif ($flag == 3) {
				?>
				<div class="alert alert-danger alert-dismissible fade show" role="alert">
					<strong>Failed!</strong> No data added! Please check your excel file.
					<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				</div>
				<?php
			}
			elseif ($flag == 4) {
				?>
				<div class="alert alert-warning alert-dismissible fade show" role="alert">
					<strong>Warning!</strong> Some data not added! Please check your excel file.
					<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				</div>
				<?php
			}
		}
		session_unset();
		session_destroy();
		?>
		<button type="button" class="btn btn-primary" style="border-radius: 5px; padding: 5px 10px 5px 10px;" data-toggle="modal" data-target="#printModal"><span><i class="fa fa-print"></i></span> Print</button>
		<button type="button" class="btn btn-success" style="border-radius: 5px; padding: 5px 10px 5px 10px;" data-toggle="modal" data-target="#editModal"><span><i class="fa fa-pencil"></i></span> Edit</button>
		<button type="button" class="btn btn-danger" style="border-radius: 5px; padding: 5px 10px 5px 10px;" data-toggle="modal" data-target="#deleteModal"><span><i class="fa fa-trash"></i></span> Delete</button>
		<br><br>
		<fieldset class="shadow-lg" style="background-color: white; padding: 20px; border-radius: 5px;">
			<strong><h1><?php echo $result['com_name']; ?></h1></strong>
			<hr class="my-4">
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
			<hr class="my-4">
			<?php
				mysqli_next_result($conn);

				$ccl_check = 'ok';
				$lp_check = 'ok';
				$ps_check = 'ok';
				$ec_check = 'ok';
				$da_check = 'ok';
				$exp_check = 'ok';
				$op_check = 'ok';
				$tor_check = 'ok';
				$additional_table = NULL;
				if ($bs_id>6) {
					$qdt = "SELECT * FROM detil_tabel WHERE bs_id='$bs_id'";
					$qdtrun = mysqli_query($conn,$qdt);
					$detil_tabelnya = mysqli_fetch_assoc($qdtrun);

					$ccl_check = $detil_tabelnya['ccl_check'];
					$lp_check = $detil_tabelnya['lp_check'];
					$ps_check = $detil_tabelnya['ps_check'];
					$ec_check = $detil_tabelnya['ec_check'];
					$da_check = $detil_tabelnya['da_check'];
					$exp_check = $detil_tabelnya['exp_check'];
					$op_check = $detil_tabelnya['op_check'];
					$tor_check = $detil_tabelnya['tor_check'];
					$additional_table = $detil_tabelnya['additional_table'];
				}
			?>
			<button type="button" class="btn btn-light" style="border-radius: 5px; padding: 5px 10px 5px 10px; border: 1px solid grey;" data-toggle="modal" data-target="#importModal"><span><i class="fa fa-upload"></i></span> Batch Add Data</button>
			<br><br>

			<?php
			if ($ccl_check == 'ok') {
			?>
			<div id="cclDiv">
				<div>
					<h5 style="float: left;"><strong>Corporate Certificate/License</strong></h5>
					<button type="button" class="btn btn-primary btn-sm" style="margin-bottom: 6px; border-radius: 5px; padding: 5px 10px 5px 10px; float: right;" data-toggle="modal" data-target="#addCer"><span><i class="fa fa-plus"></i></span> Add Data</button>
				</div>
				<table class="table table-bordered table-sm">
					<thead>
						<tr>
							<th style="vertical-align: middle;">Certification/License Name</th>
							<th width="10%" style="vertical-align: middle;">Code</th>
							<th width="30%" style="vertical-align: middle;">Classification</th>
							<th width="20%" style="vertical-align: middle;">Qualification</th>
							<th width="7%" style="vertical-align: middle;" scope="col"><span><i class="fa fa-gears"></i></span> Action</th>
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
							<td style="vertical-align: middle;" rowspan="<?php echo $span; ?>"><?php echo $cer['c_name']; ?></td>
							<td><?php echo $cer['c_code']; ?></td>
							<td><?php echo $cer['c_classification']; ?></td>
							<td><?php echo $cer['c_qualification']; ?></td>
							<td style="vertical-align: middle;">
								<center>
									<button type="button" class="btn btn-success btn-sm tooltip_btn" style="border-radius: 5px; padding: 5px 10px;" data-toggle="modal" data-target="#editCer_<?php echo $cer['c_id']; ?>" data-placement="top" title="" data-original-title="Edit"><span><i class="fa fa-pencil"></i></span></button>
									<button type="button" class="btn btn-danger btn-sm tooltip_btn" style="border-radius: 5px; padding: 5px 10px;" data-toggle="modal" data-target="#deleteCer_<?php echo $cer['c_id']; ?>" data-placement="top" title="" data-original-title="Delete"><span><i class="fa fa-trash"></i></span></button>
								</center>
							</td>
						</tr>
						<?php
								} else {
						?>
						<tr>
							<td><?php echo $cer['c_code']; ?></td>
							<td><?php echo $cer['c_classification']; ?></td>
							<td><?php echo $cer['c_qualification']; ?></td>
							<td style="vertical-align: middle;">
								<center>
									<button type="button" class="btn btn-success btn-sm" style="border-radius: 5px; padding: 5px 10px;" data-toggle="modal" data-target="#editCer_<?php echo $cer['c_id']; ?>"><span><i class="fa fa-pencil"></i></span> Edit</button>
									<button type="button" class="btn btn-danger btn-sm" style="border-radius: 5px; padding: 5px 10px;" data-toggle="modal" data-target="#deleteCer_<?php echo $cer['c_id']; ?>"><span><i class="fa fa-trash"></i></span> Delete</button>
								</center>
							</td>
						</tr>
						<?php
								}
						?>
						<div class="modal fade" tabindex="-1" id="editCer_<?php echo $cer['c_id']; ?>">
							<div class="modal-dialog modal-lg">
								<div class="modal-content">
									<div class="modal-header">
										<h5 class="modal-title">Edit Certificate/License</h5>
										<button type="button" class="close" data-dismiss="modal" aria-label="Close">
											<span aria-hidden="true">&times;</span>
										</button>
									</div>
									<form action="certif_edit.php" method="post" enctype="multipart/form-data">
										<div class="modal-body">
											<input type="hidden" name="com_id" value="<?php echo $com_id; ?>">
											<input type="hidden" name="c_id" value="<?php echo $cer['c_id']; ?>">
											<div class="form-group">
												<label for="cname_form">Certification/License Name</label>
												<input class="form-control" id="cname_form" type="text" name="c_name" value="<?php echo $cer['c_name']; ?>">
											</div>
											<div class="form-group">
												<div class="row">
													<div class="col-7">
														<label for="c_class_form">Classification</label>
														<textarea class="form-control" id="c_class_form" rows="4" name="c_classification"><?php echo $cer['c_classification']; ?></textarea>
													</div>
													<div class="col">
														<div class="form-group">
															<label for="c_code_form">Code</label>
															<input class="form-control" id="c_code_form" type="text" name="c_code" value="<?php echo $cer['c_code']; ?>">
														</div>
														<div class="form-group">
															<label for="c_qual_form">Qualification</label>
															<input class="form-control" id="c_qual_form" type="text" name="c_qualification" value="<?php echo $cer['c_qualification']; ?>">
														</div>
													</div>
												</div>
											</div>
										</div>
										<div class="modal-footer">
											<button type="submit" name="editCertif" value="editCertif" class="btn btn-primary">Submit</button>
											<button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
										</div>
									</form>
								</div>
							</div>
						</div>
						<div class="modal fade" tabindex="-1" id="deleteCer_<?php echo $cer['c_id']; ?>">
							<div class="modal-dialog">
								<div class="modal-content">
									<div class="modal-header">
										<h5 class="modal-title">Delete Certificate/License</h5>
										<button type="button" class="close" data-dismiss="modal" aria-label="Close">
											<span aria-hidden="true">&times;</span>
										</button>
									</div>
									<form action="certif_delete.php" method="post" enctype="multipart/form-data">
										<div class="modal-body">
											<input type="hidden" name="com_id" value="<?php echo $com_id; ?>">
											<input type="hidden" name="c_id" value="<?php echo $cer['c_id']; ?>">
											<div class="row">
												<div style="float: left; width: 150px; margin-left: 15px;">
													<strong>Certificate/License</strong>
												</div>
												<div style="float: left; width: 20px; text-align: center;">
													:
												</div>
												<div class="col">
													<?php echo $cer['c_name']; ?>
												</div>
											</div>
											<div class="row">
												<div style="float: left; width: 150px; margin-left: 15px;">
													<strong>Code</strong>
												</div>
												<div style="float: left; width: 20px; text-align: center;">
													:
												</div>
												<div class="col">
													<?php echo $cer['c_code']; ?>
												</div>
											</div>
											<div class="row">
												<div style="float: left; width: 150px; margin-left: 15px;">
													<strong>Classification</strong>
												</div>
												<div style="float: left; width: 20px; text-align: center;">
													:
												</div>
												<div class="col">
													<?php echo $cer['c_classification']; ?>
												</div>
											</div>
											<div class="row">
												<div style="float: left; width: 150px; margin-left: 15px;">
													<strong>Qualification</strong>
												</div>
												<div style="float: left; width: 20px; text-align: center;">
													:
												</div>
												<div class="col">
													<?php echo $cer['c_qualification']; ?>
												</div>
											</div>
											<div style="margin-top: 5px;">
												Are you sure want to <strong>delete</strong> this data?
											</div>
										</div>
										<div class="modal-footer">
											<button type="submit" name="deleteCertif" value="deleteCertif" class="btn btn-primary">Yes</button>
											<button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
										</div>
									</form>
								</div>
							</div>
						</div>
						<?php
							}
						} else{
							echo "<tr><td colspan='5'><center>No Data</center></td></tr>";
						}
						?>
					</tbody>
				</table>
			</div>
			<?php
			}
			if ($bs_id == 3 && $lp_check == 'ok') {
			?>
			<div id="lDiv">
				<div>
					<h5 style="float: left;"><strong>Licensed Processes</strong></h5>
					<button type="button" class="btn btn-primary btn-sm" style="margin-bottom: 6px; border-radius: 5px; padding: 5px 10px 5px 10px; float: right;" data-toggle="modal" data-target="#addLp"><span><i class="fa fa-plus"></i></span> Add Data</button>
				</div>
				<table class="table table-bordered table-sm">
					<thead>
						<tr>
							<th width="7%" style="vertical-align: middle;">No</th>
							<th style="vertical-align: middle;">Process Name</th>
							<th width="30%" style="vertical-align: middle;">Bussiness Field</th>
							<th width="7%" style="vertical-align: middle;" scope="col"><span><i class="fa fa-gears"></i></span> Action</th>
						</tr>
					</thead>
					<tbody>
						<?php
						$qlicense = "SELECT * FROM licensed l JOIN bussiness_fields bf USING(bf_id) WHERE l.com_id = '$com_id' ORDER BY bf_id, l_process;";
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
							<td style="vertical-align: middle;">
								<center>
									<button type="button" class="btn btn-success btn-sm tooltip_btn" style="border-radius: 5px; padding: 5px 10px;" data-toggle="modal" data-target="#editLp_<?php echo $license['l_id']; ?>" data-placement="top" title="" data-original-title="Edit"><span><i class="fa fa-pencil"></i></span></button>
									<button type="button" class="btn btn-danger btn-sm tooltip_btn" style="border-radius: 5px; padding: 5px 10px;" data-toggle="modal" data-target="#deleteLp_<?php echo $license['l_id']; ?>" data-placement="top" title="" data-original-title="Delete"><span><i class="fa fa-trash"></i></span></button>
								</center>
							</td>
						</tr>
						<div class="modal fade" tabindex="-1" id="editLp_<?php echo $license['l_id']; ?>">
							<div class="modal-dialog">
								<div class="modal-content">
									<div class="modal-header">
										<h5 class="modal-title">Edit Licensed Process</h5>
										<button type="button" class="close" data-dismiss="modal" aria-label="Close">
											<span aria-hidden="true">&times;</span>
										</button>
									</div>
									<form action="licensed_proc_edit.php" method="post" enctype="multipart/form-data">
										<div class="modal-body">
											<input type="hidden" name="com_id" value="<?php echo $com_id; ?>">
											<input type="hidden" name="l_id" value="<?php echo $license['l_id']; ?>">
											<div class="form-group">
												<label for="l_name_form">Process Name</label>
												<input class="form-control" id="l_name_form" type="text" name="l_process" value="<?php echo $license['l_process']; ?>">
											</div>
											<div class="form-group">
												<label for="bs_form">Bussiness Field</label>
												<select class="form-control custom-select" id="bs_form" name="bf_id">
													<?php
													$qbf1 = "SELECT * FROM bussiness_fields;";
													$qbf1run = mysqli_query($conn,$qbf1);
													while ($bf1 = mysqli_fetch_assoc($qbf1run)) {
														if ($bf1['bf_id'] == $license['bf_id']) {
													?>
														<option selected="" value='<?php echo $bf1['bf_id']; ?>'><?php echo $bf1['bf_name']; ?></option>
													<?php
														}else{
													?>
														<option value='<?php echo $bf1['bf_id']; ?>'><?php echo $bf1['bf_name']; ?></option>
													<?php
														}
													}
													?>
												</select>
											</div>
										</div>
										<div class="modal-footer">
											<button type="submit" name="editLp" value="editLp" class="btn btn-primary">Submit</button>
											<button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
										</div>
									</form>
								</div>
							</div>
						</div>
						<div class="modal fade" tabindex="-1" id="deleteLp_<?php echo $license['l_id']; ?>">
							<div class="modal-dialog">
								<div class="modal-content">
									<div class="modal-header">
										<h5 class="modal-title">Delete Licensed Process</h5>
										<button type="button" class="close" data-dismiss="modal" aria-label="Close">
											<span aria-hidden="true">&times;</span>
										</button>
									</div>
									<form action="licensed_proc_delete.php" method="post" enctype="multipart/form-data">
										<div class="modal-body">
											<input type="hidden" name="com_id" value="<?php echo $com_id; ?>">
											<input type="hidden" name="l_id" value="<?php echo $license['l_id']; ?>">
											<div class="row">
												<div style="float: left; width: 120px; margin-left: 15px;">
													<strong>Process Name</strong>
												</div>
												<div style="float: left; width: 20px; text-align: center;">
													:
												</div>
												<div class="col">
													<?php echo $license['l_process']; ?>
												</div>
											</div>
											<div class="row">
												<div style="float: left; width: 120px; margin-left: 15px;">
													<strong>Bussiness Field</strong>
												</div>
												<div style="float: left; width: 20px; text-align: center;">
													:
												</div>
												<div class="col">
													<?php echo $license['bf_name']; ?>
												</div>
											</div>
											<div style="margin-top: 5px;">
												Are you sure want to <strong>delete</strong> this data?
											</div>
										</div>
										<div class="modal-footer">
											<button type="submit" name="deleteLp" value="deleteLp" class="btn btn-primary">Yes</button>
											<button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
										</div>
									</form>
								</div>
							</div>
						</div>
						<?php
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
			if ($ps_check == 'ok') {
			?>
			<div id="shpDiv">
				<div>
					<h5 style="float: left;"><strong>Product Spesification</strong></h5>
					<button type="button" class="btn btn-primary btn-sm" style="margin-bottom: 6px; border-radius: 5px; padding: 5px 10px 5px 10px; float: right;" data-toggle="modal" data-target="#psAdd"><span><i class="fa fa-plus"></i></span> Add Data</button>
				</div>
				<table class="table table-bordered table-sm">
					<thead>
						<tr>
							<th width="14%" style="vertical-align: middle;">Product Name</th>
							<th width="14%" style="vertical-align: middle;">Product Type</th>
							<th width="20%" style="vertical-align: middle;">Spesification</th>
							<th width="14%" style="vertical-align: middle;">Product Standard</th>
							<th width="14%" style="vertical-align: middle;">Product Certificate</th>
							<th width="7%" style="vertical-align: middle;">TKDN (%)</th>
							<th width="10%" style="vertical-align: middle;">Capacity</th>
							<th width="7%" style="vertical-align: middle;" scope="col"><span><i class="fa fa-gears"></i></span> Action</th>
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
							<td style="vertical-align: middle;">
								<center>
									<button type="button" class="btn btn-success btn-sm tooltip_btn" style="border-radius: 5px; padding: 5px 10px;" data-toggle="modal" data-target="#editSp_<?php echo $shp['shp_id']; ?>" data-placement="top" title="" data-original-title="Edit"><span><i class="fa fa-pencil"></i></span></button>
									<button type="button" class="btn btn-danger btn-sm tooltip_btn" style="border-radius: 5px; padding: 5px 10px;" data-toggle="modal" data-target="#deleteSp_<?php echo $shp['shp_id']; ?>" data-placement="top" title="" data-original-title="Delete"><span><i class="fa fa-trash"></i></span></button>
								</center>
							</td>
						</tr>
						<div class="modal fade" tabindex="-1" id="editSp_<?php echo $shp['shp_id']; ?>">
							<div class="modal-dialog modal-lg">
								<div class="modal-content">
									<div class="modal-header">
										<h5 class="modal-title">Edit Product Spesification</h5>
										<button type="button" class="close" data-dismiss="modal" aria-label="Close">
											<span aria-hidden="true">&times;</span>
										</button>
									</div>
									<form action="product_spec_edit.php" method="post" enctype="multipart/form-data">
										<div class="modal-body">
											<input type="hidden" name="com_id" value="<?php echo $com_id; ?>">
											<input type="hidden" name="shp_id" value="<?php echo $shp['shp_id']; ?>">
											<div class="form-group">
												<label for="p_name">Product Name</label>
												<input class="form-control" id="p_name" type="text" name="hasil_produksi" value="<?php echo $shp['hasil_produksi']; ?>">
											</div>
											<div class="form-group">
												<div class="row">
													<div class="col">
														<label for="p_type">Product Type</label>
														<textarea class="form-control" id="p_type" rows="4" name="jenis_produksi"><?php echo $shp['jenis_produksi']; ?></textarea>
													</div>
													<div class="col">
														<label for="p_spec">Spesification</label>
														<textarea class="form-control" id="p_spec" rows="4" name="spesifikasi"><?php echo $shp['spesifikasi']; ?></textarea>
													</div>
												</div>
											</div>
											<div class="row">
												<div class="col">
													<div class="form-group">
														<label for="p_standart">Product Standart</label>
														<input class="form-control" id="p_standart" type="text" name="standar_produk" value="<?php echo $shp['standar_produk']; ?>">
													</div>
													<div class="form-group">
														<label for="p_certif">Product Certificate</label>
														<input class="form-control" id="p_certif" type="text" name="sertifikat" value="<?php echo $shp['sertifikat']; ?>">
													</div>
												</div>
												<div class="col-4">
													<div class="form-group">
														<label for="sp_tkdn">TKDN(%)</label>
														<input class="form-control" id="sp_tkdn" type="number" max="100" min="0" name="tkdn" step="any" value="<?php echo $shp['tkdn']; ?>">
													</div>
													<div class="form-group">
														<label for="l_name_form">Capacity</label>
														<input class="form-control" id="l_name_form" type="text" name="kapasitas" value="<?php echo $shp['kapasitas']; ?>">
													</div>
												</div>
											</div>
										</div>
										<div class="modal-footer">
											<button type="submit" name="editSp" value="editSp" class="btn btn-primary">Submit</button>
											<button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
										</div>
									</form>
								</div>
							</div>
						</div>
						<div class="modal fade" tabindex="-1" id="deleteSp_<?php echo $shp['shp_id']; ?>">
							<div class="modal-dialog modal-lg">
								<div class="modal-content">
									<div class="modal-header">
										<h5 class="modal-title">Delete Product Spesification</h5>
										<button type="button" class="close" data-dismiss="modal" aria-label="Close">
											<span aria-hidden="true">&times;</span>
										</button>
									</div>
									<form action="product_spec_delete.php" method="post" enctype="multipart/form-data">
										<div class="modal-body">
											<input type="hidden" name="com_id" value="<?php echo $com_id; ?>">
											<input type="hidden" name="shp_id" value="<?php echo $shp['shp_id']; ?>">
											<div class="row">
												<div style="float: left; width: 150px; margin-left: 15px;">
													<strong>Product Name</strong>
												</div>
												<div style="float: left; width: 20px; text-align: center;">
													:
												</div>
												<div class="col">
													<?php echo $shp['hasil_produksi']; ?>
												</div>
											</div>
											<div class="row">
												<div style="float: left; width: 150px; margin-left: 15px;">
													<strong>Product Type</strong>
												</div>
												<div style="float: left; width: 20px; text-align: center;">
													:
												</div>
												<div class="col">
													<?php echo $shp['jenis_produksi']; ?>
												</div>
											</div>
											<div class="row">
												<div style="float: left; width: 150px; margin-left: 15px;">
													<strong>Spesification</strong>
												</div>
												<div style="float: left; width: 20px; text-align: center;">
													:
												</div>
												<div class="col">
													<?php echo $shp['spesifikasi']; ?>
												</div>
											</div>
											<div class="row">
												<div style="float: left; width: 150px; margin-left: 15px;">
													<strong>Product Standart</strong>
												</div>
												<div style="float: left; width: 20px; text-align: center;">
													:
												</div>
												<div class="col">
													<?php echo $shp['standar_produk']; ?>
												</div>
											</div>
											<div class="row">
												<div style="float: left; width: 150px; margin-left: 15px;">
													<strong>Product Certificate</strong>
												</div>
												<div style="float: left; width: 20px; text-align: center;">
													:
												</div>
												<div class="col">
													<?php echo $shp['sertifikat']; ?>
												</div>
											</div>
											<div class="row">
												<div style="float: left; width: 150px; margin-left: 15px;">
													<strong>TKDN</strong>
												</div>
												<div style="float: left; width: 20px; text-align: center;">
													:
												</div>
												<div class="col">
													<?php echo $shp['tkdn']." %"; ?>
												</div>
											</div>
											<div class="row">
												<div style="float: left; width: 150px; margin-left: 15px;">
													<strong>Capacity</strong>
												</div>
												<div style="float: left; width: 20px; text-align: center;">
													:
												</div>
												<div class="col">
													<?php echo $shp['kapasitas']; ?>
												</div>
											</div>
											<div style="margin-top: 5px;">
												Are you sure want to <strong>delete</strong> this data?
											</div>
										</div>
										<div class="modal-footer">
											<button type="submit" name="deleteSp" value="deleteSp" class="btn btn-primary">Yes</button>
											<button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
										</div>
									</form>
								</div>
							</div>
						</div>
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
			if ($bs_id != 2 && $bs_id != 3 && $ec_check == 'ok') {
			?>
			<div id="ecDiv">
				<form action="ec_update.php" method="post" enctype="multipart/form-data">
					<div>
						<h5 style="float: left;"><strong>Employee Composition</strong></h5>
						<input type="hidden" name="com_id" value="<?php echo $com_id; ?>">
						<button type="button" class="btn btn-danger btn-sm" id="tbl_cancel_ec" style="display: none; margin-bottom: 6px; padding: 5px 10px; margin-left: 6px; float: right;" onclick="fungsiEC_canel()">Cancel</button>
						<button type="submit" name="editEC" value="editEC" class="btn btn-primary btn-sm" id="tbl_submit_ec" style="display: none; margin-bottom: 6px; padding: 5px 10px; margin-left: 6px; float: right;">Save</button>
						<button type="button" class="btn btn-primary btn-sm" id="tbl_edit_ec" style="margin-bottom: 6px; border-radius: 5px; padding: 5px 10px; float: right;" onclick="fungsiEC()"><span><i class="fa fa-pencil"></i></span> Edit Data</button>
					</div>
					<table class="table table-bordered table-sm">
						<thead>
							<tr>
								<th rowspan="2" style="vertical-align: middle;">Department</th>
								<th rowspan="2" style="vertical-align: middle;">Sub Department</th>
								<th colspan="2" style="vertical-align: middle;">Number of Employee</th>
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
									<div class="isinya">
										<?php
										if ($jum_e_process_wni != 0 && $jum_e_process_wni != NULL) {
											echo $jum_e_process_wni;
										} else{
											echo "-";
										}
										?>
									</div>
									<div class="jumlahec" style="display: none;">
										<input class="form-control" type="number" min="0" name="jum_e_process_wni" value="<?php echo $jum_e_process_wni; ?>">
									</div>
								</td>
								<td style="text-align: center;">
									<div class="isinya">
										<?php
										if ($jum_e_process_wna != 0 && $jum_e_process_wna != NULL) {
											echo $jum_e_process_wna;
										} else{
											echo "-";
										}
										?>
									</div>
									<div class="jumlahec" style="display: none;">
										<input class="form-control" type="number" min="0" name="jum_e_process_wna" value="<?php echo $jum_e_process_wna; ?>">
									</div>
								</td>
							</tr>
							<tr>
								<td>Civil</td>
								<td style="text-align: center;">
									<div class="isinya">
										<?php
										if ($jum_e_civil_wni != 0 && $jum_e_civil_wni != NULL) {
											echo $jum_e_civil_wni;
										} else{
											echo "-";
										}
										?>
									</div>
									<div class="jumlahec" style="display: none;">
										<input class="form-control" type="number" min="0" name="jum_e_civil_wni" value="<?php echo $jum_e_civil_wni; ?>">
									</div>
								</td>
								<td style="text-align: center;">
									<div class="isinya">
										<?php
										if ($jum_e_civil_wna != 0 && $jum_e_civil_wna != NULL) {
											echo $jum_e_civil_wna;
										} else{
											echo "-";
										}
										?>
									</div>
									<div class="jumlahec" style="display: none;">
										<input class="form-control" type="number" min="0" name="jum_e_civil_wna" value="<?php echo $jum_e_civil_wna; ?>">
									</div>
								</td>
							</tr>
							<tr>
								<td>Piping</td>
								<td style="text-align: center;">
									<div class="isinya">
										<?php
										if ($jum_e_piping_wni != 0 && $jum_e_piping_wni != NULL) {
											echo $jum_e_piping_wni;
										} else{
											echo "-";
										}
										?>
									</div>
									<div class="jumlahec" style="display: none;">
										<input class="form-control" type="number" min="0" name="jum_e_piping_wni" value="<?php echo $jum_e_piping_wni; ?>">
									</div>
								</td>
								<td style="text-align: center;">
									<div class="isinya">
										<?php
										if ($jum_e_piping_wna != 0 && $jum_e_piping_wna != NULL) {
											echo $jum_e_piping_wna;
										} else{
											echo "-";
										}
										?>
									</div>
									<div class="jumlahec" style="display: none;">
										<input class="form-control" type="number" min="0" name="jum_e_piping_wna" value="<?php echo $jum_e_piping_wna; ?>">
									</div>
								</td>
							</tr>
							<tr>
								<td>Instrument</td>
								<td style="text-align: center;">
									<div class="isinya">
										<?php
										if ($jum_e_instrument_wni != 0 && $jum_e_instrument_wni != NULL) {
											echo $jum_e_instrument_wni;
										} else{
											echo "-";
										}
										?>
									</div>
									<div class="jumlahec" style="display: none;">
										<input class="form-control" type="number" min="0" name="jum_e_instrument_wni" value="<?php echo $jum_e_instrument_wni; ?>">
									</div>
								</td>
								<td style="text-align: center;">
									<div class="isinya">
										<?php
										if ($jum_e_instrument_wna != 0 && $jum_e_instrument_wna != NULL) {
											echo $jum_e_instrument_wna;
										} else{
											echo "-";
										}
										?>
									</div>
									<div class="jumlahec" style="display: none;">
										<input class="form-control" type="number" min="0" name="jum_e_instrument_wna" value="<?php echo $jum_e_instrument_wna; ?>">
									</div>
								</td>
							</tr>
							<tr>
								<td>Electrical</td>
								<td style="text-align: center;">
									<div class="isinya">
										<?php
										if ($jum_e_electrical_wni != 0 && $jum_e_electrical_wni != NULL) {
											echo $jum_e_electrical_wni;
										} else{
											echo "-";
										}
										?>
									</div>
									<div class="jumlahec" style="display: none;">
										<input class="form-control" type="number" min="0" name="jum_e_electrical_wni" value="<?php echo $jum_e_electrical_wni; ?>">
									</div>
								</td>
								<td style="text-align: center;">
									<div class="isinya">
										<?php
										if ($jum_e_electrical_wna != 0 && $jum_e_electrical_wna != NULL) {
											echo $jum_e_electrical_wna;
										} else{
											echo "-";
										}
										?>
									</div>
									<div class="jumlahec" style="display: none;">
										<input class="form-control" type="number" min="0" name="jum_e_electrical_wna" value="<?php echo $jum_e_electrical_wna; ?>">
									</div>
								</td>
							</tr>
							<tr>
								<td>Mechanical</td>
								<td style="text-align: center;">
									<div class="isinya">
										<?php
										if ($jum_e_mechanical_wni != 0 && $jum_e_mechanical_wni != NULL) {
											echo $jum_e_mechanical_wni;
										} else{
											echo "-";
										}
										?>
									</div>
									<div class="jumlahec" style="display: none;">
										<input class="form-control" type="number" min="0" name="jum_e_mechanical_wni" value="<?php echo $jum_e_mechanical_wni; ?>">
									</div>
								</td>
								<td style="text-align: center;">
									<div class="isinya">
										<?php
										if ($jum_e_mechanical_wna != 0 && $jum_e_mechanical_wna != NULL) {
											echo $jum_e_mechanical_wna;
										} else{
											echo "-";
										}
										?>
									</div>
									<div class="jumlahec" style="display: none;">
										<input class="form-control" type="number" min="0" name="jum_e_mechanical_wna" value="<?php echo $jum_e_mechanical_wna; ?>">
									</div>
								</td>
							</tr>
							<tr>
								<td>Rotary, Package & Machine</td>
								<td style="text-align: center;">
									<div class="isinya">
										<?php
										if ($jum_e_rotary_package_machinary_wni != 0 && $jum_e_rotary_package_machinary_wni != NULL) {
											echo $jum_e_rotary_package_machinary_wni;
										} else{
											echo "-";
										}
										?>
									</div>
									<div class="jumlahec" style="display: none;">
										<input class="form-control" type="number" min="0" name="jum_e_rotary_package_machinary_wni" value="<?php echo $jum_e_rotary_package_machinary_wni; ?>">
									</div>
								</td>
								<td style="text-align: center;">
									<div class="isinya">
										<?php
										if ($jum_e_rotary_package_machinary_wna != 0 && $jum_e_rotary_package_machinary_wna != NULL) {
											echo $jum_e_rotary_package_machinary_wna;
										} else{
											echo "-";
										}
										?>
									</div>
									<div class="jumlahec" style="display: none;">
										<input class="form-control" type="number" min="0" name="jum_e_rotary_package_machinary_wna" value="<?php echo $jum_e_rotary_package_machinary_wna; ?>">
									</div>
								</td>
							</tr>
							<tr>
								<td colspan="2">Project Management</td>
								<td style="text-align: center;">
									<div class="isinya">
										<?php
										if ($jumlah_project_management_wni != 0 && $jumlah_project_management_wni != NULL) {
											echo $jumlah_project_management_wni;
										} else{
											echo "-";
										}
										?>
									</div>
									<div class="jumlahec" style="display: none;">
										<input class="form-control" type="number" min="0" name="jumlah_project_management_wni" value="<?php echo $jumlah_project_management_wni; ?>">
									</div>
								</td>
								<td style="text-align: center;">
									<div class="isinya">
										<?php
										if ($jumlah_project_management_wna != 0 && $jumlah_project_management_wna != NULL) {
											echo $jumlah_project_management_wna;
										} else{
											echo "-";
										}
										?>
									</div>
									<div class="jumlahec" style="display: none;">
										<input class="form-control" type="number" min="0" name="jumlah_project_management_wna" value="<?php echo $jumlah_project_management_wna; ?>">
									</div>
								</td>
							</tr>
							<tr>
								<td colspan="2">Project Planning & Control</td>
								<td style="text-align: center;">
									<div class="isinya">
										<?php
										if ($jumlah_project_planning_control_wni != 0 && $jumlah_project_planning_control_wni != NULL) {
											echo $jumlah_project_planning_control_wni;
										} else{
											echo "-";
										}
										?>
									</div>
									<div class="jumlahec" style="display: none;">
										<input class="form-control" type="number" min="0" name="jumlah_project_planning_control_wni" value="<?php echo $jumlah_project_planning_control_wni; ?>">
									</div>
								</td>
								<td style="text-align: center;">
									<div class="isinya">
										<?php
										if ($jumlah_project_planning_control_wna != 0 && $jumlah_project_planning_control_wna != NULL) {
											echo $jumlah_project_planning_control_wna;
										} else{
											echo "-";
										}
										?>
									</div>
									<div class="jumlahec" style="display: none;">
										<input class="form-control" type="number" min="0" name="jumlah_project_planning_control_wna" value="<?php echo $jumlah_project_planning_control_wna; ?>">
									</div>
								</td>
							</tr>
							<tr>
								<td colspan="2">Procurement</td>
								<td style="text-align: center;">
									<div class="isinya">
										<?php
										if ($jumlah_procurement_wni != 0 && $jumlah_procurement_wni != NULL) {
											echo $jumlah_procurement_wni;
										} else{
											echo "-";
										}
										?>
									</div>
									<div class="jumlahec" style="display: none;">
										<input class="form-control" type="number" min="0" name="jumlah_procurement_wni" value="<?php echo $jumlah_procurement_wni; ?>">
									</div>
								</td>
								<td style="text-align: center;">
									<div class="isinya">
										<?php
										if ($jumlah_procurement_wna != 0 && $jumlah_procurement_wna != NULL) {
											echo $jumlah_procurement_wna;
										} else{
											echo "-";
										}
										?>
									</div>
									<div class="jumlahec" style="display: none;">
										<input class="form-control" type="number" min="0" name="jumlah_procurement_wna" value="<?php echo $jumlah_procurement_wna; ?>">
									</div>
								</td>
							</tr>
							<tr>
								<td colspan="2">Construction Management</td>
								<td style="text-align: center;">
									<div class="isinya">
										<?php
										if ($jumlah_construction_management_wni != 0 && $jumlah_construction_management_wni != NULL) {
											echo $jumlah_construction_management_wni;
										} else{
											echo "-";
										}
										?>
									</div>
									<div class="jumlahec" style="display: none;">
										<input class="form-control" type="number" min="0" name="jumlah_construction_management_wni" value="<?php echo $jumlah_construction_management_wni; ?>">
									</div>
								</td>
								<td style="text-align: center;">
									<div class="isinya">
										<?php
										if ($jumlah_construction_management_wna != 0 && $jumlah_construction_management_wna != NULL) {
											echo $jumlah_construction_management_wna;
										} else{
											echo "-";
										}
										?>
									</div>
									<div class="jumlahec" style="display: none;">
										<input class="form-control" type="number" min="0" name="jumlah_construction_management_wna" value="<?php echo $jumlah_construction_management_wna; ?>">
									</div>
								</td>
							</tr>
							<tr>
								<td colspan="2">Quality Control</td>
								<td style="text-align: center;">
									<div class="isinya">
										<?php
										if ($jumlah_qc_wni != 0 && $jumlah_qc_wni != NULL) {
											echo $jumlah_qc_wni;
										} else{
											echo "-";
										}
										?>
									</div>
									<div class="jumlahec" style="display: none;">
										<input class="form-control" type="number" min="0" name="jumlah_qc_wni" value="<?php echo $jumlah_qc_wni; ?>">
									</div>
								</td>
								<td style="text-align: center;">
									<div class="isinya">
										<?php
										if ($jumlah_qc_wna != 0 && $jumlah_qc_wna != NULL) {
											echo $jumlah_qc_wna;
										} else{
											echo "-";
										}
										?>
									</div>
									<div class="jumlahec" style="display: none;">
										<input class="form-control" type="number" min="0" name="jumlah_qc_wna" value="<?php echo $jumlah_qc_wna; ?>">
									</div>
								</td>
							</tr>
						</tbody>
					</table>
				</form>
			</div>
			<?php
			}
			if ($da_check == 'ok') {
			?>
			<div id="daDiv">
				<div>
					<h5 style="float: left;"><strong>Tools</strong></h5>
					<button type="button" class="btn btn-primary btn-sm" style="margin-bottom: 6px; border-radius: 5px; padding: 5px 10px 5px 10px; float: right;" data-toggle="modal" data-target="#addDa"><span><i class="fa fa-plus"></i></span> Add Data</button>
				</div>
				<table class="table table-bordered table-sm" id="kpjTable">
					<thead>
						<tr>
							<th width="15%" style="vertical-align: middle;">Name</th>
							<th width="15%" style="vertical-align: middle;">Brand/Type</th>
							<th width="7%" style="vertical-align: middle;">Quantity</th>
							<th width="8%" style="vertical-align: middle;">Production Year</th>
							<th width="8%" style="vertical-align: middle;">Condition</th>
							<th width="12%" style="vertical-align: middle;">Ownership Status</th>
							<th width="18%" style="vertical-align: middle;">Tech Description</th>
							<th width="10%" style="vertical-align: middle;">Attached File</th>
							<th width="7%" style="vertical-align: middle;" scope="col"><span><i class="fa fa-gears"></i></span> Action</th>
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
									echo 'No file attached';
								}
								?>
							</td>
							<td style="vertical-align: middle;">
								<center>
									<button type="button" class="btn btn-success btn-sm tooltip_btn" style="border-radius: 5px; padding: 5px 10px;" data-toggle="modal" data-target="#editDa_<?php echo $a_id; ?>" data-placement="top" title="" data-original-title="Edit"><span><i class="fa fa-pencil"></i></span></button>
									<button type="button" class="btn btn-danger btn-sm tooltip_btn" style="border-radius: 5px; padding: 5px 10px;" data-toggle="modal" data-target="#deleteDa_<?php echo $a_id; ?>" data-placement="top" title="" data-original-title="Delete"><span><i class="fa fa-trash"></i></span></button>
								</center>
							</td>
						</tr>
						<div class="modal fade" tabindex="-1" id="editDa_<?php echo $a_id; ?>">
							<div class="modal-dialog modal-lg">
								<div class="modal-content">
									<div class="modal-header">
										<h5 class="modal-title">Edit Tool</h5>
										<button type="button" class="close" data-dismiss="modal" aria-label="Close">
											<span aria-hidden="true">&times;</span>
										</button>
									</div>
									<form action="da_edit.php" method="post" enctype="multipart/form-data">
										<div class="modal-body">
											<input type="hidden" name="com_id" value="<?php echo $com_id; ?>">
											<input type="hidden" name="a_id" value="<?php echo $a_id; ?>">
											<div class="form-group">
												<div class="row">
													<div class="col">
														<label for="t_name">Name</label>
														<input class="form-control" id="t_name" type="text" name="a_name" value="<?php echo $da['a_name']; ?>">
													</div>
													<div class="col-5">
														<label for="p_spec">Brand/Type</label>
														<input class="form-control" id="p_standart" type="text" name="merk_type" value="<?php echo $da['merk_type']; ?>">
													</div>
												</div>
											</div>
											<div class="form-group">
												<div class="row">
													<div class="col-2">
														<label for="sp_tkdn">Quantity</label>
														<input class="form-control" id="sp_tkdn" type="number" max="100" min="0" name="jumlah" step="any" value="<?php echo $da['jumlah']; ?>">
													</div>
													<div class="col-3">
														<label for="p_spec">Production Year</label>
														<input class="form-control" id="p_standart" type="text" pattern="[0-9]{4}" title="format: yyyy" name="tahun_pembuatan" value="<?php echo $da['tahun_pembuatan']; ?>">
													</div>
													<div class="col">
														<label for="p_spec">Condition</label>
														<input class="form-control" id="p_standart" type="text" name="kondisi" value="<?php echo $da['kondisi']; ?>">
													</div>
												</div>
											</div>
											<div class="form-group">
												<label for="p_standart">Technical Description</label>
												<textarea class="form-control" id="p_spec" rows="2" name="tech_desc"><?php echo $da['tech_desc']; ?></textarea>
											</div>
											<div class="form-group">
												<div class="row">
													<div class="col">
														<label for="p_type">Ownership Status</label>
														<input class="form-control" id="p_standart" type="text" name="status_kepemilikan" value="<?php echo $da['status_kepemilikan']; ?>">
													</div>
													<div class="col-4">
														<label for="fileUpload">Attached file</label><br>
														<div class="custom-file">
															<input type="file" id="fileUpload" name="attached_file" class="custom-file-input">
															<label class="custom-file-label" for="fileUpload">Choose file</label>
														</div>
													</div>
												</div>
											</div>
										</div>
										<div class="modal-footer">
											<button type="submit" name="editDa" value="editDa" class="btn btn-primary">Submit</button>
											<button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
										</div>
									</form>
								</div>
							</div>
						</div>
						<div class="modal fade" tabindex="-1" id="deleteDa_<?php echo $a_id; ?>">
							<div class="modal-dialog modal-lg">
								<div class="modal-content">
									<div class="modal-header">
										<h5 class="modal-title">Delete Tool</h5>
										<button type="button" class="close" data-dismiss="modal" aria-label="Close">
											<span aria-hidden="true">&times;</span>
										</button>
									</div>
									<form action="da_delete.php" method="post" enctype="multipart/form-data">
										<div class="modal-body">
											<input type="hidden" name="com_id" value="<?php echo $com_id; ?>">
											<input type="hidden" name="a_id" value="<?php echo $a_id; ?>">
											<div class="row">
												<div style="float: left; width: 165px; margin-left: 15px;">
													<strong>Name</strong>
												</div>
												<div style="float: left; width: 20px; text-align: center;">
													:
												</div>
												<div class="col">
													<?php echo $da['a_name']; ?>
												</div>
											</div>
											<div class="row">
												<div style="float: left; width: 165px; margin-left: 15px;">
													<strong>Brand/Type</strong>
												</div>
												<div style="float: left; width: 20px; text-align: center;">
													:
												</div>
												<div class="col">
													<?php echo $da['merk_type']; ?>
												</div>
											</div>
											<div class="row">
												<div style="float: left; width: 165px; margin-left: 15px;">
													<strong>Quantity</strong>
												</div>
												<div style="float: left; width: 20px; text-align: center;">
													:
												</div>
												<div class="col">
													<?php echo $da['jumlah']; ?>
												</div>
											</div>
											<div class="row">
												<div style="float: left; width: 165px; margin-left: 15px;">
													<strong>Production Year</strong>
												</div>
												<div style="float: left; width: 20px; text-align: center;">
													:
												</div>
												<div class="col">
													<?php echo $da['tahun_pembuatan']; ?>
												</div>
											</div>
											<div class="row">
												<div style="float: left; width: 165px; margin-left: 15px;">
													<strong>Condition</strong>
												</div>
												<div style="float: left; width: 20px; text-align: center;">
													:
												</div>
												<div class="col">
													<?php echo $da['kondisi']; ?>
												</div>
											</div>
											<div class="row">
												<div style="float: left; width: 165px; margin-left: 15px;">
													<strong>Ownership Status</strong>
												</div>
												<div style="float: left; width: 20px; text-align: center;">
													:
												</div>
												<div class="col">
													<?php echo $da['status_kepemilikan']; ?>
												</div>
											</div>
											<div class="row">
												<div style="float: left; width: 165px; margin-left: 15px;">
													<strong>Technical Description</strong>
												</div>
												<div style="float: left; width: 20px; text-align: center;">
													:
												</div>
												<div class="col">
													<?php echo $da['tech_desc']; ?>
												</div>
											</div>
											<div style="margin-top: 5px;">
												Are you sure want to <strong>delete</strong> this data?
											</div>
										</div>
										<div class="modal-footer">
											<button type="submit" name="deleteA" value="deleteA" class="btn btn-primary">Yes</button>
											<button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
										</div>
									</form>
								</div>
							</div>
						</div>
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
			if ($exp_check == 'ok') {
			?>
			<div id="expDiv">
				<div>
					<h5 style="float: left;"><strong>Experience List</strong></h5>
					<button type="button" class="btn btn-primary btn-sm" style="margin-bottom: 6px; border-radius: 5px; padding: 5px 10px 5px 10px; float: right;" data-toggle="modal" data-target="#addExp"><span><i class="fa fa-plus"></i></span> Add Data</button>
				</div>
				<table class="table table-bordered table-sm" id="kpjTable">
					<thead>
						<tr>
							<th width="15%" style="vertical-align: middle;">Project Name</th>
							<th width="7%" style="vertical-align: middle;">Work Scope</th>
							<th width="15%" style="vertical-align: middle;">Location</th>
							<th width="5%" style="vertical-align: middle;">Year</th>
							<th width="15%" style="vertical-align: middle;">Client</th>
							<th width="9%" style="vertical-align: middle;">Project Fields</th>
							<th width="7%" style="vertical-align: middle;">Onshore/<br>Offshore</th>
							<th style="vertical-align: middle;">Capacity</th>
							<th width="10%" style="vertical-align: middle;">Project Value</th>
							<th width="7%" style="vertical-align: middle;" scope="col"><span><i class="fa fa-gears"></i></span> Action</th>
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
							<td style="text-align: right;"><?php echo $exp['p_cost']; ?></td>
							<td style="vertical-align: middle;">
								<center>
									<button type="button" class="btn btn-success btn-sm tooltip_btn" style="border-radius: 5px; padding: 5px 10px;" data-toggle="modal" data-target="#editExp_<?php echo $exp['p_id']; ?>" data-placement="top" title="" data-original-title="Edit"><span><i class="fa fa-pencil"></i></span></button>
									<button type="button" class="btn btn-danger btn-sm tooltip_btn" style="border-radius: 5px; padding: 5px 10px;" data-toggle="modal" data-target="#deleteExp_<?php echo $exp['p_id']; ?>" data-placement="top" title="" data-original-title="Delete"><span><i class="fa fa-trash"></i></span></button>
								</center>
							</td>
						</tr>
						<div class="modal fade" tabindex="-1" id="editExp_<?php echo $exp['p_id']; ?>">
							<div class="modal-dialog modal-lg">
								<div class="modal-content">
									<div class="modal-header">
										<h5 class="modal-title">Edit Experience List</h5>
										<button type="button" class="close" data-dismiss="modal" aria-label="Close">
											<span aria-hidden="true">&times;</span>
										</button>
									</div>
									<form action="exp_edit.php" method="post" enctype="multipart/form-data">
										<div class="modal-body">
											<input type="hidden" name="com_id" value="<?php echo $com_id; ?>">
											<input type="hidden" name="p_id" value="<?php echo $exp['p_id']; ?>">
											<div class="form-group">
												<label for="exp_p_name">Project Name</label>
												<textarea class="form-control" id="exp_p_name" rows="2" name="nama_proyek"><?php echo $exp['nama_proyek']; ?></textarea>
											</div>
											<div class="form-group">
												<label for="exp_client">Client</label>
												<input class="form-control" id="exp_client" type="text" name="client" value="<?php echo $exp['client']; ?>">
											</div>
											<div class="form-group">
												<div class="row">
													<div class="col-2">
														<label for="exp_year">Year</label>
														<input class="form-control" id="exp_year" type="text" pattern="[0-9]{4}" title="format: yyyy" name="periode" value="<?php echo $exp['periode']; ?>">
													</div>
													<div class="col-3">
														<label for="exp_ws">Work Scope</label>
														<input class="form-control" id="exp_ws" type="text" name="lingkup_pekerjaan" value="<?php echo $exp['lingkup_pekerjaan']; ?>">
													</div>
													<div class="col">
														<label for="exp_p_field">Project Fields</label>
														<input class="form-control" id="exp_p_field" type="text" name="p_field" value="<?php echo $exp['p_field']; ?>">
													</div>
												</div>
											</div>
											<div class="form-group">
												<div class="row">
													<div class="col">
														<label for="exp_loc">Location</label>
														<textarea class="form-control" id="exp_loc" rows="2" name="lokasi"><?php echo $exp['lokasi']; ?></textarea>
													</div>
													<div class="col-3">
														<label for="exp_on_off_shore">Onshore/Offshore</label>
														<select class="form-control custom-select" id="exp_on_off_shore" name="on_off_shore">
															<?php
															if ($exp['on_off_shore'] == 'Onshore') {
															?>
															<option selected="" value="Onshore">Onshore</option>
															<option value="Offshore">Offshore</option>
															<?php
															} elseif ($exp['on_off_shore'] == 'Offshore') {
															?>
															<option value="Onshore">Onshore</option>
															<option selected="" value="Offshore">Offshore</option>
															<?php
															} else {
															?>
															<option>Choose one</option>
															<option value="Onshore">Onshore</option>
															<option value="Offshore">Offshore</option>
															<?php
															}
															?>
														</select>
													</div>
												</div>
											</div>
											<div class="form-group">
												<div class="row">
													<div class="col">
														<label for="exp_capacity">Capacity</label>
														<input class="form-control" id="exp_capacity" type="text" name="capacity" value="<?php echo $exp['capacity']; ?>">
													</div>
													<div class="col-4">
														<label for="exp_value">Project Value</label>
														<input class="form-control" id="exp_value" type="text" name="p_cost" value="<?php echo $exp['p_cost']; ?>">
													</div>
												</div>
											</div>
										</div>
										<div class="modal-footer">
											<button type="submit" name="editExp" value="editExp" class="btn btn-primary">Submit</button>
											<button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
										</div>
									</form>
								</div>
							</div>
						</div>
						<div class="modal fade" tabindex="-1" id="deleteExp_<?php echo $exp['p_id']; ?>">
							<div class="modal-dialog modal-lg">
								<div class="modal-content">
									<div class="modal-header">
										<h5 class="modal-title">Delete Experience List</h5>
										<button type="button" class="close" data-dismiss="modal" aria-label="Close">
											<span aria-hidden="true">&times;</span>
										</button>
									</div>
									<form action="exp_delete.php" method="post" enctype="multipart/form-data">
										<div class="modal-body">
											<input type="hidden" name="com_id" value="<?php echo $com_id; ?>">
											<input type="hidden" name="p_id" value="<?php echo $exp['p_id']; ?>">
											<div class="row">
												<div style="float: left; width: 150px; margin-left: 15px;">
													<strong>Project Name</strong>
												</div>
												<div style="float: left; width: 20px; text-align: center;">
													:
												</div>
												<div class="col">
													<?php echo $exp['nama_proyek']; ?>
												</div>
											</div>
											<div class="row">
												<div style="float: left; width: 150px; margin-left: 15px;">
													<strong>Work Scope</strong>
												</div>
												<div style="float: left; width: 20px; text-align: center;">
													:
												</div>
												<div class="col">
													<?php echo $exp['lingkup_pekerjaan']; ?>
												</div>
											</div>
											<div class="row">
												<div style="float: left; width: 150px; margin-left: 15px;">
													<strong>Location</strong>
												</div>
												<div style="float: left; width: 20px; text-align: center;">
													:
												</div>
												<div class="col">
													<?php echo $exp['lokasi']; ?>
												</div>
											</div>
											<div class="row">
												<div style="float: left; width: 150px; margin-left: 15px;">
													<strong>Year</strong>
												</div>
												<div style="float: left; width: 20px; text-align: center;">
													:
												</div>
												<div class="col">
													<?php echo $exp['periode']; ?>
												</div>
											</div>
											<div class="row">
												<div style="float: left; width: 150px; margin-left: 15px;">
													<strong>Client</strong>
												</div>
												<div style="float: left; width: 20px; text-align: center;">
													:
												</div>
												<div class="col">
													<?php echo $exp['client']; ?>
												</div>
											</div>
											<div class="row">
												<div style="float: left; width: 150px; margin-left: 15px;">
													<strong>Project Fields</strong>
												</div>
												<div style="float: left; width: 20px; text-align: center;">
													:
												</div>
												<div class="col">
													<?php echo $exp['p_field']; ?>
												</div>
											</div>
											<div class="row">
												<div style="float: left; width: 150px; margin-left: 15px;">
													<strong>Onshore/Offshore</strong>
												</div>
												<div style="float: left; width: 20px; text-align: center;">
													:
												</div>
												<div class="col">
													<?php echo $exp['on_off_shore']; ?>
												</div>
											</div>
											<div class="row">
												<div style="float: left; width: 150px; margin-left: 15px;">
													<strong>Capacity</strong>
												</div>
												<div style="float: left; width: 20px; text-align: center;">
													:
												</div>
												<div class="col">
													<?php echo $exp['capacity']; ?>
												</div>
											</div>
											<div class="row">
												<div style="float: left; width: 150px; margin-left: 15px;">
													<strong>Project Value</strong>
												</div>
												<div style="float: left; width: 20px; text-align: center;">
													:
												</div>
												<div class="col">
													<?php echo $exp['p_cost']; ?>
												</div>
											</div>
											<div style="margin-top: 5px;">
												Are you sure want to <strong>delete</strong> this data?
											</div>
										</div>
										<div class="modal-footer">
											<button type="submit" name="delExp" value="delExp" class="btn btn-primary">Yes</button>
											<button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
										</div>
									</form>
								</div>
							</div>
						</div>
						<?php
							}
						} else{
							echo "<tr><td colspan='10'><center>No Data</center></td></tr>";
						}
						?>
					</tbody>
				</table>
			</div>
			<?php
			}
			if ($op_check == 'ok') {
			?>
			<div id="opDiv">
				<div>
					<h5 style="float: left;"><strong>Ongoing Project</strong></h5>
					<button type="button" class="btn btn-primary btn-sm" style="margin-bottom: 6px; border-radius: 5px; padding: 5px 10px 5px 10px; float: right;" data-toggle="modal" data-target="#addExp"><span><i class="fa fa-plus"></i></span> Add Data</button>
				</div>
				<table class="table table-bordered table-sm" id="kpjTable">
					<thead>
						<tr>
							<th width="15%" style="vertical-align: middle;">Project Name</th>
							<th width="7%" style="vertical-align: middle;">Work Scope</th>
							<th width="15%" style="vertical-align: middle;">Location</th>
							<th width="5%" style="vertical-align: middle;">Year</th>
							<th width="15%" style="vertical-align: middle;">Client</th>
							<th width="9%" style="vertical-align: middle;">Project Fields</th>
							<th width="7%" style="vertical-align: middle;">Onshore/<br>Offshore</th>
							<th style="vertical-align: middle;">Capacity</th>
							<th width="10%" style="vertical-align: middle;">Project Value</th>
							<th width="7%" style="vertical-align: middle;" scope="col"><span><i class="fa fa-gears"></i></span> Action</th>
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
							<td style="text-align: right;"><?php echo $op['p_cost']; ?></td>
							<td style="vertical-align: middle;">
								<center>
									<button type="button" class="btn btn-success btn-sm tooltip_btn" style="border-radius: 5px; padding: 5px 10px;" data-toggle="modal" data-target="#editExp_<?php echo $op['p_id']; ?>" data-placement="top" title="" data-original-title="Edit"><span><i class="fa fa-pencil"></i></span></button>
									<button type="button" class="btn btn-danger btn-sm tooltip_btn" style="border-radius: 5px; padding: 5px 10px;" data-toggle="modal" data-target="#deleteExp_<?php echo $op['p_id']; ?>" data-placement="top" title="" data-original-title="Delete"><span><i class="fa fa-trash"></i></span></button>
								</center>
							</td>
						</tr>
						<div class="modal fade" tabindex="-1" id="editExp_<?php echo $op['p_id']; ?>">
							<div class="modal-dialog modal-lg">
								<div class="modal-content">
									<div class="modal-header">
										<h5 class="modal-title">Edit Ongoing Project</h5>
										<button type="button" class="close" data-dismiss="modal" aria-label="Close">
											<span aria-hidden="true">&times;</span>
										</button>
									</div>
									<form action="exp_edit.php" method="post" enctype="multipart/form-data">
										<div class="modal-body">
											<input type="hidden" name="com_id" value="<?php echo $com_id; ?>">
											<input type="hidden" name="p_id" value="<?php echo $op['p_id']; ?>">
											<div class="form-group">
												<label for="exp_p_name">Project Name</label>
												<textarea class="form-control" id="exp_p_name" rows="2" name="nama_proyek"><?php echo $op['nama_proyek']; ?></textarea>
											</div>
											<div class="form-group">
												<label for="exp_client">Client</label>
												<input class="form-control" id="exp_client" type="text" name="client" value="<?php echo $op['client']; ?>">
											</div>
											<div class="form-group">
												<div class="row">
													<div class="col-2">
														<label for="exp_year">Year</label>
														<input class="form-control" id="exp_year" type="text" pattern="[0-9]{4}" title="format: yyyy" name="periode" value="<?php echo $op['periode']; ?>">
													</div>
													<div class="col-3">
														<label for="exp_ws">Work Scope</label>
														<input class="form-control" id="exp_ws" type="text" name="lingkup_pekerjaan" value="<?php echo $op['lingkup_pekerjaan']; ?>">
													</div>
													<div class="col">
														<label for="exp_p_field">Project Fields</label>
														<input class="form-control" id="exp_p_field" type="text" name="p_field" value="<?php echo $op['p_field']; ?>">
													</div>
												</div>
											</div>
											<div class="form-group">
												<div class="row">
													<div class="col">
														<label for="exp_loc">Location</label>
														<textarea class="form-control" id="exp_loc" rows="2" name="lokasi"><?php echo $op['lokasi']; ?></textarea>
													</div>
													<div class="col-3">
														<label for="exp_on_off_shore">Onshore/Offshore</label>
														<select class="form-control custom-select" id="exp_on_off_shore" name="on_off_shore">
															<?php
															if ($op['on_off_shore'] == 'Onshore') {
															?>
															<option selected="" value="Onshore">Onshore</option>
															<option value="Offshore">Offshore</option>
															<?php
															} elseif ($op['on_off_shore'] == 'Offshore') {
															?>
															<option value="Onshore">Onshore</option>
															<option selected="" value="Offshore">Offshore</option>
															<?php
															} else {
															?>
															<option>Choose one</option>
															<option value="Onshore">Onshore</option>
															<option value="Offshore">Offshore</option>
															<?php
															}
															?>
														</select>
													</div>
												</div>
											</div>
											<div class="form-group">
												<div class="row">
													<div class="col">
														<label for="exp_capacity">Capacity</label>
														<input class="form-control" id="exp_capacity" type="text" name="capacity" value="<?php echo $op['capacity']; ?>">
													</div>
													<div class="col-4">
														<label for="exp_value">Project Value</label>
														<input class="form-control" id="exp_value" type="text" name="p_cost" value="<?php echo $op['p_cost']; ?>">
													</div>
												</div>
											</div>
										</div>
										<div class="modal-footer">
											<button type="submit" name="editExp" value="editExp" class="btn btn-primary">Submit</button>
											<button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
										</div>
									</form>
								</div>
							</div>
						</div>
						<div class="modal fade" tabindex="-1" id="deleteExp_<?php echo $op['p_id']; ?>">
							<div class="modal-dialog modal-lg">
								<div class="modal-content">
									<div class="modal-header">
										<h5 class="modal-title">Delete Ongoing Project</h5>
										<button type="button" class="close" data-dismiss="modal" aria-label="Close">
											<span aria-hidden="true">&times;</span>
										</button>
									</div>
									<form action="exp_delete.php" method="post" enctype="multipart/form-data">
										<div class="modal-body">
											<input type="hidden" name="com_id" value="<?php echo $com_id; ?>">
											<input type="hidden" name="p_id" value="<?php echo $op['p_id']; ?>">
											<div class="row">
												<div style="float: left; width: 150px; margin-left: 15px;">
													<strong>Project Name</strong>
												</div>
												<div style="float: left; width: 20px; text-align: center;">
													:
												</div>
												<div class="col">
													<?php echo $op['nama_proyek']; ?>
												</div>
											</div>
											<div class="row">
												<div style="float: left; width: 150px; margin-left: 15px;">
													<strong>Work Scope</strong>
												</div>
												<div style="float: left; width: 20px; text-align: center;">
													:
												</div>
												<div class="col">
													<?php echo $op['lingkup_pekerjaan']; ?>
												</div>
											</div>
											<div class="row">
												<div style="float: left; width: 150px; margin-left: 15px;">
													<strong>Location</strong>
												</div>
												<div style="float: left; width: 20px; text-align: center;">
													:
												</div>
												<div class="col">
													<?php echo $op['lokasi']; ?>
												</div>
											</div>
											<div class="row">
												<div style="float: left; width: 150px; margin-left: 15px;">
													<strong>Year</strong>
												</div>
												<div style="float: left; width: 20px; text-align: center;">
													:
												</div>
												<div class="col">
													<?php echo $op['periode']; ?>
												</div>
											</div>
											<div class="row">
												<div style="float: left; width: 150px; margin-left: 15px;">
													<strong>Client</strong>
												</div>
												<div style="float: left; width: 20px; text-align: center;">
													:
												</div>
												<div class="col">
													<?php echo $op['client']; ?>
												</div>
											</div>
											<div class="row">
												<div style="float: left; width: 150px; margin-left: 15px;">
													<strong>Project Fields</strong>
												</div>
												<div style="float: left; width: 20px; text-align: center;">
													:
												</div>
												<div class="col">
													<?php echo $op['p_field']; ?>
												</div>
											</div>
											<div class="row">
												<div style="float: left; width: 150px; margin-left: 15px;">
													<strong>Onshore/Offshore</strong>
												</div>
												<div style="float: left; width: 20px; text-align: center;">
													:
												</div>
												<div class="col">
													<?php echo $op['on_off_shore']; ?>
												</div>
											</div>
											<div class="row">
												<div style="float: left; width: 150px; margin-left: 15px;">
													<strong>Capacity</strong>
												</div>
												<div style="float: left; width: 20px; text-align: center;">
													:
												</div>
												<div class="col">
													<?php echo $op['capacity']; ?>
												</div>
											</div>
											<div class="row">
												<div style="float: left; width: 150px; margin-left: 15px;">
													<strong>Project Value</strong>
												</div>
												<div style="float: left; width: 20px; text-align: center;">
													:
												</div>
												<div class="col">
													<?php echo $op['p_cost']; ?>
												</div>
											</div>
											<div style="margin-top: 5px;">
												Are you sure want to <strong>delete</strong> this data?
											</div>
										</div>
										<div class="modal-footer">
											<button type="submit" name="delExp" value="delExp" class="btn btn-primary">Yes</button>
											<button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
										</div>
									</form>
								</div>
							</div>
						</div>
						<?php
							}
						} else{
							echo "<tr><td colspan='10'><center>No Data</center></td></tr>";
						}
						?>
					</tbody>
				</table>
			</div>
			<?php
			}
			if ($tor_check == 'ok') {
			?>
			<div id="torDiv">
				<div>
					<h5 style="float: left;"><strong>Turn Over Revenue</strong></h5>
					<button type="button" class="btn btn-primary btn-sm" style="margin-bottom: 6px; border-radius: 5px; padding: 5px 10px 5px 10px; float: right;" data-toggle="modal" data-target="#newTor"><span><i class="fa fa-plus"></i></span> Add Data</button>
				</div>
				<table class="table table-bordered table-sm" id="torTable">
					<thead>
						<tr>
							<th width="7%" style="vertical-align: middle;">No</th>
							<th width="10%" style="vertical-align: middle;">Year</th>
							<th style="vertical-align: middle;">Project Value</th>
							<th width="7%" style="vertical-align: middle;" scope="col"><span><i class="fa fa-gears"></i></span> Action</th>
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
							<td style="vertical-align: middle;">
								<center>
									<button type="button" class="btn btn-success btn-sm tooltip_btn" style="border-radius: 5px; padding: 5px 10px;" data-toggle="modal" data-target="#editTor_<?php echo $tor['to_id']; ?>" data-placement="top" title="" data-original-title="Edit"><span><i class="fa fa-pencil"></i></span></button>
									<button type="button" class="btn btn-danger btn-sm tooltip_btn" style="border-radius: 5px; padding: 5px 10px;" data-toggle="modal" data-target="#deleteTor_<?php echo $tor['to_id']; ?>" data-placement="top" title="" data-original-title="Delete"><span><i class="fa fa-trash"></i></span></button>
								</center>
							</td>
						</tr>
						<div class="modal fade" tabindex="-1" id="editTor_<?php echo $tor['to_id']; ?>">
							<div class="modal-dialog">
								<div class="modal-content">
									<div class="modal-header">
										<h5 class="modal-title">Edit Turn Over Revenue</h5>
										<button type="button" class="close" data-dismiss="modal" aria-label="Close">
											<span aria-hidden="true">&times;</span>
										</button>
									</div>
									<form action="tor_edit.php" method="post" enctype="multipart/form-data">
										<div class="modal-body">
											<input type="hidden" name="com_id" value="<?php echo $com_id; ?>">
											<input type="hidden" name="to_id" value="<?php echo $tor['to_id']; ?>">
											<div class="form-group">
												<div class="row">
													<div class="col-3">
														<label for="tor_year">Year</label>
														<input class="form-control" id="tor_year" type="text" pattern="[0-9]{4}" title="format: yyyy" name="to_year" value="<?php echo $tor['to_year']; ?>">
													</div>
													<div class="col">
														<label for="tor_pv">Project Value</label>
														<input class="form-control" id="tor_pv" type="text" name="to_value" value="<?php echo $tor['to_value']; ?>">
													</div>
												</div>
											</div>
										</div>
										<div class="modal-footer">
											<button type="submit" name="editTor" value="editTor" class="btn btn-primary">Submit</button>
											<button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
										</div>
									</form>
								</div>
							</div>
						</div>
						<div class="modal fade" tabindex="-1" id="deleteTor_<?php echo $tor['to_id']; ?>">
							<div class="modal-dialog">
								<div class="modal-content">
									<div class="modal-header">
										<h5 class="modal-title">Delete Turn Over Revenue</h5>
										<button type="button" class="close" data-dismiss="modal" aria-label="Close">
											<span aria-hidden="true">&times;</span>
										</button>
									</div>
									<form action="tor_delete.php" method="post" enctype="multipart/form-data">
										<div class="modal-body">
											<input type="hidden" name="com_id" value="<?php echo $com_id; ?>">
											<input type="hidden" name="to_id" value="<?php echo $tor['to_id']; ?>">
											<div class="row">
												<div style="float: left; width: 110px; margin-left: 15px;">
													<strong>Year</strong>
												</div>
												<div style="float: left; width: 20px; text-align: center;">
													:
												</div>
												<div class="col">
													<?php echo $tor['to_year']; ?>
												</div>
											</div>
											<div class="row">
												<div style="float: left; width: 110px; margin-left: 15px;">
													<strong>Project Value</strong>
												</div>
												<div style="float: left; width: 20px; text-align: center;">
													:
												</div>
												<div class="col">
													<?php echo $tor['to_value']; ?>
												</div>
											</div>
											<div style="margin-top: 5px;">
												Are you sure want to <strong>delete</strong> this data?
											</div>
										</div>
										<div class="modal-footer">
											<button type="submit" name="torDel" value="torDel" class="btn btn-primary">Yes</button>
											<button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
										</div>
									</form>
								</div>
							</div>
						</div>
						<?php
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
			if ($additional_table == 'ok') {
			?>
			<div id="add_div">
				<div>
					<h5 style="float: left;"><strong>Additional Detail</strong></h5>
					<button type="button" class="btn btn-primary btn-sm" style="margin-bottom: 6px; border-radius: 5px; padding: 5px 10px 5px 10px; float: right;" data-toggle="modal" data-target="#add_ad"><span><i class="fa fa-plus"></i></span> Add Data</button>
				</div>
				<table class="table table-bordered table-sm" id="add_table">
					<thead>
						<tr>
							<th width="20%" style="vertical-align: middle;">Item</th>
							<th style="vertical-align: middle;">Description</th>
							<th width="7%" style="vertical-align: middle;" scope="col"><span><i class="fa fa-gears"></i></span> Action</th>
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
							<td style="vertical-align: middle;">
								<center>
									<button type="button" class="btn btn-success btn-sm tooltip_btn" style="border-radius: 5px; padding: 5px 10px;" data-toggle="modal" data-target="#edit_ad_<?php echo $add_det['ad_id']; ?>" data-placement="top" title="" data-original-title="Edit"><span><i class="fa fa-pencil"></i></span></button>
									<button type="button" class="btn btn-danger btn-sm tooltip_btn" style="border-radius: 5px; padding: 5px 10px;" data-toggle="modal" data-target="#delete_ad_<?php echo $add_det['ad_id']; ?>" data-placement="top" title="" data-original-title="Delete"><span><i class="fa fa-trash"></i></span></button>
								</center>
							</td>
						</tr>
						<div class="modal fade" tabindex="-1" id="edit_ad_<?php echo $add_det['ad_id']; ?>">
							<div class="modal-dialog modal-lg">
								<div class="modal-content">
									<div class="modal-header">
										<h5 class="modal-title">Edit Additional Detail</h5>
										<button type="button" class="close" data-dismiss="modal" aria-label="Close">
											<span aria-hidden="true">&times;</span>
										</button>
									</div>
									<form action="ad_edit.php" method="post" enctype="multipart/form-data">
										<div class="modal-body">
											<input type="hidden" name="com_id" value="<?php echo $com_id; ?>">
											<input type="hidden" name="ad_id" value="<?php echo $add_det['ad_id']; ?>">
											<div class="form-group">
												<label for="ad_item">Item</label>
												<input class="form-control" id="ad_item" type="text" name="item" value="<?php echo $add_det['item']; ?>">
											</div>
											<div class="form-group">
												<label for="ad_desc">Description</label>
												<textarea class="form-control" id="ad_desc" rows="2" name="description"><?php echo $add_det['description']; ?></textarea>
											</div>
										</div>
										<div class="modal-footer">
											<button type="submit" name="editAd" value="editAd" class="btn btn-primary">Submit</button>
											<button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
										</div>
									</form>
								</div>
							</div>
						</div>
						<div class="modal fade" tabindex="-1" id="delete_ad_<?php echo $add_det['ad_id']; ?>">
							<div class="modal-dialog modal-lg">
								<div class="modal-content">
									<div class="modal-header">
										<h5 class="modal-title">Delete Additional Detail</h5>
										<button type="button" class="close" data-dismiss="modal" aria-label="Close">
											<span aria-hidden="true">&times;</span>
										</button>
									</div>
									<form action="ad_delete.php" method="post" enctype="multipart/form-data">
										<div class="modal-body">
											<input type="hidden" name="com_id" value="<?php echo $com_id; ?>">
											<input type="hidden" name="ad_id" value="<?php echo $add_det['ad_id']; ?>">
											<div class="row">
												<div style="float: left; width: 100px; margin-left: 15px;">
													<strong>Item</strong>
												</div>
												<div style="float: left; width: 20px; text-align: center;">
													:
												</div>
												<div class="col">
													<?php echo $add_det['item']; ?>
												</div>
											</div>
											<div class="row">
												<div style="float: left; width: 100px; margin-left: 15px;">
													<strong>Description</strong>
												</div>
												<div style="float: left; width: 20px; text-align: center;">
													:
												</div>
												<div class="col">
													<?php echo $add_det['description']; ?>
												</div>
											</div>
											<div style="margin-top: 5px;">
												Are you sure want to <strong>delete</strong> this data?
											</div>
										</div>
										<div class="modal-footer">
											<button type="submit" name="ad_del" value="ad_del" class="btn btn-primary">Yes</button>
											<button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
										</div>
									</form>
								</div>
							</div>
						</div>
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
			?>
		</fieldset>
	</div>
	
	<div class="modal fade" tabindex="-1" id="editModal">
		<div class="modal-dialog modal-lg">
			<div class="modal-content">
				<div class="modal-header">
					<h4 class="modal-title">Edit Company Data</h4>
					<button type="button" class="close" data-dismiss="modal">&times;</button>
				</div>
				<form method="post" action="com_update.php" enctype="multipart/form-data">
					<div class="modal-body">
						<fieldset>
							<input type="hidden" name="com_id" value="<?php echo $com_id; ?>">
							<div class="form-group">
								<div class="row">
									<div class="col">
										<label for="com_name_form"><strong>Company Name</strong></label>
										<input class="form-control" id="com_name_form" type="text" name="com_name" required="" value="<?php echo $result['com_name']; ?>">
									</div>
									<div class="col">
										<label for="bs_form"><strong>Bussiness Services</strong></label>
										<select class="form-control custom-select" id="bs_form" name="bs_id">
											<?php
											$qbs = "SELECT * FROM bussiness_services;";
											$qbsrun = mysqli_query($conn,$qbs);
											while ($bs = mysqli_fetch_assoc($qbsrun)) {
												if ($bs['bs_id'] == $result['bs_id']) {
											?>
												<option selected="" value='<?php echo $bs['bs_id']; ?>'><?php echo $bs['bs_name']; ?></option>
											<?php
												}else{
											?>
												<option value='<?php echo $bs['bs_id']; ?>'><?php echo $bs['bs_name']; ?></option>
											<?php
												}
											}
											?>
										</select>
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col">
									<div class="form-group">
										<label for="com_email_form"><strong>Email</strong></label>
										<input class="form-control" id="com_email_form" type="text" name="com_email" value="<?php echo $result['com_email']; ?>">
									</div>
									<div class="form-group">
										<label for="com_web_form"><strong>Website</strong></label>
										<input class="form-control" id="com_web_form" type="text" name="com_website" value="<?php echo $result['com_website']; ?>">
									</div>
								</div>
								<div class="col">
									<div class="form-group">
										<label><strong>Bussiness Fields</strong></label>
										<div class="row">
											<?php
											$qallbf = "SELECT * FROM bussiness_fields;";
											$qallbfrun = mysqli_query($conn,$qallbf);
											while ($allbf = mysqli_fetch_assoc($qallbfrun)) {
												$idbf = $allbf['bf_id'];
											?>
											<div class="col-6" style="padding-right: 0;">
												<?php
												if ($thisbf[$idbf] == "checked") {
												?>
												<div class="custom-control custom-checkbox">
													<input class="custom-control-input" id="customCheck<?php echo $allbf['bf_id']; ?>" checked="" type="checkbox" name="com_bf[]" value="<?php echo $allbf['bf_id']; ?>">
													<label class="custom-control-label" for="customCheck<?php echo $allbf['bf_id']; ?>"><?php echo $allbf['bf_name']; ?></label>
												</div>
												<?php
												} else {
												?>
												<div class="custom-control custom-checkbox">
													<input class="custom-control-input" id="customCheck<?php echo $allbf['bf_id']; ?>" type="checkbox" name="com_bf[]" value="<?php echo $allbf['bf_id']; ?>">
													<label class="custom-control-label" for="customCheck<?php echo $allbf['bf_id']; ?>"><?php echo $allbf['bf_name']; ?></label>
												</div>
												<?php
												}
												?>
											</div>
											<?php
											}
											?>
										</div>
									</div>
								</div>
							</div>
							<div class="form-group">
								<div>
									<label for="com_addr_form"><strong>Head Office Addres</strong></label>
									<textarea class="form-control" id="com_addr_form" rows="2" name="com_address"><?php echo $result['com_address']; ?></textarea>
								</div>
								<div class="row">
									<div class="col">
										<label for="ocity_from">City</label>
										<input class="form-control" id="ocity_form" type="text" name="com_city" value="<?php echo $result['com_city']; ?>">
									</div>
									<div class="col">
										<label for="pcode_form">Postal Code</label>
										<input class="form-control" id="pcode_form" type="text" name="com_postal_code" value="<?php echo $result['com_postal_code']; ?>">
									</div>
									<div class="col">
										<label for="ocountry_form">Country</label>
										<input class="form-control" id="ocountry_form" type="text" name="com_country" value="<?php echo $result['com_country']; ?>">
									</div>
								</div>
								<div class="row">
									<div class="col">
										<label for="com_phone_form">Phone</label>
										<input class="form-control" id="com_phone_form" type="text" name="com_phone" value="<?php echo $result['com_phone']; ?>" placeholder="format: +[country code] [area code]-[phone number]">
									</div>
									<div class="col">
										<label for="com_fax">Fax</label>
										<input class="form-control" id="com_fax" type="text" name="com_fax" value="<?php echo $result['com_fax']; ?>" placeholder="format: +[country code] [area code]-[phone number]">
									</div>
								</div>
							</div>
							<div class="form-group">
								<div>
									<label for="com_addr_form"><strong>Plant Addres</strong></label>
									<textarea class="form-control" id="com_addr_form" rows="2" name="plant_address"><?php echo $result['plant_address']; ?></textarea>
								</div>
								<div class="row">
									<div class="col">
										<label for="plant_city">City</label>
										<input class="form-control" id="plant_city" type="text" name="plant_city" value="<?php echo $result['plant_city']; ?>">
									</div>
									<div class="col">
										<label for="plant_postal_code">Postal Code</label>
										<input class="form-control" id="plant_postal_code" type="text" name="plant_postal_code" value="<?php echo $result['plant_postal_code']; ?>">
									</div>
									<div class="col">
										<label for="plant_country">Country</label>
										<input class="form-control" id="plant_country" type="text" name="plant_country" value="<?php echo $result['plant_country']; ?>">
									</div>
								</div>
								<div class="row">
									<div class="col">
										<label for="plant_phone">Phone</label>
										<input class="form-control" id="plant_phone" type="text" name="plant_phone" value="<?php echo $result['plant_phone']; ?>" placeholder="format: +[country code] [area code]-[phone number]">
									</div>
									<div class="col">
										<label for="plant_fax">Fax</label>
										<input class="form-control" id="plant_fax" type="text" name="plant_fax" value="<?php echo $result['plant_fax']; ?>" placeholder="format: +[country code] [area code]-[phone number]">
									</div>
								</div>
							</div>
							<div class="form-group">
								<label><strong>NPWP</strong></label>
								<div class="row" style="margin-left: 1px; margin-right: 1px;">
									<?php
									$npwpmentah = $result['npwp'];
									$npwp1 = substr($npwpmentah, 0, 2);
									$npwp2 = substr($npwpmentah, 3, 3);
									$npwp3 = substr($npwpmentah, 7, 3);
									$npwp4 = substr($npwpmentah, 11, 1);
									$npwp5 = substr($npwpmentah, 13, 3);
									$npwp6 = substr($npwpmentah, 17, 3);
									?>
									<input class="form-control" style="width: 10%; text-align: center;" id="npwp1" type="text" pattern="[0-9]{2}" title="Two-digit number" maxlength="2" name="npwp1" value="<?php echo $npwp1; ?>">
									<span style="width: 5%;"><center>.</center></span>
									<input class="form-control" style="width: 15%; text-align: center;" id="npwp2" type="text" pattern="[0-9]{3}" title="Three-digit number" maxlength="3" name="npwp2" value="<?php echo $npwp2; ?>">
									<span style="width: 5%;"><center>.</center></span>
									<input class="form-control" style="width: 15%; text-align: center;" id="npwp3" type="text" pattern="[0-9]{3}" title="Three-digit number" maxlength="3" name="npwp3" value="<?php echo $npwp3; ?>">
									<span style="width: 5%;"><center>.</center></span>
									<input class="form-control" style="width: 5%; text-align: center;" id="npwp4" type="text" pattern="[0-9]{1}" title="One-digit number" maxlength="1" name="npwp4" value="<?php echo $npwp4; ?>">
									<span style="width: 5%;"><center>_</center></span>
									<input class="form-control" style="width: 15%; text-align: center;" id="npwp5" type="text" pattern="[0-9]{3}" title="Three-digit number" maxlength="3" name="npwp5" value="<?php echo $npwp5; ?>">
									<span style="width: 5%;"><center>.</center></span>
									<input class="form-control" style="width: 15%; text-align: center;" id="npwp6" type="text" pattern="[0-9]{3}" title="Three-digit number" maxlength="3" name="npwp6" value="<?php echo $npwp6; ?>">
								</div>
							</div>
							<div class="form-group">
								<label for="com_name_form"><strong>Notarial Deed of Establish</strong></label><br>
								Akta Pendirian Perusahaan No. <input style="width: 55px;" type="number" min="0" name="akta_awal_no" value="<?php echo $result['akta_awal_no']; ?>"> tanggal <input type="date" min="0" name="akta_awal_tgl" value="<?php echo $result['akta_awal_tgl']; ?>"> oleh <input type="text" min="0" name="akta_awal_notaris" value="<?php echo $result['akta_awal_notaris']; ?>"> di <input style="width: 80px;" type="text" min="0" name="akta_awal_kota" value="<?php echo $result['akta_awal_kota']; ?>">
							</div>
							<div class="form-group">
								<label for="com_name_form"><strong>Notarial Deed of Change</strong></label><br>
								Akta Perubahan Terakhir No. <input style="width: 55px;" type="number" min="0" name="akta_akhir_no" value="<?php echo $result['akta_akhir_no']; ?>"> tanggal <input type="date" min="0" name="akta_akhir_tgl" value="<?php echo $result['akta_akhir_tgl']; ?>"> oleh <input type="text" min="0" name="akta_akhir_notaris" value="<?php echo $result['akta_akhir_notaris']; ?>"> di <input style="width: 80px;" type="text" min="0" name="akta_akhir_kota" value="<?php echo $result['akta_akhir_kota']; ?>">
							</div>
							<div class="form-group">
								<div class="row">
									<div class="col">
										<label for="org_chart_form">Organization Chart</label><br>
										<div class="custom-file">
											<input class="custom-file-input" id="org_chart_form" type="file" name="org_chart">
											<label class="custom-file-label" for="org_chart_form">Choose file</label>
										</div>
									</div>
									<div class="col">
										<label for="finance_cap">Financial Capability</label><br>
										<div class="custom-file">
											<input class="custom-file-input" id="finance_cap" type="file" name="finance_capability">
											<label class="custom-file-label" for="finance_cap">Choose file</label>
										</div>
									</div>
								</div>
							</div>
							<div class="form-group">
								<label><strong>Director Composition</strong></label>
								<div data-role="dynamic-fields">
									<?php
									$qdirnya = "SELECT * FROM personal WHERE com_id = '$com_id' AND per_dir>0 ORDER BY per_dir ASC;";
									$qdirnyar = mysqli_query($conn,$qdirnya);
									while ($dirnya = mysqli_fetch_assoc($qdirnyar)) {
									?>
									<div class="form-inline">
										<input class="form-control" style="float: left; width: 50%;" type="text" name="dir_name[]" placeholder="Name" value="<?php echo $dirnya['per_full_name']; ?>">
										<span style="width: 5%; text-align: center;">as</span>
										<input class="form-control" style="float: left; width: 40%;" type="text" name="dir_position[]" placeholder="Position" value="<?php echo $dirnya['per_position']; ?>">
										<div style="width: 5%; align-items: right;">
											<button class="btn btn-danger" data-role="remove">
												<span><i class="fa fa-remove"></i></span>
											</button>
											<button class="btn btn-primary" data-role="add">
												<span><i class="fa fa-plus"></i></span>
											</button>
										</div>
									</div>
									<?php
									}
									?>
									<div class="form-inline">
										<input class="form-control" style="float: left; width: 50%;" type="text" name="dir_name[]" placeholder="Name">
										<span style="width: 5%; text-align: center;">as</span>
										<input class="form-control" style="float: left; width: 40%;" type="text" name="dir_position[]" placeholder="Position">
										<div style="width: 5%; align-items: right;">
											<button class="btn btn-danger" data-role="remove">
												<span><i class="fa fa-remove"></i></span>
											</button>
											<button class="btn btn-primary" data-role="add">
												<span><i class="fa fa-plus"></i></span>
											</button>
										</div>
									</div>
								</div>
							</div>
							<div class="form-group">
								<label><strong>Shareholder</strong></label>
								<div class="row">
									<div class="col">
										<div class="row">
											<div class="col">
												<label for="saham_indo">- National Shareholder (%)</label>
											</div>
											<div class="col-1" style="text-align: center;">:</div>
											<div class="col-4">
												<input class="form-control" onkeyup="psi()" onchange="psi()" id="saham_indo" type="number" max="100" min="0" name="saham_indo" step="any" value="<?php echo $result['saham_indo']; ?>">
											</div>
										</div>
									</div>
									<div class="col">
										<div class="row">
											<div class="col">
												<label for="saham_indo">- Foreign Shareholder (%)</label>
											</div>
											<div class="col-1" style="text-align: center;">:</div>
											<div class="col-4">
												<input class="form-control" onkeyup="psa()" onchange="psa()" id="saham_asing" type="number" max="100" min="0" name="saham_asing" step="any" value="<?php echo $result['saham_asing']; ?>">
											</div>
										</div>
									</div>
								</div>
							</div>
						</fieldset>
					</div>
					<div class="modal-footer">
						<button type="submit" class="btn btn-primary" name="update">Submit</button>
						<button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
					</div>
				</form>
			</div>
		</div>
	</div>
	<div class="modal fade" tabindex="-1" id="deleteModal">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title">Warning!</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					<p>Are you sure want to delete this data?</p>
				</div>
				<div class="modal-footer">
					<button type="button" onclick="window.location.href = 'com_delete?com_id=<?php echo $com_id; ?>';" class="btn btn-primary">Yes</button>
					<button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
				</div>
			</div>
		</div>
	</div>
	<div class="modal fade" tabindex="-1" id="printModal">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title">Select print section</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<form action="com_print" method="post" onsubmit="new_windows(this)" enctype="multipart/form-data">
					<div class="modal-body">
						<input type="hidden" name="com_id" value="<?php echo $com_id; ?>">
						Select detail table that you want to print
						<br><br>
						<div class="row">
							<div class="col">
								<input class="custom-control-input" id="gi_check" checked="" type="checkbox" name="gi_check" disabled="" value="ok" hidden="">
								<?php
								if ($ccl_check == 'ok') {
								?>
								<div class="custom-control custom-checkbox">
									<input class="custom-control-input" id="ccl_check" checked="" type="checkbox" name="ccl_check" value="ok">
									<label class="custom-control-label" for="ccl_check">Corporate Certificate/License</label>
								</div>
								<?php
								}
								if ($bs_id == 3 && $lp_check == 'ok') {
								?>
								<div class="custom-control custom-checkbox">
									<input class="custom-control-input" id="lp_check" checked="" type="checkbox" name="lp_check" value="ok">
									<label class="custom-control-label" for="lp_check">Licensed Processes</label>
								</div>
								<?php
								}
								if ($ps_check == 'ok') {
								?>
								<div class="custom-control custom-checkbox">
									<input class="custom-control-input" id="ps_check" checked="" type="checkbox" name="ps_check" value="ok">
									<label class="custom-control-label" for="ps_check">Product Spesification</label>
								</div>
								<?php
								}
								if ($bs_id != 2 && $bs_id !=3 && $ec_check == 'ok') {
								?>
								<div class="custom-control custom-checkbox">
									<input class="custom-control-input" id="ec_check" checked="" type="checkbox" name="ec_check" value="ok">
									<label class="custom-control-label" for="ec_check">Employee Composition</label>
								</div>
								<?php
								}
								if ($da_check == 'ok') {
								?>
								<div class="custom-control custom-checkbox">
									<input class="custom-control-input" id="da_check" checked="" type="checkbox" name="da_check" value="ok">
									<label class="custom-control-label" for="da_check">Tools</label>
								</div>
								<?php
								}
								?>
							</div>
							<div class="col">
								<?php
								if ($exp_check == 'ok') {
								?>
								<div class="custom-control custom-checkbox">
									<input class="custom-control-input" id="exp_check" checked="" type="checkbox" name="exp_check" value="ok">
									<label class="custom-control-label" for="exp_check">Experience List</label>
								</div>
								<?php
								}
								if ($op_check == 'ok') {
								?>
								<div class="custom-control custom-checkbox">
									<input class="custom-control-input" id="op_check" checked="" type="checkbox" name="op_check" value="ok">
									<label class="custom-control-label" for="op_check">Ongoing Project</label>
								</div>
								<?php
								}
								if ($tor_check == 'ok') {
								?>
								<div class="custom-control custom-checkbox">
									<input class="custom-control-input" id="tor_check" checked="" type="checkbox" name="tor_check" value="ok">
									<label class="custom-control-label" for="tor_check">Turn Over Revenue</label>
								</div>
								<?php
								}
								if ($additional_table == 'ok') {
								?>
								<div class="custom-control custom-checkbox">
									<input class="custom-control-input" id="additional_table" checked="" type="checkbox" name="additional_table" value="ok">
									<label class="custom-control-label" for="additional_table">Additional Detail</label>
								</div>
								<?php
								}
								?>
							</div>
						</div>
					</div>
					<div class="modal-footer">
						<button type="submit" name="section" value="section" class="btn btn-primary">Print</button>
						<button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
					</div>
				</form>
			</div>
		</div>
	</div>
	<div class="modal fade" tabindex="-1" id="importModal">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title">Add Company Detail</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<form action="com_import_detail.php" method="post" enctype="multipart/form-data">
					<div class="modal-body">
						<strong>Download template file, add data of this company, then submit the file.</strong>
						<br><br>
						<input type="hidden" name="com_id" value="<?php echo $com_id; ?>">
						<input type="hidden" name="bs_id" value="<?php echo $bs_id; ?>">
						<div class="form-group">
							<div class="input-group mb-3">
								<div class="custom-file">
									<input type="file" id="fileImport" name="fileExcel" class="custom-file-input" accept="application/vnd.ms-excel">
									<label class="custom-file-label" for="fileImport">Choose file</label>
								</div>
							</div>
							<a href="file/template/template_company_details.xls" download="">Downlaod template file</a>
							<small id="fileHelp" class="form-text text-muted" style="float: right;">File must be .xls (Excel 97-2003)</small>
						</div>
					</div>
					<div class="modal-footer">
						<button type="submit" name="submit_detail" value="Import" class="btn btn-primary">Submit</button>
						<button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
					</div>
				</form>
			</div>
		</div>
	</div>
	<div class="modal fade" tabindex="-1" id="addCer">
		<div class="modal-dialog modal-lg">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title">Add New Certificate/License</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<form action="certif_add.php" method="post" enctype="multipart/form-data">
					<div class="modal-body">
						<input type="hidden" name="com_id" value="<?php echo $com_id; ?>">
						<div class="form-group">
							<label for="cname_form">Certification/License Name</label>
							<input class="form-control" id="cname_form" type="text" name="c_name">
						</div>
						<div class="form-group">
							<div class="row">
								<div class="col-7">
									<label for="c_class_form">Classification</label>
									<textarea class="form-control" id="c_class_form" rows="4" name="c_classification"></textarea>
								</div>
								<div class="col">
									<div class="form-group">
										<label for="c_code_form">Code</label>
										<input class="form-control" id="c_code_form" type="text" name="c_code">
									</div>
									<div class="form-group">
										<label for="c_qual_form">Qualification</label>
										<input class="form-control" id="c_qual_form" type="text" name="c_qualification">
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="modal-footer">
						<button type="submit" name="addCertif" value="addCertif" class="btn btn-primary">Submit</button>
						<button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
					</div>
				</form>
			</div>
		</div>
	</div>
	<div class="modal fade" tabindex="-1" id="addLp">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title">Add New Licensed Process</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<form action="licensed_proc_add.php" method="post" enctype="multipart/form-data">
					<div class="modal-body">
						<input type="hidden" name="com_id" value="<?php echo $com_id; ?>">
						<div class="form-group">
							<label for="lname_form">Process Name</label>
							<input class="form-control" id="lname_form" type="text" name="l_process">
						</div>
						<div class="form-group">
							<label for="bs_form">Bussiness Field</label>
							<select class="form-control custom-select" id="bs_form" name="bf_id">
								<option value="">Choose Bussiness Field</option>
								<?php
								$qbfaddLP = "SELECT * FROM bussiness_fields;";
								$qbfaddLPr = mysqli_query($conn,$qbfaddLP);
								while ($bfalp = mysqli_fetch_assoc($qbfaddLPr)) {
								?>
									<option value='<?php echo $bfalp['bf_id']; ?>'><?php echo $bfalp['bf_name']; ?></option>
								<?php
								}
								?>
							</select>
						</div>
					</div>
					<div class="modal-footer">
						<button type="submit" name="newLP" value="newLP" class="btn btn-primary">Submit</button>
						<button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
					</div>
				</form>
			</div>
		</div>
	</div>
	<div class="modal fade" tabindex="-1" id="psAdd">
		<div class="modal-dialog modal-lg">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title">Add New Product Spesification</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<form action="product_spec_add.php" method="post" enctype="multipart/form-data">
					<div class="modal-body">
						<input type="hidden" name="com_id" value="<?php echo $com_id; ?>">
						<div class="form-group">
							<label for="p_name">Product Name</label>
							<input class="form-control" id="p_name" type="text" name="hasil_produksi">
						</div>
						<div class="form-group">
							<div class="row">
								<div class="col">
									<label for="p_type">Product Type</label>
									<textarea class="form-control" id="p_type" rows="4" name="jenis_produksi"></textarea>
								</div>
								<div class="col">
									<label for="p_spec">Spesification</label>
									<textarea class="form-control" id="p_spec" rows="4" name="spesifikasi"></textarea>
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col">
								<div class="form-group">
									<label for="p_standart">Product Standart</label>
									<input class="form-control" id="p_standart" type="text" name="standar_produk">
								</div>
								<div class="form-group">
									<label for="p_certif">Product Certificate</label>
									<input class="form-control" id="p_certif" type="text" name="sertifikat">
								</div>
							</div>
							<div class="col-4">
								<div class="form-group">
									<label for="sp_tkdn">TKDN(%)</label>
									<input class="form-control" id="sp_tkdn" type="number" max="100" min="0" name="tkdn" step="any">
								</div>
								<div class="form-group">
									<label for="l_name_form">Capacity</label>
									<input class="form-control" id="l_name_form" type="text" name="kapasitas">
								</div>
							</div>
						</div>
					</div>
					<div class="modal-footer">
						<button type="submit" name="newSP" value="newSP" class="btn btn-primary">Submit</button>
						<button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
					</div>
				</form>
			</div>
		</div>
	</div>
	<div class="modal fade" tabindex="-1" id="addDa">
		<div class="modal-dialog modal-lg">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title">Add New Tool</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<form action="da_add.php" method="post" enctype="multipart/form-data">
					<div class="modal-body">
						<input type="hidden" name="com_id" value="<?php echo $com_id; ?>">
						<div class="form-group">
							<div class="row">
								<div class="col">
									<label for="t_name">Name</label>
									<input class="form-control" id="t_name" type="text" name="a_name">
								</div>
								<div class="col-5">
									<label for="p_spec">Brand/Type</label>
									<input class="form-control" id="p_standart" type="text" name="merk_type">
								</div>
							</div>
						</div>
						<div class="form-group">
							<div class="row">
								<div class="col-2">
									<label for="sp_tkdn">Quantity</label>
									<input class="form-control" id="sp_tkdn" type="number" max="100" min="0" name="jumlah" step="any">
								</div>
								<div class="col-3">
									<label for="p_spec">Production Year</label>
									<input class="form-control" id="p_standart" type="text" pattern="[0-9]{4}" title="format: yyyy" name="tahun_pembuatan">
								</div>
								<div class="col">
									<label for="p_spec">Condition</label>
									<input class="form-control" id="p_standart" type="text" name="kondisi">
								</div>
							</div>
						</div>
						<div class="form-group">
							<label for="p_standart">Technical Description</label>
							<textarea class="form-control" id="p_spec" rows="2" name="tech_desc"></textarea>
						</div>
						<div class="form-group">
							<div class="row">
								<div class="col">
									<label for="p_type">Ownership Status</label>
									<input class="form-control" id="p_standart" type="text" name="status_kepemilikan">
								</div>
								<div class="col-4">
									<label for="fileUpload">Attached file</label><br>
									<div class="custom-file">
										<input type="file" id="fileUpload" name="attached_file" class="custom-file-input">
										<label class="custom-file-label" for="fileUpload">Choose file</label>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="modal-footer">
						<button type="submit" name="newA" value="newA" class="btn btn-primary">Submit</button>
						<button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
					</div>
				</form>
			</div>
		</div>
	</div>
	<div class="modal fade" tabindex="-1" id="addExp">
		<div class="modal-dialog modal-lg">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title">Add New Project</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<form action="exp_add.php" method="post" enctype="multipart/form-data">
					<div class="modal-body">
						<input type="hidden" name="com_id" value="<?php echo $com_id; ?>">
						<div class="form-group">
							<label for="exp_p_name">Project Name</label>
							<textarea class="form-control" id="exp_p_name" rows="2" name="nama_proyek"></textarea>
						</div>
						<div class="form-group">
							<label for="exp_client">Client</label>
							<input class="form-control" id="exp_client" type="text" name="client">
						</div>
						<div class="form-group">
							<div class="row">
								<div class="col-2">
									<label for="exp_year">Year</label>
									<input class="form-control" id="exp_year" type="text" pattern="[0-9]{4}" title="format: yyyy" name="periode">
								</div>
								<div class="col-3">
									<label for="p_status">Status</label>
									<select class="form-control custom-select" id="p_status" name="p_status">
										<option>Choose status</option>
										<option value="finish">Finish</option>
										<option value="ongoing">Ongoing</option>
									</select>
								</div>
								<div class="col-3">
									<label for="exp_ws">Work Scope</label>
									<input class="form-control" id="exp_ws" type="text" name="lingkup_pekerjaan">
								</div>
								<div class="col">
									<label for="exp_p_field">Project Fields</label>
									<input class="form-control" id="exp_p_field" type="text" name="p_field">
								</div>
							</div>
						</div>
						<div class="form-group">
							<div class="row">
								<div class="col">
									<label for="exp_loc">Location</label>
									<textarea class="form-control" id="exp_loc" rows="2" name="lokasi"></textarea>
								</div>
								<div class="col-3">
									<label for="exp_on_off_shore">Onshore/Offshore</label>
									<select class="form-control custom-select" id="exp_on_off_shore" name="on_off_shore">
										<option>Choose one</option>
										<option value="Onshore">Onshore</option>
										<option value="Offshore">Offshore</option>
									</select>
								</div>
							</div>
						</div>
						<div class="form-group">
							<div class="row">
								<div class="col">
									<label for="exp_capacity">Capacity</label>
									<input class="form-control" id="exp_capacity" type="text" name="capacity">
								</div>
								<div class="col-4">
									<label for="exp_value">Project Value</label>
									<input class="form-control" id="exp_value" type="text" name="p_cost">
								</div>
							</div>
						</div>
					</div>
					<div class="modal-footer">
						<button type="submit" name="new_exp" value="new_exp" class="btn btn-primary">Submit</button>
						<button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
					</div>
				</form>
			</div>
		</div>
	</div>
	<div class="modal fade" tabindex="-1" id="newTor">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title">Add New Turn Over Revenue Data</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<form action="tor_add.php" method="post" enctype="multipart/form-data">
					<div class="modal-body">
						<input type="hidden" name="com_id" value="<?php echo $com_id; ?>">
						<div class="form-group">
							<div class="row">
								<div class="col-3">
									<label for="tor_year">Year</label>
									<input class="form-control" id="tor_year" type="text" pattern="[0-9]{4}" title="format: yyyy" name="to_year">
								</div>
								<div class="col">
									<label for="tor_pv">Project Value</label>
									<input class="form-control" id="tor_pv" type="text" name="to_value">
								</div>
							</div>
						</div>
					</div>
					<div class="modal-footer">
						<button type="submit" name="torAdd" value="torAdd" class="btn btn-primary">Submit</button>
						<button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
					</div>
				</form>
			</div>
		</div>
	</div>
	<div class="modal fade" tabindex="-1" id="add_ad">
		<div class="modal-dialog modal-lg">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title">Add Additional Detail</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<form action="add_ad.php" method="post" enctype="multipart/form-data">
					<div class="modal-body">
						<input type="hidden" name="com_id" value="<?php echo $com_id; ?>">
						<div class="form-group">
							<label for="ad_item">Item</label>
							<input class="form-control" id="ad_item" type="text" name="item">
						</div>
						<div class="form-group">
							<label for="ad_desc">Description</label>
							<textarea class="form-control" id="ad_desc" rows="2" name="description"></textarea>
						</div>
					</div>
					<div class="modal-footer">
						<button type="submit" name="add_ad" value="add_ad" class="btn btn-primary">Submit</button>
						<button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
					</div>
				</form>
			</div>
		</div>
	</div>

	<style type="text/css">
		th {
			text-align: center;
		}
	</style>

	<script>
	function psi() {
		document.getElementById("saham_asing").value = 100 - document.getElementById("saham_indo").value;
	}

	function psa() {
		document.getElementById("saham_indo").value = 100 - document.getElementById("saham_asing").value;
	}

	function fungsiEC() {
		document.getElementById("tbl_edit_ec").style.display = "none";
		document.getElementById("tbl_cancel_ec").style.display = "block";
		document.getElementById("tbl_submit_ec").style.display = "block";

		var arrIsinya = document.getElementsByClassName('isinya');
		for (var i = 0; i < arrIsinya.length; i++) {
			arrIsinya[i].style.display = "none";
		}

		var arrJumlahec = document.getElementsByClassName('jumlahec');
		for (var i = 0; i < arrJumlahec.length; i++) {
			arrJumlahec[i].style.display = "block";
		}
	}

	function fungsiEC_canel() {
		document.getElementById("tbl_edit_ec").style.display = "block";
		document.getElementById("tbl_cancel_ec").style.display = "none";
		document.getElementById("tbl_submit_ec").style.display = "none";

		var arrIsinya = document.getElementsByClassName('isinya');
		for (var i = 0; i < arrIsinya.length; i++) {
			arrIsinya[i].style.display = "block";
		}

		var arrJumlahec = document.getElementsByClassName('jumlahec');
		for (var i = 0; i < arrJumlahec.length; i++) {
			arrJumlahec[i].style.display = "none";
		}
	}

	function new_windows(form) {
		window.open('com_print', 'company', 'scrollbars');
		form.target = 'company';
	}

	$(document).ready(function(){
		$('.tooltip_btn').tooltip();
	});

	$(function() {
	    // Remove button click
	    $(document).on(
	        'click',
	        '[data-role="dynamic-fields"] > .form-inline [data-role="remove"]',
	        function(e) {
	            e.preventDefault();
	            $(this).closest('.form-inline').remove();
	        }
	    );
	    // Add button click
	    $(document).on(
	        'click',
	        '[data-role="dynamic-fields"] > .form-inline [data-role="add"]',
	        function(e) {
	            e.preventDefault();
	            var container = $(this).closest('[data-role="dynamic-fields"]');
	            new_field_group = container.children().filter('.form-inline:first-child').clone();
	            new_field_group.find('input').each(function(){
	                $(this).val('');
	            });
	            container.append(new_field_group);
	        }
	    );
	});
	</script>
	<?php
	mysqli_close($conn);
	?>
</body>
</html>