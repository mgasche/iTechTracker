<?php
// Datenbankverbindung herstellen
$dbservername = "localhost";
$dbusername = "itechtracker";
$dbpassword = "TrvM]s9(SwNzls_A";
$dbname = "itechtracker";

// Initialisierung der Variablen mit leeren Werten
$firstname = $lastname = $email = $username = $error = $message = '';

// Verbindung zu der Datenbank herstellen
$dbconn = new mysqli($dbservername, $dbusername, $dbpassword, $dbname);

// Überprüfen, ob die Verbindung erfolgreich war
if ($dbconn->connect_error) {
    die("Verbindung fehlgeschlagen: " . $dbconn->connect_error);
}
?>