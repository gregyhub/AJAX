
// AJAX
//Ashynchronous JavaScript And XML

document.getElementById('action').addEventListener('click', loadDoc);
function loadDoc(){
    var xhttp = new XMLHttpRequest();
    //readyStat, doit etre égale à 4 pour confirmer qu'il a abouti
    //status, par exemple error 404, success 200 : requete traité avec succes.
    xhttp.onreadystatechange = function(){
        // au changement d'etat
         if(xhttp.readyState==4 && xhttp.status==200){
            document.getElementById('demo').innerHTML = xhttp.responseText;
        }
    };

    xhttp.open('GET', 'fichier.txt', true);
    xhttp.send();
}