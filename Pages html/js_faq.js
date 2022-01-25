function display(){
    document.getElementById('js_messages').style.display = "block";
}

function apparaitre(){
    document.getElementById('js_reponse').style.display = "block";

}


function afficher_reponse(id){
    document.getElementById('js_reponse_message_'+id).style.display = "block";
}

function refresh_page(){
    window.location = 'http://www.leomelki.fr/armandb/FAQ.php';
}