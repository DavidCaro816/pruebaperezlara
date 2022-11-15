<?php

$title = 'Clientes';
$css = '<link rel="stylesheet" href="' . css('clients.css') . '">';
$js = '<script src="' . js('actions/helper/UserClient.js') . '"></script>' .
      '<script src="' . js('actions/client.js') . '"></script>';
$modal = 'customers_modal.php';
$icon_view = 'sidebar/clients.svg';
$filters = [['Departamento', $departments], ['Ciudad', $cities], ['Estado', $status],];
$title_modal_confirm = '¿Desea eliminar el cliente?';
require_once "components/app/app.php";
