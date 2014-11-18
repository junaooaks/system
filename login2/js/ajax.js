jQuery.noConflict();
jQuery(document).ready(function()
{
  jQuery("#submenu").load("resources/submenu/submenu.php");  
    
});

function mudaPage(page){
    jQuery("#submenu").load(page);  
}
function mudaConteudo(page){
    jQuery("#conteudo").load(page);  
}
