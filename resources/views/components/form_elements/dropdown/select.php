<?php

require_once helper('transform.php');
require_once view('components/form_elements/checkbox.php');

function select(string $select, array|object|null $data = null): void
{
    $id = separate($select);
    $fecha = str_contains($select, 'Fecha');
    $src = icon('buttons/' . ($fecha ? 'calendar.svg' : 'icon_select.svg'));
    echo "<div class='group-input'>
                <div class='input select' data-toggle='modal' data-target='$id-select' ";
    if ($fecha) {
        echo 'data-multiple="true"';
    }
    echo "tabindex='0'>
                    <span id='label-$id-select' class='label'>$select</span>
                    <span id='selected-$id-select' class='label' data-selected='0'></span>
                    <img src='$src' alt=''>
                </div>
                <div id='$id-select' class='data-option modal' aria-labelledby='label-$id-select'>
                 <ul id='$id-select-content' role='listbox' class='content scrollbar'>";
    if ($data !== null) {
        foreach ($data as $datum) {
            echo "<li role='option' class='option' data-id='$datum[0]'>$datum[1]</li>";
        }
    } elseif ($fecha) {
        require_once view('components/form_elements/dropdown/calendar.php');
        calendar($id);
    }

    echo '</ul>
                </div>
                <span role="alert" class="alert"></span>
            </div>';
}
