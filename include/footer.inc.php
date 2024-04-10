<footer class="footer bg-dark text-light ">
  <div class="container">
    <div class="row">
      <div class="col-md-4">
        <h5>Kategorien</h5>
        <ul class="list-unstyled">
          <li><a href="#" class="text-light">iPhone</a></li>
          <li><a href="#" class="text-light">iPad</a></li>
          <li><a href="#" class="text-light">Mac</a></li>
          <li><a href="#" class="text-light">Watch</a></li>
          <li><a href="#" class="text-light">Diverses</a></li>
        </ul>
      </div>
      <div class="col-md-4">
        <h5>Über uns</h5>
        <ul class="list-unstyled">
          <li><a href="./about.php" class="text-light">Über iTechTracker</a></li>
          <li><a href="./datenschutz.php" class="text-light">Datenschutz</a></li>
          <li><a href="./impressum.php" class="text-light">Impressum</a></li>
          <li><a href="./kontakt" class="text-light">Kontakt</a></li>
          <li><a href="#" class="text-light">Sitemap</a></li>
        </ul>
      </div>
    </div>
    <div class="row mt-4">
      <div class="col">
        <hr class="bg-light">
      </div>
    </div>
    <div class="row">
      <div class="col">
        <?php
        $year = date('Y');
        echo '<p>Copyright &copy; ' . $year . ' TomatoTec - iTechTracker. Alle Rechte vorbehalten.</p>';
        ?>
      </div>
    </div>
  </div>

</footer>