<?php

    require_once('./inc/init.php');
    //traitement de la connexion
    if(isset($_POST['connexion'])){
        $msg ='';
       //je vérifie si le pseudo existe
       $sql = 'SELECT * FROM membre WHERE pseudo = :pseudo';
       $pseudoExiste = $pdo->prepare($sql);
       $pseudoExiste -> execute(array('pseudo' => $_POST['pseudo']));
       $membre =  $pseudoExiste->fetch(PDO::FETCH_ASSOC);
       if($pseudoExiste->rowCount() == 0){
           //le pseudo est disponible
            //insert dans la base
            $sql = 'INSERT INTO membre  VALUES (NULL, :pseudo, :civilite, :ville,:date_de_naissance, :ip, '.time().')';
            $insertMembre = $pdo->prepare($sql);
            $insertMembre -> execute(array(
                'pseudo'    => $_POST['pseudo'],
                'civilite'  => $_POST['civilite'],
                'ville'     => $_POST['ville'],
                'date_de_naissance'    => $_POST['date_de_naissance'],
                'ip'        => gethostbyname($_SERVER['SERVER_NAME'])
            ));
       }
       elseif($pseudoExiste->rowCount() == 1 && $membre['ip'] == gethostbyname($_SERVER['SERVER_NAME'])){
           //le pseudo n'est pas libre mais c'est la meme IP, donc on considère que c'est le même utilisateur
           //donc on met à jour la date de connexion
           $sql = 'UPDATE membre set date_connexion =:date_connexion where id_membre=:id_membre';
           $insertMembre = $pdo->prepare($sql);
           $insertMembre -> execute(array(
               'date_connexion'    => time(),
               'id_membre'  => $membre['id_membre']
           ));

       }else{
            //nouvel utilisateur mais doit changer le pseudo
            $msg .= '<div class="error">Le pseudo est déjà réservé</div>';
       }

       if(empty($msg)){
           //remplir la SESSION et rediriger vers l'index
           $_SESSION['id_membre']=$membre['id_membre'];
           $_SESSION['pseudo']=$membre['pseudo'];
           header('location:index.php');
           exit();
       }
       
       
    } //fin du POST['connexion']

?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="./inc/style.css">
    <title>Connexion</title>
</head>
<body>
    <?= $msg ?>
    <fieldset>
        <form action="" method="post">
           <p><label for="pseudo">Pseudo : </label><input type="text" name="pseudo" id="pseudo"></p>

           <p><label for="civilite">Civilite : </label>
           <input type="radio" name="civilite" id="civilite" value="f" checked>Femme
            <input type="radio" name="civilite" id="civilite" value="m">Homme</p>

           <p><label for="ville">Ville : </label><input type="text" name="ville" id="ville"></p>

           <p><label for="date_de_naissance">Date de naissance</label><input type="text" name="date_de_naissance" id="date_de_naissance" placeholder="(YYYY-MM-DD)"></p>

           <p><input type="submit" value="Connexion au tchat" name="connexion"></p>

        </form>
    </fieldset>

</body>
</html>