<?php
// DB Zugangsdaten
$dbservername = "localhost";
$dbusername = "itechtracker";
$dbpassword = "TrvM]s9(SwNzls_A";
$dbname = "itechtracker";

// Verbindung zu der DB herstellen
$dbconn = new mysqli($dbservername, $dbusername, $dbpassword, $dbname);

// Überprüfen, ob die Verbindung erfolgreich war
if ($dbconn->connect_error) {
    die("Verbindung fehlgeschlagen: " . $dbconn->connect_error);
}
?>