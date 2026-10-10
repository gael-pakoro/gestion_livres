<?php
session_start();
require_once __DIR__ . '/bdd.php';

$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['nom'] ?? '';
    $password = $_POST['password'] ?? '';

    $stmt = $pdo->prepare("SELECT * FROM utilisateur WHERE nom = ?");
    $stmt->execute([$username]);
    $user = $stmt->fetch();

    if ($user && password_verify($password, $user['password_hash'])) {
        session_regenerate_id(true);
        $_SESSION['id_utilisateur'] = $user['id_utilisateur'];
        header('Location: /compte.php');
        exit;
    } else {
        $error = 'nom incorrects.';
    }
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>connexions</title>
    <link rel="stylesheet" href="/frontend/style.css">
</head>
<body>
<h1>Connexion</h1>

<?php if ($error): ?>
    <div class="alert alert-error"><?php echo htmlspecialchars($error, ENT_QUOTES, 'UTF-8'); ?></div>
<?php endif; ?>

<form method="POST" action="/backend/connexions.php">
    <label>nom d'utilisateur</label>
    <input type="text" name="nom" required>
    <label>Mot de passe</label>
    <input type="password" name="password" required>
    <button type="submit">Se connecter</button>
    <p class="muted"><a href="/backend/mot_depasseoublié.php"> Mot de passe oublié ?</a></p>
</form>
<p class="muted">Pas de compte ? <a href="/backend/inscriptions.php">Inscrivez-vous</a>.</p>
<p><a href="/backend/index.php"> Retour à l'accueil</a></p>
</body>
</html>
