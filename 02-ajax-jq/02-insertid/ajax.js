
// AJAX
$(function(){
   
    $('#submit').click(function(event){
        event.preventDefault();
        ajax();
    })


    function ajax(){
        
        var personne = $('#personne').val();
        //$.post('fichier de destination', 'parametres', fonction de reponses({}), 'format')
        $.post('ajax.php', 'personne='+personne, function(donnees){
            if(donnees.validation == 'ok'){
                $('#resultat').append('employé '+personne+' ajouté !');
                $('#personne').val('');
                $('#resultat').css('color','green');
            }
            else{
                alert('pb insertion');
            }
        }, 'json')
        
    }

});


