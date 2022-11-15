<header class="header-main">
    <div class="group-header-main">
        <h1 id="title"><?php
            if (isset($title)) {
                echo $title;
            } ?></h1>
        <section class="new-action">
            <button id="new-button" class="button2 primary-button button-is-red" type="button" data-toggle="modal2"
                    data-target="backdrop">
                <img src="<?php
                echo icon('buttons/new_button.svg'); ?>" alt="">Nuevo
            </button>
            <div id="backdrop" class="backdrop" role="dialog" data-target="modal-form">
                <span id="alert-error" class="alert-error"></span>
                <?php
                if (isset($modal)) {
                    require_once view('components/content/' . $modal);
                }
        ?>
            </div>
        </section>
        <?php
        require_once view('components/search.php'); ?>
    </div>
    <div class="group-header-main">
        <a id="pdf" href="#" role="button" class="button2 button-download">
            <div id="type-pdf" class="button2 quinary-button button-is-red">
                <img src="<?php
        echo icon('buttons/pdf.svg'); ?>" alt="">
                <span>PDF</span>
            </div>
            <div class="download">
                <svg class="css-i6dzq1" stroke-linejoin="round" stroke-linecap="round" fill="none" stroke-width="2"
                     stroke="#ffffff" height="24" width="24" viewBox="0 0 24 24">
                    <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"></path>
                    <polyline points="7 10 12 15 17 10"></polyline>
                    <line y2="3" x2="12" y1="15" x1="12"></line>
                </svg>
            </div>
        </a>
        <a id="excel" href="#" role="button" class="button2 button-download">
            <div id="type-excel" class="button2 quinary-button button-is-green">
                <img src="<?php
        echo icon('buttons/excel.svg'); ?>" alt="">
                <span>Excel</span>
            </div>
            <div class="download">
                <svg class="css-i6dzq1" stroke-linejoin="round" stroke-linecap="round" fill="none" stroke-width="2"
                     stroke="#ffffff" height="24" width="24" viewBox="0 0 24 24">
                    <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"></path>
                    <polyline points="7 10 12 15 17 10"></polyline>
                    <line y2="3" x2="12" y1="15" x1="12"></line>
                </svg>
            </div>
        </a>
    </div>
</header>