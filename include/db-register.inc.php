<?php
// Wurden Daten mit "POST" gesendet?
if ($_SERVER['REQUEST_METHOD'] == "POST") {

    $error = '';

    // Servervalidierung Validierung
    // Überprüfen erforderlichen Felder und Trimmen und htmlspecialchars
    if (isset($_POST['firstname'])) {
        $firstname = htmlspecialchars(trim($_POST['firstname']));
        if (empty($firstname)) {
            $error .= "Geben Sie bitte Ihren Vornamen ein. ";
        }
    }
    if (isset($_POST['lastname'])) {
        $lastname = htmlspecialchars(trim($_POST['lastname']));
        if (empty($lastname)) {
            $error .= "Geben Sie bitte Ihren Nachnamen ein. ";
        }
    }
    if (isset($_POST['email'])) {
        $email = htmlspecialchars(trim($_POST['email']));
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $error .= "Geben Sie bitte eine gültige E-Mail-Adresse ein. ";
        }
    }
    if (isset($_POST['username'])) {
        $username = htmlspecialchars(trim($_POST['username']));
        if (empty($username) || strlen($username) < 6) {
            $error .= "Der Benutzername muss mindestens 6 Zeichen lang sein. ";
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
        header ("Location: login.php"); //Deaktivieren um Fehlermeldungen zu sehen.
    }
}
// Datenbankverbindung schliessen
$dbconn->close();
?>