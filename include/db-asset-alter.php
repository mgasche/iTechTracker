<?php
// Starten der Session
session_start();

// Überprüfen, ob der Benutzer angemeldet ist
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php"); // Weiterleitung zum Login, falls nicht angemeldet
    exit();
}

// Include Dateien
include 'include/dbconnector.inc.php';

// Überprüfen, ob die ID des Assets im URL-Parameter vorhanden ist
if (!isset($_GET['id'])) {
    header("Location: overview.php");
    exit();
}

$asset_id = intval($_GET['id']);

// Daten aus dem Formular verarbeiten und in der Datenbank aktualisieren
if ($_SERVER['REQUEST_METHOD'] == "POST") {
    // Überprüfen, ob die erforderlichen Felder vorhanden und nicht leer sind
    if (!empty($_POST['device_name']) && !empty($_POST['model']) && !empty($_POST['manufacturer'])) {
        // Attribute aus dem Formular erhalten und bereinigen
        $device_name = htmlspecialchars(trim($_POST['device_name']));
        $model = htmlspecialchars(trim($_POST['model']));
        $manufacturer = htmlspecialchars(trim($_POST['manufacturer']));

        // SQL-Update-Statement vorbereiten
        $sql = "UPDATE assets SET (device_name, model, manufacturer WHERE id AND user_id) VALUES (?, ?, ?, ?, ?)";
        $stmt = $dbconn->prepare($sql);
        $user_id = $_SESSION['user_id'];

        // Parameter binden
        $stmt->bind_param("sssii", $device_name, $model, $manufacturer, $asset_id, $user_id);

        // Statement ausführen
        if ($stmt->execute()) {
            $message = "Asset erfolgreich aktualisiert.";
        } else {
            $error = "Fehler beim Aktualisieren des Assets: " . $stmt->error;
        }

        // Statement schliessen
        $stmt->close();
    } else {
        $error = "Bitte füllen Sie alle erforderlichen Felder aus.";
    }
}
?>
