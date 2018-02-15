<?php

    require_once('init.php');
    extract($_POST);
    // me donnera le variable $personne.

    $del=$pdo->prepare('DELETE FROM employes WHERE id_employes=:id');
    $del->execute(array('id' => $id)); //$id vient directement de la requete AJAX en JS, donc ce n'est pas la variable $personne qui vient du formulaire php

    $select = $pdo->query('SELECT * FROM employes');
    //je regénère la liste des prenoms.
    $tab['resultat'] = genererNomEmp($select);
    $tab['validation'] = 'ok';
    echo json_encode($tab);
   

?>