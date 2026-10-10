<?php
session_start();
require_once __DIR__ . '/bdd.php';

if (!isset($_SESSION['id_utilisateur'])) {
    header('Location: /connexions.php');
    exit;
}

$id = $_SESSION['id_utilisateur'];

$stmt = $pdo->prepare("SELECT id_liste FROM liste WHERE id_utilisateur = ?");
$stmt->execute([$id]);
$liste = $stmt->fetch();
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Ma liste</title>
    <link rel="stylesheet" href="/frontend/style.css">
</head>

<body>

<header>
    <nav>
        <a href="/backend/index.php">Accueil</a> |
        <a href="/backend/liste.php">Liste</a> |
        <a href="/backend/compte.php">Compte</a>
    </nav>

    <form method="GET" action="/backend/recherche.php" style="margin-top:10px;">
        <input type="search" name="q" placeholder="Cherche un livre">
        <button type="submit">Rechercher</button>
    </form>
</header>

<hr>

<h1>Ma liste de livres</h1>

<?php if (!$liste): ?>

    <p>Vous n'avez pas encore créé de liste.</p>
    <p><a href="/backend/ajouter_livre.php">Créer une liste</a></p>

<?php else: ?>

    <?php
    $stmt = $pdo->prepare("
        SELECT livre.id_livre, livre.nom, livre.auteur, livre.maison_d_edition
        FROM livre
        INNER JOIN liste_livre ON livre.id_livre = liste_livre.id_livre
        WHERE liste_livre.id_liste = ?
    ");
    $stmt->execute([$liste['id_liste']]);
    $livres = $stmt->fetchAll();
    ?>

    <?php if (empty($livres)): ?>
        <p>Votre liste est vide.</p>
        <p><a href="/backend/ajouter_livre.php">Ajouter un livre</a></p>
    <?php else: ?>
        <h2>Livres dans votre liste :</h2>

            
                <table border="1" cellpadding="8">
                     <tr>
                        <th>nom</th>
                        <th>auteur</th>
                        <th>maison d'édition</th>
                    </tr>
                    <?php foreach ($livres as $livre): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($livre['nom']); ?></td>
                        <td><?php echo htmlspecialchars($livre['auteur']); ?></td>
                        <td><?php echo htmlspecialchars($livre['maison_d_edition']); ?></td>
                        <td>
                            <a href="/backend/supprimer_livre.php?id_livre=<?php echo $livre['id_livre']; ?>&id_liste=<?php echo $liste['id_liste']; ?>"> 
                            Supprimer 
                            </a>
                        </td>
                    </tr>
                    <?php endforeach; ?>    
                </table>
            
            

        <p><a href="/backend/ajouter_livre.php">Ajouter un livre</a></p>
    <?php endif; ?>

<?php endif; ?>
</body>
</html>