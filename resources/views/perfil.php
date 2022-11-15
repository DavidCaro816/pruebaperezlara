<?php

$title = 'Perfil';
$css_template = false;
$css = '<link rel="stylesheet" href="' . css('profile.css') . '">';
$js = '<script src="' . js('input.js') . '"></script>' .
      '<script src="' . js('modal_static.js') . '"></script>' .
      '<script src="' . js('actions/profile.js') . '"></script>' .
      '<script src="' . helper('helper_form.js') . '"></script>' .
      '<script src="' . js('actions/helper/UserClient.js') . '"></script>';
$content = 'main_profile.php';

require_once 'components/app/app.php';
