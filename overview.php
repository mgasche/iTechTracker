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

// Löschen eines Geräts, wenn die Anfrage zum Löschen gesendet wurde
if (isset($_POST['delete_asset'])) {
    $asset_id_to_delete = $_POST['asset_id'];

    // Query zum Löschen des Geräts ausführen
    $delete_query = "DELETE FROM assets WHERE asset_id = ? AND user_id = ?";
    $stmt = $dbconn->prepare($delete_query);
    $stmt->bind_param("ii", $asset_id_to_delete, $user_id);
    if ($stmt->execute()) {
        // Erfolgreich gelöscht
        // Hier können Sie eine Erfolgsmeldung anzeigen, wenn Sie möchten
    } else {
        // Fehler beim Löschen
        // Hier können Sie eine Fehlermeldung anzeigen, wenn Sie möchten
    }
}

// Datenbankabfrage, um die Geräte des Benutzers abzurufen
$query = "SELECT * FROM assets WHERE user_id = ?";
$stmt = $dbconn->prepare($query);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();

if (isset($_SESSION['firstname']) && isset($_SESSION['lastname'])) {
    // Vorname und Nachname aus der Session auslesen
    $firstname = $_SESSION['firstname'];
    $lastname = $_SESSION['lastname'];

    // Vollständiger Name erstellen
    $fullname = $firstname . ' ' . $lastname;
}

?>

<!DOCTYPE html>
<html lang="de">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Übersicht - iTechTracker</title>

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
        <?php
        $current_hour = date("H"); // Die aktuelle Stunde im 24-Stunden-Format abrufen
        // Gruss entsprechend der Tageszeit auswählen
        if ($current_hour < 12) {
            $greeting = "Guten Morgen";
        } elseif ($current_hour < 18) {
            $greeting = "Guten Tag";
        } else {
            $greeting = "Guten Abend";
        }
        echo '<h2>' . $greeting . ',</h2>';
        echo '<h1>' . $fullname . '</h1>';
        ?>
        <p>Hier können Sie Ihre Geräte verwalten:</p>
        <table class="table">
            <thead>
                <tr>
                    <th>Öffentlich</th>
                    <th>Gerätenamen</th>
                    <th>Modell</th>
                    <th>Hersteller</th>
                    <th>Kaufdatum</th>
                    <th>Ändern</th>
                    <th>Löschen</th>
                </tr>
            </thead>
            <tbody>
                <?php
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . $row['public'] . "</td>";
                    echo "<td>" . $row['device_name'] . "</td>";
                    echo "<td>" . $row['model'] . "</td>";
                    echo "<td>" . $row['manufacturer'] . "</td>";
                    echo "<td>" . $row['purchase_date'] . "</td>";
                    echo "<td><a href='asset-edit.php?id=" . $row['asset_id'] . "' class='btn btn-primary'>Bearbeiten</a></td>";
                    echo "<td>
                    <form method='post'>
                    <input type='hidden' name='asset_id' value='" . $row['asset_id'] . "'>
                    <button type='submit' class='btn btn-danger' name='delete_asset' onclick='return confirm(\"Möchten Sie dieses Gerät wirklich löschen?\")'>Löschen</button>
                </form>
              </td>";
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
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>

</html>