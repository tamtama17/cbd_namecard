<?php
session_start();
?>
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
		<h1>Personal Data</h1>
		<hr class="my-4">
		<?php
		if (isset($_SESSION['flag'])) {
			$flag = $_SESSION['flag'];
			if ($flag == 1) {
				?>
				<div class="alert alert-primary alert-dismissible fade show" role="alert">
					<strong>Success!</strong> New data has been added!
					<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				</div>
				<?php
			}
			elseif ($flag == 2) {
				?>
				<div class="alert alert-danger alert-dismissible fade show" role="alert">
					<strong>Done!</strong> Data has been deleted!
					<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				</div>
				<?php
			}
			elseif ($flag == 3) {
				?>
				<div class="alert alert-success alert-dismissible fade show" role="alert">
					<strong>Done!</strong> Your data has been added!
					<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				</div>
				<?php
			}
			elseif ($flag == 4) {
				?>
				<div class="alert alert-warning alert-dismissible fade show" role="alert">
					<strong>Warning!</strong> Some data not added!
					<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				</div>
				<?php
			}
			elseif ($flag == 5) {
				?>
				<div class="alert alert-danger alert-dismissible fade show" role="alert">
					<strong>Failed!</strong> No data added! Please check your excel.
					<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				</div>
				<?php
			}
			elseif ($flag == 6) {
				?>
				<div class="alert alert-primary alert-dismissible fade show" role="alert">
					<strong>No data affected!</strong>
					<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				</div>
				<?php
			}
		}

		if (isset($_SESSION['sama'])) {
			$n = count($_SESSION['sama']);
		?>
		<div class="modal fade" tabindex="-1" id="samedataModal">
			<div class="modal-dialog modal-lg">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title"><strong>Warning!</strong> Some data is similar to existing data.</h5>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
					<form action="per_pilihdata.php" method="post" enctype="multipart/form-data">
						<input type="text" name="n" value="<?php echo $n; ?>" hidden="">
						<div class="modal-body">
							Choose the data that you want to input.<br><br>
							<table class="table table-bordered table-sm">
								<thead>
									<tr>
										<th width="50%" style="text-align: center;">Existing Data</th>
										<th width="50%" style="text-align: center;">New Data</th>
									</tr>
								</thead>
								<tbody>
									<?php
									for ($i=0; $i < $n; $i++) {
										$x = count($_SESSION['sama'][$i]['per_id']);
									?>
									<input type="text" name="x[]" value="<?php echo $x; ?>" hidden="">
									<tr>
										<td>
											<?php
											for ($j=0; $j < $x; $j++) {
												$idnya = $_SESSION['sama'][$i]['per_id'][$j];
												$qnya = "SELECT * FROM personal LEFT JOIN company USING(com_id) WHERE per_id = '$idnya';";
												$qnyarun = mysqli_query($conn,$qnya);
												$hasil = mysqli_fetch_assoc($qnyarun);
											?>
											<div class="custom-control custom-checkbox">
												<input type="text" name="per_id[<?php echo $i; ?>][<?php echo $j; ?>]" value="<?php echo $_SESSION['sama'][$i]['per_id'][$j]; ?>" hidden="">

												<input class="custom-control-input" id="exist_<?php echo $i ?>_<?php echo $j ?>" checked="" type="checkbox" name="existdata[<?php echo $i; ?>][<?php echo $j; ?>]" value="checked">
												<label class="custom-control-label" for="exist_<?php echo $i ?>_<?php echo $j ?>">
													<?php
														echo "Full Name : ".$hasil['per_full_name']."<br>";
														echo "First Name : ".$hasil['per_first_name']."<br>";
														echo "Last Name : ".$hasil['per_last_name']."<br>";
														echo "Position : ".$hasil['per_position']."<br>";
														echo "Department : ".$hasil['per_department']."<br>";
														echo "Company Name : ".$hasil['com_name'];
													?>
												</label>
											</div>
											<?php
											}
											?>
										</td>
										<td>
											<div class="custom-control custom-checkbox">
												<input type="text" name="full_name[<?php echo $i; ?>]" value="<?php echo $_SESSION['sama'][$i]['full_name']; ?>" hidden="">
												<input type="text" name="first_name[<?php echo $i; ?>]" value="<?php echo $_SESSION['sama'][$i]['first_name']; ?>" hidden="">
												<input type="text" name="last_name[<?php echo $i; ?>]" value="<?php echo $_SESSION['sama'][$i]['last_name']; ?>" hidden="">
												<input type="text" name="per_position[<?php echo $i; ?>]" value="<?php echo $_SESSION['sama'][$i]['per_position']; ?>" hidden="">
												<input type="text" name="per_department[<?php echo $i; ?>]" value="<?php echo $_SESSION['sama'][$i]['per_department']; ?>" hidden="">
												<input type="text" name="com_name[<?php echo $i; ?>]" value="<?php echo $_SESSION['sama'][$i]['com_name']; ?>" hidden="">
												<input type="text" name="per_phone1[<?php echo $i; ?>]" value="<?php echo $_SESSION['sama'][$i]['per_phone1']; ?>" hidden="">
												<input type="text" name="per_phone2[<?php echo $i; ?>]" value="<?php echo $_SESSION['sama'][$i]['per_phone2']; ?>" hidden="">
												<input type="text" name="per_phone3[<?php echo $i; ?>]" value="<?php echo $_SESSION['sama'][$i]['per_phone3']; ?>" hidden="">
												<input type="text" name="per_email[<?php echo $i; ?>]" value="<?php echo $_SESSION['sama'][$i]['per_email']; ?>" hidden="">
												<input type="text" name="com_address[<?php echo $i; ?>]" value="<?php echo $_SESSION['sama'][$i]['com_address']; ?>" hidden="">
												<input type="text" name="com_city[<?php echo $i; ?>]" value="<?php echo $_SESSION['sama'][$i]['com_city']; ?>" hidden="">
												<input type="text" name="com_postal_code[<?php echo $i; ?>]" value="<?php echo $_SESSION['sama'][$i]['com_postal_code']; ?>" hidden="">
												<input type="text" name="com_country[<?php echo $i; ?>]" value="<?php echo $_SESSION['sama'][$i]['com_country']; ?>" hidden="">

												<input class="custom-control-input" id="new_<?php echo $i ?>" type="checkbox" name="newdata[<?php echo $i; ?>]" value="checked">
												<label class="custom-control-label" for="new_<?php echo $i ?>">
													<?php
													echo "Full Name : ".$_SESSION['sama'][$i]['full_name']."<br>";
													echo "First Name : ".$_SESSION['sama'][$i]['first_name']."<br>";
													echo "Last Name : ".$_SESSION['sama'][$i]['last_name']."<br>";
													echo "Position : ".$_SESSION['sama'][$i]['per_position']."<br>";
													echo "Department : ".$_SESSION['sama'][$i]['per_department']."<br>";
													echo "Company Name : ".$_SESSION['sama'][$i]['com_name'];
													?>
												</label>
											</div>
										</td>
									</tr>
									<?php
									}
									?>
								</tbody>
							</table>
						</div>
						<div class="modal-footer">
							<button type="submit" name="save" class="btn btn-primary">Save</button>
							<button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
						</div>
					</form>
				</div>
			</div>
		</div>
		<script>
			$(document).ready(function(){
				$("#samedataModal").modal();
			});
		</script>
		<?php
		}
		session_unset();
		session_destroy();
		?>
		<button type="button" class="btn btn-primary btn-sm" style="border-radius: 5px; float: left; padding: 5px 10px 5px 10px;" data-toggle="modal" data-target="#formModal"><span><i class="fa fa-plus"></i></span> Add</button>
		<button type="button" class="btn btn-success btn-sm" style="border-radius: 5px; float: left; padding: 5px 10px 5px 10px; margin-left: 5px;" data-toggle="modal" data-target="#importModal"><span><i class="fa fa-upload"></i></span> Import</button>
		<table class="table table-hover table-bordered table-sm shadow" id="perTable">
			<thead class="thead-dark">
				<tr>
			    	<th scope="col">Name</th>
			    	<th scope="col">Position</th>
			    	<th scope="col">Department</th>
			    	<th scope="col">Phone</th>
			    	<th scope="col">Email</th>
			    	<th scope="col">Company</th>
			    </tr>
			</thead>
			<tbody id="cardnameList">
				<?php
				$qper = "SELECT p.*, c.com_name FROM personal p LEFT JOIN company c USING (com_id)";
				$qrun = mysqli_query($conn,$qper);
				while ($result = mysqli_fetch_assoc($qrun)) {
				?>
				<tr class="table-light" style="cursor: pointer;" onclick="window.location.href = 'per_detail?per_id=<?php echo $result['per_id']; ?>';">
			    	<td><?php echo $result['per_full_name']; ?></td>
			    	<td><?php echo $result['per_position']; ?></td>
			    	<td><?php echo $result['per_department']; ?></td>
			    	<td><?php echo $result['per_phone1']; ?></td>
			    	<td><?php echo $result['per_email']; ?></td>
			    	<td><?php echo $result['com_name']; ?></td>
			    </tr>
                <?php
					}
				?>
			</tbody>
		</table>
	</div>
	<div class="modal fade" tabindex="-1" id="formModal">
		<div class="modal-dialog modal-lg">
			<div class="modal-content">
				<div class="modal-header">
					<h4 class="modal-title">New Personal Data</h4>
					<button type="button" class="close" data-dismiss="modal">&times;</button>
				</div>
				<form method="post" action="per_insert.php" enctype="multipart/form-data">
					<div class="modal-body">
						<div class="form-group">
							<div class="row">
								<div class="col">
									<label for="per_first_name_form">First Name</label>
									<input class="form-control" required="" name="first_name" id="per_first_name_form">
								</div>
								<div class="col">
									<label for="per_last_name_form">Last Name</label>
									<input class="form-control" name="last_name" id="per_last_name_form">
								</div>
							</div>
						</div>
						<div class="form-group">
							<div class="row">
								<div class="col">
									<label for="born_place">Place of Birth</label>
									<input class="form-control" name="born_place" id="born_place">
								</div>
								<div class="col">
									<label for="born_date">Date of Birth</label>
									<input class="form-control" name="born_date" id="born_date" type="date">
								</div>
							</div>
						</div>
						<div class="form-group">
							<div class="row">
								<div class="col">
									<label for="sex">Gender</label>
									<select class="form-control custom-select" id="sex" name="sex">
										<option value="" selected="">Choose gender</option>
										<option value="Male">Male</option>
										<option value="Female">Female</option>
									</select>
								</div>
								<div class="col">
									<label for="religion">Religion</label>
									<input class="form-control" name="religion" id="religion">
								</div>
								<div class="col">
									<label for="latest_education">Latest Education</label>
									<input class="form-control" name="latest_education" id="latest_education">
								</div>
							</div>
						</div>
						<div class="form-group">
							<label for="address">Address</label>
							<textarea class="form-control" name="address" type="text" rows="3" id="address"></textarea>
						</div>
						<div id="existingData">
							<div class="form-group">
								<label for="companySelect">Company Name</label>
								<div class="row">
									<div class="col">
										<select class="form-control custom-select" id="companySelect" name="com_id" required="">
											<option value="" selected="">Choose company</option>
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
								<label for="companySelect">Company Name</label>
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
						<div class="form-group">
							<div class="row">
								<div class="col">
									<label for="per_position_form">Position</label>
									<input class="form-control" name="per_position" id="per_position_form">
								</div>
								<div class="col">
									<label for="per_department_form">Department</label>
									<input class="form-control" name="per_department" id="per_department_form">
								</div>
							</div>
						</div>
						<div class="form-group">
							<div class="row">
								<div class="col">
									<label for="per_phone_form">Phone 1</label>
									<input class="form-control" name="per_phone1" id="per_phone_form">
								</div>
								<div class="col">
									<label for="per_phone_form">Phone 2</label>
									<input class="form-control" name="per_phone2" id="per_phone_form">
								</div>
								<div class="col">
									<label for="per_phone_form">Phone 3</label>
									<input class="form-control" name="per_phone3" id="per_phone_form">
								</div>
							</div>
						</div>
						<div class="form-group">
							<div class="row">
								<div class="col">
									<label for="per_email_form">Email</label>
									<input type="email" class="form-control" name="per_email" id="per_email_form">
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
						<button type="submit" name="newdata" class="btn btn-primary">Submit</button>
					</div>
				</form>
			</div>
		</div>
	</div>
	<div class="modal fade" tabindex="-1" id="importModal">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title">Import from Excel</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<form action="per_import.php" method="post" enctype="multipart/form-data">
					<div class="modal-body">
						<div class="form-group">
							<div class="input-group mb-3">
								<div class="custom-file">
									<input type="file" id="fileImport" name="fileExcel" class="custom-file-input" accept="application/vnd.ms-excel">
									<label class="custom-file-label" for="fileImport">Choose file</label>
								</div>
							</div>
							<small id="fileHelp" class="form-text text-muted" style="text-align: right;">File must be .xls (Excel 97-2003)</small>
						</div>
					</div>
					<div class="modal-footer">
						<button type="submit" name="submit" value="Import" class="btn btn-primary">Submit</button>
						<button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
					</div>
				</form>
			</div>
		</div>
	</div>
	<?php
	mysqli_close($conn);
	?>
	<script>
	$(document).ready( function () {
		$('#perTable').dataTable({
			"lengthChange": false
		});
	} );

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
</body>
</html>