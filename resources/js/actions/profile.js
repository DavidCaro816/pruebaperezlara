/******************************/
/* Usuario con sesión activa */
/* Valor de prueba */
const user = 'admin@perezlara.com';
/*****************************/

const verify_email = document.getElementById ('verify-email'),
    username = document.getElementById ('username'), password = document.getElementById ('password'),
    repeat_password = document.getElementById ('repeat-password'),
    current_password = document.getElementById ('current-password'),
    role = document.getElementById ('rol'),
    info_profile = document.getElementById ('info-profile'),
    container_img = document.getElementById ('container-img'),
    file_profile = document.getElementById ('file-profile');

info_profile.addEventListener ('submit', e => e.preventDefault ())

window.addEventListener ('load', index);

function draw(res){
    const element = document.getElementById ('img-profile');
    if (element){
        element.remove ();
    }
    const img_profile = document.createElement ('img');
    img_profile.id = 'img-profile';
    img_profile.classList.add ('img-profile');
    img_profile.src = res['Foto'];
    container_img.appendChild (img_profile);
    username.innerHTML = res['Nombre'].replace ('&', ' ');
    role.innerHTML = res['Rol'];
    names.value = first_word (res['Nombre'], '&').trim ();
    surnames.value = following_words (res['Nombre'], '&').trim ();
    document_type.dataset.selected = res['id_tipo_documento'];
    document_type.innerHTML = res['descripcion_documento'];
    document_number.value = res['No. Documento'].replace (/[a-zA-Z]+/, '').trim ();
    email.value = res['Email'].trim ();
    verify_email.innerHTML = res['Email'].trim ();
    phone.value = res['Celular'];
    input_active ();
    select_active ();
}

async function index(){
    const res = await fetch ('User/show', {
        method: 'POST',
        body: new URLSearchParams ({document: user}),
    })
    draw (await res.json ());
}

async function trigger(e){
    e.preventDefault ();
    const form_data = new FormData ();
    form_data.append ('email', user);
    form_data.append ('password', current_password.value);
    const res = await fetch ('User/login', {
        method: 'POST',
        body: form_data,
    })
    const data = await res.json ();
    if (typeof data !== 'string') {
        const data_user = givens (), form_data = new FormData ();
        data_user.append ('email', email.value);
        data_user.append ('phone', phone.value);
        data_user.append ('password', password.value);
        data_user.append ('profile_picture', file_profile.value);
        data_user.append ('document_type', document_type.dataset.selected);
        data_user.append ('role', '1'); ////////////////////////////////////////////////////////////////////
        form_data.append ('user', JSON.stringify (Object.fromEntries (data_user)));
        form_data.append ('user_update', user);
        const res = await fetch ('User/update', {
            method: 'POST',
            body: form_data,
        })
        const data = await res.json ();
        draw (data);
        password.value = null;
        repeat_password.value = null;
        document.getElementById ('label-password').classList.remove ('is-label-active');
        document.getElementById ('label-repeat-password').classList.remove ('is-label-active');
        reset ();
        close_modal2 ();
    } else {
        console.log (data);
    }
}
