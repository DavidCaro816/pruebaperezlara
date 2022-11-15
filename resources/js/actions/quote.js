const select_content_coverages = document.getElementById('coberturas-select-content'),
    message_empty_table = document.getElementById ('message-empty-table'),
    table_form = document.getElementById ('table-form'),
    thead_form = document.getElementById ('thead-cotizacion'),
    tbody_form = document.getElementById ('tbody-cotizacion'),
    select_content_insurance = document.getElementById ('seguro-select-content'),
    select_content_insurer = document.getElementById ('aseguradora-select-content'),
    filter_content_insurance = document.getElementById ('seguro-filter-content'),
    filter_content_insurer = document.getElementById ('aseguradora-filter-content'),
    max_width = Number (window.getComputedStyle (table_form).maxWidth.replace (/[a-zA-Z]+/, '')),
    max_height = Number (window.getComputedStyle (table_form).maxHeight.replace (/[a-zA-Z]+/, ''));

function inputs(tr){
    const price = document.createElement ('td'), deductible = document.createElement ('td'),
        label_price = document.createElement ('label'), label_deductible = document.createElement ('label'),
        input_price = document.createElement ('input'), input_deductible = document.createElement ('input');
    input_price.className = 'input-title';
    input_deductible.className = 'input-title';
    label_price.appendChild (input_price);
    label_deductible.appendChild (input_deductible);
    price.appendChild (label_price);
    deductible.appendChild (label_deductible);
    tr.append (price, deductible);
}

function titles(td){
    const price = document.createElement ('th'), deductible = document.createElement ('th');
    price.appendChild (document.createTextNode ('Valor'));
    deductible.appendChild (document.createTextNode ('Deducible'));
    td.append (price, deductible);
}

function add_event(){
    document.querySelectorAll ('.select + .modal .checkbox').forEach (e => e.addEventListener ('change', create_quote_table));
}

function create_quote_table(e){
    if (e.target.checked){
        hide_message ();
        if (thead_form.getElementsByTagName ('tr').length === 0){
            thead_form.innerHTML += '<tr><th rowspan="2">Cobertura</th></tr>';
        }
        if (e.target.closest ('#aseguradora-select')){
            thead_form.rows[0].innerHTML +=
                '<th id="aseguradora' + e.target.dataset.id + '" colspan="2">' + e.target.labels.item (0).innerHTML +
                '</th>';
            if (tbody_form.rows.length > 0){
                if (thead_form.rows[0].getElementsByTagName ('th').length === 2){
                    thead_form.insertRow ();
                }
                titles (thead_form.rows[1]);
            }
            for (let i = 0; i < tbody_form.childElementCount; i++) {
                inputs (tbody_form.rows[i]);
            }
        } else {
            if (thead_form.getElementsByTagName ('th').length > 1 && tbody_form.childElementCount === 0){
                const tr = thead_form.insertRow ();
                for (let i = 0; i < thead_form.rows[0].childElementCount - 1; i++) {
                    titles (tr);
                }
            }
            const tr = tbody_form.insertRow ();
            tr.id = 'cobertura' + e.target.dataset.id;
            tr.insertCell ().appendChild (document.createTextNode (e.target.labels.item (0).innerHTML));
            for (let i = 0; i < thead_form.rows[0].childElementCount - 1; i++) {
                inputs (tr);
            }
        }
        if (table_form.offsetWidth > max_width || table_form.offsetHeight > max_height){
            table_form.classList.add ('is-table-form-active');
        }
    } else {
        if (e.target.closest ('.modal').id === 'coberturas-select'){
            document.getElementById ('cobertura' + e.target.dataset.id).remove ();
            if (tbody_form.childElementCount === 0){
                thead_form.rows[0].childElementCount > 1 ? thead_form.rows[1].remove () : show_message ();
            }
        } else {
            const eliminar = Array.from (thead_form.rows[0].children)
                                  .findIndex (x => x.id === 'aseguradora' + e.target.dataset.id);
            Array.from (thead_form.children).forEach ((e, index) => {
                Array.from (e.children).forEach ((x, index1) => {
                    if (eliminar - 1 === index1 && index === 1 || eliminar === index1){
                        x.remove ();
                    }
                })
            });
            Array.from (tbody_form.children).forEach ((e) => {
                Array.from (e.children).forEach ((x, index) => {
                    if (eliminar * 2 - 1 === index || eliminar * 2 === index){
                        x.remove ();
                    }
                })
            });
            if (thead_form.childElementCount === 1){
                if (thead_form.rows[0].childElementCount === 1){
                    show_message ();
                }
            } else if (thead_form.rows[1].childElementCount === 0){
                thead_form.rows[1].remove ();
            }
        }
        if (thead_form.offsetWidth < max_width || tbody_form.offsetWidth < max_width){
            table_form.classList.remove ('is-table-form-active');
        }
    }
}

function hide_message(){
    message_empty_table.classList.add ('is-message-empty-table-inactive');
}

function show_message(){
    message_empty_table.classList.remove ('is-message-empty-table-inactive');
    thead_form.rows[0].remove ();
}

function form_text(){
    change_form_text ('Nueva cotización', 'Registrar cotización');
}

async function index(){
    await show_data ('Quote');
}

async function products(){
    const res = await fetch ('Quote/dataView', {
        method: 'POST',
        body: new URLSearchParams ({
                                       request: true,
                                   }),
    })
    const data = await res.json ();
    data['insurances'].forEach(e => {
        one_option (e['id_seguro'], e['seguro'], select_content_insurance);
        multiple_option (e['id_seguro'], e['seguro'], filter_content_insurance);
    })
    data['insurers'].forEach(e => {
        multiple_option (e['id_aseguradora'], e['aseguradora'], select_content_insurer);
        multiple_option (e['id_aseguradora'], e['aseguradora'], filter_content_insurer);
    })
    data['coverages'].forEach(e => {
        multiple_option (e['id_cobertura'], e['cobertura'], select_content_coverages);
    })
    select_multiple(select_content_insurer);
    select_multiple(select_content_coverages);
    add_event();
}

async function create(e){
    e.preventDefault ();
    const res = await fetch ('Quote/create', {
        method: 'POST',
        body: {}
    })
    const data = await res.json ();
    response (data, 'Cotización registrada');
}

async function edit(){
    change_form_text ('Editar cotización', 'Actualizar cotización')
    const res = await fetch ('Quote/show', {
        method: 'POST',
        body: new URLSearchParams ({
                                       id: context_menu.dataset.rel
                                   }),
    })
    const data = await res.json ();
    console.log (data);
}

async function filter_results(){

}

async function update(e){
    e.preventDefault ();
    const res = await fetch ('Quote/update', {
        method: 'POST',
        body: {
            id: context_menu.dataset.rel
        },
    })
    const data = await res.json ();
    response (data, 'Cotización actualizada', true);
}

async function remove(){
    const res = await fetch ('Quote/delete', {
        method: 'POST',
        body: new URLSearchParams({
            id_quote: context_menu.dataset.rel
        }),
    })
    const data = await res.json ();
    table (data['data']);
    console.log(data['msg']); // Mostrar alerta de eliminación exitosa
}