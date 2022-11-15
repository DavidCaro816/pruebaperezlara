<?php
require_once view('components/form_elements/input.php');
require_once view('components/form_elements/dropdown/select.php');
?>
<div class="container-profile">
    <header class="header-profile">
        <div id="container-img" class="container-img">
            <input id="file-profile" type="file" class="file">
            <label for="file-profile" class="label-file-profile">
                <img src="<?php
                echo icon('buttons/camera.svg') ?>" alt="">
            </label>
        </div>
        <div>
            <h1 id="username"></h1>
            <span id="rol"></span>
        </div>
    </header>
    <div class="form-profile">
        <form id="info-profile" class="info-profile">
            <fieldset class="fieldset-profile">
                <legend class="legend">Información personal</legend>
                <div class="body-modal">
                    <?php
                    input('Nombres');
input('Apellidos');
select('Tipo de documento', $types_documents);
input('Número de documento');
input('Telefono');
input('Correo electrónico');
input('Contraseña', 'password', 'password', null, 'autocomplete="on" spellcheck="false"');
input(
    'Repita su contraseña',
    'password',
    'repeat-password',
    null,
    'autocomplete="on" spellcheck="false"'
);
?>
                </div>
            </fieldset>
            <button id="send-form" type="submit" class="primary-button button-is-red" data-toggle="modal2"
                    data-target="backdrop">Guardar cambios
            </button>
        </form>
        <div id="backdrop" class="backdrop" role="dialog">
            <form id="modal-form" class="container-form form" aria-labelledby="title-form">
                <div class="header-modal">
                    <h1 id="title-form" class="title-form">Verifica tu identidad</h1>
                    <img class="close-modal" data-dismiss="modal2" aria-label="Cerrar"
                         src="<?php
     echo icon('buttons/closeDark.svg') ?>" alt="">
                </div>
                <span id="verify-email" class="verify-email"></span>
                <?php
                input(
    'Ingresa tu contraseña actual',
    'password',
    'current-password',
    null,
    'autocomplete="on" spellcheck="false"'
)
?>
                <button id="verify-send-form" type="submit" class="primary-button button-is-red button-is-block">
                    Verificar
                </button>
            </form>
        </div>
    </div>
</div>