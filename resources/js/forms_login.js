const button_open_forms = document.getElementById ('button-open-forms'), main = document.querySelector ('main'),
    cover = document.getElementById ('cover'), register_section = document.getElementById ('register'),
    login_section = document.getElementById ('login'),
    login_form_container = document.getElementById ('container-login'),
    register_form = document.getElementById ('register-form'), message = document.getElementById ('message');

button_open_forms.addEventListener ('click', open_form);
message.addEventListener ('click', action_shake);

/* Mostrar formulario -> Login - Register */
function open_form(){
    main.classList.toggle ('is-main-active');
    cover.classList.toggle ('is-cover-active');
    register_section.classList.toggle ('is-register-active');
    login_section.classList.toggle ('is-login-inactive');
    register_form.classList.toggle ('is-register-form-active');
    login_form_container.classList.toggle ('is-container-login-inactive');
    if (main.classList.contains ('is-main-active')){
        message.innerHTML = '¿Ya tienes una cuenta?';
        button_open_forms.innerHTML = 'Inicia sesión';
    } else {
        message.innerHTML = '¿No tienes una cuenta?';
        button_open_forms.innerHTML = 'Registrate';
    }
}

/* Sacudir botón para abrir formulario*/
function action_shake(){
    button_open_forms.classList.add ('is-shake');
    setTimeout (() => {
        button_open_forms.classList.remove ('is-shake');
    }, 600)
}

