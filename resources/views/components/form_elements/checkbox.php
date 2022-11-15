<?php

/**
 * Función para componente input tipo checkbox
 * @param string $checkbox
 * @param string|null $id_
 * @return void
 */
function checkbox(string $checkbox, string|null $id_ = null): void
{
    $id = $id_ ?? $checkbox;
    echo "<input id='$id' class='checkbox' type='checkbox'>
            <label class='label-checkbox' for='$id'>$checkbox</label>";
}
