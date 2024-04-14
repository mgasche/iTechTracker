<?php
session_start(); // Starten der Sitzung
// Überprüfen, ob eine Suchanfrage gesendet wurde
if(isset($_GET['query'])) {
    // Suchanfrage auswerten
    $search_query = $_GET['query'];

} else {
    header("Location: index.php");
    exit();
}
include 'include/search.inc.php'
?>


<!DOCTYPE html>
<html lang="de">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Suchergebnisse - iTechTracker</title>

    <!-- CSS verlinken -->
    <link rel="stylesheet" href="Style.css">

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>

<body>
    <?php include 'include/navbar.inc.php'; ?>

    <div class="container content-all">
        <h1>Suchergebnisse</h1>
        <p>Hier sind die Suchergebnisse:</p>
        <table class="table">
            <thead>
                <tr>
                    <th>Benutzer</th>
                    <th>Gerätenamen</th>
                    <th>Modell</th>
                    <th>Hersteller</th>
                    <th>Kaufdatum</th>
                </tr>
            </thead>
            <tbody>
                <?php
                // Schleife durch die Suchergebnisse
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . $row['user_id'] . "</td>";
                    echo "<td>" . $row['device_name'] . "</td>";
                    echo "<td>" . $row['model'] . "</td>";
                    echo "<td>" . $row['manufacturer'] . "</td>";
                    echo "<td>" . $row['purchase_date'] . "</td>";
                    echo "</tr>";
                }
                ?>
            </tbody>
        </table>
    </div>

    <?php include 'include/footer.inc.php'; ?>

    <!-- Bootstrap JavaScript-Links -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.min.js" integrity="sha384-Atwg2Pkwv9vp0ygtn1JAojH0nYbwNJLPhwyoVbhoPwBhjQPR5VtM2+xf0Uwh9KtT" crossorigin="anonymous"></script>
</body>

</html>
