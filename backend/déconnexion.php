<?php
session_start();
session_destroy();
header('Location: /connexions.php');
exit;
?>
