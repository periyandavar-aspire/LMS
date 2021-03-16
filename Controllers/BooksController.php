<?php
class BooksController extends Controller
{
    public function __construct($model = null)
    {
        parent::__construct($model);
    }
    public function index()
    {
        // $this->loadLayout("adminHeader.html");
        $this->loadView('books');
        // $this->loadLayout("adminFooter.html");
    }
    public function add()
    {
        $this->loadLayout("adminHeader.html");
        $this->loadView('addBooks');
        $this->loadLayout("adminFooter.html");
    }
    public function manage()
    {
        $this->loadLayout("adminHeader.html");
        $this->loadView('manageBooks');
        $this->loadLayout("adminFooter.html");
    }

    public function export()
    {
        header('Content-Type: text/csv; charset=utf-8');
        header('Content-Disposition: attachment; filename=output.csv');
        $output = fopen('php:outputoutput.csv', 'w');

        fputcsv($output, array('Column 1', 'Column 2', 'Column 3'));

        $list = array (
            array('aaa', 'bbb', 'ccc', 'dddd'),
            array('123', '456', '789'),
            array('"aaa"', '"bbb"')
        );
        
        
        foreach ($list as $fields) {
            fputcsv($output, $fields);
        }
        
        fclose($output);
    }

    public function bookstatus()
    {
        $lastUpdate = filemtime("log/unavailablebooks.log");
        header("Cache-Control: no-cache");
        header("Content-Type: text/event-stream");
        while (true) {
            // if ($lastUpdate != filemtime("log/unavailablebooks.log")) {
                echo "event: $lastUpdate";
                echo "\n\n";
                $data = base64_decode(file_get_contents("log/unavailablebooks.log"));
                echo 'data:'.$data."\n\n";
            // }
            flush();
            sleep(10);
            if(connection_aborted()){
                break;
            }
        }
    }
}