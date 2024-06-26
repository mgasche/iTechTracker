<?php
session_start(); // Starten der Sitzung

// Include Dateien
include('include/dbconnector.inc.php');

// DB abfrage, um alle Assets abzurufen
$query = "SELECT * FROM assets where public = 1";
$stmt = $dbconn->prepare($query);
$stmt->execute();
$result = $stmt->get_result();
?>

<!DOCTYPE html>
<html lang="de">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Home - iTechTracker</title>

    <!-- CSS verlinken -->
    <link rel="stylesheet" href="Style.css">

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>

<body>
    <?php
    // Include Navbar
    include 'include/navbar.inc.php';
    ?>
    <div class="container content-all">
        <h1>Willkommen beim iTechTracker</h1>
        <p>Hier sehen Sie alle erstellten Assets der User</p>
        <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4">
            <?php
            // Schleife durch die abgerufenen Assets
            while ($row = $result->fetch_assoc()) {
                echo '<div class="col">';
                echo '<div class="card h-100 rounded">';
                // Überprüfen, ob ein Bildpfad vorhanden ist, sonst Standardbild verwenden
                $image_path = isset($row['image_path']) ? $row['image_path'] : 'public/default.webp';
                echo '<img src="' . $image_path . '" class="card-img-top" alt="Asset-Bild">';
                echo '<div class="card-body">';
                echo '<h5 class="card-title">' . $row['device_name'] . '</h5>';
                echo '<p class="card-text">Model: ' . $row['model'] . '</p>';
                echo '<p class="card-text">Hersteller: ' . $row['manufacturer'] . '</p>';
                echo '<p class="card-text">Kaufdatum: ' . $row['purchase_date'] . '</p>';
                echo '<p class="card-text">Benutzer ID: ' . $row['user_id'] . '</p>';
                echo '</div>';
                echo '</div>';
                echo '</div>';
            }
            ?>
        </div>
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
