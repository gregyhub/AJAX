<?php
    require_once('./inc/init.php');
    if(!isset($_SESSION['pseudo'])){
        //si pas de session, ca veut dire pas connecté, donc je redirige sur l'index
        header('location:connexion.php');
    }
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="./inc/style.css">
    <title>tchat index</title>
</head>
<body>
    <script>
        <?php 
            $lastid = $pdo->query('SELECT id_dialogue FROM dialogue ORDER BY id_dialogue DESC LIMIT 0,1');
            $donnee = $lastid->fetch(PDO::FETCH_ASSOC);
        ?>
        var lastid = <?= $donnee['id_dialogue'] ?? 0 ?>;
    </script>
    <div id="conteneur">
        <div id="message_tchat">
            <h2>connecté en tant que <?= $_SESSION['pseudo'] ?></h2>

            <?php
                $sql = 'SELECT m.pseudo, m.civilite, d.message, date_format(d.date, "%d/%m/%Y") as date_fr, date_format(d.date, "%H;%i:%s") as heure_fr 
                FROM dialogue d, membre m WHERE m.id_membre=d.id_membre ORDER BY d.date';
                $AllMessages = $pdo->query($sql);
                while($message = $AllMessages->fetch(PDO::FETCH_ASSOC)){
                    if($message['civilite'] == 'm'){
                        $couleur='bleu';
                    }else{
                        $couleur='rose';
                    }
                    echo '<p title="'.$message['date_fr'].' - '.$message['heure_fr'].'" class="'.$couleur.'"><strong>'.$message['pseudo'].' : </strong>'.$message['message'].'</p>';
                }
            ?>

        </div>
        <div id="liste_membre_connecte">
            <h2>Membres Connectés :</h2>
            <?php
                $resultat=$pdo->query('SELECT * FROM membre WHERE date_connexion >'.(time()-1800).' ORDER BY pseudo'); //connecté pendant 30 minutes, sinon est considéré 
                while( $membre = $resultat->fetch(PDO::FETCH_ASSOC)){
                    if($membre['civilite'] == 'm'){
                        $couleur='bleu';
                        $titre='Homme';
                    }else{
                        $couleur='rose';
                        $titre='Femme';
                    }
                    echo '<p class="'.$couleur.'" title="'.$titre.', '.$membre['ville'].', '.age($membre['date_de_naissance']).'ans">'.$membre['pseudo'].'</p>';
                }
            ?>

        </div>
        <div class="clear"></div>
        <div id="smiley">
            <img src="./smil/smiley1.gif" alt=":)" class="smiley">
            <img src="./smil/smiley2.gif" alt=":(" class="smiley">
            <img src="./smil/smiley3.gif" alt=":p" class="smiley">
            <img src="./smil/smiley4.gif" alt=";)" class="smiley">
            <img src="./smil/smiley5.gif" alt="T_T" class="smiley">
            <img src="./smil/smiley6.gif" alt=":)" class="smiley">
            <img src="./smil/smiley7.gif" alt=":)" class="smiley">
        </div>
        <div id="formulaire_tchat">
            <form action="#" method="post">
            <textarea name="message" id="message" cols="30" rows="4" maxlength="300"></textarea><br>
            <input type="submit" value="envoi" value="envoie" id="submit" class="submit">
            </form>
        </div>
    </div>

    <script src="http://code.jquery.com/jquery-3.3.1.js" integrity="sha256-2Kok7MbOyxpgUVvAk/HJ2jigOSYS2auK4Pfzbm7uH60=" crossorigin="anonymous"></script>
    <script src="./inc/ajax.js"></script>
</body>
</html>