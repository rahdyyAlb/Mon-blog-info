function onAffichearticles()
{
    $.get("php/ajax.php",afficherArticle);//json --> js
}
// une callBack qui permet de traiter la réponse AJAX
function afficherArticle(article)
{
    // console.log(article);
    $('#com').html(article);
}

document.addEventListener("DOMContentLoaded",function()
{
//     function refresh(){
//  $('.#com').load('php/ajax.php .#com');
// }

    // 1- sélectionner l'element 
    onAffichearticles();// 2- installer l'event click sur cette élément 
    // rafraichir chaque 10 secondes 
    //setInterval(onAffichearticles,10000);
});
