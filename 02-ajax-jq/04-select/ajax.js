
// AJAX
$(function(){

    var personne = $('#personne').text(); 
    console.log(personne);
    $.post('ajax.php','personne='+personne,function(donnees){
        if(donnees.validation == 'ok'){
            $('#resultat').html(donnees.resultat);
        }
        else{
            alert('pb ');
        }
    },'json');



});

