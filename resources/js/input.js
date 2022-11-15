const input = document.querySelectorAll ('.input:not(.select)'), option = document.getElementsByClassName ('option');

input.forEach (e => e.addEventListener ('blur', blur))
Array.from (option).forEach (e => e.addEventListener ('click', choose))

/* Escoger una opción de un select */
function choose(e){
    let id = e.target.closest ('.modal').id;
    document.getElementById ('label-' + id).classList.add ('is-label-active');
    document.getElementById ('selected-' + id).classList.add ('is-label-selected-active');
    document.getElementById ('selected-' + id).dataset.selected = e.target.dataset.id;
    document.getElementById ('selected-' + id).textContent = e.target.textContent;
}

/* Desenfocar un input*/
function blur(e){
    const element = document.getElementById ('label-' + e.target.id);
    e.target.value.length === 0 ? element.classList.remove ('is-label-active')
                                : element.classList.add ('is-label-active');
}