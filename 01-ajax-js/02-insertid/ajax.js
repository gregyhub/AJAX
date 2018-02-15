
// AJAX
document.addEventListener('DOMContentLoaded',function(event){

    document.getElementById("submit").addEventListener('click', function(event){
        event.preventDefault();
        ajax();
    })

});


function ajax(){
    if(window.XMLHttpRequest){
        //si oui
        var r = new XMLHttpRequest();
    }else{
        //si non, par exemple avec IE.
        var r = new ActiveXObject('Microsoft.XMLHTTP');
    }

    var p = document.getElementById('personne');
    var personne = p.value;

    var parameters = "personne="+personne;
    r.open('POST','ajax.php',true);
    r.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
    r.send(parameters);

    document.getElementById('resultat').innerHTML='<div class="success">Employé : '+personne+' ajouté !</div>';
    p.value="";
}