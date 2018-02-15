<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Ajax select EXO</title>
    <style>
      
    </style>
</head>
<body>
    <h2>Ajax select EXO</h2>
    <!-- adapter en remplacant la div personne par un select option avec tous les prénoms.
    Un bouton submit va receuillir les infos du prenom selectionné et les afficher dans la div resultat  -->

    <form action="#" method="POST">
    <?php	
        require_once('init.php');
        $req = $pdo->query('select distinct prenom from employes');
        echo '<select id="personne" name="personne">';
        echo '<option value="checkSelected">Selectionnez un prenom</option>';
        while($employe = $req->fetch(PDO::FETCH_ASSOC)){
            echo'<option value="'.$employe['prenom'].'">'.$employe['prenom'].'</option>';
        }
        echo '</select>';
        
    ?>
    </form>
    <div id="resultat"></div>


    <script src="ajax.js"></script>
</body>
</html>