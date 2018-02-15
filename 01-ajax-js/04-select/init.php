<?php 

    $pdo = new PDO('mysql:host=localhost; dbname=entreprise','root', '', 
    array(
        PDO::ATTR_ERRMODE=>PDO::ERRMODE_WARNING,
        PDO::MYSQL_ATTR_INIT_COMMAND=>'SET NAMES utf8'
    ));

    function genererNomEmp($req){
        $tab = array();
        $tab['resultat'] = '';
        $tab['resultat'] .= '<select name="personne" id="personne">';
        while($employe = $req->fetch(PDO::FETCH_ASSOC)){
            $tab['resultat'] .= '<option value="'.$employe['id_employes'].'">'.$employe['prenom'].'</option>';
        }
        $tab['resultat'] .= '</select>';
        return($tab['resultat']);
    }

?>