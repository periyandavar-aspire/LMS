<?php
define("VALID_REQ", true);
session_start();
require_once 'core/Route.php';

require_once 'config/config.php';
require_once 'config/routeConfig.php';
require_once 'config/dbConfig.php';

require_once 'core/autoload.php';
require_once 'core/utilities/Utility.php';

try {
    Route::run();
} catch (Error $e) {
    Route::error($e);
}
