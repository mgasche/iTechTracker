<?php
if (isset($_SESSION['firstname']) && isset($_SESSION['lastname'])) {
    // Vorname und Nachname aus der Session auslesen
    $firstname = $_SESSION['firstname'];
    $lastname = $_SESSION['lastname'];

    // Vollständiger Name erstellen
    $fullname = $firstname . ' ' . $lastname;
}
?>
<nav class="navbar navbar-default navbar-fixed-top">
    <div class="container-fluid">
        <div class="navbar-header">
            <a class="navbar-brand" href="./">iTechTracker</a>
            <a href="./dashboard.php" class="btn btn-default navbar-btn">Dashboard</a>
            <a href="./asset-creation.php" class="btn btn-default navbar-btn">Neues Gerät</a>
            <a href="./change-pw.php" class="btn btn-default navbar-btn">Passwort ändern</a>
            <a href="./logout.php" class="btn btn-default navbar-btn">Logout</a>
        </div>
        <?php if (isset($_SESSION['user_id'])) : ?>
            <div class="nav navbar-nav navbar-right">
                <div class="dropdown">
                    <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenu2" data-bs-toggle="dropdown" aria-expanded="false">
                        <?php echo isset($fullname) ? $fullname : 'Dropdown'; ?>
                    </button>
                    <ul class="dropdown-menu" aria-labelledby="dropdownMenu2">
                        <li><a class="dropdown-item" href="change-pw.php">Passwort ändern</a></li>
                        <li><a class="dropdown-item" href="logout.php">Logout</a></li>
                    </ul>
                </div>
            </div>
        <?php endif; ?>

    </div>
    </div>
</nav>