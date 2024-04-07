<nav class="navbar navbar-default navbar-fixed-top">
    <div class="container-fluid">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="./">iTechTracker</a>
        </div>
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav">
            
            </ul>

            <?php
            // Überprüfen, ob der Benutzer nicht angemeldet ist
            if (!isset($_SESSION['user_id'])) {
                echo '<ul class="nav navbar-nav navbar-right">';
                echo '<li><a href="./login.php">Anmelden</a></li>';
                echo '<li><a href="./register.php">Registrieren</a></li>';
                echo '</ul>';
            }

            // Überprüfen, ob der Benutzer angemeldet ist
            if (isset($_SESSION['user_id'])) {
                echo '<ul class="nav navbar-nav navbar-right">';
                echo '<li><a href="logout.php">Logout</a></li>';
                echo '</ul>';
            }
            ?>
        </div>
    </div>
</nav>