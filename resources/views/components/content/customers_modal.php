<?php
require_once view('components/form_elements/input.php');
require_once view('components/form_elements/dropdown/select.php');
?>
<form id="modal-form" class="container-form form" aria-labelledby="title-form">
    <div class="header-modal">
        <h1 id="title-form" class="title-form">Nuevo cliente</h1>
        <img class="close-modal" data-dismiss="modal2" aria-label="Cerrar" src="<?php
        echo icon('buttons/closeDark.svg') ?>"
             alt="">
    </div>
    <div class="body-modal">
        <?php
        input('Nombres') .
        input('Apellidos') .
        select('Tipo de documento', $types_documents) .
        input('Número de documento') .
        select('Fecha de nacimiento') .
        input('Correo electrónico', 'email') .
        select('Departamento', $departments) .
        select('Ciudad', $cities) .
        input('Direccion') .
        input('Direccion (opcional)', 'text', 'direccion2') .
        input('Telefono', 'tel') .
        input('Telefono (opcional)', 'tel', 'telefono2');
?>
    </div>
    <div class="footer-modal">
        <button id="clean-form" type="reset" class="primary-button button-is-black">Limpiar formulario</button>
        <button id="send-form" type="submit" class="primary-button button-is-red">Registrar cliente</button>
    </div>
</form>

