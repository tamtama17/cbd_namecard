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
	$per_id = $_GET['per_id'];
	$qper = "CALL dataper('$per_id');";
	$qrun = mysqli_query($conn,$qper);
	$result = mysqli_fetch_assoc($qrun);
	?>
	<div style="padding: 20px;">
		<strong><h1><?php echo $result['per_full_name']; ?></h1></strong>
		<hr class="my-4" style="border-top:1px solid rgba(0,0,0,0.5);">
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
					<div style="float: left; width: 150px;">
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
					<div style="float: left; width: 150px;">
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
					<div style="float: left; width: 150px;">
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
					<div style="float: left; width: 150px;">
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
					<div style="float: left; width: 150px;">
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
					<div style="float: left; width: 150px;">
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
					<div style="float: left; width: 150px;">
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
			<h3><strong>Job Experience</strong></h3>
			<table class="table-sm">
				<thead>
					<tr>
						<th scope="col" width="10%">Date</th>
						<th scope="col">Position</th>
						<th scope="col">Department</th>
						<th scope="col">Company</th>
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
							echo '<td style="color: red;">';
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
					</tr>
					<?php
					}
					?>
				</tbody>
			</table>
		</div>
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
	<?php
	mysqli_close($conn);
	?>
	<script type="text/javascript">
		$( document ).ready(function() {
			window.print();
		});
	</script>
</body>
</html>