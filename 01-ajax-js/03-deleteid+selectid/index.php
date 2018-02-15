<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Ajax delet + select</title>
    <style>
        .success{
            color:green;
        }
        #employes{
            display: inline;
        }
    </style>
</head>
<body>
    <h2>Ajax delete + select</h2>
    
    <form action="#" method="post">
        <div id="employes">
            <?php	
                require_once('init.php');
                $result = $pdo->query('select * from employes');
                echo genererNomEmp($result);
            ?>
        </div>
        <input type="submit" value="supprimer" id="submit">
    </form>


    <script src="ajax.js"></script>
</body>
</html>