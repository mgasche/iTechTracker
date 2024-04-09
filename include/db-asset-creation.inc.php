<?php
// Variablen leer initialisieren
$error = $message  = "";
// user_id Festlegen
$user_id = $_SESSION['user_id'];

// Wurden Daten mit "POST" gesendet?
if ($_SERVER['REQUEST_METHOD'] == "POST") {
    
    // Servervalidierung Validierung
    // Überprüfen erforderlichen Felder und Trimmen und htmlspecialchars
    if (!isset($_POST['device_name']) || empty($_POST['device_name'])) {
        $error .= "Bitte geben Sie einen Gerätenamen ein. ";
    } else {
        $device_name = htmlspecialchars(trim($_POST['device_name']));
    }
    if (!isset($_POST['model']) || empty($_POST['model'])) {
        $error .= "Bitte geben Sie ein Modell ein. ";
    } else {
        $model = htmlspecialchars(trim($_POST['model']));
    }
    if (!isset($_POST['manufacturer']) || empty($_POST['manufacturer'])) {
        $error .= "Bitte geben Sie einen Hersteller ein. ";
    } else {
        $manufacturer = htmlspecialchars(trim($_POST['manufacturer']));
    }

    // Optionale Felder Validierung
    $purchase_date = isset($_POST['purchase_date']) ? $_POST['purchase_date'] : "";
    $price = isset($_POST['price']) ? floatval($_POST['price']) : "";
    $color = isset($_POST['color']) ? htmlspecialchars(trim($_POST['color'])) : "";
    $processor = isset($_POST['processor']) ? htmlspecialchars(trim($_POST['processor'])) : "";
    $ram = isset($_POST['ram']) ? htmlspecialchars(trim($_POST['ram'])) : "";
    $storage = isset($_POST['storage']) ? htmlspecialchars(trim($_POST['storage'])) : "";
    $warranty_end = isset($_POST['warranty_end']) ? $_POST['warranty_end'] : "";
    $image_path = isset($_POST['image_path']) ? htmlspecialchars(trim($_POST['$image_path'])) : "";

    if (empty($error)) {
        // Query erstellen
        $sql = "INSERT INTO assets (user_id, device_name, model, manufacturer, purchase_date, price, color, processor, ram, storage, warranty_end, image_path) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

        // Query vorbereiten
        $stmt = $dbconn->prepare($sql);

        // Parameter binden
        $stmt->bind_param("isssdsssssss", $user_id, $device_name, $model, $manufacturer, $purchase_date, $price, $color, $processor, $ram, $storage, $warranty_end, $image_path);

        // Statement ausführen
        if ($stmt->execute()) {
            $message = "Gerät erfolgreich erstellt";
        } else {
            $error = "Fehler beim Einfügen des Geräts in die Datenbank: " . $stmt->error;
        }
        // Statement schließen
        $stmt->close();
    }
}
