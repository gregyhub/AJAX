
// AJAX
$(function(event){

    $('#personne').on('change',function(){
        ajax();
    });
   

    function ajax(){
        var personne = $('#personne').val(); 
       
        $.post('ajax.php','personne='+personne,function(donnees){
            if(donnees.validation == 'ok'){
                $('#resultat').html(donnees.resultat);
            }
            else{
                alert('pb ');
            }
        },'json');
    }
});

