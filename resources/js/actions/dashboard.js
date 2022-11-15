const filter_content_insurance = document.getElementById ('seguro-filter-content'),
    filter_content_insurer = document.getElementById ('aseguradora-filter-content'),
    clients = document.getElementById('total-clients'),quotes = document.getElementById('total-quotes'),
    policies = document.getElementById('total-policies'),soon_beat = document.getElementById('soon-to-beat'),
    active = document.getElementById('active'),expired = document.getElementById('expired');

async function index() {
    await show_data ('Quote', 'recent')
}

async function products(){
    const res = await fetch ('User/dashboard', {
        method: 'POST',
        body: new URLSearchParams ({
                                       request: true,
                                   }),
    })
    const data = await res.json ();
    data['insurances'].forEach(e => multiple_option (e['id_seguro'], e['seguro'], filter_content_insurance));
    data['insurers'].forEach(e => multiple_option (e['id_aseguradora'], e['aseguradora'], filter_content_insurer));
    clients.textContent = data['total_clients'];
    quotes.textContent = data['total_quotes'];
    policies.textContent = data['total_policies'];
    const array = [expired,soon_beat,active];
    array.forEach((e,index) => e.textContent = data['count_states_policies'][index]['Total'])
}