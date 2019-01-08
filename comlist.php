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
		<h1>Company Data</h1>
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
				<div class="alert alert-danger alert-dismissible fade show" role="alert">
					<strong>Failed!</strong> No data added! Please check your excel.
					<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				</div>
				<?php
			}
			elseif ($flag == 5) {
				?>
				<div class="alert alert-warning alert-dismissible fade show" role="alert">
					<strong>Warning!</strong> Some data not added! Please check your excel.
					<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				</div>
				<?php
			}
		}
		session_unset();
		session_destroy();
		?>
		<button type="button" class="btn btn-primary btn-sm" style="border-radius: 5px; float: left; padding: 5px 10px 5px 10px;" data-toggle="modal" data-target="#formModal"><span><i class="fa fa-plus"></i></span> Add</button>
		<button type="button" class="btn btn-success btn-sm" style="border-radius: 5px; float: left; padding: 5px 10px 5px 10px; margin-left: 5px;" data-toggle="modal" data-target="#importModal"><span><i class="fa fa-upload"></i></span> Import</button>
		<table class="table table-hover table-bordered table-sm shadow-lg" id="comTable">
			<thead class="thead-dark">
				<tr>
					<th style="vertical-align: middle;" scope="col">Name</th>
					<th style="vertical-align: middle;" scope="col">Detail</th>
					<th style="vertical-align: middle;" scope="col">Bussiness Services</th>
					<th style="vertical-align: middle;" scope="col">Website</th>
					<th width="25%" style="vertical-align: middle;" scope="col">Head Office Address</th>
					<th width="25%" style="vertical-align: middle;" scope="col">Plant Address</th>
				</tr>
			</thead>
			<tbody id="companyList">
				<?php
				$qcom = "SELECT * FROM company c LEFT JOIN bussiness_services bs USING(bs_id);";
				$qrun = mysqli_query($conn,$qcom);
				while ($result = mysqli_fetch_assoc($qrun)) {
					$com_id = $result['com_id'];
				?>
				<tr class="table-light" style="cursor: pointer;" onclick="window.location.href = 'com_detail?com_id=<?php echo $result['com_id']; ?>';">
					<td><?php echo $result['com_name']; ?></td>
					<td>
						<?php echo "detailnya"; ?>
					</td>
					<td><?php echo $result['bs_name']; ?></td>
					<td><?php echo $result['com_website']; ?></td>
					<td><?php echo $result['com_address']." ".$result['com_city']." ".$result['com_country']."<br>".$result['com_phone']; ?></td>
					<td><?php echo $result['plant_address']." ".$result['plant_city']." ".$result['plant_country']."<br>".$result['plant_phone']; ?></td>
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
					<h4 class="modal-title">New Company Data</h4>
					<button type="button" class="close" data-dismiss="modal">&times;</button>
				</div>
				<form method="post" action="com_insert.php" enctype="multipart/form-data">
					<div class="modal-body">
						<fieldset>
							<input type="hidden" name="com_id" value="<?php echo $com_id; ?>">
							<div class="form-group">
								<div class="row">
									<div class="col">
										<label for="com_name_form"><strong>Company Name</strong></label>
										<input class="form-control" id="com_name_form" type="text" name="com_name" required="">
									</div>
									<div class="col" id="existingData">
										<label for="bs_form"><strong>Bussiness Services</strong></label>
										<div class="row">
											<div class="col">
												<select class="form-control custom-select" id="bs_form" name="bs_id">
													<option value="" selected="">Choose bussiness service</option>
													<?php
													$qbs = "SELECT * FROM bussiness_services;";
													$qbsrun = mysqli_query($conn,$qbs);
													while ($bs = mysqli_fetch_assoc($qbsrun)) {
													?>
													<option value='<?php echo $bs['bs_id']; ?>'><?php echo $bs['bs_name']; ?></option>
													<?php
													}
													?>
												</select>
											</div>
											<div style="margin-right: 1rem;">
												<button id="" type="button" onclick="newBS()" class="btn btn-primary"><span><i class="fa fa-plus"></i></span> New</button>
											</div>
										</div>
									</div>
									<div class="col" id="newData" style="display: none;">
										<label><strong>Bussiness Services</strong></label>
										<div class="row">
											<div class="col">
												<input placeholder="New bussiness services" class="form-control" id="new_bs" type="text" name="new_bs">
											</div>
											<div style="margin-right: 1rem;">
												<button id="" type="button" onclick="newBSCancel()" class="btn btn-danger"><span><i class="fa fa-times"></i></span> Cancel</button>
											</div>
										</div>
									</div>
								</div>
							</div>
							<div class="form-group" id="detil_table" style="display: none;">
								<label><strong>Detail Table</strong></label>
								<div class="row">
									<div class="col">
										<div class="custom-control custom-checkbox">
											<input class="custom-control-input" id="ccl_check" checked="" type="checkbox" name="ccl_check" value="ok">
											<label class="custom-control-label" for="ccl_check">Corporate Certificate/License</label>
										</div>
										<div class="custom-control custom-checkbox">
											<input class="custom-control-input" id="lp_check" checked="" type="checkbox" name="lp_check" value="ok">
											<label class="custom-control-label" for="lp_check">Licensed Processes</label>
										</div>
										<div class="custom-control custom-checkbox">
											<input class="custom-control-input" id="ps_check" checked="" type="checkbox" name="ps_check" value="ok">
											<label class="custom-control-label" for="ps_check">Product Spesification</label>
										</div>
									</div>
									<div class="col">
										<div class="custom-control custom-checkbox">
											<input class="custom-control-input" id="ec_check" checked="" type="checkbox" name="ec_check" value="ok">
											<label class="custom-control-label" for="ec_check">Employee Composition</label>
										</div>
										<div class="custom-control custom-checkbox">
											<input class="custom-control-input" id="da_check" checked="" type="checkbox" name="da_check" value="ok">
											<label class="custom-control-label" for="da_check">Tools</label>
										</div>
										<div class="custom-control custom-checkbox">
											<input class="custom-control-input" id="exp_check" checked="" type="checkbox" name="exp_check" value="ok">
											<label class="custom-control-label" for="exp_check">Experience List</label>
										</div>
									</div>
									<div class="col">
										<div class="custom-control custom-checkbox">
											<input class="custom-control-input" id="op_check" checked="" type="checkbox" name="op_check" value="ok">
											<label class="custom-control-label" for="op_check">Ongoing Project</label>
										</div>
										<div class="custom-control custom-checkbox">
											<input class="custom-control-input" id="tor_check" checked="" type="checkbox" name="tor_check" value="ok">
											<label class="custom-control-label" for="tor_check">Turn Over Revenue</label>
										</div>
										<div class="custom-control custom-checkbox">
											<input class="custom-control-input" id="additional_table" checked="" type="checkbox" name="additional_table" value="ok">
											<label class="custom-control-label" for="additional_table">Additional Detail Table</label>
										</div>
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col">
									<div class="form-group">
										<label for="com_email_form"><strong>Email</strong></label>
										<input class="form-control" id="com_email_form" type="text" name="com_email">
									</div>
									<div class="form-group">
										<label for="com_web_form"><strong>Website</strong></label>
										<input class="form-control" id="com_web_form" type="text" name="com_website">
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
												<div class="custom-control custom-checkbox">
													<input class="custom-control-input" id="customCheck<?php echo $allbf['bf_id']; ?>" type="checkbox" name="com_bf[]" value="<?php echo $allbf['bf_id']; ?>">
													<label class="custom-control-label" for="customCheck<?php echo $allbf['bf_id']; ?>"><?php echo $allbf['bf_name']; ?></label>
												</div>
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
									<textarea class="form-control" id="com_addr_form" rows="2" name="com_address"></textarea>
								</div>
								<div class="row">
									<div class="col">
										<label for="ocity_from">City</label>
										<input class="form-control" id="ocity_form" type="text" name="com_city">
									</div>
									<div class="col">
										<label for="pcode_form">Postal Code</label>
										<input class="form-control" id="pcode_form" type="text" name="com_postal_code">
									</div>
									<div class="col">
										<label for="ocountry_form">Country</label>
										<input class="form-control" id="ocountry_form" type="text" name="com_country">
									</div>
								</div>
								<div class="row">
									<div class="col">
										<label for="com_phone_form">Phone</label>
										<input class="form-control" id="com_phone_form" type="text" name="com_phone" placeholder="format: +[country code] [area code]-[phone number]">
									</div>
									<div class="col">
										<label for="com_fax">Fax</label>
										<input class="form-control" id="com_fax" type="text" name="com_fax"  placeholder="format: +[country code] [area code]-[fax number]">
									</div>
								</div>
							</div>
							<div class="form-group">
								<div>
									<label for="com_addr_form"><strong>Plant Addres</strong></label>
									<textarea class="form-control" id="com_addr_form" rows="2" name="plant_address"></textarea>
								</div>
								<div class="row">
									<div class="col">
										<label for="ocity_from">City</label>
										<input class="form-control" id="ocity_form" type="text" name="plant_city">
									</div>
									<div class="col">
										<label for="pcode_form">Postal Code</label>
										<input class="form-control" id="pcode_form" type="text" name="plant_postal_code">
									</div>
									<div class="col">
										<label for="ocountry_form">Country</label>
										<input class="form-control" id="ocountry_form" type="text" name="plant_country">
									</div>
								</div>
								<div class="row">
									<div class="col">
										<label for="com_phone_form">Phone</label>
										<input class="form-control" id="com_phone_form" type="text" name="plant_phone" placeholder="format: +[country code] [area code]-[phone number]">
									</div>
									<div class="col">
										<label for="com_fax">Fax</label>
										<input class="form-control" id="com_fax" type="text" name="plant_fax"  placeholder="format: +[country code] [area code]-[fax number]">
									</div>
								</div>
							</div>
							<div class="form-group">
								<label><strong>NPWP</strong></label>
								<div class="row" style="margin-left: 1px; margin-right: 1px;">
									<input class="form-control" style="width: 10%; text-align: center;" id="npwp1" type="text" pattern="[0-9]{2}" title="Two-digit number" maxlength="2" name="npwp1">
									<span style="width: 5%;"><center>.</center></span>
									<input class="form-control" style="width: 15%; text-align: center;" id="npwp2" type="text" pattern="[0-9]{3}" title="Three-digit number" maxlength="3" name="npwp2">
									<span style="width: 5%;"><center>.</center></span>
									<input class="form-control" style="width: 15%; text-align: center;" id="npwp3" type="text" pattern="[0-9]{3}" title="Three-digit number" maxlength="3" name="npwp3">
									<span style="width: 5%;"><center>.</center></span>
									<input class="form-control" style="width: 5%; text-align: center;" id="npwp4" type="text" pattern="[0-9]{1}" title="One-digit number" maxlength="1" name="npwp4">
									<span style="width: 5%;"><center>_</center></span>
									<input class="form-control" style="width: 15%; text-align: center;" id="npwp5" type="text" pattern="[0-9]{3}" title="Three-digit number" maxlength="3" name="npwp5">
									<span style="width: 5%;"><center>.</center></span>
									<input class="form-control" style="width: 15%; text-align: center;" id="npwp6" type="text" pattern="[0-9]{3}" title="Three-digit number" maxlength="3" name="npwp6">
								</div>
							</div>
							<div class="form-group">
								<label for="com_name_form"><strong>Notarial Deed of Establish</strong></label><br>
								Akta Pendirian Perusahaan No. <input style="width: 55px;" type="number" min="0" name="akta_awal_no"> tanggal <input type="date" min="0" name="akta_awal_tgl"> oleh <input type="text" min="0" name="akta_awal_notaris"> di <input style="width: 80px;" type="text" min="0" name="akta_awal_kota">
							</div>
							<div class="form-group">
								<label for="com_name_form"><strong>Notarial Deed of Change</strong></label><br>
								Akta Perubahan Terakhir No. <input style="width: 55px;" type="number" min="0" name="akta_akhir_no"> tanggal <input type="date" min="0" name="akta_akhir_tgl"> oleh <input type="text" min="0" name="akta_akhir_notaris"> di <input style="width: 80px;" type="text" min="0" name="akta_akhir_kota">
							</div>
							<div class="form-group">
								<div class="row">
									<div class="col">
										<label for="org_chart_form"><strong>Organization Chart</strong></label><br>
										<div class="custom-file">
											<input class="custom-file-input" id="org_chart_form" type="file" name="org_chart">
											<label class="custom-file-label" for="org_chart_form">Choose file</label>
										</div>
									</div>
									<div class="col">
										<label for="finance_cap"><strong>Financial Capability</strong></label><br>
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
												<input class="form-control" onkeyup="psi()" onchange="psi()" id="saham_indo" type="number" max="100" min="0" name="saham_indo" step="any">
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
												<input class="form-control" onkeyup="psa()" onchange="psa()" id="saham_asing" type="number" max="100" min="0" name="saham_asing" step="any">
											</div>
										</div>
									</div>
								</div>
							</div>
						</fieldset>
					</div>
					<div class="modal-footer">
						<button type="submit" class="btn btn-primary" name="com_new">Submit</button>
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
					<h5 class="modal-title">Import from Excel</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<form action="com_import.php" method="post" enctype="multipart/form-data">
					<div class="modal-body">
						<strong>Download template file, add data of this company, then submit the file.</strong><br><br>
						<div class="form-group">
							<div class="input-group mb-3">
								<div class="custom-file">
									<input type="file" id="fileImport" name="fileExcel" class="custom-file-input" accept="application/vnd.ms-excel">
									<label class="custom-file-label" for="fileImport">Choose file</label>
								</div>
							</div>
							<a href="file/template/template_company.xls" download="">Downlaod template file</a>
							<small id="fileHelp" class="form-text text-muted" style="float: right;">File must be .xls (Excel 97-2003)</small>
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
	<style type="text/css">
		th {
			text-align: center;
		}
	</style>
	<script>
	$(document).ready( function () {
		var table = $('#comTable').DataTable({
			"lengthChange": false,
			columnDefs: [
			{
				targets: 1,
				searchable: true,
				visible: false
			}
			]
		});
	});

	function psi() {
		document.getElementById("saham_asing").value = 100 - document.getElementById("saham_indo").value;
	}

	function psa() {
		document.getElementById("saham_indo").value = 100 - document.getElementById("saham_asing").value;
	}

	function newBS() {
		document.getElementById("newData").style.display = "block";
		document.getElementById("detil_table").style.display = "block";
		document.getElementById("existingData").style.display = "none";
		document.getElementById('bs_form').selectedIndex = 0;
	}
	function newBSCancel() {
		document.getElementById("newData").style.display = "none";
		document.getElementById("detil_table").style.display = "none";
		document.getElementById("existingData").style.display = "block";
		document.getElementById('new_bs').value = '';
	}
	
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
</body>
</html>