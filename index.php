<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Initiation a MySQL</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bulma@0.9.0/css/bulma.min.css">
  </head>
  <body>
  <?php
  
  require ('dbconfig.php');

  try {
    $conn = new PDO("mysql:host=$servername;dbname=guillaumeb_dbmay", $username, $password);
    // set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  } catch(PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
  }
     
  ?>
    <nav class="navbar bd-navbar is-spaced has-shadow" role="navigation" aria-label="main navigation">
        <div class="navbar-brand">
          <a class="navbar-item" href="github.io/miluge">
            Initiation PHP
          </a>
          <a class="navbar-item">
            Home
          </a>
          <div class="navbar-item has-dropdown">
            <a class="navbar-link">
              Docs
            </a>
            <div class="navbar-dropdown">
                <a class="navbar-item" href="https://www.php.net/docs.php">
                    PHP
                  </a>
                  <a class="navbar-item" href="https://dev.mysql.com/doc/">
                    MySQL
                  </a>
            </div>
          </div>
          <a class="navbar-item" href="https://github.com/miluge">
            Github
          </a>
          <a role="button" class="navbar-burger" aria-label="menu" aria-expanded="false">
            <span aria-hidden="true"></span>
            <span aria-hidden="true"></span>
            <span aria-hidden="true"></span>
          </a>
        </div>
    </nav>
  <div class="container">
    <div class="content">
      <section class="section">
        <p>1) Afficher tous les gens dont le nom est palmer.<br>
            Solution :
            <blockquote>
            SELECT `last_name` FROM `clients`<br> 
            WHERE `last_name` = 'Palmer' 
            </blockquote>
        </p>
      </section>
      <section class="section">
        <p>2) Afficher toutes les femmes.<br>
            Solution : 
            <blockquote>
            SELECT `gender` FROM `clients`<br> 
            WHERE `gender` = 'Female' 
            </blockquote>
        </p>
      </section>
      <section class="section">
        <p>3) Tous les états dont la lettre commence par N.<br>
            Solution : 
            <blockquote>
            SELECT `country_code` FROM `clients`<br> 
            WHERE `country_code` LIKE 'N%'
            </blockquote>
        </p> 
      </section>
      <section class="section">
        <p>4) Tous les emails qui contiennent google.<br>
            Solution : 
            <blockquote>
            SELECT `email` FROM `clients`<br> 
            WHERE `email` LIKE '%google%'
            </blockquote>
        </p>
      </section>
      <section class="section">
        <p>5) Répartition par Etat et le nombre d’enregistrement par état (croissant).<br>
            Solution : 
            <blockquote>
            SELECT `country_code`, COUNT(*) FROM `clients`<br>
            GROUP BY `country_code`
            </blockquote>
        </p>
      </section>
      <section class="section">
        <p>6) Insérer un utilisateur, lui mettre à jour son adresse mail puis supprimer l’utilisateur.<br>
            Solution : 
            <blockquote>
            INSERT INTO clients (id, first_name, last_name, email, gender, ip_address, birth_date, zip_code, avatar_url, state_code, country_code)<br> 
            VALUES ('0', 'Edward', 'Radical', 'radicaled@bebop.co', 'Female', '152.181.43.128', '03/04/1998', '90000', 'http://bebop.com', 'MMN', 'FR')<br>
            UPDATE clients SET email = 'holaed@bebop.co' WHERE email = 'radicaled@bebop.co'<br>
            DELETE FROM clients WHERE email = 'holaed@bebop.co'
            </blockquote>
        </p>
      </section>
      <section class="section">
        <p>7) Nombre de femme et d’homme.<br>
            Solution : 
            <blockquote>
            SELECT `gender`, COUNT(*) FROM `clients` 
            GROUP BY `gender`
            </blockquote>
        </p>
      </section>
      <section class="section">
        <p>8) Afficher l'âge de chaque personne, puis la moyenne d’âge générale, celle des femmes puis celle des hommes.<br>
            Solution : 
            <blockquote>
            SELECT TIMESTAMPDIFF(year, STR_TO_DATE(birth_date, '%d/%m/%Y'), NOW()) AS age FROM `clients`;<br>
            SELECT AVG (TIMESTAMPDIFF(year, STR_TO_DATE(birth_date, '%d/%m/%Y'), NOW())) AS average FROM `clients`;<br>
            SELECT gender, AVG (TIMESTAMPDIFF(year, STR_TO_DATE(birth_date, '%d/%m/%Y'), NOW())) AS average FROM `clients` GROUP BY gender
            </blockquote>
        </p>
      </section>
      <section class="section">
        <p>9) Créer deux nouvelles tables, une qui contient l’ensemble des membres de l’ACS, l’autre qui contient les département avec numéros et nom écrit.<br>
            Afficher le nom de chaque apprenant avec son département de résidence.<br>
            Solution : 
            <blockquote>
            <?php
            $reponse = $conn->query('SELECT first_name, last_name, region.id_departement, region.name FROM `apprenants`, `region` WHERE apprenants.id_departement = region.id_departement');
            while ($donnees = $reponse->fetch()) {
              echo '<p>' . $donnees['last_name'].', '.$donnees['first_name'].', '.$donnees['id_departement'].', ' .$donnees['name']. '</p>';
            }
            ?>
            </blockquote>
        </p>
      </section>
    </div>
  </div>
  <footer class="footer">
    <div class="content has-text-centered">
        <p>
        <strong>Initiation MySQL</strong> par <a href="https://blondelguillau.me">Guillaume Blondel</a>
        </p>
    </div>
  </footer>
  <script>
      document.addEventListener('DOMContentLoaded', function () {

        // Get all "navbar-burger" elements
        var $navbarBurgers = Array.prototype.slice.call(document.querySelectorAll('.navbar-burger'), 0);

        // Check if there are any navbar burgers
        if ($navbarBurgers.length > 0) {

        // Add a click event on each of them
        $navbarBurgers.forEach(function ($el) {
            $el.addEventListener('click', function () {

            // Get the target from the "data-target" attribute
            var target = $el.dataset.target;
            var $target = document.getElementById(target);

            // Toggle the class on both the "navbar-burger" and the "navbar-menu"
            $el.classList.toggle('is-active');
            $target.classList.toggle('is-active');
            });
        });
        }

        });
  </script>
  </body>
</html>