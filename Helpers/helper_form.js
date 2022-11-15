const form = document.getElementById ('modal-form'),
    label_select = document.querySelectorAll ('.select span:first-child'),
    selected_select = document.querySelectorAll ('.select span:nth-child(2)'),
    label_active = form.getElementsByClassName ('is-label-active'),
    label_selected_active = form.getElementsByClassName ('is-label-selected-active');

form.addEventListener ('submit', trigger);

/* Activar inputs con content y limpiarlos de espacios al inicio y final de la cadena */
function input_active(){
    input.forEach (e => {
        if (e.value !== ''){
            document.getElementById ('label-' + e.id).classList.add ('is-label-active');
        }
    });
}

/* Activar selects con content */
function select_active(){
    label_select.forEach (e => e.classList.add ('is-label-active'));
    selected_select.forEach (e => e.classList.add ('is-label-selected-active'));
}

function reset() {
    form.reset ();
    Array.from (label_active).forEach (e => e.classList.remove ('is-label-active'))
    Array.from (label_selected_active).forEach (e => {
        delete e.dataset.selected;
        e.textContent = null;
        e.classList.remove ('is-label-selected-active');
    })
}
