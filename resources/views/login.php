<?php

require_once view('components/form_elements/input.php');
require_once view('components/form_elements/dropdown/select.php');
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <link rel="icon" href="<?php
    echo icon('window/icono.svg'); ?>">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Roboto:wght@500&display=swap">
    <link rel="stylesheet" href="<?php
    echo css('login.css'); ?>">
    <title>Pérez Lara Cia Ltda - Asesores de Seguros en Bogotá</title>
</head>
<body>
<div class="container">
    <main>
        <section class="forms">
            <section id="register" class="register">
                <form id="register-form" class="register-form">
                    <div class="inputs-register">
                        <?php
                        input('Nombres');
input('Apellidos');
select('Tipo de documento', $types_documents);
input('Número de documento');
input('Correo electrónico', 'email');
input('Telefono', 'tel');
input(
    'Contraseña',
    'password',
    'password',
    'group-password',
    'autocomplete="on" spellcheck="false"'
);
input('Repetir contraseña', 'password', 'repeat-password', 'group-password', 'autocomplete="on" spellcheck="false"');
?>
                    </div>
                    <div class="button-container container-button-register">
                        <button type="submit" class="button quaternary-button">Crear cuenta</button>
                    </div>
                </form>
            </section>
            <section id="login" class="login">
                <div id="container-login" class="container-login">
                    <div class="profile">
                        <img class="icon-profile" src="<?php
echo icon('buttons/profile.svg') ?>" alt="">
                    </div>
                    <form id="login-form" class="login-form">
                        <div class="login-form-body">
                            <div class="inputs-login">
                                <?php
        input('Usuario', 'email');
input('Contraseña', 'password', 'clave', null, 'autocomplete="on" spellcheck="false"');
?>
                                <span id="alert-login" role="alert" class="alert"></span>
                            </div>
                            <div id="options" class="options">
                                <?php
checkbox('Recodarme', 'remember-me'); ?>
                                <a class="forgot-password" href="">¿Olvidaste tu contraseña</a>
                            </div>
                        </div>
                        <div class="button-container container-button-login">
                            <button type="submit" class="button quaternary-button">Iniciar sesión</button>
                        </div>
                    </form>
                </div>
            </section>
        </section>
        <section id="cover" class="cover">
            <img src="<?php
            echo icon('login/logo.svg') ?>" alt="">
            <button id="message" class="button button2 tertiary-button message">¿No tienes una cuenta?</button>
            <button type="button" id="button-open-forms" class="button tertiary-button button-open-forms">Registrate
            </button>
        </section>
    </main>
</div>
<script src="<?php
echo js('forms_login.js'); ?>"></script>
<script src="<?php
echo js('modal.js'); ?>"></script>
<script src="<?php
echo js('input.js'); ?>"></script>
<script src="<?php
echo js('actions/helper/UserClient.js'); ?>"></script>
<script src="<?php
echo js('actions/login.js'); ?>"></script>
</body>
</html>