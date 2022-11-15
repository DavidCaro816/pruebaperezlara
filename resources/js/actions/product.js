const insurances_cards_container = document.getElementById ('insurances-cards-container'),
    insurers_cards_container = document.getElementById ('insurers-cards-container'),
    backdrop = document.getElementById ('backdrop');

window.addEventListener ('load', products);

async function products(){
    const res = await fetch ('User/products', {
        method: 'POST',
        body: new URLSearchParams ({
                                       request: true,
                                   }),
    });
    const data = await res.json ();
    data['insurances'].forEach (e => {
        const img_card = document.createElement ('div'), h3 = document.createElement ('h3'),
            img = document.createElement ('img');
        img_card.className = 'img-card';
        h3.className = 'insurance-name';
        h3.appendChild (document.createTextNode (e['seguro']));
        img.className = 'card-logo';
        img.src = e['imagen'];
        img_card.append (h3, img);
        insurances_cards_container.appendChild (img_card);
    });
    data['insurers'].forEach (e => {
        const container_card = document.createElement ('div'), card = document.createElement ('div'),
            img_card = document.createElement ('div'), img = document.createElement ('img'),
            container_list = document.createElement ('div'), h3 = document.createElement ('h3'),
            ol = document.createElement ('ol'), insurances = e['seguros'].split (',');
        container_card.className = 'container-card';
        card.className = 'card';
        img_card.className = 'img-card';
        img.className = 'card-logo';
        img.src = e['aseguradora'];
        img_card.appendChild (img);
        container_list.className = 'container-list';
        h3.className = 'title-list';
        h3.appendChild (document.createTextNode ('Seguros'));
        ol.className = 'insurance-list scrollbar';
        insurances.forEach (e => {
            const li = document.createElement ('li');
            li.className = 'insurance';
            li.appendChild (document.createTextNode (e.toString ()));
            ol.appendChild (li);
        })
        container_list.append (h3, ol);
        card.append (img_card, container_list);
        container_card.appendChild (card);
        insurers_cards_container.appendChild (container_card);
    });
    const card = document.getElementsByClassName ('card'), cards = card.length;
    Array.from (card).forEach ((e, index) => {
        e.style.zIndex = (cards - index).toString ();
    })
    header.style.zIndex = (cards + 1).toString ();
    sidebar.style.zIndex = (cards + 1).toString ();
    backdrop.style.zIndex = (cards + 2).toString ();
}