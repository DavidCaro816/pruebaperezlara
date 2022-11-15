const names = document.getElementById ('nombres'),
    surnames = document.getElementById ('apellidos'),
    document_type = document.getElementById ('selected-tipo-documento-select'),
    document_number = document.getElementById ('numero-documento'),
    email = document.getElementById ('correo-electronico'),
    phone = document.getElementById ('telefono');

function first_word(string, search_element = ' '){
    const index = string.indexOf (search_element), end = index === -1 ? string.length : index;
    return string.substring (0, end);
}

function following_words(string, search_element = ' '){
    const index = string.indexOf (search_element);
    return index !== -1 ? string.substring (index + 1, string.length) : '';
}

function givens(){
    const form_data = new FormData ();
    form_data.append ('document', document_number.value);
    form_data.append ('first_name', first_word (names.value));
    form_data.append ('second_name', following_words (names.value));
    form_data.append ('first_surname', first_word (surnames.value));
    form_data.append ('second_surname', following_words (surnames.value));
    return form_data;
}