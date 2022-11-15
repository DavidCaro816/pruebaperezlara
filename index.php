<?php

use Core\FrontController;

require_once 'vendor/autoload.php';
require_once 'Helpers/routes.php';

(new FrontController($_GET['action'] ?? 'login')) -> run();
