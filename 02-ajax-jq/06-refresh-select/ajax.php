<?php

    require_once('init.php');

    $select=$pdo->prepare('SELECT * FROM employes ORDER BY nom');
    $select->execute(); 

    $tab=array();
    $tab['resultat']='';

    $tab['resultat'] .= '<table><tr>';
    $bncolonnes = $select->columnCount();
    for($i=0; $i<$bncolonnes; $i++){
        $infoscolonne = $select->getColumnMeta($i);
        //donne dans un tableau les infos pour une colonne pour chaque index de  0 à N.
        //ce tableau, à l'index 'name' donne le nom du champs.
        $tab['resultat'] .= '<th>'.$infoscolonne['name'].'</th>';
    }
    $tab['resultat'] .= '</tr>';

    //parcours des enregistrements
    while($ligne = $select->fetch(PDO::FETCH_ASSOC)){
        $tab['resultat'] .= '<tr>';
        foreach($ligne as $information){
            $tab['resultat'] .= '<td>'.$information.'</td>';
        }
        $tab['resultat'] .= '</tr>';
    }

    $tab['resultat'] .= '</table>';
    $tab['validation'] = 'ok';
    

    echo json_encode($tab);
   

?>