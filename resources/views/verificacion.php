<!doctype html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Roboto:wght@500&display=swap">
    <link rel="stylesheet" href="<?php
    echo css('verification.css') ?>">
    <title>Perez Lara Cia LTDA - Verificación</title>
</head>
<body>
<?php
require_once 'resources/views/components/app/header_alternative.php';
    ?>
<main class="main">
    <div class="container-confirmation">
        <div class="container-img">
            <img src="<?php
                echo icon('policies_data/data_right/x.svg'); ?>" alt="">
        </div>
        <h1 class="title-confirmation">Confirmación de la dirección de correo electrónico de la cuenta</h1>
        <p class="description">No pudimos confirmar la dirección de correo electrónico de su cuenta. Vuelva a enviar el
            correo electrónico de confirmación y vuelva a intentarlo.</p>
    </div>
</main>
</body>
</html>