<!DOCTYPE html>
<html>
<head>
	<?php
	include('head.php');
	?>
</head>
<body style="background-color: #e9ecef;">
	<?php
	include('conn.php');
	include('navbar.php');
	?>
	<div class="jumbotron" style="padding-top: 30px;">
		<?php
		$per_id = $_GET['per_id'];
		$qper = "CALL dataper('$per_id');";
		$qrun = mysqli_query($conn,$qper);
		$result = mysqli_fetch_assoc($qrun);
		$idcom = $result['com_id'];
		?>
		<h1>Personal Detail</h1>
		<hr class="my-4">
		<button type="button" class="btn btn-primary" style="border-radius: 5px; padding: 5px 10px 5px 10px;" onclick="window.open('per_print?per_id=<?php echo $result['per_id']; ?>', 'namecard', 'scrollbars');"><span><i class="fa fa-print"></i></span> Print</button>
		<button type="button" class="btn btn-success" style="border-radius: 5px; padding: 5px 10px 5px 10px;" data-toggle="modal" data-target="#editModal"><span><i class="fa fa-pencil"></i></span> Edit</button>
		<button type="button" class="btn btn-danger" style="border-radius: 5px; padding: 5px 10px 5px 10px;" data-toggle="modal" data-target="#deleteModal"><span><i class="fa fa-trash"></i></span> Delete</button>
		<br><br>
		<fieldset class="shadow-lg" style="background-color: white; padding: 20px; border-radius: 5px;">
			<strong><h1><?php echo $result['per_full_name']; ?></h1></strong>
			<hr class="my-4">
			<div class="row" style="padding-bottom: 20px;">
				<div style="float: left; width: 200px; margin-right: 15px; margin-left: 15px;">
					<?php
					if ($result['per_profile_picture'] != NULL) {
					?>
					<center><img src="profile_pictures/<?php echo $result['per_profile_picture']; ?>" style="max-height: 200px; max-width: 200px;"></center>
					<?php
					} else{
					?>
					<center><img src="profile_pictures/default.jpg" style="max-height: 200px; max-width: 200px;"></center>
					<?php
					}
					?>
				</div>
				<div class="col">
					<div class="row">
						<div style="float: left; width: 170px;">
							PLACE/DATE OF BIRTH
						</div>
						<div style="float: left; width: 20px; text-align: center;">
							:
						</div>
						<div class="col">
							<?php
							if ($result['born_place'] != NULL) {
								echo $result['born_place'];
							}
							if ($result['born_date'] != '0000-00-00' && $result['born_date'] != NULL) {
								$born = date("F jS, Y", strtotime($result['born_date']));
								echo " / ".$born;
							}
							?>
						</div>
					</div>
					<div class="row">
						<div style="float: left; width: 170px;">
							GENDER
						</div>
						<div style="float: left; width: 20px; text-align: center;">
							:
						</div>
						<div class="col">
							<?php echo $result['sex']; ?>
						</div>
					</div>
					<div class="row">
						<div style="float: left; width: 170px;">
							RELIGION
						</div>
						<div style="float: left; width: 20px; text-align: center;">
							:
						</div>
						<div class="col">
							<?php echo $result['religion']; ?>
						</div>
					</div>
					<div class="row">
						<div style="float: left; width: 170px;">
							ADDRESS
						</div>
						<div style="float: left; width: 20px; text-align: center;">
							:
						</div>
						<div class="col">
							<?php echo $result['address']; ?>
						</div>
					</div>
					<div class="row">
						<div style="float: left; width: 170px;">
							PHONE
						</div>
						<div style="float: left; width: 20px; text-align: center;">
							:
						</div>
						<div class="col">
							<?php
							echo $result['per_phone1'];
							if ($result['per_phone2'] != NULL) {
								echo "<br>".$result['per_phone2'];
							}
							if ($result['per_phone3'] != NULL) {
								echo "<br>".$result['per_phone3'];
							}
							?>
						</div>
					</div>
					<div class="row">
						<div style="float: left; width: 170px;">
							LATES EDUCATION
						</div>
						<div style="float: left; width: 20px; text-align: center;">
							:
						</div>
						<div class="col">
							<?php echo $result['latest_education']; ?>
						</div>
					</div>
					<div class="row">
						<div style="float: left; width: 170px;">
							EMAIL
						</div>
						<div style="float: left; width: 20px; text-align: center;">
							:
						</div>
						<div class="col">
							<?php echo $result['per_email']; ?>
						</div>
					</div>
				</div>
			</div>
			<div>
				<div>
					<h3 style="float: left;"><strong>Job Experience</strong></h3>
					<button type="button" class="btn btn-primary btn-sm" style="margin-bottom: 6px; border-radius: 5px; padding: 5px 10px 5px 10px; float: right;" data-toggle="modal" data-target="#addExp"><span><i class="fa fa-plus"></i></span> New Data</button>
				</div>
				<table class="table table-hover table-bordered table-sm">
					<thead>
						<tr>
							<th scope="col" width="10%">Date</th>
							<th scope="col">Position</th>
							<th scope="col">Department</th>
							<th scope="col">Company</th>
							<th scope="col" width="150px"><span><i class="fa fa-gears"></i></span> Action</th>
						</tr>
					</thead>
					<tbody>
						<?php
						mysqli_next_result($conn);
						$qlog = "CALL job_history('$per_id');";
						$logrun = mysqli_query($conn,$qlog);
						while ($jobh = mysqli_fetch_assoc($logrun)) {
						?>
						<tr>
							<?php
							if ($jobh['tgl_jabat'] == NULL || $jobh['tgl'] == $jobh['tgl_jabat']) {
								$tglnya = strtotime($jobh['tgl']);
								echo '<td title="Not actual date(using insertion date)" style="color: red;">';
							?>
							<?php
							} else {
								$tglnya = strtotime($jobh['tgl_jabat']);
								echo "<td>";
							}
							echo date("F jS, Y", $tglnya)."</td>";
							?>
							<td><?php echo $jobh['per_position_baru']; ?></td>
							<td><?php echo $jobh['per_department_baru']; ?></td>
							<td>
								<?php
								if ($jobh['com_name'] != NULL) {
								?>
								<a href="com_detail?com_id=<?php echo $jobh['com_id_baru']; ?>"><?php echo $jobh['com_name']; ?></a>
								<?php
								} else {
									echo "<strong>Company data deleted</strong>";
								}
								?>
							</td>
							<td>
								<center>
									<button type="button" class="btn btn-success btn-sm" style="border-radius: 5px; padding: 5px 10px;" data-toggle="modal" data-target="#editJH_<?php echo $jobh['jobh_id']; ?>"><span><i class="fa fa-pencil"></i></span> Edit</button>
									<button type="button" class="btn btn-danger btn-sm" style="border-radius: 5px; padding: 5px 10px;" data-toggle="modal" data-target="#deleteJH_<?php echo $jobh['jobh_id']; ?>"><span><i class="fa fa-trash"></i></span> Delete</button>
								</center>
							</td>
						</tr>
						<div class="modal fade" tabindex="-1" id="editJH_<?php echo $jobh['jobh_id']; ?>">
							<div class="modal-dialog modal-lg">
								<div class="modal-content">
									<div class="modal-header">
										<h4 class="modal-title">Edit Job History</h4>
										<button type="button" class="close" data-dismiss="modal">&times;</button>
									</div>
									<form method="post" action="jobh_update.php" enctype="multipart/form-data">
										<fieldset>
											<div class="modal-body">
												<input type="hidden" name="jobh_id" value="<?php echo $jobh['jobh_id'] ?>">
												<input type="hidden" name="per_id" value="<?php echo $jobh['per_id'] ?>">
												<div class="form-group">
													<label for="tgl_jobh">Date</label>
													<input class="form-control" id="tgl_jobh" type="date" name="tgl_jabat" required="" value="<?php echo $jobh['tgl_jabat']; ?>">
												</div>
												<div class="form-group">
													<label for="jobh_position">Position</label>
													<input class="form-control" id="jobh_position" type="text" name="per_position_baru" value="<?php echo $jobh['per_position_baru']; ?>">
												</div>
												<div class="form-group">
													<label for="jobh_department">Department</label>
													<input class="form-control" id="jobh_department" type="text" name="per_department_baru" value="<?php echo $jobh['per_department_baru']; ?>">
												</div>
												<div id="existingData">
													<div class="form-group">
														<label for="companySelect">Company Name</label>
														<div class="row">
															<div class="col">
																<select class="form-control custom-select" id="companySelect" name="com_id">
																	<?php
																	mysqli_next_result($conn);
																	$qcom = "SELECT * FROM company;";
																	$qrun = mysqli_query($conn,$qcom);
																	while ($comlist = mysqli_fetch_assoc($qrun)) {
																		if ($comlist['com_id'] == $jobh['com_id_baru']) {
																	?>
																		<option selected="" value='<?php echo $comlist['com_id']; ?>'><?php echo $comlist['com_name']; ?></option>
																	<?php
																		}else{
																	?>
																		<option value='<?php echo $comlist['com_id']; ?>'><?php echo $comlist['com_name']; ?></option>
																	<?php
																		}
																	}
																	?>
																</select>
																<small id="comHelp" class="form-text text-muted">If company name doesn't exist, click '<span><i class="fa fa-plus"></i></span> New' button to create new</small>
															</div>
															<div style="margin-right: 1rem;">
																<button type="button" onclick="newCompany()" class="btn btn-primary"><span><i class="fa fa-plus"></i></span> New</button>
															</div>
														</div>
													</div>
												</div>
												<div id="newData" style="display: none;">
													<div class="form-group">
														<label for="com_name_form">Company Name</label>
														<div class="row">
															<div class="col">
																<input class="form-control" name="com_name" id="com_name_form">
																<small id="comHelp" class="form-text text-muted">Click '<span><i class="fa fa-times"></i></span> Cancel' button to select from existing Company Name</small>
															</div>
															<div style="margin-right: 1rem;">
																<button type="button" onclick="newCompanyCancel()" class="btn btn-danger"><span><i class="fa fa-times"></i></span> Cancel</button>
															</div>
														</div>
													</div>
												</div>
											</div>
											<div class="modal-footer">
												<button type="submit" class="btn btn-primary" name="update_jobh">Submit</button>
												<button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
											</div>
										</fieldset>
									</form>
								</div>
							</div>
						</div>
						<div class="modal fade" tabindex="-1" id="deleteJH_<?php echo $jobh['jobh_id']; ?>">
							<div class="modal-dialog">
								<div class="modal-content">
									<div class="modal-header">
										<h5 class="modal-title">Warning!</h5>
										<button type="button" class="close" data-dismiss="modal" aria-label="Close">
											<span aria-hidden="true">&times;</span>
										</button>
									</div>
									<div class="modal-body">
										<?php
										echo date("F jS, Y", $tglnya)."<br>";
										echo $jobh['per_position_baru']."<br>";
										echo $jobh['per_department_baru']."<br>";
										echo $jobh['com_name']."<br>";
										?>
										<p style="margin-top: 5px;">Are you sure want to <strong>delete</strong> this job history?</p>
									</div>
									<div class="modal-footer">
										<button type="button" onclick="window.location.href = 'jobh_delete?jobh_id=<?php echo $jobh['jobh_id']; ?>&per_id=<?php echo $jobh['per_id']; ?>';" class="btn btn-primary">Yes</utton>
										<button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
									</div>
								</div>
							</div>
						</div>
						<?php
							}
						?>
					</tbody>
				</table>
			</div>
		</fieldset>
	</div>
	<div class="modal fade" tabindex="-1" id="editModal">
		<div class="modal-dialog modal-lg">
			<div class="modal-content">
				<div class="modal-header">
					<h4 class="modal-title">Edit Personal Data</h4>
					<button type="button" class="close" data-dismiss="modal">&times;</button>
				</div>
				<form method="post" action="per_update.php" enctype="multipart/form-data">
					<fieldset>
						<input type="hidden" name="per_id" value="<?php echo $per_id; ?>">
						<div class="modal-body">
							<div class="form-group">
								<div class="row">
									<div class="col">
										<label for="per_first_name_form">First Name</label>
										<input class="form-control" required="" name="first_name" id="per_first_name_form" value="<?php echo $result['per_first_name']; ?>">
									</div>
									<div class="col">
										<label for="per_last_name_form">Last Name</label>
										<input class="form-control" name="last_name" id="per_last_name_form" value="<?php echo $result['per_last_name']; ?>">
									</div>
								</div>
							</div>
							<div class="form-group">
								<div class="row">
									<div class="col">
										<label for="born_place">Place of Birth</label>
										<input class="form-control" name="born_place" id="born_place" value="<?php echo $result['born_place']; ?>">
									</div>
									<div class="col">
										<label for="born_date">Date of Birth</label>
										<input class="form-control" name="born_date" id="born_date" type="date" value="<?php echo $result['born_date']; ?>">
									</div>
								</div>
							</div>
							<div class="form-group">
								<div class="row">
									<div class="col">
										<label for="sex">Gender</label>
										<select class="form-control custom-select" id="sex" name="sex">
											<?php
											if ($result['sex'] == 'Male') { ?>
												<option selected="" value="Male">Male</option>
												<option value="Female">Female</option>
											<?php
											} elseif ($result['sex'] == 'Female') { ?>
												<option value="Male">Male</option>
												<option selected="" value="Female">Female</option>
											<?php
											}else{ ?>
												<option value="" selected="">Choose gender</option>
												<option value="Male">Male</option>
												<option value="Female">Female</option>
											<?php
											}
											?>
										</select>
									</div>
									<div class="col">
										<label for="religion">Religion</label>
										<input class="form-control" name="religion" id="religion" value="<?php echo $result['religion']; ?>">
									</div>
									<div class="col">
										<label for="latest_education">Latest Education</label>
										<input class="form-control" name="latest_education" id="latest_education" value="<?php echo $result['latest_education']; ?>">
									</div>
								</div>
							</div>
							<div class="form-group">
								<label for="address">Address</label>
								<textarea class="form-control" name="address" type="text" rows="3" id="address"><?php echo $result['address']; ?></textarea>
							</div>
							<div class="form-group">
								<div class="row">
									<div class="col">
										<label for="per_phone_form">Phone 1</label>
										<input class="form-control" name="per_phone1" id="per_phone_form" value="<?php echo $result['per_phone1']; ?>">
									</div>
									<div class="col">
										<label for="per_phone_form">Phone 2</label>
										<input class="form-control" name="per_phone2" id="per_phone_form" value="<?php echo $result['per_phone2']; ?>">
									</div>
									<div class="col">
										<label for="per_phone_form">Phone 3</label>
										<input class="form-control" name="per_phone3" id="per_phone_form" value="<?php echo $result['per_phone3']; ?>">
									</div>
								</div>
							</div>
							<div class="form-group">
								<div class="row">
									<div class="col">
										<label for="per_email_form">Email</label>
										<input type="email" class="form-control" name="per_email" id="per_email_form" value="<?php echo $result['per_email']; ?>">
									</div>
									<div class="col-4">
										<label for="inputfoto">Profile Picture</label><br>
										<div class="custom-file">
											<input class="custom-file-input" id="inputGroupFile02" type="file" id="inputfoto" name="foto" accept="image/*">
											<label class="custom-file-label" for="inputGroupFile02">Choose file</label>
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="modal-footer">
							<button type="submit" name="editdata" class="btn btn-primary">Submit</button>
							<button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
						</div>
					</fieldset>
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
					<p>Are you sure want to delete this person?</p>
				</div>
				<div class="modal-footer">
					<button type="button" onclick="window.location.href = 'per_delete?per_id=<?php echo $per_id; ?>';" class="btn btn-primary">Yes</utton>
					<button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
				</div>
			</div>
		</div>
	</div>
	<div class="modal fade" tabindex="-1" id="addExp">
		<div class="modal-dialog modal-lg">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title">Add New Job Experience</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<form action="jobh_add.php" method="post" enctype="multipart/form-data">
					<fieldset>
						<div class="modal-body">
							<input type="hidden" name="per_id" value="<?php echo $per_id; ?>">
							<div class="form-group">
								<label for="tgl_jobh">Date</label>
								<input class="form-control" id="tgl_jobh" type="date" name="tgl_jabat">
							</div>
							<div class="form-group">
								<label for="jobh_position">Position</label>
								<input class="form-control" id="jobh_position" type="text" name="per_position_baru">
							</div>
							<div class="form-group">
								<label for="jobh_department">Department</label>
								<input class="form-control" id="jobh_department" type="text" name="per_department_baru">
							</div>
							<div id="existingData">
								<div class="form-group">
									<label for="companySelect">Company Name</label>
									<div class="row">
										<div class="col">
											<select class="form-control custom-select" id="companySelect" name="com_id">
												<option value="">Choose company</option>
												<?php
												mysqli_next_result($conn);
												$qcom = "SELECT * FROM company;";
												$qrun = mysqli_query($conn,$qcom);
												while ($comlist = mysqli_fetch_assoc($qrun)) {
												?>
												<option value='<?php echo $comlist['com_id']; ?>'><?php echo $comlist['com_name']; ?></option>
												<?php
												}
												?>
											</select>
											<small id="comHelp" class="form-text text-muted">If company name doesn't exist, click '<span><i class="fa fa-plus"></i></span> New' button to create new</small>
										</div>
										<div style="margin-right: 1rem;">
											<button type="button" onclick="newCompany()" class="btn btn-primary"><span><i class="fa fa-plus"></i></span> New</button>
										</div>
									</div>
								</div>
							</div>
							<div id="newData" style="display: none;">
								<div class="form-group">
									<label for="com_name_form">Company Name</label>
									<div class="row">
										<div class="col">
											<input class="form-control" name="com_name" id="com_name_form">
											<small id="comHelp" class="form-text text-muted">Click '<span><i class="fa fa-times"></i></span> Cancel' button to select from existing Company Name</small>
										</div>
										<div style="margin-right: 1rem;">
											<button type="button" onclick="newCompanyCancel()" class="btn btn-danger"><span><i class="fa fa-times"></i></span> Cancel</button>
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="modal-footer">
							<button type="submit" name="newJH" class="btn btn-primary">Submit</button>
							<button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
						</div>
					</fieldset>
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
	function newCompany() {
		document.getElementById("newData").style.display = "block";
		document.getElementById("existingData").style.display = "none";
		document.getElementById('companySelect').value = '';
		document.getElementById("companySelect").required = false;
		document.getElementById("com_name_form").required = true;
	}
	function newCompanyCancel() {
		document.getElementById("newData").style.display = "none";
		document.getElementById("existingData").style.display = "block";
		document.getElementById('com_name_form').value = '';
		document.getElementById("com_name_form").required = false;
		document.getElementById("companySelect").required = true;
	}
	</script>
	<?php
	mysqli_close($conn);
	?>
</body>
</html>