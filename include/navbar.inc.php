<?php
if (isset($_SESSION['firstname']) && isset($_SESSION['lastname'])) {
    // Vorname und Nachname aus der Session auslesen
    $firstname = $_SESSION['firstname'];
    $lastname = $_SESSION['lastname'];

    // Vollständiger Name erstellen
    $fullname = $firstname . ' ' . $lastname;
}
?>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
    <div class="container">
        <a class="navbar-brand" href="./">iTechTracker</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav me-auto">
                <?php
                // Überprüfen, ob Benutzer angemeldet ist
                if (isset($_SESSION['user_id'])) {
                    echo '<li class="nav-item"><a class="nav-link" href="./overview.php">Übersicht</a></li>';
                    echo '<li class="nav-item"><a class="nav-link" href="./asset-creation.php">Neues Gerät</a></li>';
                }
                ?>
            </ul>
            <ul class="navbar-nav">
                <?php
                // Überprüfen, ob der Benutzer nicht angemeldet ist
                if (!isset($_SESSION['user_id'])) {
                    echo '<li class="nav-item"><a class=" btn btn-success" href="./login.php">Anmelden</a></li>';
                    echo '<li class="nav-item"><a class=" btn btn-primary" href="./register.php">Registrieren</a></li>';
                }
                if (isset($_SESSION['user_id'])) {
                    echo '<li class="nav-item dropdown ">';
                    echo '<a class="btn btn-success dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">' . (isset($fullname) ? $fullname : 'Account') . '</a>';
                    echo '<ul class="dropdown-menu dropdown-menu-dark dropdown-menu-end">';
                    echo '<li><a class="dropdown-item" href="./profile.php">Mein Profil</a></li>';
                    echo '<li><a class="dropdown-item" href="./change-pw.php">Passwort ändern</a></li>';
                    echo '<li><hr class="dropdown-divider"></li>';
                    echo '<li><a class="dropdown-item" href="./logout.php">Abmelden</a></li>';
                    echo '</ul>';
                }
                ?>
            </ul>
        </div>
    </div>
</nav>

