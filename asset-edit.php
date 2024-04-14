<?php
// Starten der Session
session_start();

// Überprüfen, ob der Benutzer angemeldet ist
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php"); // Redirect zu login falls nicht gefudnen
    exit();
}

// Include Dateien
include 'include/dbconnector.inc.php';

// Überprüfen, ob die ID des Assets im URL-Parameter vorhanden ist
if (!isset($_GET['id'])) {
    header("Location: overview.php"); //Wenn nicht gefunden redirect zu overview
    exit();
}

$asset_id = intval($_GET['id']);

// Daten aus der Datenbank abrufen, um das Asset mit der angegebenen ID zu laden
$query = "SELECT * FROM assets WHERE asset_id = ? AND user_id = ?";
$stmt = $dbconn->prepare($query);
$user_id = $_SESSION['user_id'];
$stmt->bind_param("ii", $asset_id, $user_id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows == 0) {
    header("Location: overview.php"); //Wenn nicht gefunden redirect zu overview
    exit();
}

// Daten des Assets laden
$asset = $result->fetch_assoc();

// Wurden Daten mit "POST" gesendet?
if ($_SERVER['REQUEST_METHOD'] == "POST") {
    if (!isset($_POST['device_name']) || empty($_POST['device_name'])) {
        $error .= "Bitte geben Sie einen Gerätenamen ein. ";
    } else {
        $device_name = htmlspecialchars(trim($_POST['device_name']));
    }
    if (!isset($_POST['model']) || empty($_POST['model'])) {
        $error .= "Bitte geben Sie ein Modell ein. ";
    } else {
        $model = htmlspecialchars(trim($_POST['model']));
    }
    if (!isset($_POST['manufacturer']) || empty($_POST['manufacturer'])) {
        $error .= "Bitte geben Sie einen Hersteller ein. ";
    } else {
        $manufacturer = htmlspecialchars(trim($_POST['manufacturer']));
    }

    if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
        // Dateiname und Speicherpfad festlegen
        $filename = $_FILES['image']['name'];
        $temp_filepath = $_FILES['image']['tmp_name'];

        // Dateiendung überprüfen
        $allowed_extensions = array('jpg', 'jpeg', 'png', 'gif');
        $file_extension = strtolower(pathinfo($filename, PATHINFO_EXTENSION));

        if (!in_array($file_extension, $allowed_extensions)) {
            $error .= "Nur JPG, JPEG, PNG und GIF Dateien sind erlaubt. ";
        } else {
            // Eindeutigen Dateinamen generieren
            $unique_filename = uniqid() . '_' . $filename;

            // Speicherpfad der Bilder bestimmen
            $new_filepath = "public/asset-media/" . $unique_filename;
            // Bild speichern
            if (move_uploaded_file($temp_filepath, $new_filepath)) {
                // Bild wurde erfolgreich hochgeladen
                $image_path = $new_filepath; // Bild in db Speichern
            } else {
                // Fehler beim Speichern des Bildes
                $error .= "Fehler beim Hochladen des Bildes. ";
            }
        }
    } else {
        // Kein Bild hochgeladen = null in DB
        $image_path = NULL;
    }


    $purchase_date = isset($_POST['purchase_date']) ? $_POST['purchase_date'] : "";
    $price = isset($_POST['price']) ? ($_POST['price'] !== '' ? floatval($_POST['price']) : null) : null;
    $color = isset($_POST['color']) ? htmlspecialchars(trim($_POST['color'])) : "";
    $processor = isset($_POST['processor']) ? htmlspecialchars(trim($_POST['processor'])) : "";
    $ram = isset($_POST['ram']) ? htmlspecialchars(trim($_POST['ram'])) : "";
    $storage = isset($_POST['storage']) ? htmlspecialchars(trim($_POST['storage'])) : "";
    $warranty_end = isset($_POST['warranty_end']) ? $_POST['warranty_end'] : "";
    $public = isset($_POST['public']) && $_POST['public'] === 'on' ? true : false;

    if ($purchase_date === "") {
        $purchase_date = null;
    }

    if ($warranty_end === "") {
        $warranty_end = null;
    }

    $query = "UPDATE assets SET device_name = ?, model = ?, manufacturer = ?, purchase_date = ?, price = ?, color = ?, processor = ?, ram = ?, storage = ?, warranty_end = ?, image_path = ?, public = ? WHERE asset_id = ? AND user_id = ?";

    // Query vorbereiten
    $stmt = $dbconn->prepare($query);

    // Parameter binden
    $stmt->bind_param("sssssssssssiii", $device_name, $model, $manufacturer, $purchase_date, $price, $color, $processor, $ram, $storage, $warranty_end, $image_path, $public, $asset_id, $user_id);

    // Statement ausführen
    if ($stmt->execute()) {
        // Erfolgreich aktualisiert
        $message = "Asset erfolgreich aktualisiert";

        // Nach dem Speichern zur gleichen Seite weiterleiten, um die aktualisierten Daten anzuzeigen
        header("Location: " . $_SERVER['PHP_SELF'] . "?id=" . $asset_id);
        exit();
    } else {
        // Fehler beim Aktualisieren
        $error = "Fehler beim Aktualisieren des Assets: " . $stmt->error;
    }

    // Statement schließen
    $stmt->close();
} else {
    // Formularfelder mit den Daten aus der Datenbank vorbefüllen
    $device_name = $asset['device_name'];
    $model = $asset['model'];
    $manufacturer = $asset['manufacturer'];
    $purchase_date = $asset['purchase_date'];
    $price = $asset['price'];
    $color = $asset['color'];
    $processor = $asset['processor'];
    $ram = $asset['ram'];
    $storage = $asset['storage'];
    $warranty_end = $asset['warranty_end'];
    $public = $asset['public'];
    $image_path = $asset['image_path'];
}

