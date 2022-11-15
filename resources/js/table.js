const thead = document.getElementById ('thead'), tbody = document.getElementById ('tbody');

window.addEventListener ('load', index);

async function show_data(controller, action = 'index'){
    const res = await fetch (controller + '/' + action, {
        method: 'POST',
        body: new URLSearchParams ({
                                       request: true
                                   }),
    })
    const json = await res.json ();
    table (json);
}

function table(data){
    thead.innerHTML = null;
    tbody.innerHTML = null;
    if (data.length > 0){
        const keys = Object.keys (data[0]);
        data.forEach ((e, index) => {
            const tr = tbody.insertRow ();
            tr.classList.add ('row');
            for (let j = 0; j < keys.length; j++) {
                if (index === 0){
                    if (thead.childElementCount === 0){
                        thead.insertRow ().classList.add ('row');
                    }
                    const th = document.createElement ('th');
                    th.appendChild (document.createTextNode (keys[j]));
                    thead.rows[0].appendChild (th);
                }
                const td = tr.insertCell ();
                if (keys[j] === 'Aseguradora'){
                    td.classList.add ('container-img');
                    e[keys[j]].split (',').forEach (e => {
                        const img = document.createElement ('img');
                        img.src = e.toString ();
                        td.appendChild (img);
                    });
                } else {
                    td.appendChild (document.createTextNode (e[keys[j]]));
                }
            }
        });
        tbody.insertRow ();
    } else {
        const tr = document.createElement ('tr'), th = document.createElement ('th');
        tr.className = 'row';
        th.className = 'row-not-found';
        th.appendChild (document.createTextNode ('No hay resultados'));
        tr.appendChild (th);
        thead.appendChild(tr);
    }
}


