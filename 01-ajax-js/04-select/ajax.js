
// AJAX
document.addEventListener('DOMContentLoaded',function(event){

    if(window.XMLHttpRequest){
        //si oui
        var r = new XMLHttpRequest();
    }else{
        //si non, par exemple avec IE.
        var r = new ActiveXObject('Microsoft.XMLHTTP');
    }

    var personne = document.getElementById("personne");
    personne = personne.innerHTML;
    var parameters = "personne="+personne;

    r.open('POST','ajax.php',true);
    r.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
    r.onreadystatechange = function() {
        if(r.readyState == 4 && r.status == 200){
            var obj = JSON.parse(r.responseText);
            document.getElementById('resultat').innerHTML = obj.resultat;
        }
    }
    r.send(parameters); 

});

