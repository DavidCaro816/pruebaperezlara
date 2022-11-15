<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="<?php
    echo icon('window/icono.svg') ?>">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Roboto:wght@500&display=swap">
    <link rel="stylesheet" href="<?php
    echo css('components/error/error.css') ?>">
    <?php
    if (isset($css)) {
        echo $css;
    }
    ?>
    <title>
        <?php
        if (isset($title)) {
            echo $title;
        }
    ?>- Perez Lara Cia Ltda
    </title>
</head>
<body>
<?php
require_once view('components/App/header_alternative.php');
    ?>
<main class="main">
    <div class="container-error-code">
        <span class="number">
            <?php
                if (isset($number1)) {
                    echo $number1;
                }
    ?>
        </span>
        <?php
        if (isset($content)) {
            require_once view('components/content/error/' . $content);
        }
    ?>
        <span class="number">
            <?php
        if (isset($number2)) {
            echo $number2;
        }
    ?>
        </span>
    </div>
    <h1 class="error-message">
        <?php
        if (isset($error_message)) {
            echo $error_message;
        }
    ?>
    </h1>
    <p class="error-description">
        <?php
    if (isset($error_description)) {
        echo $error_description;
    }
    ?>
    </p>
    <a class="secondary-button a-button button-is-red">Regresar</a>
</main>
</body>
</html>