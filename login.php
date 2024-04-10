<?php
session_start(); // Starten der Sitzung

// Include Dateien
include('include/dbconnector.inc.php');

$error = $message = ''; // Initialisierung der Variablen mit leeren Werten

// Überprüfen, ob der Benutzer bereits angemeldet ist
if (isset($_SESSION['user_id'])) {
    header("Location: overview.php"); // Weiterleitung auf das Dashboard
    exit();
}

// Formular wurde gesendet und Benutzer ist noch nicht angemeldet
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Benutzereingaben überprüfen
    if (isset($_POST['username']) && isset($_POST['password'])) {

        // Benutzereingaben trimmen
        $username = trim($_POST['username']);
        $password = trim($_POST['password']);

        // Datenbankabfrage, um Benutzerdaten abzurufen
        $query = "SELECT * FROM users WHERE username = ?";
        $stmt = $dbconn->prepare($query);
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $result = $stmt->get_result();

        // Benutzer in der Datenbank gefunden?
        if ($result->num_rows == 1) {
            $row = $result->fetch_assoc();
            $stored_password = $row['password'];

            // Passwort überprüfen
            if (password_verify($password, $stored_password)) {
                // Setzen der Benutzerinformationen in der Sitzung
                $_SESSION['user_id'] = $row['id']; // User ID
                $_SESSION['username'] = $row['username']; // Username
                $_SESSION['firstname'] = $row['firstname']; // Vorname
                $_SESSION['lastname'] = $row['lastname']; // Nachname
                $message = "Sie sind nun eingeloggt.";
                session_regenerate_id(true);
                // Weiterleitung des Benutzers auf Dashboard bei Erfolg.
                header("Location: overview.php");
                exit();
            } else {
                $error = "Benutzername oder Passwort ist falsch.";
            }
        } else {
            $error = "Benutzername oder Passwort ist falsch.";
        }
    } else {
        $error = "Geben Sie bitte Benutzername und Passwort an.";
    }
}
?>
<!DOCTYPE html>
<html lang="de">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login - iTechTracker</title>

    <!-- CSS verlinken -->
    <link rel="stylesheet" href="style.css">

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>

<body>
<?php
    // Include Navbar
    include 'include/navbar.inc.php';
    ?>
    <div class="container content-all">
        <h1>Login</h1>
        <p>
            Bitte melden Sie sich mit Benutzernamen und Passwort an.
        </p>
        <?php
        // Fehlermeldung oder Nachricht ausgeben
        if (!empty($message)) {
            echo "<div class=\"alert alert-success\" role=\"alert\">" . $message . "</div>";
        } else if (!empty($error)) {
            echo "<div class=\"alert alert-danger\" role=\"alert\">" . $error . "</div>";
        }
        ?>
        <form action="" method="POST">
            <div class="form-group">
                <label for="username">Benutzername</label>
                <input type="text" name="username" class="form-control" id="username" value="" title="Gross- und Keinbuchstaben, min 6 Zeichen." maxlength="30" required="true">
            </div>
            <!-- password -->
            <div class="form-group">
                <label for="password">Passwort</label>
                <input type="password" name="password" class="form-control" id="password" title="mindestens einen Gross-, einen Kleinbuchstaben, eine Zahl und ein Sonderzeichen, mindestens 8 Zeichen lang,keine Umlaute." maxlength="255" required="true">
            </div>
            <button type="submit" name="button" value="submit" class="btn btn-primary">Anmelden</button>
            <button type="reset" name="button" value="reset" class="btn btn-secondary">Löschen</button><br><br>
            <p>
                Sie haben noch kein ein Konto?
            </p>
            <button onclick="window.location.href='./register.php';" type="button" name="button" class="btn btn-light">Registrieren</button>
        </form>

    </div>
    <?php
    // Include Navbar
    include 'include/footer.inc.php';
    ?>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" ></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.min.js" integrity="sha384-Atwg2Pkwv9vp0ygtn1JAojH0nYbwNJLPhwyoVbhoPwBhjQPR5VtM2+xf0Uwh9KtT" crossorigin="anonymous"></script>
</body>

</html>
