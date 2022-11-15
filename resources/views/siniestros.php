<?php

$title = 'Siniestros';
$css = '<link rel="stylesheet" href="' . css('claims.css') . '">';
$js = '<script src="' . js('actions/sinister.js') . '"></script>'.
      '<script src="' . view('components/form_elements/dropdown/filter_select.js') . '"></script>';
$modal = 'sinister_modal.php';
$icon_view = 'sidebar/sinister.svg';
$filters = [['Fecha'], ['Seguro'], ['Aseguradora'], ['Estado', $status],];
$title_modal_confirm = '¿Desea eliminar el siniestro?';
require_once 'components/app/app.php';
