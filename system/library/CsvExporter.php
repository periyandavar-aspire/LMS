<?php
/**
 * Fields File Doc Comment
 * php version 7.3.5
 *
 * @category Fields
 * @package  Fields
 * @author   Periyandavar <periyandavar@gmail.com>
 * @license  http://license.com license
 * @link     http://url.com
 */
/**
 * Fields Class used to store the input fields
 * User defined Error controller should implement this interface
 *
 * @category Fields
 * @package  Fields
 * @author   Periyandavar <periyandavar@gmail.com>
 * @license  http://license.com license
 * @link     http://url.com
 */
class CsvExporter
{
    /**
     * Filename
     *
     * @var string|null
     */
    private $_filename = null;

    /**
     * Deletes the csv file
     */
    public function __destruct()
    {
        if ($this->_filename != null) {
            unlink($this->_filename);
        }
    }

    /**
     * Generates Excel
     *
     * @param array      $data       Data
     * @param null|array $ignoreList Ignore values
     *
     * @return void
     */
    public function generate(array $data, ?array $ignoreList)
    {
        $this->_filename = uniqid() . ".csv";
        $data = json_decode(json_encode($data), true);
        $fp = fopen($this->_filename, "w");
        $headings = array_keys($data[0]);
        foreach ($ignoreList as $ignore) {
            unset($headings[array_search($ignore, $headings)]);
        }
        fputcsv($fp, $headings);
        foreach ($data as $row) {
            foreach ($ignoreList as $ignore) {
                unset($row[$ignore]);
            }
            fputcsv($fp, $row);
        }
        fclose($fp);
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
        rename($this->_filename, $destination);
    }

    /**
     * Send csv file to the client
     *
     * @return void
     */
    public function send()
    {
        header("Content-Disposition: attachment; filename=\"$this->_filename\"");
        header("Content-Type: application/vnd.ms-excel");
        readfile($this->_filename);
    }
}
