<?php

include('includes/config.php');

if (empty($_POST['type']) || empty($_POST['mac'])) {
	$mysqli->close();
	exit();
}

$type=$_POST['type'];
$mac=$_POST['mac'];
$subj="";
$msg="";

$hQuery = $mysqli->query("SELECT * FROM user WHERE device_mac='$mac'");

if ($hQuery->num_rows == 1) {

	$row = $hQuery->fetch_assoc();
	$id = $row['id'];

	if ($type == 1) {
		$subj="IntelliH: Fire Warning";
		$msg="A fire has been detected!";
	} else if ($type == 2) {
		$subj="IntelliH: Flood Warning";
		$msg="A flood has been detected!";
	} else if ($type == 3) {
		$subj="IntelliH: Earthquake Warning";
		$msg="An earthquake has been detected!";
	} else if ($type == 4) {
		$subj="IntelliH: Home Invasion Warning";
		$msg="Someone invaded your home!";
	}

	$hQueryB = $mysqli->query("SELECT * FROM contacts WHERE userid='$id'");
	for ($i = 0; $i < $hQueryB->num_rows; $i++) {
		$row = $hQueryB->fetch_assoc();
		// send emails to contacts
		mail($row['email'],$subj,$msg,'from: '.WEBMASTER_EMAIL);
	}

	if ($type > 0) {
		$mysqli->query("INSERT INTO casualties VALUES (NULL, NOW(), NOW(), '$type', '$id')");
	}
}

$mysqli->close();

?>