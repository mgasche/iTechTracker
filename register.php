<?php
// Include Dateien
include 'include/dbconnector.inc.php';
include 'include/db-register.inc.php';

$error = $message = '';
?>

<!DOCTYPE html>
<html lang="de">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Registrierung - iTechTracker</title>

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
    <h1>Registrierung - iTechTracker</h1>
    <p>
      Bitte registrieren Sie sich, damit Sie diesen Dienst benutzen können.
    </p>
    <?php
    //Ausgabe Fehlermeldungen 
    if (strlen($error)) {
      echo "<div class=\"alert alert-danger\" role=\"alert\">" . $error . "</div>";
    } elseif (strlen($message)) {
      echo "<div class=\"alert alert-success\" role=\"alert\">" . $message . "</div>";
    }
    ?>
    <form action="" method="post">
      <!--Clientseitige Validierung der Formularfelder -->
      <div class="form-group">
        <label for="firstname">Vorname *</label>
        <input type="text" name="firstname" id="firstname" autocomplete="given-name" class="form-control" placeholder="Geben Sie Ihren Vornamen an.">
      </div>
      <div class="form-group">
        <label for="lastname">Nachname *</label>
        <input type="text" name="lastname" class="form-control" autocomplete="family-name" id="lastname" maxlength="30" required placeholder="Geben Sie Ihren Nachnamen an">
      </div>
      <div class="form-group">
        <label for="email">E-Mail *</label>
        <input type="email" name="email" class="form-control" autocomplete="email" id="email" type="email" maxlength="30" required placeholder="Geben Sie Ihre E-Mail-Adresse an.">
      </div>
      <div class="form-group">
        <label for="username">Benutzername *</label>
        <input type="text" name="username" class="form-control" autocomplete="username" id="username" minlength="6" maxlength="30" required placeholder="Mindestens 6 Zeichen.">
      </div>
      <div class="form-group">
        <label for="password">Password *</label>
        <input type="password" name="password" class="form-control" id="password" required minlength="12" maxlength="255" placeholder="Gross- und Kleinbuchstaben, Zahlen, Sonderzeichen, min. 12 Zeichen, keine Umlaute">
      </div>

      <br>
      <button type="submit" name="button" value="submit" class="btn btn-primary">Registrieren</button>
      <button type="reset" name="button" value="reset" class="btn btn-secondary">Löschen</button><br><br>
      <p>
        Sie haben bereits ein Konto?
      </p>
      <button onclick="window.location.href='./login.php';" type="button" name="button" class="btn btn-light">Anmelden</button>
    </form>
  </div>
  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.min.js" integrity="sha384-Atwg2Pkwv9vp0ygtn1JAojH0nYbwNJLPhwyoVbhoPwBhjQPR5VtM2+xf0Uwh9KtT" crossorigin="anonymous"></script>
</body>
<?php
// Include Navbar
include 'include/footer.inc.php';
?>

</html>