<?php
/**
 * ReportController File Doc Comment
 * php version 7.3.5
 *
 * @category Controller
 * @package  Controller
 * @author   Periyandavar <periyandavar@gmail.com>
 * @license  http://license.com license
 * @link     http://url.com
 */
defined('VALID_REQ') or exit('Invalid request');

/**
 * ReportController Class Handles the requests related to the Books
 *
 * @category   Controller
 * @package    Controller
 * @subpackage ReportController
 * @author     Periyandavar <periyandavar@gmail.com>
 * @license    http://license.com license
 * @link       http://url.com
 */
class ReportController extends BaseController
{
    /**
     * Instantiate a new ReportController instance.
     */
    public function __construct()
    {
        parent::__construct(new ReportModel());
    }

    /**
     * Displays analytics page
     *
     * @return void
     */
    public function get()
    {
        $user = $this->input->session('type');
        $this->loadLayout($user . "Header.html");
        $this->loadView('reports');
        $this->loadLayout($user . "Footer.html");
    }

    /**
     * Undocumented function
     *
     * @return void
     */
    public function exportToCsv()
    {
        $user = $this->input->session('type');
        $sDate = $this->input->get('sDate') ?? "0000-00-00";
        $eDate = $this->input->get('eDate') ?? Date('Y-m-d');
        $list = $this->input->get('list');
        $funcName = "getTop" . $list . "List";
        $tcount = $tfcount = null;
        $data = $this->model->$funcName(
            $sDate,
            $eDate,
            0,
            10,
            'rank',
            'DESC',
            '',
            $tcount,
            $tfcount
        );
        $csv = new Export('csv');
        $csv->generate($data, ["id", 'rank']);
        $csv->send();
        // unset($->new_property);

        // $this->load->helper('chartHelper');
        // $this->loadLayout($user . "Header.html");
        // $this->includeScript('chart.js');
        // $this->loadView('analytics', $data);
        // $this->loadLayout($user . "Footer.html");
        // print_r($data);   
    }

    /**
     * Undocumented function
     *
     * @return void
     */
    public function exportToPdf()
    {
        $user = $this->input->session('type');
        $sDate = $this->input->get('sDate') ?? "0000-00-00";
        $eDate = $this->input->get('eDate') ?? Date('Y-m-d');
        $list = $this->input->get('list');
        $funcName = "getTop" . $list . "List";
        $tcount = $tfcount = null;
        $data = $this->model->$funcName(
            $sDate,
            $eDate,
            0,
            10,
            'rank',
            'DESC',
            '',
            $tcount,
            $tfcount
        );
        $csv = new Export('pdf');
        $csv->generate($data, ["id", 'rank']);
        $csv->send();
        // unset($->new_property);

        // $this->load->helper('chartHelper');
        // $this->loadLayout($user . "Header.html");
        // $this->includeScript('chart.js');
        // $this->loadView('analytics', $data);
        // $this->loadLayout($user . "Footer.html");
        // print_r($data);   
    }

    /**
     * Displays reports page
     *
     * @param string $list  List Name
     * @param string $sDate Start Date
     * @param string $eDate End Date
     *
     * @return void
     */
    public function analytics(
        string $list = 'book',
        ?string $sDate = null,
        ?string $eDate = null
    ) {
        $user = $this->input->session('type');
        $data['sDate'] = $sDate ?? "0000-00-00";
        $data['eDate'] = $eDate ?? Date('Y-m-d');
        $data['list'] = $list;
        $funcName = "getTop" . $list . "List";
        $tcount = $tfcount = null;
        $data['data'] = $this->model->$funcName(
            $data['sDate'],
            $data['eDate'],
            0,
            10,
            'rank',
            'DESC',
            '',
            $tcount,
            $tfcount
        );
        $this->load->helper('chartHelper');
        $this->loadLayout($user . "Header.html");
        $this->includeScript('chart.js');
        $this->loadView('analytics', $data);
        $this->loadLayout($user . "Footer.html");

        // $user = $this->input->session('type');
        // $data['sDate'] = $this->input->get('sDate') ?? "0000-00-00";
        // $data['eDate'] = $this->input->get('eDate') ?? Date('Y-m-d');
        // $data['list'] = $this->input->get('list');
        // $funcName = "getTop" . $data['list'] . "List";
        // $tcount = $tfcount = null;
        // $data['data'] = $this->model->$funcName(
        //     $data['sDate'],
        //     $data['eDate'],
        //     0,
        //     10,
        //     'rank',
        //     'DESC',
        //     '',
        //     $tcount,
        //     $tfcount
        // );
        // $this->load->helper('chartHelper');
        // $this->loadLayout($user . "Header.html");
        // $this->includeScript('chart.js');
        // $this->loadView('analytics', $data);
        // $this->loadLayout($user . "Footer.html"); 
    }

    /**
     * Displays Top books list
     *
     * @param string $list  List Name
     * @param string $sDate Start Date
     * @param string $eDate End Date
     *
     * @return void
     */
    public function topList($list, $sDate, $eDate)
    {
        $start = $this->input->get("iDisplayStart");
        $limit = $this->input->get("iDisplayLength");
        $sortby = $this->input->get("iSortCol_0");
        $sortDir = $this->input->get("sSortDir_0");
        $searchKey = $this->input->get("sSearch");
        $tcount = $tfcount = '';
        if ($sortby == 0) {
            $sortby = 'rank';
            $sortDir = 'desc';
        }
        $funcName = "getTop" . $list . "List";
        $data['aaData'] = $this->model->$funcName(
            $sDate,
            $eDate,
            $start,
            $limit,
            $sortby,
            $sortDir,
            $searchKey,
            $tcount,
            $tfcount
        );
        $data["iTotalRecords"] = $tcount;
        $data["iTotalDisplayRecords"] = $tfcount;
        echo json_encode($data);
    }
}
