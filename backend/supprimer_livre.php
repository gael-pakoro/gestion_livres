<?php
session_start();
require_once __DIR__ . '/bdd.php';

if (!isset($_SESSION['id_utilisateur'])) {
    header('Location: /connexions.php');
    exit;
}

$id_livre = $_GET['id_livre'] ?? null;
$id_liste = $_GET['id_liste'] ?? null;

if ($id_livre && $id_liste) {
    $stmt = $pdo->prepare("DELETE FROM liste_livre WHERE id_livre = ? AND id_liste = ?");
    $stmt->execute([$id_livre, $id_liste]);
}

header('Location: /liste.php');
exit;
?>