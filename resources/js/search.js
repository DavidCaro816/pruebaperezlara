const input_search = document.getElementById ('input-search'),
    container_icon_clear_search = document.getElementById ('container-icon-clear-search');

input_search.addEventListener ('input', search);
container_icon_clear_search.addEventListener ('click', erase);

/* Borrar content de input search */
function erase(){
    input_search.value = null;
    index();
}