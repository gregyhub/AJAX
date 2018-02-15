<?php

    require_once('init.php');
    extract($_POST);
    // me donnera le variable $personne.

    $insert=$pdo->prepare('INSERT INTO employes (prenom) VALUES (:personne)');
    
    if($insert->execute(array('personne' => $personne))){
        $tab['validation'] = 'ok';
        echo json_encode($tab);
    }


?>