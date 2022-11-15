<ul id="context-menu" class="context-menu">
    <li id="edit" class="action" data-toggle="modal2" data-target="backdrop">
        <div class="container-icon-action">
            <img class="icon-action" src="<?php
            echo icon('buttons/edit.svg'); ?>" alt="">
        </div>
        Editar
    </li>
    <li id="delete" class="action" data-toggle="modal2" data-target="backdrop1">
        <div class="container-icon-action">
            <img class="icon-action" src="<?php
            echo icon('buttons/trash.svg'); ?>" alt="">
        </div>
        Eliminar
    </li>
    <li id="download" class="action">
        <div class="container-icon-action">
            <img class="icon-action" src="<?php
            echo icon('buttons/download.svg'); ?>" alt="">
        </div>
        Descargar
    </li>
    <li id="share" class="action">
        <div class="container-icon-action">
            <img class="icon-action" src="<?php
            echo icon('buttons/share.svg'); ?>" alt="">
        </div>
        Compartir
    </li>
</ul>
<div id="backdrop1" class="backdrop" data-target="modal-confirm">
    <div id="modal-confirm" class="modal modal-confirm" aria-labelledby="title-modal-confirm">
        <div class="header-modal">
            <h1 class="title-form"><?php
                echo $title_modal_confirm ?? null ?></h1>
            <img class="close-modal" data-dismiss="modal2" aria-label="Cerrar"
                 src="<?php
                 echo icon('buttons/closeDark.svg'); ?>" alt="">
        </div>
        <img class="warning-modal" src="<?php
        echo icon('buttons/warning.svg'); ?>" alt="">
        <div class="footer-modal">
            <button id="false-confirm" data-dismiss="modal2" type="submit" class="primary-button button-is-black">
                Cancelar
            </button>
            <button id="true-confirm" data-dismiss="modal2" type="reset" class="primary-button button-is-red">Eliminar
            </button>
        </div>
    </div>
</div>
