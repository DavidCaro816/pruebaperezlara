<?php

namespace Enum;

enum Routes: string
{
    public const BASE = 'resources/';
    public const ICON = Routes::BASE . 'icons/';
    public const VIEW = Routes::BASE . 'views/';
    public const CSS = Routes::BASE . 'css/';
    public const JS = Routes::BASE . 'js/';
    public const ERROR = Routes::VIEW . 'error/';
    public const HELPER = 'Helpers/';
}
