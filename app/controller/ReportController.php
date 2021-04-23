<?php
/**
 * BookController File Doc Comment
 * php version 7.3.5
 *
 * @category Controller
 * @package  Controller
 * @author   Periyandavar <periyandavar@gmail.com>
 * @license  http://license.com license
 * @link     http://url.com
 */
/**
 * BookController Class Handles the requests related to the Books
 *
 * @category   Controller
 * @package    Controller
 * @subpackage BookController
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
    public function getAnalytics()
    {
        $user = $this->input->session('type');
        $this->loadLayout($user . "Header.html");
        $this->loadTemplate('analytics');
        $this->loadLayout($user . "Footer.html");
    }

    /**
     * Displays reports page
     *
     * @return void
     */
    public function getReports(string $list = 'book', ?string $sDate = null, ?string $eDate = null)
    {
        $user = $this->input->session('type');
        $data['sDate'] = $sDate ?? "0000-00-00";
        $data['eDate'] = $eDate ?? Date('Y-m-d');
        $data['list'] = $list;
        $this->loadLayout($user . "Header.html");
        $this->loadTemplate('reports', $data);
        $this->loadLayout($user . "Footer.html");
    }

    /**
     * Displays Top books list
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