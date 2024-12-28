<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\IOFactory;

class Excel
{
    protected $spreadsheet;

    public function __construct()
    {
        $this->spreadsheet = new Spreadsheet();
    }

    public function getSpreadsheet()
    {
        return $this->spreadsheet;
    }

    public function save($filename, $format = 'Xlsx')
    {
        $writer = IOFactory::createWriter($this->spreadsheet, $format);
        $writer->save($filename);
    }

    public function output($filename, $format = 'Xlsx')
    {
        $writer = IOFactory::createWriter($this->spreadsheet, $format);

        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment; filename="' . $filename . '"');
        header('Cache-Control: max-age=0');

        $writer->save('php://output');
        exit;
    }

    public function __call($method, $arguments)
    {
        if (method_exists($this->spreadsheet, $method)) {
            return call_user_func_array([$this->spreadsheet, $method], $arguments);
        }

        throw new Exception("Method {$method} does not exist in " . get_class($this));
    }
}
