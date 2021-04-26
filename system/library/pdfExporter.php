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
class PdfExporter
{
    /**
     * Pdf file pointer
     *
     * @var string|null
     */
    private $_pdf = null;

    /**
     * Instantiate new PdfExporter instance
     */
    public function __construct()
    {
        $this->_pdf = new PDF();
        $this->_pdf->AliasNbPages();
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
        $this->_pdf->AddPage();
        $data = json_decode(json_encode($data), true);
        $this->_pdf->SetFont('Arial', 'B', 7);
        $cell_width = 30;
        $cell_height= 10;
        $current_y = $this->_pdf->GetY();
        $start_x = $current_x = $this->_pdf->GetX();
        $this->_pdf->SetXY($current_x, $current_y);
        $this->_pdf->multicell(10, $cell_height, "Sl. No", 1);
        $current_x += 10;
        $headings = array_keys($data[0]);
        // foreach ($ignoreList as $ignore) {
        //     unset($headings[array_search($ignore, $headings)]);
        // }
        foreach ($headings as $heading) {
            if (in_array($heading, $ignoreList)) {
                continue;
            }
            $this->_pdf->SetXY($current_x, $current_y);
            $this->_pdf->multicell($cell_width, $cell_height, $heading, 1);
            $current_x += $cell_width;
        }
        $current_x = $start_x;
        $current_y += $cell_height;
        $i = 1;
        foreach ($data as $row) {
            $this->_pdf->Ln();
            $this->_pdf->SetXY($current_x, $current_y);
            $this->_pdf->multicell(10, $cell_height, $i++, 1);
            $current_x += 10;
            foreach ($row as $column) {
                if (in_array(array_search($column, $row), $ignoreList)) {
                    continue;
                }
                $str = $this->formatStr($column);
                $this->_pdf->SetXY($current_x, $current_y);
                $this->_pdf->multicell($cell_width, $cell_height, $column, 1);
                $current_x += $cell_width;
            }
            $current_x = $start_x;
            $current_y += $cell_height;
        }
    }

    /**
     * Formates the String
     *
     * @param string|null $str String
     *
     * @return void
     */
    public function formatStr(?string $str)
    {
        for ($i = 0; $i < strlen($str) % 17; $i++) {
            $str = substr_replace($str, "\n", 17+$i, 0);
        }
        return $str;
    }

    /**
     * Stores the pdf file on the server
     *
     * @param string $destination Destination with filename
     *
     * @return void
     */
    public function store(string $destination)
    {
        $this->_pdf->Output('F', $destination);
    }

    /**
     * Send pdf file to the client
     *
     * @return void
     */
    public function send()
    {
        $filename = uniqid();
        $this->_pdf->Output('d', $filename.".pdf");
    }
}
