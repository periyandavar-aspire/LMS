<?php
/**
 * Mailer Doc Comment
 * php version 7.3.5
 *
 * @category View
 * @package  View
 * @author   Periyandavar <periyandavar@gmail.com>
 * @license  http://license.com license
 * @link     http://url.com
 */
defined('VALID_REQ') or exit('Invalid request');
/**
 * Mailer class to send mail
 *
 * @category   Mailer
 * @package    Mailer
 * @subpackage Library
 * @author     Periyandavar <periyandavar@gmail.com>
 * @license    http://license.com license
 * @link       http://url.com
 */
class Mailer
{
    /**
     * This function will sends the mail
     *
     * @param string     $from    From address
     * @param string     $to      To address
     * @param string     $subject Subject
     * @param string     $layout  Layout
     * @param array|null $data    Data to be inclued to layout
     *
     * @return bool
     */
    public function send(
        string $from,
        string $to,
        string $subject,
        string $layout,
        array $data = null
    ) {
        global $config;
        $path = $config['view'] . '' . $layout . ".php";
        if (file_exists($path)) {
            if ($data != null) {
                foreach ($data as $key => $value) {
                    $$key = $value;
                }
            }
            ob_start();
            include_once $path;
            $message = ob_get_clean();
            $headers = "From: " . $from . "\r\n";
            $headers .= "Reply-To: " . $from . "\r\n";
            $headers .= "CC: susan@example.com\r\n";
            $headers .= "MIME-Version: 1.0\r\n";
            $headers .= "Content-Type: text/html; charset=UTF-8\r\n";
            return (mail($to, $subject, $message, $headers));
        } else {
            return false;
        }
    }
}
