<?php

$title = 'Productos';
$css_template = false;
$css = '<link rel="stylesheet" href="' . css('products.css') . '">';
$js = '<script src="' . js('modal_static.js') . '"></script>' .
      '<script src="' . js('actions/product.js') . '"></script>';
$content = 'main_products.php';

require_once 'components/app/app.php';
