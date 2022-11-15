<?php

require_once 'resources/views/components/form_elements/input.php';
require_once 'resources/views/components/form_elements/dropdown/select.php';
?>
<div id="container-form" class="container-form">
    <form id="modal-form" class="form scrollbar" aria-labelledby="title-form">
        <div class="header-modal">
            <h1 id="title-form" class="title-form">Nuevo Siniestro</h1>
            <img class="close-modal" data-dismiss="modal2" aria-label="Cerrar"
                 src="<?php
                 echo icon('buttons/closeDark.svg') ?>" alt="">
        </div>
        <div class="body-modal-f">
            <fieldset class="fieldset">
                <legend class="legend">Información póliza</legend>
                <div class="body-modal">
                    <?php
                    input('Codigo');
input('Cliente', 'text', null, null, 'disabled');
input('Seguro', 'text', null, null, 'disabled');
input('Aseguradora', 'text', null, null, 'disabled');
?>
                </div>
            </fieldset>
            <fieldset class="fieldset">
                <legend class="legend">Información siniestro</legend>
                <div class="body-modal">
                    <?php
input('Titulo del siniestro');
select('Fecha');
input('Monto');
checkbox('Aún no se conoce el monto', 'checkbox-monto');
input('Descripción', 'textarea', 'description', 'group-description');
?>
                </div>
            </fieldset>
            <fieldset class="fieldset">
                <legend class="legend">Archivos</legend>
            </fieldset>
        </div>
        <div class="footer-modal" id="footer-modal">
            <div class="container-file">
                <?php
                input_file('multiple'); ?>
            </div>
            <div class="footer-modal">
                <button id="clean-form" type="reset" class="primary-button button-is-black">Limpiar formulario</button>
                <button id="send-form" type="submit" class="primary-button button-is-red">Registrar siniestro</button>
            </div>
        </div>
    </form>
</div>
