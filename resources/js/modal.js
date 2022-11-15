const icon_settings = document.getElementById ('icon-settings');

document.body.addEventListener ('click', action_modal)
Array.from (document.getElementsByClassName ('link-modal')).forEach (e => e.addEventListener ('click', close_modal));

/* Abrir y cerrar modales */
function action_modal(e){
    const modal = document.querySelector ('.is-modal-active'),
        elemento = e.target.closest ("[data-toggle=\"modal\"]");
    /* Abrir modal si se dio clic al icono */
    if (elemento){
        if (elemento.dataset.target === 'settings-modal'){
            icon_settings.classList.add ('is-settings-active');
            icon_settings.classList.remove ('is-settings-inactive');
        }
        document.getElementById (elemento.dataset.target).classList.add ('is-modal-active');
    }

    /* Cerrar modal si está activo */
    if (modal){
        const modal_active = document.querySelector ('[data-target=' + modal.id + ']');
        if (modal_active.classList.contains ('select')){
            !modal_active.dataset.multiple
            ? modal.classList.remove ('is-modal-active')
            : e.target.closest ('.modal') ? modal_active.focus () : modal_active.blur ();
        }
        if (!e.target.closest ('.modal')){
            modal.classList.remove ('is-modal-active');
            if (modal.id === 'settings-modal'){
                icon_settings.classList.add ('is-settings-inactive');
                icon_settings.classList.remove ('is-settings-active');
            }
        }
    }
}

function close_modal(){
    document.querySelector ('.is-modal-active').classList.remove ('is-modal-active')
}