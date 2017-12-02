<?php

include('includes/config.php');

if (empty($_POST['type']) || empty($_POST['mac'])) {
	$mysqli->close();
	exit();
}

$type=$_POST['type'];
$mac=$_POST['mac'];

if ($type == 1) {
	mail('intellih@gmail.com','Warning','Fire','from: intellih@gmail.com');
} else if ($type == 2) {
	mail('intellih@gmail.com','Warning','Flood','from: intellih@gmail.com');
} else if ($type == 3) {
	mail('intellih@gmail.com','Warning','Earthquake','from: intellih@gmail.com');
} else if ($type == 4) {
	mail('intellih@gmail.com','Warning','Home Invasion','from: intellih@gmail.com');
}

if ($type > 0) {
	$mysqli->query("INSERT INTO casualties VALUES (NULL, NOW(), NOW(), '$type', '$mac')");
}

$mysqli->close();

?>