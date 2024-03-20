<?php
// Wurden Daten mit "POST" gesendet?
if ($_SERVER['REQUEST_METHOD'] == "POST") {
    // Validierung mit htmlspecialchars() und trim()

    if (isset($_POST['firstname'])) {
        $firstname = htmlspecialchars(trim($_POST['firstname']));
        if (empty($firstname) or strlen($firstname) < 30) {
            $error .= "Geben Sie bitte einen korrekten Vornamen ein";
        }
    }
    if (isset($_POST['lastname'])) {
        $lastname = htmlspecialchars(trim($_POST['lastname']));
        if (empty($lastname) or strlen($lastname) < 30) {
            $error .= "Geben Sie bitte einen korrekten Nachnamen ein";
        }
    }
    if (isset($_POST['email'])) {
        $email = htmlspecialchars(trim($_POST['email']));
        if (empty($email) or strlen($email) < 100) {
            $error .= "Geben Sie bitte eine korrekte Email-Adresse ein";
        }
    }
    if (isset($_POST['username'])) {
        $username = htmlspecialchars(trim($_POST['username']));
        if (empty($username) or strlen($username) < 30) {
            $error .= "Geben Sie bitte einen korrekten Benutzernamen ein";
        }
    }

    // Keine Fehler, Benutzer in die Datenbank einfügen
    if (empty($error)) {

        //Passwort hashen
        $hashed_password = password_hash($_POST['password'], PASSWORD_DEFAULT);

        // Query erstellen
        $sql_query = "INSERT INTO users (firstname, lastname, email, username, password) VALUES (?, ?, ?, ?, ?)";

        // Query vorbereiten
        $stmt = $dbconn->prepare($sql_query);

        // Parameter binden
        $stmt->bind_param("sssss", $firstname, $lastname, $email, $username, $hashed_password);

        // Statement ausführen
        if ($stmt->execute()) {
            $message = "Benutzer erfolgreich registriert";
        } else {
            $error = "Fehler beim Einfügen des Benutzers in die Datenbank: " . $stmt->error;
        }
        // Statement schliessen
        $stmt->close();
        // Weiterleiten auf Login seite
        //header ("Location: login.php"); //Deaktiviert um Fehlermeldungen zu sehen
    }
}
// Datenbankverbindung schliessen
$dbconn->close();
