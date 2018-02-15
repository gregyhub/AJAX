
// AJAX
//Ashynchronous JavaScript And XML


$(document).ready(function(){

    $('#action').click(function(e){
        e.preventDefault();
        $.ajax(
            {
                url: 'fichier.txt',
                dataType: 'text',
                success: function(data){
                    $('#demo').html(data);
                } //fin du success
            } //fin des parametres ajax
        );//fin ajax
    })

}); //fin du document ready

$(function(){
    
});