<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="icon" href="<?php
    echo icon('window/icono.svg'); ?>">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Roboto:wght@500&display=swap">
    <link rel="stylesheet" href="<?php
    echo css('components/App/App.css'); ?>">

    <?php
    if (!isset($css_template)) {
        echo '<link rel="stylesheet" href="' . css('components/App/content.css') . '">';
    }
    ?>

    <?php
    if (isset($css)) {
        echo $css;
    }
    ?>

    <title>Perez Lara Cia Ltda - <?php
        if (isset($title)) {
            echo $title;
        } ?></title>
</head>
<body class="scrollbar">
<div class="container">
    <?php
    require_once view('components/App/header.php');
    ?>

    <?php
    require_once view('components/App/navbar.php');
    ?>

    <main class="main">
        <?php
        if (!isset($content)) {
            require_once view('components/App/header_content.php');
            require_once view('components/App/content.php');
        } elseif (!isset($not_content)) {
            require_once view('components/content/' . $content);
        }
    ?>
    </main>
</div>
<script src="<?php
echo js('sidebar.js') ?>"></script>
<script src="<?php
echo js('modal.js') ?>"></script>

<?php
if (isset($js)) {
    echo $js;
}
    ?>

<?php
if (!isset($content)) {
    echo '<script src="' . js('input.js') . '"></script>
<script src="' . js('modal_static.js') . '"></script>
<script src="' . helper_js('helper.js') . '"></script>
<script src="' . helper_js('helper_form.js') . '"></script>
<script src="' . js('context_menu.js') . '"></script>
<script src="' . js('table.js') . '"></script>';
}
    ?>

<?php
if (isset($filters)) {
    echo '<script src="' . js('search.js') . '"></script>
<script src="' . js('calendar.js') . '"></script>';
}
    ?>

</body>
</html>