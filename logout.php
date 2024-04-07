<?php
session_start(); // Starten der Sitzung

// Überprüfen, ob Benutzer angemeldet ist
if (isset($_SESSION['user_id'])) {
    // Benutzersitzung löschen
    session_unset();
    session_destroy();
}

// Weiterleitung zum Login
header("Location: login.php");
exit();
?>
