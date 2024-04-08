<?php
// Starten der Session
session_start();
$user_id = $_SESSION['user_id'];

// Überprüfen, ob der Benutzer angemeldet ist
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php"); // Weiterleitung zum Login, falls nicht angemeldet
    exit();
}
// Include Dateien
include 'include/dbconnector.inc.php';
include 'include/db-asset-creation.inc.php';
?>

<!DOCTYPE html>
<html lang="de">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Gerät erstellen</title>
    <!-- CSS verlinken -->
    <link rel="stylesheet" href="style.css">
    <!-- Bootstrap -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
</head>

<body>
    <?php
    include 'include/navbar.inc.php';
    ?>
    <div class="container">
        <h1>Gerät erstellen</h1>
        <?php
        // Ausgabe der Fehlermeldungen und Erfolgsmeldungen 
        if (!empty($error)) {
            echo "<div class=\"alert alert-danger\" role=\"alert\">" . $error . "</div>";
        } elseif (!empty($message)) {
            echo "<div class=\"alert alert-success\" role=\"alert\">" . $message . "</div>";
        }
        ?>
        <form action="" method="post">
            <div class="form-group">
                <label for="device_name">Gerätename *</label>
                <input type="text" name="device_name" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="model">Model *</label>
                <input type="text" name="model" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="manufacturer">Hersteller *</label>
                <input type="text" name="manufacturer" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="purchase_date">Kaufdatum</label>
                <input type="date" name="purchase_date" class="form-control">
            </div>
            <div class="form-group">
                <label for="price">Preis</label>
                <input type="number" name="price" class="form-control" step="0.01">
            </div>
            <div class="form-group">
                <label for="color">Farbe</label>
                <input type="text" name="color" class="form-control">
            </div>
            <div class="form-group">
                <label for="processor">Prozessor</label>
                <input type="text" name="processor" class="form-control">
            </div>
            <div class="form-group">
                <label for="ram">RAM</label>
                <input type="text" name="ram" class="form-control">
            </div>
            <div class="form-group">
                <label for="storage">Speicher</label>
                <input type="text" name="storage" class="form-control">
            </div>
            <div class="form-group">
                <label for="warranty_end">Garantieende</label>
                <input type="date" name="warranty_end" class="form-control">
            </div>
            <!-- ToDo: Bild Imput feld erstellen -->
            <button type="submit" class="btn btn-primary">Gerät erstellen</button>
        </form>
    </div>
    <?php
    // Include Navbar
    include 'include/footer.inc.php';
    ?>
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</body>

</html>