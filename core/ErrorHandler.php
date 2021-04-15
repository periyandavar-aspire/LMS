<?php
/**
 * ErrorHandler File Doc Comment
 * php version 7.3.5
 *
 * @category ErrorHandler
 * @package  ErrorHandler
 * @author   Periyandavar <periyandavar@gmail.com>
 * @license  http://license.com license
 * @link     http://url.com
 */
/**
 * ErrorHandler interface
 * User defined Error controller should implement this interface
 *
 * @category ErrorHandler
 * @package  ErrorHandler
 * @author   Periyandavar <periyandavar@gmail.com>
 * @license  http://license.com license
 * @link     http://url.com
 */
interface ErrorHandler
{
    /**
     * This function will call when page not found error occurs
     *
     * @return void
     */
    public function pageNotFound();

    /**
     * This function will call when the method is not found
     *
     * @return void
     */
    public function invalidRequest();

    /**
     * This function will call when an error occurs
     *
     * @return void
     */
    public function serverError();
}
