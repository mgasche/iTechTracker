
<?php
if (isset($_SESSION['firstname']) && isset($_SESSION['lastname'])) {
    // Vorname und Nachname aus der Session auslesen
    $firstname = $_SESSION['firstname'];
    $lastname = $_SESSION['lastname'];

    // Vollständiger Name erstellen
    $fullname = $firstname . ' ' . $lastname;
}
?><nav class="navbar navbar-expand-lg bg-body-tertiary">
      <div class="container-fluid">
        <a class="navbar-brand" href="./">iTechTracker</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <ul class="navbar-nav me-auto mb-2 mb-lg-0">
            <li class="nav-item">
              <a class="nav-link active" aria-current="page" href="#">Home</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#">Link</a>
            </li>
            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                Dropdown
              </a>
              <ul class="dropdown-menu">
                <li><a class="dropdown-item" href="#">Action</a></li>
                <li><a class="dropdown-item" href="#">Another action</a></li>
                <li><hr class="dropdown-divider"></li>
                <li><a class="dropdown-item" href="#">Something else here</a></li>
              </ul>
            </li>
            <li class="nav-item">
              <a class="nav-link disabled" aria-disabled="true">Disabled</a>
            </li>
          </ul>
          <ul class="navbar-nav">
                <?php
                // Überprüfen, ob der Benutzer nicht angemeldet ist
                if (!isset($_SESSION['user_id'])) {
                    echo '<li class="nav-item"><a class="nav-link btn btn-success" href="./login.php">Anmelden</a></li>';
                    echo '<li class="nav-item"><a class="nav-link btn btn-primary" href="./register.php">Registrieren</a></li>';
                }
                if (isset($_SESSION['user_id'])) {
                    echo '<li class="nav-item dropdown">';
                    echo '<a class="btn btn-success dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">' . (isset($fullname) ? $fullname : 'Account') . '</a>';
                    echo '<ul class="dropdown-menu">';
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