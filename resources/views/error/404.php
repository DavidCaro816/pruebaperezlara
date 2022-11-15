<?php

$css = '<link rel="stylesheet" href="' . css('error/404.css') . '">';
$title = 'Página no encontrada';
$number1 = 4;
$content = 'main_404.php';
$number2 = 4;
$error_message = 'Página no encontrada';
$error_description = 'Parece que no podemos encontrar la página que estas buscando';
require_once view('components/error/error.php');
