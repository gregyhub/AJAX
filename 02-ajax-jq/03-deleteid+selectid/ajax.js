
// AJAX
$(function(){

    $('#submit').click(function(e){
        e.preventDefault();
        ajax();
    })

    function ajax(){
        var id = $('#personne').val(); //idem $('#personne').find(':selected').val();
        $.post('ajax.php','id='+id,function(donnees){
            if(donnees.validation == 'ok'){
                $('#employes').html(donnees.resultat);
            }
            else{
                alert('pb ');
            }
        },'json');
    }
});