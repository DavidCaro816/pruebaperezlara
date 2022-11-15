<?php

require_once view('components/form_elements/input.php');
require_once view('components/form_elements/dropdown/select.php');
?>
<div id="container-form" class="container-form">
    <form id="modal-form" class="form scrollbar" aria-labelledby="title-form">
        <div class="header-modal">
            <h1 id="title-form" class="title-form">Nueva Póliza</h1>
            <img class="close-modal" data-dismiss="modal2" aria-label="Cerrar"
                 src="<?php
                 echo icon('buttons/closeDark.svg') ?>" alt="">
        </div>
        <div class="body-modal-f">
            <fieldset class="fieldset">
                <legend class="legend">Información cliente</legend>
                <div class="body-modal">
                    <?php
                    input('Número de documento');
input('Cliente', 'text', null, null, 'disabled');
?>
                </div>
            </fieldset>
            <fieldset id="quotes-fieldset" class="fieldset is-fieldset-hidden">
                <legend class="legend">Cotización</legend>
                <table>
                    <thead>
                        <tr>
                            <td>Seguro</td>
                            <td>Aseguradoras</td>
                            <td>Seleccionar</td>
                        </tr>
                    </thead>
                    <tbody id="quotes-info"></tbody>
                </table>
            </fieldset>
            <fieldset class="fieldset">
                <legend class="legend">Información póliza</legend>
                <div class="body-modal">
                    <?php
input('Codigo');
select('Seguro');
select('Aseguradora');
input('Valor asegurado');
input('Valor prima');
select('Fecha de inicio');
select('Fecha de vencimiento');
select('Fecha de pago');
input('Cantidad de meses');
?>
                </div>
            </fieldset>
        </div>
        <div class="footer-modal" id="footer-modal">
            <div class="container-file">
                <?php
                input_file();
?>
                <span id="filename" class="filename"></span>
                <span class="title pop-filename"></span>
            </div>
            <div class="footer-modal">
                <button id="clean-form" type="reset" class="primary-button button-is-black">Limpiar formulario</button>
                <button id="send-form" type="submit" class="primary-button button-is-red">Registrar póliza</button>
            </div>

        </div>
    </form>
</div>