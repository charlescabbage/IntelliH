<?php

include('includes/config.php');

$type=$_POST['type'];
$mac=$_POST['mac'];
$typeId=0;

if ($type == "fire") {
	mail('intellih@gmail.com','Warning','Fire','from: intellih@gmail.com');
	$typeId = 1;
} else if ($type == "flooding") {
	mail('intellih@gmail.com','Warning','Flood','from: intellih@gmail.com');
	$typeId = 2;
} else if ($type == "earthquake") {
	mail('intellih@gmail.com','Warning','Earthquake','from: intellih@gmail.com');
	$typeId = 3;
} else if ($type == "raid") {
	mail('intellih@gmail.com','Warning','Home Invasion','from: intellih@gmail.com');
	$typeId = 4;
}

if ($typeId > 0) {
	$mysqli->query("INSERT INTO casualties VALUES (NULL, NOW(), NOW(), '$type', '$mac')");
}

?>