<?php 

    $pdo = new PDO('mysql:host=localhost; dbname=tchat','root', '', 
    array(
        PDO::ATTR_ERRMODE=>PDO::ERRMODE_WARNING,
        PDO::MYSQL_ATTR_INIT_COMMAND=>'SET NAMES utf8'
    ));

   session_start();
   //session_destroy();
   $msg = '';

   //fonction de calcul d'age a partir de date de naissance sous forme AAAA-MM-JJ
   function age($naiss){
       list($y,$m,$d) = explode('-',$naiss);// list créer un tableau
       $diff = date('m') - $m;
       if( $diff < 0 ){
        //le mois de naissance de la personne n'est pas encore le bon, par rapport au mois en cours, donc elle "perd" 1an (y++)
            $y++;
       }elseif($diff == 0 && (date('d') - $d < 0)){
            $y++;
       }
       return date('Y') - $y;
   }

?>