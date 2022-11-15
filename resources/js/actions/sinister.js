const code = document.getElementById ('codigo'),
    label_client = document.getElementById('label-cliente'),
    client = document.getElementById ('cliente'),
    label_insurance = document.getElementById('label-seguro'),
    insurance = document.getElementById ('seguro'),
    label_insurer = document.getElementById('label-aseguradora'),
    insurer = document.getElementById ('aseguradora'),
    title = document.getElementById('titulo-siniestro'),
    sinister_date = document.getElementById('selected-fecha-select'),
    amount = document.getElementById ('monto'),
    checkbox_monto = document.getElementById('checkbox-monto'),
    description = document.getElementById ('description'),
    file = document.getElementById ('file'),
    filter_content_insurance = document.getElementById ('seguro-filter-content'),
    filter_content_insurer = document.getElementById ('aseguradora-filter-content');

code.addEventListener('input', show_data_policy);
checkbox_monto.addEventListener('input', choose_amount);
file.addEventListener('input', show_files);

function show_files(e) {
}

async function show_data_policy(){
    const data = await fetch('Policy/show',{
        method: 'POST',
        body: new URLSearchParams({
            code: code.value,
                                  })
    });
    const res = await data.json();
    if(typeof res === 'object') {
        client.value = res['Cliente'];
        insurance.value = res['Seguro'];
        insurer.value = res['nombre_aseguradora'];
        label_client.classList.add('is-label-active');
        label_insurance.classList.add('is-label-active');
        label_insurer.classList.add('is-label-active');
    }
}

function choose_amount(e){
    e.target.checked ? amount.disabled = true : amount.disabled = false;
}

function form_text(){
    reset ();
    change_form_text ('Nuevo siniestro', 'Registrar siniestro');
}

async function index(){
    await show_data ('Sinister');
}

async function products(){
    const res = await fetch ('Sinister/productsActive', {
        method: 'POST',
        body: new URLSearchParams ({
                                       request: true,
                                   }),
    })
    const data = await res.json ();
    data['insurers'].forEach(e => multiple_option (e['id_aseguradora'], e['aseguradora'], filter_content_insurer));
    data['insurances'].forEach(e => multiple_option (e['id_seguro'], e['seguro'], filter_content_insurance));
}
function common_data(datum){
    datum.append ('title', title.value);
    datum.append ('date', sinister_date.textContent);
    datum.append ('description', description.value);
    datum.append ('amount', !checkbox_monto.checked ? amount.value : '');
    datum.append ('policy_code', code.value);
    Array.from(file.files).forEach((e,index) => datum.append('file' + index,e));
    return datum;
}

async function create(e){
    e.preventDefault ();
    const form_data = common_data (new FormData ());
    form_data.append('collection_file','');
    const res = await fetch ('Sinister/create', {
        body: form_data,
        method: 'post',
    })
    const data = await res.json ();
    response(data['data'], data['msg']);
}

async function edit(){
    change_form_text ('Editar Siniestro', 'Actualizar Siniestro')
    const res = await fetch ('Sinister/show', {
        body: new URLSearchParams ({
                                       id: context_menu.dataset.rel
                                   }),
        method: 'post',
    })
    const data = await res.json ();
    client.value = data['Cliente'];
    title.value = data['Titulo'];
    amount.value = data['Monto'];
    if(data['Monto'] === '-') {
        checkbox_monto.checked = true;
        amount.disabled = true;
    }else{
        checkbox_monto.checked = false;
        amount.disabled = false;
    }
    description.value = data['Descripción'];
    code.value = data['Codigo póliza'];
    insurance.value = data['Seguro'];
    insurer.value = data['nombre_aseguradora'];
    sinister_date.textContent = data['Fecha'];
    input_active ();
    select_active();
}

async function update(e){
    e.preventDefault ();
    const form_data = new FormData ();
    form_data.append ('reference_number', context_menu.dataset.rel);
    common_data (form_data);
    form_data.append('collection_file','');
    const res = await fetch ('Sinister/update', {
        method: 'POST',
        body: form_data,
    })
    const data = await res.json ();
    response (data['data'],data['msg'],true)
}

function filter_results(){

}

async function remove(){
    const res = await fetch ('Sinister/delete', {
        body: new URLSearchParams ({
                                       id: context_menu.dataset.rel
                                   }),
        method: 'POST',
    })
    const data = await res.json ();
    table (data['data']);
    alert(data['msg']);
}
