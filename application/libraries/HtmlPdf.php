<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
* Library TCPDF untuk CodeIgniter
* Pengganti htmlpdf/html2pdf
* @author Yuukio Fuyu
* @since 2024
*/

class HtmlPdf extends TCPDF
{
    // Properti default
    var $orientation = 'P';
    var $format = 'A4';
    var $marges = array(8, 8, 8, 8);

    public function __construct($config = array())
    {
        // Inisialisasi properti dari konfigurasi
        $this->initialize($config);

        // Memanggil konstruktor TCPDF
        parent::__construct($this->orientation, PDF_UNIT, $this->format, true, 'UTF-8', false);

        // Atur margin default
        $this->SetMargins($this->marges[0], $this->marges[1], $this->marges[2]);
        $this->SetAutoPageBreak(TRUE, $this->marges[3]);
    }

    public function initialize($config = array())
    {
        foreach ($config as $key => $value) {
            if (isset($this->$key)) {
                $this->$key = $value;
            }
        }
    }

    /**
    * Fungsi untuk memuat tampilan HTML dan mengembalikannya dalam format string
    * @param file string
    * @param data array
    * @return string
    */
    public function loadHtmlPdf($file = NULL, $data = array())
    {
        $CI =& get_instance();
        $file = $CI->load->view($file, $data, TRUE);
        return $file;
    }

    /**
    * Fungsi untuk menambahkan halaman PDF dengan konten HTML
    * @param html string
    */
    public function addHtmlPage($html)
    {
        // Tambahkan halaman baru
        $this->AddPage();

        // Tulis konten HTML ke PDF
        $this->writeHTML($html, true, false, true, false, '');
    }
}

/* End of file HtmlPdf.php */
/* Location: ./application/libraries/HtmlPdf.php */