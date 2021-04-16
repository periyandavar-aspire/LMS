<?php
/**
 * Constants File Doc Comment
 * All the requests are handled by this file
 * php version 7.3.5
 *
 * @category IndexFile
 * @package  IndexFile
 * @author   Periyandavar <periyandavar@gmail.com>
 * @license  http://license.com license
 * @link     http://url.com
 */

define("VALID_REQ", true);

session_start();

require_once 'core/Constants.php';

require_once 'core/Route.php';

require_once 'config/config.php';
require_once 'config/routeConfig.php';
require_once 'config/dbConfig.php';

require_once 'core/autoload.php';
require_once 'core/utilities/Utility.php';


// set_error_handler(Route::"error");

try {
    Route::run();
} catch (Error $e) {
    Route::error($e);
}
