<?php

include('includes/config.php');

session_start();

$strAction = $_POST['action'];

if ($strAction == "login") {

	$strEmail = $_POST['email'];
	$strPassword = $_POST['password'];

	$hQuery = $mysqli->query("SELECT * FROM user WHERE email='$strEmail'");

	if ($hQuery->num_rows == 0) {
		header("location: index.php?response=error");
		exit();
	}

	$row = $hQuery->fetch_assoc();

	$strPasswordHash = md5(md5($strPassword).$row['salt']);
	if ($strPasswordHash != $row['password']) {
		header("location: index.php?response=error");
		exit();
	}

	$_SESSION['logged_in'] = $row;

	header("location: index.php");

} else if ($strAction == "register") {

	$strDeviceMac = $_POST['device_mac'];
	$strFirstName = $_POST['first_name'];
	$strLastName = $_POST['last_name'];
	$strEmail = $_POST['email'];
	$strPassword = $_POST['password'];

	$hQuery = $mysqli->query("SELECT * FROM device WHERE mac='$strDeviceMac'");

	if ($hQuery->num_rows == 0) {
		header("location: register.php?response=device-invalid");
		exit();
	}

	$hQuery = $mysqli->query("SELECT * FROM user WHERE device_mac='$strDeviceMac'");

	if ($hQuery->num_rows == 1) {
		header("location: register.php?response=device-registered");
		exit();
	}

	$hQuery = $mysqli->query("SELECT * FROM user WHERE email='$strEmail'");

	if ($_POST['confirm_password'] != $strPassword) {
		header("location: register.php?response=password-mismatch");
		exit();
	}

	if (filter_var($strEmail, FILTER_VALIDATE_EMAIL) === false) {
		header("location: register.php?response=email-invalid");
		exit();
	}

	if ($hQuery->num_rows > 0) {
		header("location: register.php?response=email-existing");
		exit();
	}

	$salt = uniqid(mt_rand(), true);
	$strPasswordHash = md5(md5($strPassword).$salt);

	$mysqli->query("INSERT INTO user VALUES (NULL, '$strEmail', '$strPasswordHash', '$salt', '$strFirstName', '$strLastName', '$strDeviceMac')");

	header("location: index.php");

} else if ($strAction == "update_acct") {

	$strDeviceMac = $_POST['device_mac'];
	$strFirstName = $_POST['first_name'];
	$strLastName = $_POST['last_name'];
	$strEmail = $_POST['email'];
	$strPassword = $_POST['password'];
	$strUserID = $_SESSION['logged_in']['id'];

	if ($strDeviceMac != $_SESSION['logged_in']['device_mac']) {
		$hQuery = $mysqli->query("SELECT * FROM device WHERE mac='$strDeviceMac'");

		if ($hQuery->num_rows == 0) {
			header("location: account.php?response=device-invalid");
			exit();
		}

		$hQuery = $mysqli->query("SELECT * FROM user WHERE device_mac='$strDeviceMac'");

		if ($hQuery->num_rows == 1) {
			header("location: account.php?response=device-registered");
			exit();
		}
	}

	if ($strEmail != $_SESSION['logged_in']['email']) {
		$hQuery = $mysqli->query("SELECT * FROM user WHERE email='$strEmail'");

		if (filter_var($strEmail, FILTER_VALIDATE_EMAIL) === false) {
			header("location: account.php?response=email-invalid");
			exit();
		}

		if ($hQuery->num_rows > 0) {
			header("location: account.php?response=email-existing");
			exit();
		}
	}

	$mysqli->query("UPDATE user SET first_name='$strFirstName', last_name='$strLastName', email='$strEmail', mac='$strDeviceMac' WHERE id='$strUserID'");

	if (!empty($strPassword)) {
		if ($_POST['confirm_password'] != $strPassword) {
			header("location: account.php?response=password-mismatch");
			exit();
		}
		$strPasswordHash = md5(md5($strPassword).$_SESSION['logged_in']['salt']); // storing salt in session is not safe
		$mysqli->query("UPDATE user SET first_name='$strFirstName', last_name='$strLastName', password='$strPasswordHash', email='$strEmail', mac='$strDeviceMac' WHERE id='$strUserID'");
	}

	header("location: account.php");

} else if ($strAction == "add_contact") {

	$strName = $_POST['name'];
	$strEmail = $_POST['email'];
	$strUserID = $_SESSION['logged_in']['id'];

	if (filter_var($strEmail, FILTER_VALIDATE_EMAIL) === false) {
		header("location: contacts.php?response=email-invalid");
		exit();
	}

	$mysqli->query("INSERT INTO contacts VALUES (NULL, '$strName', '$strEmail', '$strUserID')");
	header("location: contacts.php");
}

$mysqli->close();

?>