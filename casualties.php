<?php

session_start();

include("includes/config.php");

$id = $_SESSION['logged_in']['id'];

if(isset($_GET['getData']) && $_GET['getData'] === 'fire') {
    $data = $mysqli->query("SELECT COUNT(type) AS count FROM casualties WHERE type = '1' AND userid='$id'");
}
else if(isset($_GET['getData']) && $_GET['getData'] === 'flood') {
    $data = $mysqli->query("SELECT COUNT(type) AS count FROM casualties WHERE type = '2' AND userid='$id'");
}
else if(isset($_GET['getData']) && $_GET['getData'] === 'quake') {
    $data = $mysqli->query("SELECT COUNT(type) AS count FROM casualties WHERE type = '3' AND userid='$id'");    
}
else if(isset($_GET['getData']) && $_GET['getData'] === 'invasion') {
    $data = $mysqli->query("SELECT COUNT(type) AS count FROM casualties WHERE type = '4' AND userid='$id'");    
}
else {
    echo json_encode("invalid data");
    exit;
}

while($row = $data->fetch_row()) {
    $rows[] = $row;
}

echo json_encode($rows);
?>
