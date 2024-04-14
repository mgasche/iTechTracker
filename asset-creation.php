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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>

<body>
    <?php
    include 'include/navbar.inc.php';
    ?>
    <div class="container content-all">
        <h1>Gerät erstellen</h1>
        <?php
        // Ausgabe der Fehlermeldungen und Erfolgsmeldungen 
        if (!empty($error)) {
            echo "<div class=\"alert alert-danger\" role=\"alert\">" . $error . "</div>";
        } elseif (!empty($message)) {
            echo "<div class=\"alert alert-success\" role=\"alert\">" . $message . "</div>";
        }
        ?>
        <form method="post" enctype="multipart/form-data">
            <div class="form-group">
                <label for="device_name">Gerätename *</label>
                <input type="text" id="device_name" name="device_name" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="model">Model *</label>
                <input type="text" id="model" name="model" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="manufacturer">Hersteller *</label>
                <input type="text" id="manufacturer" name="manufacturer" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="purchase_date">Kaufdatum</label>
                <input  type="date" id="purchase_date" name="purchase_date" class="form-control">
            </div>
            <div class="form-group">
                <label for="price">Preis</label>
                <input type="number" id="price" name="price" class="form-control" step="0.01">
            </div>
            <div class="form-group">
                <label for="color">Farbe</label>
                <input type="text" id="color" name="color" class="form-control">
            </div>
            <div class="form-group">
                <label for="processor">Prozessor</label>
                <input type="text" id="processor" name="processor" class="form-control">
            </div>
            <div class="form-group">
                <label for="ram">RAM</label>
                <input type="text" id="ram" name="ram" class="form-control">
            </div>
            <div class="form-group">
                <label for="storage">Speicher</label>
                <input type="text" id="storage" name="storage" class="form-control">
            </div>
            <div class="form-group">
                <label for="warranty_end">Garantieende</label>
                <input type="date" id="warranty_end" name="warranty_end" class="form-control">
            </div>
            <br>
            <div class="form-group">
                <div class="form-check form-switch">
                    <input class="form-check-input" type="checkbox" id="public" name="public">
                    <label class="form-check-label" for="public">Öffentlich</label>
                </div>
            </div>
            <br>
            <div class="form-group">
                <label for="image">Bild hochladen</label>
                <input type="file" name="image" id="image" accept="image/png, image/jpg, image/jpeg" class="form-control">
            </div>

            <br>
            <button type="submit" class="btn btn-primary">Gerät erstellen</button>
        </form>
    </div>
    <?php
    // Include Navbar
    include 'include/footer.inc.php';
    ?>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>

</html>