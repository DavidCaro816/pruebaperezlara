<?php

function separate($value): string
{
    return strtolower(
        str_replace(
            array(' ', '-del', '-de', 'Á', 'á', 'É', 'é', 'Í', 'í', 'Ó', 'ó', 'Ú', 'ú'),
            array('-', '', '', 'a', 'a', 'e', 'e', 'i', 'i', 'o', 'o', 'u', 'u'),
            $value
        )
    );
}
