$(function(){

    //var lastid = 0;
    var timer = setInterval(affichage_message, 5000);
    var timer_membre_connecter = setInterval(affichage_membre_connecte, 10000);
    $('#message_tchat').scrollTop($('#message_tchat')[0].scrollHeight); //met l'ascenceur tout en bas pour rendre visible le dernier message
    convertir_smiley();

    //event au click du bouton envoi du message
    $('#submit').on('click', function(e){
        e.preventDefault();
        showLoader('#formulaire_tchat');
        clearInterval(timer);
        var msg = $('#message').val();
        var parameters = 'message='+msg+'&action=envoi_message';
        $.post('inc/ajax.php',parameters,function(donnees){
            if(donnees.validation == 'ok'){
                affichage_message();
                $('#message').val('');
                $('#message').focus();
            }
            else{
                alert('pb');
            }
            timer = setInterval(affichage_message, 5000);
            hideLoader();
        }, 'json')
    });//fin du on clikc

    function affichage_message(){
        showLoader('#message_tchat');
        $.post('inc/ajax.php','action=affichage_message&lastid='+lastid,function(donnees){
            if(donnees.validation == 'ok'){
                $('#message_tchat').append(donnees.resultat);
                lastid=donnees.lastid;
                $('#message_tchat').scrollTop($('#message_tchat')[0].scrollHeight); //met l'ascenceur tout en bas pour rendre visible le dernier message
                convertir_smiley();
            }
            else{
                alert('pb');
            }
        },'json');
        hideLoader();
    }

    function affichage_membre_connecte(){
        $.post('inc/ajax.php','action=affichage_membre_connecte', function(donnees){
            if(donnees.validation == 'ok'){
                $('#liste_membre_connecte').empty().append(donnees.resultat);
            }
            else{
                alert('pb');
            }
        }, 'json');

    }

    function convertir_smiley(){
       /*   $('#message_tchat p').each(function(){
            $('#message_tchat').html($('#message_tchat').html.replace(':)', '<img src="smil/smiley1.gif">'));
        });  */

    }

    //ajouter un smiley au message
    $('.smiley').on('click', function(e){
        var prevMsg = $('#message').val();
        var emotiText = $(e.target).attr('alt');
        $('#message').val(prevMsg + emotiText);
    });


    function showLoader(div){
        $(div).append('<div class="loader"></div>');
        $('.loader').fadeTo(500,0.6);
    }

    function hideLoader(){
        $('.loader').fadeOut(500,function(){
            $('.loader').remove();
        });
    }
});//fin du document ready