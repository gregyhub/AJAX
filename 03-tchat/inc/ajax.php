<?php

    require_once('./init.php');
    extract($_POST);



    $tab=array();

    if($action == 'envoi_message'){
       $message=addslashes($message);
        if(!empty($message)){
            //insert le message
            $sql = 'INSERT INTO dialogue VALUES (NULL, :id_membre, :message, NOW())';
            $insertMessage = $pdo->prepare($sql);
            $insertMessage -> execute(array(
                'id_membre' => $_SESSION['id_membre'],
                'message' => $message
            ));
            //MAJ du timestamp de date_connexion
            $sql = 'UPDATE membre SET date_connexion='.time().' WHERE id_membre=:id_membre';
            $insertMessage = $pdo->prepare($sql);
            $insertMessage -> execute(array('id_membre' => $_SESSION['id_membre']));
        }
       $tab['validation']='ok';
    }

    if($action == 'affichage_message'){
        $lastid=intval($lastid); //pour forcer au type INT
        $sql = 'SELECT d.id_dialogue, m.pseudo, m.civilite, d.message, date_format(d.date,                  "%d/%m/%Y") as date_fr, date_format(d.date, "%H;%i:%s") as heure_fr 
                FROM dialogue d, membre m WHERE m.id_membre=d.id_membre
                AND d.id_dialogue > :lastid ORDER BY d.date';
        $AllMessages = $pdo->prepare($sql);
        $AllMessages->execute(array('lastid' => $lastid));
        $tab['resultat']='';
        $tab['lastid'] = $lastid;
        if($AllMessages->rowCount()>0){
            while($message = $AllMessages->fetch(PDO::FETCH_ASSOC)){
                if($message['civilite'] == 'm'){
                    $couleur='bleu';
                }else{
                    $couleur='rose';
                }
                $tab['resultat'] .= '<p title="'.$message['date_fr'].' - '.$message['heure_fr'].'" class="'.$couleur.'"><strong>'.$message['pseudo'].' : </strong>'.$message['message'].'</p>';
                $tab['lastid'] = $message['id_dialogue'];
            }
        }

        $tab['validation']='ok';
    }

    if($action == 'affichage_membre_connecte'){
        $resultat=$pdo->query('SELECT * FROM membre WHERE date_connexion >'.(time()-1800).' ORDER BY pseudo'); //connecté pendant 30 minutes, sinon est considéré 
        $tab['resultat'] ='';
        while( $membre = $resultat->fetch(PDO::FETCH_ASSOC)){
            if($membre['civilite'] == 'm'){
                $couleur='bleu';
                $titre='Homme';
            }else{
                $couleur='rose';
                $titre='Femme';
            }
            $tab['resultat'] .= '<p class="'.$couleur.'" title="'.$titre.', '.$membre['ville'].', '.age($membre['date_de_naissance']).'ans">'.$membre['pseudo'].'</p>';
            
        }
        $tab['validation']='ok';
    }

    echo json_encode($tab);

?>