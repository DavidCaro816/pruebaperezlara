<?php

require_once helper('transform.php');
require_once view('components/form_elements/checkbox.php');

function filter(string $filter, array|object|null $data): void
{
    $id = separate($filter);
    $fecha = $filter === 'Fecha';
    $src = icon('buttons/' . ($fecha ? 'calendar.svg' : 'icon_select.svg'));
    echo "<div class='group-input'>
            <div class='filter' data-toggle='modal' data-target='$id-filter' tabindex='0'>
                <span id=label-'$id-filter'>$filter</span>
                <img src='$src' alt=''>
            </div>
            <div id='$id-filter' class='data-option modal' aria-labelledby='label-$id-filter'>
                <ul id='$id-filter-content' role='listbox' class='content scrollbar'>";
    if ($fecha) {
        require_once view('components/form_elements/dropdown/calendar.php');
        calendar($id . '-from');
        calendar($id . '-up');
    } elseif ($data !== null) {
        foreach ($data as $datum) {
            echo '<li role="option">';
            checkbox($datum[1], $id . '-filter' . $datum[0]);
            echo '</li>';
        }
    }
    echo '</ul>    
            </div>
          </div>';
}
