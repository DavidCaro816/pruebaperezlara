const filters = document.querySelectorAll ('.filter ~ .modal'),
    pdf = document.getElementById ('pdf'),
    excel = document.getElementById ('excel'),
    filter_checkbox = document.querySelectorAll ('.filter + .modal .checkbox'), ////////////////
    new_button = document.getElementById ('new-button'),
    alert_request = document.getElementById ('alert-request'),
    text_alert = document.getElementById ('text-alert'),
    title_form = document.getElementById ('title-form'),
    send_form = document.getElementById ('send-form'),
    button_filter = document.getElementById ('button-filter'),
    button_clean = document.getElementById ('button-clean');
let action;

new_button.addEventListener ('click', () => {
    action = true;
    reset ();
    form_text ();
});
button_filter.addEventListener ('click', filter_data);
button_clean.addEventListener ('click', clean);
pdf.addEventListener ('click', createDoc);
excel.addEventListener ('click', createDoc);

function trigger(e) {
    action ? create (e) : update (e);
}

function change_form_text(title, btn_send) {
    title_form.textContent = title;
    send_form.textContent = btn_send;
}

/* Respuesta exitosa de acción */
function response(respuesta, message, close = false) {
    if (close === true) {
        close_modal2 ();
    }
    reset ();
    alert (message);
    table (respuesta);
}

function alert(message) {
    text_alert.textContent = message;
    alert_request.classList.add ('is-alert-request-visible');
    setTimeout (() => {
        alert_request.classList.remove ('is-alert-request-visible');
    }, 3000);
}

function filter_data(){
    const data = data_filter ();
    if (Array.from (data).length > 0){
        filter_results (data);
    }
}

function data_filter() {
    const condiciones = [], object = new FormData ();
    filters.forEach (e => {
        let data = [];
        document.querySelectorAll ('#' + e.id + ' .checkbox').forEach (e => {
            if (e.checked) {
                data.push (e.labels[0].innerHTML);
            }
        });
        if (data.length > 0) {
            condiciones.push (e.id.replace ('-filter', ''));
            object.append (e.id, JSON.stringify (data));
        }
    });
    if (condiciones.length > 0) {
        object.append ('condiciones', JSON.stringify (condiciones))
    }
    return object;
}

function clean() {
    if (filter) {
        index ();
        filter = false;
    }
    document.querySelectorAll ('.filter ~ .modal .checkbox:checked').forEach (e => e.checked = false)
}















///////////////////
function createDoc(e){
    let data;
    for (let i = 0; i < filter_checkbox.length; i++) {
        if (filter_checkbox[i].checked){
            data = true;
            break;
        }
    }
    e.target.closest ('#pdf') ? createPDF (data) : createExcel (data);
}

function createPDF(data){
    if (data){
        console.log ('crear pdf filtrado')
    } else {
        console.log ('crear pdf de toda la vista')
    }
}

function createExcel(data){
    if (data){
        console.log ('crear excel filtrado')
    } else {
        console.log ('crear excel de toda la vista')
    }
}
////////////////////