const code = document.getElementById ('codigo'), client_document_number = document.getElementById ('numero-documento'),
    label_client = document.getElementById ('label-cliente'), client = document.getElementById ('cliente'),
    quotes_fieldset = document.getElementById ('quotes-fieldset'),
    client_quotes = document.getElementById ('client-quotes'),
    quotes_info = document.getElementById ('quotes-info'),
    start_date = document.getElementById ('selected-fecha-inicio-select'),
    expiration_date = document.getElementById ('selected-fecha-vencimiento-select'),
    payment_date = document.getElementById ('selected-fecha-pago-select'),
    file = document.getElementById ('file'),
    filename = document.getElementById('filename'),
    number_months = document.getElementById ('cantidad-meses'),
    policy_customer_document = document.getElementById ('numero-documento'),
    select_insurance = document.getElementById ('selected-seguro-select'),
    select_insurer = document.getElementById ('selected-aseguradora-select'),
    insured_value = document.getElementById ('valor-asegurado'),
    premium_value = document.getElementById ('valor-prima'),
    select_content_insurance = document.getElementById ('seguro-select-content'),
    select_content_insurer = document.getElementById ('aseguradora-select-content'),
    filter_content_insurance = document.getElementById ('seguro-filter-content'),
    filter_content_insurer = document.getElementById ('aseguradora-filter-content');

client_document_number.addEventListener ('input', show_quotes);

async function show_quotes(){
    const data = await fetch ('Quote/accordingClient', {
        method: 'POST',
        body: new URLSearchParams ({
                                       ClientDocument: client_document_number.value
                                   })
    });
    const res = await data.json ();
    if (typeof res === 'object'){
        label_client.classList.add ('is-label-active');
        client.value = res[0]['Cliente'];
        quotes_fieldset.classList.remove ('is-fieldset-hidden');
        quotes_info.innerHTML = null;
        res.forEach (e => {
            const tr = document.createElement ('tr'), first_td = document.createElement ('td'),
                second_td = document.createElement ('td'), third_td = document.createElement ('td');
            first_td.appendChild (document.createTextNode (e['Seguro']));
            second_td.className = 'container-img';
            e['Aseguradora'].split (',').forEach (e => {
                const img = document.createElement ('img');
                img.src = e.toString ();
                second_td.appendChild (img);
            })
            checkbox ('cotizacion' + e['No. Cotizacion'], '', third_td);
            tr.append (first_td, second_td, third_td);
            quotes_info.appendChild (tr);
        })
    }
}

function form_text(){
    change_form_text ('Nueva Póliza', 'Registrar Póliza');
}

async function index(){
    await show_data ('Policy');
}

async function products(){
    const res = await fetch ('Policy/productsActive', {
        method: 'POST',
        body: new URLSearchParams ({
                                       request: true,
                                   }),
    })
    const data = await res.json ();
    data['insurances'].forEach (e => {
        one_option (e['id_seguro'], e['seguro'], select_content_insurance);
        multiple_option (e['id_seguro'], e['seguro'], filter_content_insurance);
    })
    data['insurers'].forEach (e => {
        one_option (e['id_aseguradora'], e['aseguradora'], select_content_insurer);
        multiple_option (e['id_aseguradora'], e['aseguradora'], filter_content_insurer);
    })
}

function common_data(){
    let data = new FormData ();
    data.append ('code', code.value);
    data.append ('insurance', select_insurance.dataset.selected);
    data.append ('insurer', select_insurer.dataset.selected);
    data.append ('insured_value', insured_value.value);
    data.append ('premium_value', premium_value.value);
    data.append ('FileService', '');
    data.append ('start_date', start_date.textContent);
    data.append ('expiration_date', expiration_date.textContent);
    data.append ('payment_date', payment_date.textContent);
    data.append ('months', number_months.value === '' ? 0 : number_months.value);
    data.append ('IdQuote', '1');
    return data;
}

async function create(e){
    e.preventDefault ();
    const obj_data = common_data ();
    obj_data.append ('policy_document', file.files[0]);
    const res = await fetch ('Policy/create', {
        method: 'POST',
        body: obj_data,
    })
    const data = await res.json ();
    response (data['data'], data['msg']);
}

async function edit(){
    change_form_text ('Editar Póliza', 'Actualizar Póliza');
    const res = await fetch ('Policy/show', {
        method: 'POST',
        body: new URLSearchParams ({
                                       code: context_menu.dataset.rel
                                   }),
    })
    const data = await res.json ();
    code.value = data['Codigo póliza'];
    policy_customer_document.value = data['Documento'];
    client.value = data['Cliente'];
    premium_value.value = data['Valor prima'];
    insured_value.value = data['Valor asegurado'];
    start_date.textContent = data['Fecha de inicio'];
    expiration_date.textContent = data['Fecha de vencimiento'];
    payment_date.textContent = data['Fecha de pago'];
    select_insurance.dataset.selected = data['id_seguro'];
    select_insurer.dataset.selected = data['id_aseguradora'];
    select_insurance.innerHTML = data['Seguro'];
    select_insurer.innerHTML = data['nombre_aseguradora'];
    number_months.value = data['Cantidad de meses'];
    filename.textContent = data['nombre_archivo'];
    filename.dataset.id = data['id_archivo'];
    filename.dataset.rel = data['Archivo'];
    input_active ();
    select_active ();
}

async function filter_results(){

}

async function update(e){
    e.preventDefault ();
    const form_data = new FormData (),form_data_common = common_data();
    if (file.files[0]) {
        form_data.append ('policy_document', file.files[0]);
        form_data_common.append ('file_id_update', filename.dataset.rel);
    }
    form_data.append ('policy', JSON.stringify (Object.fromEntries (form_data_common)));
    form_data.append ('policy_update', context_menu.dataset.rel);
    form_data.append ('file_update', filename.dataset.id);
    const res = await fetch ('Policy/update', {
        method: 'POST',
        body: form_data,
    })
    const data = await res.json ();
    response (data['data'], data['msg'], true);
}

async function remove(){
    const res = await fetch ('Policy/delete', {
        method: 'POST',
        body: new URLSearchParams ({
                                       code: context_menu.dataset.rel
                                   }),
    })
    const data = await res.json ();
    table (data['data']);
    alert (data['msg']);
}


