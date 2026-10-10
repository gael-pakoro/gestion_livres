<?php
session_start();
require_once __DIR__ . '/bdd.php';

if (!isset($_SESSION['id_utilisateur'])) {
    header('Location: /connexions.php');
    exit;
}

$id = $_SESSION['id_utilisateur'];

$stmt = $pdo->prepare("SELECT nom, mail, numero_telephone FROM utilisateur WHERE id_utilisateur = ?");
$stmt->execute([$id]);
$utilisateur = $stmt->fetch();
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>compte</title>
    <link rel="stylesheet" href="/frontend/style.css">
</head>
<body>
<header>
    <nav>
        <a href="backend/index.php">Accueil</a> |
        <a href="backend/liste.php">Liste</a> |
        <a href="backend/compte.php">Compte</a>
    </nav>

    <form method="GET" action="/backend/recherche.php">
        <input type="search" name="q" placeholder="Cherche un livre">
        <button type="submit">Rechercher</button>
    </form>
</header>

<hr>

<h1>Mon compte</h1>

<h2><?php echo htmlspecialchars($utilisateur['nom']); ?></h2>
<p>Email : <?php echo htmlspecialchars($utilisateur['mail']); ?></p>
<p>Numéro de téléphone : <?php echo htmlspecialchars($utilisateur['numero_telephone']); ?></p>

<hr>

<h2>Mes sections</h2>

<div class="section">
    <p><a href="/backend/liste.php">Voir ma liste</a></p>
</div>

<div class="section">
    <p><a href="/backend/prets.php">Voir mes prêts</a></p>
</div>

<div class="section">
    <p><a href="/backend/emprunts.php">Voir mes emprunts</a></p>
</div>

<hr>

<p><a href="/backend/déconnexion.php">Déconnexion</a></p>
</body>
</html>