<nav id="sidebar" class="sidebar">
    <ul class="sidebar-group">
        <li class="container-logo container-icon-sidebar">
            <a href="dashboard">
                <img class="logo" src="<?php
                echo icon('sidebar/logo.svg') ?>" alt="Logo">
            </a>
        </li>
        <li class="container-icon-sidebar">
            <a class="icon-sidebar" id="dashboard" href="dashboard">
                <img class="icon" src="<?php
                echo icon('sidebar/home.svg') ?>" alt="">Inicio
            </a>
            <span id="dashboard-title" class="title">Inicio</span>
        </li>
        <li class="container-icon-sidebar">
            <a class="icon-sidebar" id="clients" href="clientes">
                <img class="icon" src="<?php
                echo icon('sidebar/clients.svg') ?>" alt="">Clientes
            </a>
            <span id="clients-title" class="title">Clientes</span>
        </li>
        <li class="container-icon-sidebar">
            <a class="icon-sidebar" id="quotes" href="cotizaciones">
                <img class="icon" src="<?php
                echo icon('sidebar/quotes.svg') ?>" alt="">Cotizaciones
            </a>
            <span id="quotes-title" class="title">Cotizaciones</span>
        </li>
        <li class="container-icon-sidebar">
            <a class="icon-sidebar" id="policies" href="polizas">
                <img class="icon" src="<?php
                echo icon('sidebar/policies.svg') ?>" alt="">Pólizas
            </a>
            <span id="policies-title" class="title">Pólizas</span>
        </li>
        <li class="container-icon-sidebar">
            <a class="icon-sidebar" id="claims" href="siniestros">
                <img class="icon" src="<?php
                echo icon('sidebar/sinister.svg') ?>" alt="">Siniestros
            </a>
            <span id="claims-title" class="title">Siniestros</span>
        </li>
        <li class="container-icon-sidebar">
            <a class="icon-sidebar" id="templates" href="plantillas">
                <img class="icon" src="<?php
                echo icon('sidebar/plantilla.svg') ?>" alt="">Plantillas
            </a>
            <span id="templates-title" class="title">Plantillas</span>
        </li>
    </ul>
    <ul class="sidebar-group">
        <li class="container-icon-sidebar">
            <button id="button-settings" class="icon-sidebar icon-sidebar-button" data-toggle="modal"
                    data-target="settings-modal">
                <img id="icon-settings" class="icon" src="<?php
                echo icon('sidebar/settings.svg') ?>" alt="">Configuración
            </button>
            <div id="settings-modal" class="modal settings-modal" aria-labelledby="title-settings-modal">
                <h1 class="title-settings-modal">Configuración</h1>
                <a class="link-modal" href="productos">
                    <div class="container-modal-icon">
                        <img src="<?php
                        echo icon('sidebar/settings.svg') ?>" alt="">
                    </div>
                    Administrar productos
                </a>
                <a class="link-modal" href="usuarios">
                    <div class="container-modal-icon">
                        <img src="<?php
                        echo icon('sidebar/settings.svg') ?>" alt="">
                    </div>
                    Administrar accesos
                </a>
                <a class="link-modal">
                    <div class="container-modal-icon">
                        <img src="<?php
                        echo icon('sidebar/time.svg') ?>" alt="">
                    </div>
                    Tiempos
                </a>
                <a class="link-modal">
                    <div class="container-modal-icon">
                        <img src="<?php
                        echo icon('sidebar/manual_usuario.svg') ?>" alt="">
                    </div>
                    Manual de usuario
                </a>
            </div>
            <span class="title">Configuración</span>
        </li>
        <li class="container-icon-sidebar">
            <a class="icon-sidebar">
                <img class="icon" src="<?php
                echo icon('sidebar/log-out.svg') ?>" alt="">Cerrar sesión
            </a>
            <span class="title">Cerrar sesión</span>
        </li>
    </ul>
</nav>