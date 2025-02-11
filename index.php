<?php
session_start();
error_reporting(E_ALL);
ini_set('display_errors', 1);


?>

<!DOCTYPE html>
<html lang="fr">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="description" content="Portfolio de Fall Moustapha, développeur web full-stack passionné par la création d'expériences numériques uniques.">
    <meta name="keywords" content="Fall Moustapha, développeur web, portfolio, alternance, développeur full-stack">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

    <link rel="stylesheet" href="assets/style.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    
    <title>Portfolio de Fall Moustapha</title>
  </head>
  <body>
    <header>
      
      <div class="menu">
        <img src="assets/img/mf-logo.svg" alt="logo"  >
        
      </div> 
      <nav class="navbar">
        <ul class="links">
          <li><a href="#accueil">Accueil</a></li>
          <li><a href="#propos">À propos de moi</a></li>
          <li><a href="#competences">Mes compétences</a></li>
          <li><a href="#projet">Mes projets</a></li>
          <li><a href="#contact">Contact</a></li>
        </ul>
      </nav>
      
      <div class="burger-menu">
        <i class="fa-solid fa-bars"></i>
      </div>
      
      <div class="burger">
        <ul class="links">
          <li><a href="#accueil">Accueil</a></li>
          <li><a href="#propos">À propos de moi</a></li>
          <li><a href="#competences">Mes compétences</a></li>
          <li><a href="#projet">Mes projets</a></li>
          <li><a href="#contact">Contact</a></li>
        </ul>
      </div>
      
    </header>
    <main>
    
    <section id="accueil">
    <div id="sensation">
        <h1>Portfolio de Fall Moustapha - Développeur web</h1>
        <div class="sensation-content">
            <div class="sensation-text">
                <p>
                    Bienvenue !!! Je m’appelle Moustapha, je suis un apprenti développeur web full-stack de la région parisienne, à la recherche d'une alternance. Passionné par la technologie, je suis fasciné par la création d’expériences numériques uniques.
                </p>
                <p>
                    <strong>Mon objectif :</strong> Développer des solutions sur mesure qui répondent aux besoins des utilisateurs tout en respectant les objectifs commerciaux. Je suis toujours à la recherche de nouveaux défis et j’adore travailler en équipe pour apprendre et partager mes connaissances.
                </p>
            </div>
            <div class="bitmoji">
                <img src="assets/img/bitmojii.jpg" alt="bitmoji">
            </div>
        </div>
    </div>
</section>

    

      <section id="propos">
  <h2>À propos de moi</h2>
  <div class="about-container">
    <div class="about-item">
      <div class="icon">💻</div>
      <h3>Passionné par le développement web</h3>
      <p>
        J'ai toujours été fasciné par le développement web et la possibilité
        de créer des sites web interactifs et fonctionnels.
      </p>
    </div>

    <div class="about-item">
      <div class="icon">📚</div>
      <h3>En quête d'apprentissage constant</h3>
      <p>
        Je suis un apprenant permanent, toujours désireux d'explorer les
        dernières technologies et de développer mes compétences.
      </p>
    </div>

    <div class="about-item">
      <div class="icon">🤝</div>
      <h3>Collaborateur et communicateur</h3>
      <p>
        Je suis toujours à la recherche de nouveaux défis et j'apprécie le
        travail d'équipe et la collaboration, et je suis un communicateur
        clair et efficace.
      </p>
    </div>
  </div>
</section>

<section id="competences">
    <h2>Mes compétences techniques</h2>
    <div class="competences-container">
        
        <div class="competence">
            <h3>Développement Frontend</h3>
            <p>HTML, CSS, JavaScript</p>
            <div class="logos">
                <img src="assets/img/html.png" alt="Logo HTML">
                <img src="assets/img/css.png" alt="Logo CSS">
                <img src="assets/img/js.png" alt="Logo JavaScript">
            </div>
        </div>

        <div class="competence">
            <h3>Développement Backend</h3>
            <p>PHP, PHP Orienté Objet, MySQL</p>
            <div class="logos">
                <img src="assets/img/php.png" alt="Logo PHP">
                <img src="assets/img/mysql.png" alt="Logo MySQL">
            </div>
        </div>

        <div class="competence">
            <h3>Gestion de Version & Collaboration</h3>
            <p>Git, GitHub</p>
            <div class="logos">
                <img src="assets/img/git.png" alt="Logo Git">
                <img src="assets/img/github.png" alt="Logo GitHub">
            </div>
        </div>

        <div class="competence">
            <h3>Autres Compétences</h3>
            <p>Photoshop, InDesign, Illustrator</p>
            <div class="logos">
                <img src="assets/img/ps.png" alt="Logo Photoshop">
                <img src="assets/img/indesign.png" alt="Logo InDesign">
                <img src="assets/img/illustrator.png" alt="Logo Illustrator">
            </div>
        </div>

    </div>
</section>



          <section id="projet">
    <h2>Projets</h2>
    <div class="projet-container">
        <?php
        require_once 'Database.php';
        require_once 'back-office/Project.php';

        $database = new Database();
        $db = $database->getConnection();

        $project = new Project($db);
        $stmt = $project->read();

        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            // Échapper les données pour éviter les failles XSS
            $title = htmlspecialchars($row['title'], ENT_QUOTES, 'UTF-8');
            $description = htmlspecialchars($row['description'], ENT_QUOTES, 'UTF-8');
            $image = htmlspecialchars($row['image'], ENT_QUOTES, 'UTF-8');

            echo "<div class='projet'>";
            echo "<img src='assets/img/{$image}' alt='{$title}' width='200px'>";
            echo "<h3>{$title}</h3>";
            echo "<p>{$description}</p>";
            echo "</div>";
        }
        ?>
    </div>
</section>

    
      <section id="contact">
        <h2>Contact</h2>
        <p>Je suis ouvert aux opportunités de collaboration et de projet. N’hésitez pas à me contacter pour discuter de vos idées, projets ou opportunités professionnelles.</p>
        <div id="formulaire">
            <?php if (!empty($_SESSION["success"])): ?>
                <div class="message success"> <?= $_SESSION["success"] ?> </div>
                <?php unset($_SESSION["success"]); ?>
            <?php elseif (!empty($_SESSION["error"])): ?>
                <div class="message error"> <?= $_SESSION["error"] ?> </div>
                <?php unset($_SESSION["error"]); ?>
            <?php endif; ?>
            
            <form method="POST" action="process_form.php">
                <h3>Contactez-moi</h3>
                <label for="nom">NOM</label>
                <input type="text" name="nom" id="nom" placeholder="Entrer votre nom" required />
                <br />
                <label for="prenom">Prénom</label>
                <input type="text" name="prenom" id="prenom" placeholder="Entrer votre prénom" required />
                <br />
                <label for="mail">Email</label>
                <input type="email" name="mail" id="mail" placeholder="Entrer votre email" required />
                <br />
                <label for="message">Message</label>
                <textarea name="message" id="message" placeholder="Votre message" required></textarea>
                <br />
                <button type="submit" name="valider" id="valider">Valider</button>
            </form>
        </div>
    </section>
    </main>
    <footer>
        <p>© 2025 Mon Portolio<p>
    </footer>
    <script src="app.js"></script>
  </body>
</html>
