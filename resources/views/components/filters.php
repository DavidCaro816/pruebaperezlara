<div class="filter-group-container">
    <?php
    require_once 'resources/views/components/form_elements/dropdown/filter.php';
    if (isset($filters)) {
        foreach ($filters as $filter) {
            filter($filter[0], $filter[1] ?? null);
        }
    }
    if (!isset($buttons_filters)) {
        echo '<div class="filter-button-container">
                <button id="button-filter" class="secondary-button button-is-red" type="button">Filtrar</button>
                <button id="button-clean" class="secondary-button button-is-black" type="button">Limpiar</button>
              </div>';
    }
    ?>

</div>