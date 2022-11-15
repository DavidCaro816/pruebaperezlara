document.querySelectorAll ('[data-toggle="modal2"]').forEach ((e) => {
    e.addEventListener ('click', open_modal2);
})

document.querySelectorAll ('[data-dismiss="modal2"]').forEach ((e) => {
    e.addEventListener ('click', close_modal2);
})

function open_modal2(e){
    const elemento = document.getElementById (e.target.closest ("[data-toggle=\"modal2\"]").dataset.target);
    elemento.classList.add ('is-backdrop-active');
    elemento.querySelector ('.container-form')
    ? elemento.querySelector ('.container-form').classList.add ('is-modal2-active')
    : elemento.querySelector ('.modal-confirm').classList.add ('is-modal2-active')
}

function close_modal2(){
    document.querySelector ('.is-modal2-active').classList.remove ('is-modal2-active');
    document.querySelector ('.is-backdrop-active').classList.remove ('is-backdrop-active');
}