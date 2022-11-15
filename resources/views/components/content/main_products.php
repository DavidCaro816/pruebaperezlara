<header class="group-header-main">
    <h1 id="title">Productos</h1>
    <div class="new-action">
        <button id="new-button" class="button2 primary-button button-is-red" type="button" data-toggle="modal"
                data-target="product-select">
            <img src="<?php
            echo icon('buttons/new_button.svg'); ?>" alt="">Nuevo
        </button>
        <div id="product-select" class="data-option modal product-select" aria-label="Nuevo producto">
            <ul class="content scrollbar">
                <li role="option" class="option" data-toggle="modal2" data-target="backdrop">Aseguradora</li>
                <li role="option" class="option" data-toggle="modal2">Seguro</li>
            </ul>
        </div>
    </div>
    <div id="backdrop" class="backdrop" role="dialog">
        <?php
        require_once view('components/form_elements/input.php');
            require_once view('components/form_elements/dropdown/select.php');
            ?>
        <form id="modal-form" class="container-form form" aria-labelledby="title-form">
            <div class="header-modal">
                <h1 id="title-form" class="title-form">Nueva aseguradora</h1>
                <img class="close-modal" data-dismiss="modal2" aria-label="Cerrar"
                     src="<?php
                         echo icon('buttons/closeDark.svg'); ?>" alt="">
            </div>
            <div class="body-modal-f">
                <?php
                    input('Nombre de la aseguradora');
            select('Seguros');
            input_file();
            ?>
            </div>
            <button id="send-form" type="submit" class="primary-button button-is-red button-is-block">Registrar
                aseguradora
            </button>
        </form>
    </div>
</header>
<div class="product-content">
    <section class="section section-insurers">
        <header>
            <h2>Aseguradoras</h2>
        </header>
        <div id="insurers-cards-container" class="container-cards"></div>
    </section>
    <section class="section">
        <header>
            <h2>Seguros</h2>
        </header>
        <div id="insurances-cards-container" class="container-cards"></div>
    </section>
</div>