<?php

    require_once('init.php');
    extract($_POST);
    // me donnera le variable $personne.

    $insert=$pdo->prepare('INSERT INTO employes (prenom) VALUES (:personne)');
    $insert->execute(array('personne' => $personne));

?>