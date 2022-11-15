const select_birth_date = document.getElementById ('selected-fecha-nacimiento-select'),
    select_city = document.getElementById ('selected-ciudad-select'),
    select_department = document.getElementById ('selected-departamento-select'),
    address = document.getElementById ('direccion'),
    address2 = document.getElementById ('direccion2'),
    phone2 = document.getElementById ('telefono2');
let filter = false;

function form_text(){
    change_form_text ('Nuevo cliente', 'Registrar cliente');
}

function common_data(){
    const data = givens ();
    data.append ('birthday', select_birth_date.innerHTML);
    data.append ('email', email.value);
    data.append ('phone1', phone.value);
    data.append ('phone2', phone2.value);
    data.append ('address1', address.value);
    data.append ('address2', address2.value);
    data.append ('document_type', document_type.dataset.selected);
    data.append ('city', select_city.dataset.selected);
    return data;
}

async function index(){
    await show_data ('Client');
}

async function create(e){
    e.preventDefault ();
    const res = await fetch ('Client/create', {
        method: 'POST',
        body: common_data (),
    })
    const data = await res.json ();
    response(data['data'], data['msg'])
}

async function edit(){
    change_form_text ('Editar cliente', 'Actualizar cliente');
    const res = await fetch ('Client/show', {
        method: 'POST',
        body: new URLSearchParams ({
                                       document: context_menu.dataset.rel
                                   }),
    })
    const data = await res.json ();
    names.value = first_word (data['Cliente'], '&').trim ();
    surnames.value = following_words (data['Cliente'], '&').trim ();
    document_number.value = data['No. Documento'].replace (/[a-zA-Z]+/, '').trim ();
    email.value = data['Email'].trim ();
    address.value = first_word (data['Direccion'], '&').trim ();
    address2.value = following_words (data['Direccion'], '&').trim ();
    phone.value = first_word (data['Telefono'], '&').trim ();
    phone2.value = following_words (data['Telefono'], '&').trim ();
    document_type.dataset.selected = data['id_tipo_documento'];
    document_type.innerHTML = data['descripcion_documento'];
    select_city.dataset.selected = data['id_ciudad'];
    select_city.innerHTML = data['Ciudad'];
    select_department.dataset.selected = data['id_departamento'];
    select_department.innerHTML = data['Departamento'];
    select_birth_date.innerHTML = data['Fecha de nacimiento'];
    input_active ();
    select_active ();
}

async function filter_results(obj_data){
    const res = await fetch ('Client/filter', {
        method: 'POST',
        body: obj_data,
    })
    const data = await res.json ();
    filter = true;
    table (data);
}

async function search(){
    const res = await fetch ('Client/search', {
        method: 'POST',
        body: new URLSearchParams ({
                                       search: input_search.value
                                   })
    })
    table (await res.json ())
}

async function update(e){
    e.preventDefault ();
    const form_data = new FormData ();
    form_data.append ('client', JSON.stringify (Object.fromEntries (common_data ())));
    form_data.append ('client_update', following_words (context_menu.dataset.rel));
    const res = await fetch ('Client/update', {
        method: 'POST',
        body: form_data,
    })
    const data = await res.json ();
    response (data['data'], data['msg'], true);
}

async function remove(){
    const res = await fetch ('Client/delete', {
        method: 'POST',
        body: new URLSearchParams ({
                                       document: following_words (context_menu.dataset.rel)
                                   }),
    })
    const data = await res.json ();
    table (data['data']);
    alert(data['msg']);
}