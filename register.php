<?php
// Include der PHP-Datei für die Benutzerregistrierung
include 'include/dbconnector.inc.php';
include 'include/db-register.inc.php';
?>

<!DOCTYPE html>
<html lang="de">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Registrierung</title>

  <!-- CSS verlinken -->
  <link rel="stylesheet" href="style.css">

  <!-- Bootstrap -->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
</head>

<body>
  <?php
  // Include Navbar
  include 'include/navbar.php';
  ?>
  <div class="container">
    <h1>Registrierung</h1>
    <p>
      Bitte registrieren Sie sich, damit Sie diesen Dienst benutzen können.
    </p>
    <?php
    //Ausgabe der Fehlermeldungen 
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
        <input type="email" name="email" class="form-control" autocomplete="email" id="email" type="email" maxlength="30" required placeholder="Geben Sie Ihre Email-Adresse an.">
      </div>
      <div class="form-group">
        <label for="username">Benutzername *</label>
        <input type="text" name="username" class="form-control" autocomplete="username" id="username" maxlength="30" required placeholder="Gross- und Keinbuchstaben, min 6 Zeichen.">
      </div>
      <div class="form-group">
        <label for="password">Password *</label>
        <input type="password" name="password" class="form-control" id="password" required minlength="12" maxlength="255" placeholder="Gross- und Kleinbuchstaben, Zahlen, Sonderzeichen, min. 12 Zeichen, keine Umlaute">
      </div>
      <div class="form-group col-6">
        <label for="captcha">Enter Captcha*</label>
        <input type="text" class="form-control" name="captcha" id="captcha">
      </div>
      <div class="form-group col-6">
        <label for="captcha">Captcha Code</label>
        <img src="scripts/captcha.php" alt="PHP Captcha">
      </div>

      <button type="submit" name="button" value="submit" class="btn btn-primary">Registrieren</button>
      <button type="reset" name="button" value="reset" class="btn btn-danger">Löschen</button><br><br>
      <p>
                Sie haben bereits ein Konto?
            </p>
            <button onclick="window.location.href='./login.php';" type="button" name="button" class="btn btn-info">Anmelden</button>
    </form>
  </div>

  <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <!-- Include all compiled plugins (below), or include individual files as needed -->
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</body>

</html>