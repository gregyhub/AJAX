
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
    var id = p.value; /*IDEM => var id = p.options[p.selectedIndex].value; */
    console.log(p);
    var parameters = "id="+id;
   /*  r.open('POST','ajax.php',true);
    r.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
    r.onreadystatechange = function() {
        if(r.readyState == 4 && r.status == 200){
            var obj = JSON.parse(r.responseText);
            document.getElementById('employes').innerHTML = obj.resultat;
        }
    }
    r.send(parameters); */
}