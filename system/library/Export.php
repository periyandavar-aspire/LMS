<?php
/**
 * Exporter File Doc Comment
 * php version 7.3.5
 *
 * @category Exporter
 * @package  Exporter
 * @author   Periyandavar <periyandavar@gmail.com>
 * @license  http://license.com license
 * @link     http://url.com
 */
/**
 * Exporter Class used to store the input Exporter
 * User defined Error controller should implement this interface
 *
 * @category Exporter
 * @package  Exporter
 * @author   Periyandavar <periyandavar@gmail.com>
 * @license  http://license.com license
 * @link     http://url.com
 */
class Export
{
    private $_exporter;

    /**
     * Instantiate new Export instance
     *
     * @param string $type Export type
     */
    public function __construct(string $type)
    {
        switch ($type) {
            case 'csv':
                $this->_exporter = new CsvExporter();
                break;
            case 'pdf':
                $this->_exporter = new PdfExporter();
                break;
            default:
                throw new Exception("Invalid Export type caught");
        }
    }

    /**
     * Generates Excel
     *
     * @param array      $data   Data
     * @param null|array $ignore Ignore values
     *
     * @return void
     */
    public function generate(array $data, ?array $ignore)
    {
        $this->_exporter->generate($data, $ignore);
    }

    /**
     * Send csv file to the client
     *
     * @return void
     */
    public function send()
    {
        $this->_exporter->send();
    }

    /**
     * Stores the excel file on the server
     *
     * @param string $destination Destination with filename
     *
     * @return void
     */
    public function store(string $destination)
    {
        $this->_exporter->store($destination);
    }
}
