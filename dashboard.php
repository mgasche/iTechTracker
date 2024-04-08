<?php
session_start(); // Starten der Sitzung


// Überprüfen, ob der Benutzer angemeldet ist
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php"); // Weiterleitung zum Login, falls nicht angemeldet
    exit();
}
$user_id = $_SESSION['user_id'];
// Include Dateien
include('include/dbconnector.inc.php');

// Datenbankabfrage, um die Geräte des Benutzers abzurufen
$query = "SELECT * FROM assets WHERE user_id = ?";
$stmt = $dbconn->prepare($query);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();
?>

<!DOCTYPE html>
<html lang="de">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Dashboard</title>

    <!-- CSS verlinken -->
    <link rel="stylesheet" href="style.css">

    <!-- Bootstrap -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
</head>

<body>
    <?php
    // Include Navbar
    include 'include/navbar.inc.php';
    ?>
    <div class="container">
        <h1>Dashboard</h1>
        <p>Hier können Sie Ihre Geräte verwalten:</p>
        <table class="table">
            <thead>
                <tr>
                    <th>Gerätenamen</th>
                    <th>Modell</th>
                    <th>Hersteller</th>
                    <th>Kaufdatum</th>
                </tr>
            </thead>
            <tbody>
                <?php
                // Schleife durch die abgerufenen Geräte des Benutzers
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . $row['device_name'] . "</td>";
                    echo "<td>" . $row['model'] . "</td>";
                    echo "<td>" . $row['manufacturer'] . "</td>";
                    echo "<td>" . $row['purchase_date'] . "</td>";
                    echo "</tr>";
                }
                ?>
            </tbody>
        </table>
        <a href="asset-creation.php" class="btn btn-primary">Neues Gerät hinzufügen</a>
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