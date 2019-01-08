<?php
session_start();
include('conn.php');
if (isset($_POST['editAd'])) {
	$ad_id = $_POST['ad_id'];
	echo "ad_id : ".$ad_id."<br>";
	$com_id = $_POST['com_id'];
	echo "com_id : ".$com_id."<br>";
	$item = $_POST['item'];
	echo "item : ".$item."<br>";
	$description = $_POST['description'];
	echo "description : ".$description."<br>";

	$qupdate = "UPDATE additional_detail SET item='$item',description='$description',com_id='$com_id' WHERE ad_id = '$ad_id';";
	if (mysqli_query($conn, $qupdate)) {
		$_SESSION['flag'] = 1;
		header('location:com_detail?com_id='.$com_id);
	} else {
		die(mysqli_error($conn));
	}

	mysqli_close($conn);
}
?>