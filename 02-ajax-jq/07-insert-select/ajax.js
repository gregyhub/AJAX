
// AJAX
$(function(){

    ajax();
    setInterval(ajax,5000);
        
    $('#submit').on('click', function(e){
        e.preventDefault();
        ajaxEnvoiForm();
    });

    function ajaxEnvoiForm(){
        var personne = $("#personne").val();
        $.post('ajax.php','personne='+personne+'&mode=envoi',function(donnees){
            if(donnees.validation == 'ok'){
                ajax();
                $('#personne').val('');
            }
            else{
                alert('pb ');
            }
           
        },'json');
    }

    function ajax(){
        $.post('ajax.php','',function(donnees){
            if(donnees.validation == 'ok'){
                $('#resultat').html(donnees.resultat);
            }
            else{
                alert('pb ');
            }
        },'json');
    }



});

