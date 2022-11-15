window.addEventListener ('load', products);

function checkbox(id, checkbox, element){
    const label = document.createElement ('label'), input = document.createElement ('input');
    input.id = id;
    input.className = 'checkbox';
    input.type = 'checkbox';
    label.className = 'label-checkbox';
    label.htmlFor = id;
    label.appendChild (document.createTextNode (checkbox))
    element.append (input, label);
}

function one_option(id, option, element){
    const li = document.createElement ('li');
    li.role = 'option';
    li.className = 'option';
    li.dataset.id = id;
    li.appendChild (document.createTextNode (option));
    li.addEventListener ('click', choose);
    element.appendChild (li);
}

function multiple_option(id, option, element){
    const li = document.createElement ('li');
    li.role = 'option';
    checkbox ( element.closest('.modal').id + id, option, li);
    element.appendChild (li);
}

function select_multiple(element) {
    document.querySelector('[data-target=' + element.closest('.modal').id + ']').dataset.multiple = 'true';
}