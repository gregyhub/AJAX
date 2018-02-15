<?php

    require_once('init.php');
    extract($_POST);
    // me donnera le variable $personne.

    $del=$pdo->prepare('DELETE FROM employes WHERE id_employes=:id');
    $del->execute(array('id' => $id)); //$id vient directement de la requete AJAX en JS, donc ce n'est pas la variable $personne qui vient du formulaire php

    //je regénère la liste des prenoms.
    $select = $pdo->query('SELECT * FROM employes');
    $tab['resultat'] = genererNomEmp($select);

    echo json_encode($tab);
   

?>