<?php
/**
 * HomeView File Doc Comment
 * php version 7.3.5
 *
 * @category View
 * @package  View
 * @author   Periyandavar <periyandavar@gmail.com>
 * @license  http://license.com license
 * @link     http://url.com
 */
defined('VALID_REQ') OR exit('Not a valid Request');
/**
 * HomeView Class Base class for all View Classes
 *
 * @category   View
 * @package    View
 * @subpackage HomeView
 * @author     Periyandavar <periyandavar@gmail.com>
 * @license    http://license.com license
 * @link       http://url.com
 */
class HomeView extends BaseView
{
    /**
     * Loads the index page
     *
     * @param array $data values
     * 
     * @return void
     */
    public function loadIndexPage(array $data)
    {
        $this->setFile('index.php');
        $this->appendData($data);
        $this->output();
    }
}