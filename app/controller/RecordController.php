<?php
/**
 * RecordController File Doc Comment
 * php version 7.3.5
 *
 * @category Controller
 * @package  Controller
 * @author   Periyandavar <periyandavar@gmail.com>
 * @license  http://license.com license
 * @link     http://url.com
 */

namespace App\Controller;

defined('VALID_REQ') or exit('Invalid request');
use System\Core\BaseRestController;
use App\Model\RecordModel;

/**
 * RecordController Class Handles the requests by user
 *
 * @category   Controller
 * @package    Controller
 * @subpackage RecordController
 * @author     Periyandavar <periyandavar@gmail.com>
 * @license    http://license.com license
 * @link       http://url.com
 */
class RecordController extends BaseRestController
{
    /**
     * Instantiate the new HomeController Instance
     */
    public function __construct()
    {
        parent::__construct(new RecordModel());
    }

    /**
     * GET request
     *
     * @return void
     */
    public function get()
    {
        $id = func_get_args()[0] ?? null;
        $result = $this->model->get($id);
        echo json_encode(["result" => $result]);
    }

    /**
     * POST request
     *
     * @return void
     */
    public function create()
    {
        $fields = $this->input->post();
        $result = $this->model->insert($fields) ? 'success' : 'failed';
        echo json_encode(["result" => $result]);
    }

    /**
     * PUT request
     *
     * @return void
     */
    public function update()
    {
        $id = func_get_arg(0);
        $fields = $this->input->data();
        $result = $this->model->update($id, $fields) ? 'success' : 'failed';
        echo json_encode(["result" => $result]);
    }

    /**
     * Patch request
     *
     * @return void
     */
    public function patch()
    {
        $id = func_get_arg(0);
        $fields = $this->input->data();
        $result = $this->model->update($id, $fields) ? 'success' : 'failed';
        echo json_encode(["result" => $result]);
    }

    /**
     * Delete Request
     *
     * @return void
     */
    public function delete()
    {
        $id = func_get_arg(0);
        $result = $this->model->delete($id) ? 'success' : 'failed';
        echo json_encode(["result" => $result]);
    }
}