?>

<!DOCTYPE html>
<html lang="de">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Asset bearbeiten</title>
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
        <h1>Asset bearbeiten</h1>
        <?php
        // Ausgabe der Fehlermeldungen und Erfolgsmeldungen 
        if (!empty($error)) {
            echo "<div class=\"alert alert-danger\" role=\"alert\">" . $error . "</div>";
        } elseif (!empty($message)) {
            echo "<div class=\"alert alert-success\" role=\"alert\">" . $message . "</div>";
        }
        ?>
        <form method="post">
            <div class="form-group">
                <label for="device_name">Gerätename *</label>
                <input type="text" id="device_name" name="device_name" class="form-control" value="<?php echo $asset['device_name']; ?>" required>
            </div>
            <div class="form-group">
                <label for="model">Model *</label>
                <input type="text" id="model" name="model" class="form-control" value="<?php echo $asset['model']; ?>" required>
            </div>
            <div class="form-group">
                <label for="manufacturer">Hersteller *</label>
                <input type="text" id="manufacturer" name="manufacturer" class="form-control" value="<?php echo $asset['manufacturer']; ?>" required>
            </div>
            <div class="form-group">
                <label for="purchase_date">Kaufdatum</label>
                <input type="date" id="purchase_date" name="purchase_date" value="<?php echo $asset['purchase_date']; ?>" class="form-control">
            </div>
            <div class="form-group">
                <label for="price">Preis</label>
                <input type="number" id="price" name="price" class="form-control" step="0.01" value="<?php echo $asset['price']; ?>">
            </div>
            <div class="form-group">
                <label for="color">Farbe</label>
                <input type="text" id="color" name="color" class="form-control" value="<?php echo $asset['color']; ?>">
            </div>
            <div class="form-group">
                <label for="processor">Prozessor</label>
                <input type="text" id="processor" name="processor" class="form-control" value="<?php echo $asset['processor']; ?>">
            </div>
            <div class="form-group">
                <label for="ram">RAM</label>
                <input type="text" id="ram" name="ram" class="form-control" value="<?php echo $asset['ram']; ?>">
            </div>
            <div class="form-group">
                <label for="storage">Speicher</label>
                <input type="text" id="storage" name="storage" class="form-control" value="<?php echo $asset['storage']; ?>">
            </div>
            <div class="form-group">
                <label for="warranty_end">Garantieende</label>
                <input type="date" id="warranty_end" name="warranty_end" class="form-control" value="<?php echo $asset['warranty_end']; ?>">
            </div>
            <br>
            <div class="form-group">
                <div class="form-check form-switch">
                    <input class="form-check-input" type="checkbox" id="public" name="public" <?php echo $asset['public'] == 1 ? 'checked' : ''; ?>>
                    <label class="form-check-label" for="public">Öffentlich</label>
                </div>
            </div>
            <br>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="image">Bild hochladen</label>
                        <input type="file" id="image" name="image" accept="image/png, image/jpg, image/jpeg" class="form-control">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <?php if (!empty($asset['image_path'])) : ?>
                            <img src="<?php echo $asset['image_path']; ?>" alt="Bild" style="max-width: 200px;">
                        <?php else : ?>
                            <p>Kein Bild vorhanden</p>
                        <?php endif; ?>
                    </div>
                </div>
            </div>


            <br>
            <button type="submit" class="btn btn-primary">Speichern</button>
            <button onclick="window.location.href='./overview.php';" type="button" name="button" class="btn btn-light">zurück</button>
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