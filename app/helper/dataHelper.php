<?php
/**
 * Helper File
 * php version 7.3.5
 *
 * @category   Helper
 * @package    SYS
 * @subpackage Libraries
 * @author     Periyandavar <periyandavar@gmail.com>
 * @license    http://license.com license
 * @link       http://url.com
 */
if (!function_exists('generateTh')) {
    function generateTh(array $columns)
    {
        $th = '';
        foreach ($columns as $column) {
            $th .= "<th> $column </th>";
        }
        return $th;
    }
}

?>
