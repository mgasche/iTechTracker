<?php
session_start();

// Überprüfen, ob der Benutzer angemeldet ist
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php"); // redirect zu login
    exit();
}

$error = $message = "";

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    // DB verbindung
    include 'include/dbconnector.inc.php';

    $user_id = $_SESSION['user_id'];

    if (
        !isset($_POST['current_password']) || empty($_POST['current_password']) ||
        !isset($_POST['new_password']) || empty($_POST['new_password']) ||
        !isset($_POST['confirm_password']) || empty($_POST['confirm_password'])
    ) {
        $error = "Bitte füllen Sie alle Felder aus.";
    } else {
        $current_password = $_POST['current_password'];
        $new_password = $_POST['new_password'];
        $confirm_password = $_POST['confirm_password'];
        // Passwortüberprüfung gemäß den angegebenen Kriterien
        if (!preg_match('/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[^a-zA-Z\d\s:])([\w!@#$%^&*()-=+.,;?]){12,}$/', $new_password)) {
            $error = "Das neue Passwort muss mindestens 12 Zeichen lang sein und mindestens einen Grossbuchstaben, einen Kleinbuchstaben, eine Zahl und ein Sonderzeichen enthalten. ";
        } elseif ($new_password !== $confirm_password) {
            $error = "Das neue Passwort und das bestätigte Passwort stimmen nicht überein.";
        } else {
            $sql = "SELECT password FROM users WHERE id = ?";
            $stmt = $dbconn->prepare($sql);
            $stmt->bind_param("i", $user_id);
            $stmt->execute();
            $result = $stmt->get_result();
            $row = $result->fetch_assoc();

            if (!$row || !password_verify($current_password, $row['password'])) {
                $error = "Das aktuelle Passwort ist nicht korrekt.";
            } else {
                $hashed_password = password_hash($new_password, PASSWORD_DEFAULT);
                $update_sql = "UPDATE users SET password = ? WHERE id = ?";
                $update_stmt = $dbconn->prepare($update_sql);
                $update_stmt->bind_param("si", $hashed_password, $user_id);
                if ($update_stmt->execute()) {
                    $message = "Das Passwort wurde erfolgreich aktualisiert.";
                } else {
                    $error = "Ein Fehler ist beim Aktualisieren des Passworts aufgetreten.";
                }
                $update_stmt->close();
            }
            $stmt->close();
        }
    }
    $dbconn->close();
}
?>

<!DOCTYPE html>
<html lang="de">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Passwort ändern</title>
    <!-- CSS verlinken -->
    <link rel="stylesheet" href="style.css">
    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>

<body>
    <?php include 'include/navbar.inc.php'; ?>
    <div class="container content-all">
        <h1>Passwort ändern</h1>
        <?php
        if (!empty($error)) {
            echo "<div class=\"alert alert-danger\" role=\"alert\">" . $error . "</div>";
        } elseif (!empty($message)) {
            echo "<div class=\"alert alert-success\" role=\"alert\">" . $message . "</div>";
        }
        ?>
        <form method="post" onsubmit="return validatePassword()">
            <div class="form-group">
                <label for="current_password">Aktuelles Passwort</label>
                <input type="password" id="current_password" name="current_password" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="new_password">Neues Passwort</label>
                <input type="password" id="new_password" name="new_password" minlength="12" maxlength="255" class="form-control" required>
                <small id="passwordHelpBlock" class="form-text text-muted">
                    Das Passwort muss mindestens 12 Zeichen lang sein und mindestens einen Grossbuchstaben, einen Kleinbuchstaben, eine Zahl und ein Sonderzeichen enthalten.
                </small>
            </div>
            <div class="form-group">
                <label for="confirm_password">Passwort bestätigen</label>
                <input type="password" id="confirm_password" name="confirm_password" minlength="12" maxlength="255" class="form-control" required>
            </div>
            <br>
            <button type="submit" class="btn btn-primary">Passwort ändern</button>
        </form>
    </div>
    <?php
    // Include Navbar
    include 'include/footer.inc.php';
    ?>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.min.js" integrity="sha384-Atwg2Pkwv9vp0ygtn1JAojH0nYbwNJLPhwyoVbhoPwBhjQPR5VtM2+xf0Uwh9KtT" crossorigin="anonymous"></script>
</body>

</html>