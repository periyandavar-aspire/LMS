<?php
class BooksController extends Controller
{
    public function __construct($model = null)
    {
        parent::__construct($model);
    }
    public function index()
    {
        $this->loadLayout("adminHeader.html");
        $this->loadView('addBooks');
        $this->loadLayout("adminFooter.html");
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