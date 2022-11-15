<?php

$css = '<link rel="stylesheet" href="' . css('error/403.css') . '">';
$title = 'Página prohibida';
$number1 = 4;
$content = 'main_403.php';
$number2 = 3;
$error_message = 'Acceso denegado';
$error_description = 'No tienes permiso para ver esta página o recurso';
require_once view('components/error/error.php');
