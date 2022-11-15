const context_menu = document.getElementById ('context-menu'),
    btn_edit = document.getElementById ('edit'),
    true_confirm = document.getElementById ('true-confirm');

tbody.addEventListener ('contextmenu', open_context_menu);
document.body.addEventListener ('click', close_context_menu);
btn_edit.addEventListener ('click', () => {
    action = false;
    edit ();
});
true_confirm.addEventListener ('click', remove);

/* Abrir menú contextual*/
function open_context_menu(e){
    e.preventDefault ();
    context_menu.classList.add ('is-context-menu-active');
    context_menu.style.top = e.clientY + context_menu.offsetHeight > window.innerHeight
                             ? window.innerHeight - context_menu.offsetHeight - 1 + 'px'
                             : e.clientY + 'px';
    context_menu.style.left = e.clientX + context_menu.offsetWidth > window.innerWidth
                              ? window.innerWidth - context_menu.offsetWidth + 'px'
                              : e.clientX + 'px';
    context_menu.dataset.rel = e.target.closest ('.row').firstElementChild.innerHTML;
}

/* Cerrar menú contextual*/
function close_context_menu(){
    if (document.querySelector ('.is-context-menu-active')) {
        context_menu.classList.remove ('is-context-menu-active');
    }
}