<?php
include('dbconnector.inc.php');
$query = $_GET['query'];
$sql = "SELECT * FROM assets WHERE (user_id = ? OR public = 1) AND (device_name LIKE '%$query%' OR model LIKE '%$query%' OR manufacturer LIKE '%$query%')";
$stmt = $dbconn->prepare($sql);
$stmt->bind_param("i", $user_id); // Annahme: $user_id enthält die ID des eingeloggten Benutzers
$stmt->execute();
$result = $stmt->get_result();
?>