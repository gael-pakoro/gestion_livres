<?php
session_start();
require_once __DIR__ . '/bdd.php';

$error = '';
$success = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $nom = $_POST['nom'] ?? '';
    $numero = $_POST['numero_telephone'] ?? '';
    $mail = $_POST['mail'] ?? '';
    $password = $_POST['password'] ?? '';

    $stmt = $pdo->prepare("SELECT * FROM utilisateur WHERE mail = ?");
    $stmt->execute([$mail]);
    $existing = $stmt->fetch();

    if ($existing) {
        $error = "Un compte existe déjà avec cet email.";
    } else {
        $password_hash = password_hash($password, PASSWORD_DEFAULT);

        $stmt = $pdo->prepare("
            INSERT INTO utilisateur (nom, numero_telephone, mail, password_hash)
            VALUES (?, ?, ?, ?)
        ");

        $stmt->execute([$nom, $numero, $mail, $password_hash]);

       header('Location: /connexions.php');
        exit;
    }
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>inscriptions</title>
    <link rel="stylesheet" href="/frontend/style.css">
</head>
<body>
<h1>Inscription</h1>

<?php if ($error): ?>
    <div class="alert alert-error">
        <?php echo htmlspecialchars($error, ENT_QUOTES, 'UTF-8'); ?>
    </div>
<?php endif; ?>

<?php if ($success): ?>
    <div class="alert alert-success">
        <?php echo htmlspecialchars($success, ENT_QUOTES, 'UTF-8'); ?>
    </div>
<?php endif; ?>

<form method="POST" action="/backend/inscriptions.php">

    <label>Nom</label>
    <input type="text" name="nom" required>

    <label>Numéro de téléphone</label>
    <input type="text" name="numero_telephone">

    <label>Email</label>
    <input type="email" name="mail" required>

    <label>Mot de passe</label>
    <input type="password" name="password" required>

    <button type="submit">Créer le compte</button>
</form>

<p class="muted">
    Déjà un compte ? <a href="/backend/connexions.php">Connectez-vous</a>.
</p>
<p><a href="/backend/index.php"> Retour à l'accueil</a></p>
</body>
</html>