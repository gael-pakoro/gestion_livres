<?php
session_start();
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Accueil</title>
    <link rel="stylesheet" href="/frontend/style.css">
</head>

<body>

<header>
    <nav>
        <a href="/backend/index.php">Accueil</a> |
        <a href="/backend/liste.php">Liste</a> |

        <?php if (isset($_SESSION['id_utilisateur'])): ?>
            <a href="/backend/compte.php">Compte</a> |
            <a href="/backend/déconnexion.php">Déconnexion</a>
        <?php else: ?>
            <a href="/backend/connexions.php">Connexion</a> |
            <a href="/backend/inscriptions.php">Inscription</a>
        <?php endif; ?>
    </nav>

</header>

<hr>

<h1>Bienvenue</h1>

<form method="GET" action="/backend/recherche.php">
    <input type="search" name="q" placeholder="Cherche un livre" style="width:300px; padding:8px;">
    <button type="submit">Rechercher</button>
</form>

<hr>

<?php if (isset($_SESSION['id_utilisateur'])): ?>
    <h2>Mes prêts</h2>

    <h2>Mes emprunts</h2>

    <h2>Mes livres</h2>
<?php else: ?>
    <p>Connectez-vous pour voir vos prêts, emprunts et livres.</p>
<?php endif; ?>
</body>
</html>