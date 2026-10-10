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

if (!$liste) {
    $stmt = $pdo->prepare("INSERT INTO liste (id_utilisateur) VALUES (?) RETURNING id_liste");
    $stmt->execute([$id]);
    $liste = $stmt->fetch();
}

$id_liste = $liste['id_liste'];

$error = '';
$success = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $nom = $_POST['titre'] ?? '';
    $auteur = $_POST['auteur'] ?? '';
    $maison = $_POST['maison_d_edition'] ?? '';

    if ($nom === '' || $auteur === '' || $maison === '') {
        $error = "Veuillez remplir tous les champs.";
    } else {

        $stmt = $pdo->prepare("INSERT INTO livre (nom, auteur, maison_d_edition, id_liste) VALUES (?, ?, ?, ?) RETURNING id_livre");
        $stmt->execute([$nom, $auteur, $maison, $id_liste]);
        $livre = $stmt->fetch();
        $id_livre = $livre['id_livre'];

        $stmt = $pdo->prepare("INSERT INTO liste_livre (id_liste, id_livre) VALUES (?, ?)");
        $stmt->execute([$id_liste, $id_livre]);

        $success = "Livre ajouté avec succès !";
    }
}
?>

<head>
    <link rel="stylesheet" href="../frontend/style.css">
</head>

<h1>Ajouter un livre</h1>

<?php if ($error): ?>
    <p><?php echo htmlspecialchars($error); ?></p>
<?php endif; ?>

<?php if ($success): ?>
    <p><?php echo htmlspecialchars($success); ?></p>
    <p><a href="/liste.php">Retour à ma liste</a></p>
<?php endif; ?>

<form method="POST" action="/ajouter_livre.php">
    <label>Titre du livre</label>
    <input type="text" name="titre" required>

    <label>Auteur</label>
    <input type="text" name="auteur" required>

    <label>Maison d'édition</label>
    <input type="text" name="maison_d_edition" required>

    <button type="submit">Ajouter</button>
</form>

<p><a href="/liste.php">Retour</a></p>