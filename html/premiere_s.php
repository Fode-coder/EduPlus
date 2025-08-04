<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Cours de 1ère S | EduPlus</title>
  <link rel="stylesheet" href="../css/classe.css">
  <link rel="stylesheet" href="../css/footer.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body>

  <!-- En-tête -->
  <?php include 'header.php'; ?>

  <main>
    <!-- Section Intro Premium -->
    <section class="intro">
      <div class="intro-content">
        <h2>Cours de <span>1<sup>ère</sup>S</span></h2>
        <p class="subtitle">Programme complet conforme au cycle 3</p>
        <div class="decoration-line"></div>
      </div>
   
    </section>

    <!-- Cartes des matières premium -->
    <section class="matieres">
      <div class="section-header">
        <h3>Nos <span>matières</span></h3>
        <p>Sélectionnez une discipline pour accéder aux leçons</p>
      </div>
      
      <div class="grid-matieres">
        <!-- Mathématiques -->
        <a href="../php/1er_S/math1S.php" class="matiere-card matiere-maths">
          <div class="matiere-icon">
            <i class="fas fa-square-root-alt"></i>
          </div>
          <h4>Mathématiques</h4>
          <p>Nombres, calcul, géométrie</p>
          <div class="matiere-hover"></div>
        </a>
        <a href="../php/1er_S/pc1S.php" class="matiere-card matiere-maths">
          <div class="matiere-icon">
            <i class="fas fa-flask"></i>
          </div>
          <h4>Science physique</h4>
          <p>Nombres, calcul, géométrie</p>
          <div class="matiere-hover"></div>
        </a>
        
        <!-- Français -->
        <a href="../php/1er_S/francais1S.php" class="matiere-card matiere-francais">
          <div class="matiere-icon">
            <i class="fas fa-book-open"></i>
          </div>
          <h4>Français</h4>
          <p>Grammaire, conjugaison, lecture</p>
          <div class="matiere-hover"></div>
        </a>
        
        <!-- Histoire-Géo -->
        <a href="../php/1er_S/hg1S.php" class="matiere-card matiere-hg">
          <div class="matiere-icon">
            <i class="fas fa-globe-europe"></i>
          </div>
          <h4>Histoire-Géo</h4>
          <p>Antiquité, mondes anciens, espace</p>
          <div class="matiere-hover"></div>
        </a>
        
        <!-- SVT -->
        <a href="../php/1er_S/svt1S.php" class="matiere-card matiere-svt">
          <div class="matiere-icon">
            <i class="fas fa-microscope"></i>
          </div>
          <h4>SVT</h4>
          <p>Êtres vivants, environnement</p>
          <div class="matiere-hover"></div>
        </a>
        
        <!-- Anglais -->
        <a href="../php/1er_S/anglais1S.php" class="matiere-card matiere-anglais">
          <div class="matiere-icon">
            <i class="fas fa-language"></i>
          </div>
          <h4>Anglais</h4>
          <p>Langue vivante, communication</p>
          <div class="matiere-hover"></div>
        </a>
      </div>
    </section>
  </main>

  <!-- Pied de page -->
  <?php include 'foot.php'; ?>

</body>
</html>