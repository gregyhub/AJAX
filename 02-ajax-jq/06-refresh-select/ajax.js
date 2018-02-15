
// AJAX
$(function(){

    ajax();
    setInterval(ajax,5000);
        
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

