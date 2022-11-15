<section class="recent">
    <header class="header-recent">
        <h1 class="title-header-recent">Recientes</h1>
        <?php
        require_once view('components/filters.php');
        ?>
    </header>

    <?php
    require_once view('components/table.php');
        ?>
</section>
<section class="totals">
    <section class="summary">
        <div class="item-data-summary">
            <img src="<?php
                echo icon('policies_data/data_left/icon-black_clients.svg') ?>" alt="Clientes">
            <span class="title">Total de clientes</span>
            <span id="total-clients"></span>
        </div>
        <div class="item-data-summary">
            <img src="<?php
                echo icon('policies_data/data_left/icon-black_quotes.svg') ?>"
                 alt="Cotizaciones">
            <span class="title">Total de cotizaciones</span>
            <span id="total-quotes"></span>
        </div>
        <div class="item-data-summary">
            <img src="<?php
                echo icon('policies_data/data_left/icon-black_policies.svg') ?>" alt="Pólizas">
            <span class="title">Total de pólizas</span>
            <span id="total-policies"></span>
        </div>
    </section>
    <div class="vertical-separator"></div>
    <section class="policies">
        <header class="header-policies">
            <h1 class="title-header-policies">Pólizas</h1>
        </header>
        <div class="item-data-policies">
            <span class="title-item-data-right">Próximas a vencer</span>
            <img src="<?php
                echo icon('sidebar/time.svg'); ?>" alt="">
            <span id="soon-to-beat" class="total-right"></span>
        </div>
        <div class="item-data-policies">
            <span class="title-item-data-right">Vigentes</span>
            <img src="<?php
                echo icon('policies_data/data_right/check.svg'); ?>" alt="">
            <span id="active" class="total-right"></span>
        </div>
        <div class="item-data-policies">
            <span class="title-item-data-right">Vencidas</span>
            <img src="<?php
                echo icon('policies_data/data_right/x.svg'); ?>" alt="">
            <span id="expired" class="total-right"></span>
        </div>
    </section>
</section>
<section class="statistics">
    <section class="insurance">
        <header class="header-insurance">
            <h3 class="title-header-insurance">Seguros más vendidos</h3>
            <div class="icons-insurance">
                <div class="icon-insurance"><img src="<?php
                        echo icon('insurances/autos.svg') ?>" alt=""></div>
                <div class="icon-insurance"><img src="<?php
                        echo icon('insurances/autos.svg') ?>" alt=""></div>
                <div class="icon-insurance"><img src="<?php
                        echo icon('insurances/autos.svg') ?>" alt=""></div>
            </div>
        </header>
    </section>
    <section class="insurers">
        <div class="insurer-graphic">
            <div class="icon-insurer">
                <img src="" alt="">
            </div>
        </div>
        <div class="insurer-graphic">
            <div class="icon-insurer">
                <img src="" alt="">
            </div>
        </div>
        <div class="insurer-graphic">
            <div class="icon-insurer">
                <img src="" alt="">
            </div>
        </div>
    </section>
</section>
