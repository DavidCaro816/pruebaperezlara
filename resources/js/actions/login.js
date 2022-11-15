const password = document.getElementById ('password'), login_form = document.getElementById ('login-form'),
clave = document.getElementById('clave'), alert_login = document.getElementById('alert-login');

register_form.addEventListener ('submit', create);
login_form.addEventListener ('submit', login);

async function create(e){
    e.preventDefault ();
    const form_data = givens ();
    form_data.append ('email', email.value);
    form_data.append ('phone', phone.value);
    form_data.append ('password', password.value);
    form_data.append ('profile_picture', 'resources/icons/buttons/profile.svg');
    form_data.append ('document_type', document_type.dataset.selected);
    form_data.append ('role', '3');
    form_data.append ('state', '2');
    const res = await fetch ('User/create', {
        method: 'POST',
        body: form_data,
    })
    const data = await res.json ();
    console.log (data);
}

async function login(e){
    e.preventDefault ();
    const res = await fetch ('User/login', {
        method: 'POST',
        body: new FormData (login_form)
    })
    const data = await res.json ();
    if(typeof data === 'string'){
        clave.value = null;
        alert_login.textContent = data;
    }else{
        window.location.href = 'dashboard';
    }
}