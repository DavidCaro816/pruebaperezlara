<header class="header">
    <div class="group">
        <div id="menu" class="menu">
            <img src="<?php
            echo icon('buttons/menu.svg'); ?>" alt="Menú">
        </div>
        <?php
        if (isset($group)) {
            require_once view('components/' . $group);
        }
            ?>

    </div>
    <div class="group">
        <section class="notifications">
            <button id="container-icon-notifications" class="container-icon" data-toggle="modal"
                    data-target="notifications-modal">
                <img src="<?php
                    echo icon('buttons/campana.svg'); ?>" alt="Notificaciones">
            </button>
            <div id="notifications-modal" class="modal notifications-modal"
                 aria-labelledby="title-notifications-modal">
                <h1 class="title-notifications-modal">Notificaciones</h1>
                <div class="container-message scrollbar">
                    <a class="link-modal message-notification">
                        <div class="message">
                            <span class="person-being-reported">Pedro Sanchez</span>
                            <span class="message-content">Póliza próxima a vencer (20 días)</span>
                        </div>
                        <div class="indicator"></div>
                    </a>
                </div>
            </div>
        </section>
        <section class="profile">
            <button class="container-icon" data-toggle="modal" data-target="profile-modal">
                <img class="icon-profile" src="<?php
                    echo icon('buttons/profile.svg'); ?>" alt="Perfil">
            </button>
            <div id="profile-modal" class="modal profile-modal" aria-label="Perfil">
                <a href="perfil" class="link-modal">
                    <img class="container-icon profile1" src="<?php
                        echo icon('buttons/profile.svg'); ?>" alt="Perfil">
                    <div class="info">
                        <span class="username">Daniela Perez</span>
                        <span>Ver tu perfil</span>
                    </div>
                </a>
                <hr class="hr">
                <a class="link-modal">
                    <div class="container-modal-icon">
                        <img src="<?php
                            echo icon('sidebar/settings.svg'); ?>" alt="">
                    </div>
                    Configuración
                </a>
                <a class="link-modal">
                    <div class="container-modal-icon">
                        <img src="<?php
                            echo icon('sidebar/log-out.svg'); ?>" alt="">
                    </div>
                    Cerrar sesión
                </a>
            </div>
        </section>
    </div>
</header>