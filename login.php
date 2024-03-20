<?php

// Datenbankverbindung
include('include/dbconnector.inc.php');

$error = $message = ''; // Initialisierung der Variablen mit leeren Werten

//ToDo: DB Anbindung und Abfrage 

?>
<!DOCTYPE html>
<html lang="de">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login</title>

    <!-- CSS verlinken -->
    <link rel="stylesheet" href="style.css">

    <!-- Bootstrap -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
</head>

<body>
    <?php
    // Include Navbar
    include 'include/navbar.php';
    ?>
    <div class="container">
        <h1>Login</h1>
        <p>
            Bitte melden Sie sich mit Benutzernamen und Passwort an.
        </p>
        <?php
        // fehlermeldung oder nachricht ausgeben
        if (!empty($message)) {
            echo "<div class=\"alert alert-success\" role=\"alert\">" . $message . "</div>";
        } else if (!empty($error)) {
            echo "<div class=\"alert alert-danger\" role=\"alert\">" . $error . "</div>";
        }
        ?>
        <form action="" method="POST">
            <div class="form-group">
                <label for="username">Benutzername *</label>
                <input type="text" name="username" class="form-control" id="username" value="" placeholder="Gross- und Keinbuchstaben, min 6 Zeichen." pattern="(?=.*[a-z])(?=.*[A-Z])[a-zA-Z]{2,}" title="Gross- und Keinbuchstaben, min 6 Zeichen." maxlength="30" required="true">
            </div>
            <!-- password -->
            <div class="form-group">
                <label for="password">Password *</label>
                <input type="password" name="password" class="form-control" id="password" placeholder="Gross- und Kleinbuchstaben, Zahlen, Sonderzeichen, min. 8 Zeichen, keine Umlaute" pattern="(?=^.{8,}$)((?=.*\d+)(?=.*\W+))(?![.\n])(?=.*[A-Z])(?=.*[a-z]).*$" title="mindestens einen Gross-, einen Kleinbuchstaben, eine Zahl und ein Sonderzeichen, mindestens 8 Zeichen lang,keine Umlaute." maxlength="255" required="true">
            </div>
            <button type="submit" name="button" value="submit" class="btn btn-primary">Senden</button>
            <button type="reset" name="button" value="reset" class="btn btn-warning">Löschen</button><br><br>
            <p>
                Sie haben noch kein ein Konto?
            </p>
            <button onclick="window.location.href='./register.php';" type="button" name="button" class="btn btn-info">Registrieren</button>
        </form>

    </div>

    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</body>

</html>