<?php
defined('BASEPATH') OR exit('No direct script access allowed');

use PhpOffice\PhpSpreadsheet\Style\Fill;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Style\Color;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Cell\Coordinate;
use PhpOffice\PhpSpreadsheet\Worksheet\Drawing;

#[AllowDynamicProperties]
class MY_Model extends CI_Model {

    private $primary_key = 'id';
    private $table_name = 'table';
    private $field_search;

    public function __construct($config = array())
    {
        parent::__construct();

        foreach ($config as $key => $val)
        {
            if(isset($this->$key))
                $this->$key = $val;
        }

        $this->load->database();
    }

    public function remove($id = NULL)
    {
        $this->db->where($this->primary_key, $id);
        return $this->db->delete($this->table_name);
    }

    public function change($id = NULL, $data = array())
    {        
        $this->db->where($this->primary_key, $id);
        $this->db->update($this->table_name, $data);

        return $this->db->affected_rows();
    }

    public function find($id = NULL, $select_field = [])
    {
        if (is_array($select_field) AND count($select_field)) {
            $this->db->select($select_field);
        }

        $this->db->where($this->primary_key, $id);
        $query = $this->db->get($this->table_name);

        if($query->num_rows()>0)
        {
            return $query->row();
        }
        else
        {
            return FALSE;
        }
    }

    public function find_all()
    {
        $this->db->order_by($this->primary_key, 'DESC');
        $query = $this->db->get($this->table_name);

        return $query->result();
    }

    public function store($data = array())
    {
        $this->db->insert($this->table_name, $data);
        return $this->db->insert_id();
    }

    public function get_all_data($table = '')
    {
        $query = $this->db->get($table);

        return $query->result();
    }


    public function get_single($where)
    {
        $query = $this->db->get_where($this->table_name, $where);

        return $query->row();
    }

    public function scurity($input)
    {
        if (is_null($input)) {
            return '';
        }

        return mysqli_real_escape_string($this->db->conn_id, $input);
    }

    public function export($table, $subject = 'file')
    {
        // Load PhpSpreadsheet library
        $this->load->library('excel'); // Pastikan ini merujuk ke PhpSpreadsheet

        // Create a new spreadsheet
        $spreadsheet = new \PhpOffice\PhpSpreadsheet\Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        // Ambil data dari database
        $result = $this->db->get($table);
        $fields = $result->list_fields();

        $alphabet = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $alphabet_arr = str_split($alphabet);
        $column = [];

        foreach ($alphabet_arr as $alpha) {
            $column[] = $alpha;
        }

        // Set column width berdasarkan header
        foreach ($column as $colIndex => $col) {
            if ($colIndex < count($fields)) {
                // Hitung panjang teks di header
                $headerLength = strlen(ucwords(str_replace('_', ' ', $fields[$colIndex])));
                $maxLength = 0;
                
                // Hitung panjang teks pada data di setiap kolom
                foreach ($result->result() as $data) {
                    if (isset($data->{$fields[$colIndex]})) {
                        $cellValue = (string)$data->{$fields[$colIndex]};
                        $maxLength = max($maxLength, strlen($cellValue));
                    }
                }

                // Set lebar kolom berdasarkan panjang teks header atau data (mana yang lebih panjang)
                $sheet->getColumnDimension($col)->setWidth(max($headerLength, $maxLength) + 2); // +2 untuk sedikit buffer
            }
        }

        $col_total = $column[count($fields) - 1];

        // Styling header
        $styleArray = [
            'fill' => [
                'fillType' => Fill::FILL_SOLID,
                'color' => ['argb' => 'FF0082C9'], // Warna ARGB
            ],
            'alignment' => [
                'horizontal' => Alignment::HORIZONTAL_CENTER,
                'vertical' => Alignment::VERTICAL_CENTER,
            ],
            'borders' => [
                'allBorders' => [
                    'borderStyle' => Border::BORDER_THIN,
                ],
            ],
        ];

        $sheet->getStyle('A1:' . $col_total . '1')->applyFromArray($styleArray);
        $sheet->getStyle('A1:' . $col_total . '1')
            ->getFont()->getColor()->setARGB(Color::COLOR_WHITE);
        $sheet->getRowDimension(1)->setRowHeight(40);
        $sheet->getStyle('A1:' . $col_total . '1')->getAlignment()->setWrapText(true);

        // Isi header tabel
        $col = 0;
        foreach ($fields as $field) {
            $cell = Coordinate::stringFromColumnIndex($col + 1) . '1';  // Konversi kolom ke referensi cell (A1, B1, ...)
            $sheet->setCellValue($cell, ucwords(str_replace('_', ' ', $field)));
            $col++;
        }

        // Isi data tabel
        $row = 2;
        foreach ($result->result() as $data) {
            $col = 0;
            foreach ($fields as $field) {
                $cell = Coordinate::stringFromColumnIndex($col + 1) . $row;  // Set cell berdasarkan kolom dan row
                $fieldValue = isset($data->$field) ? $data->$field : '';
                
                // Cek jika field berisi gambar, tambahkan gambar
                if ($this->is_image($fieldValue)) {
                    $path = $this->get_image_path($fieldValue); // Mendapatkan path gambar
                    if (file_exists($path)) {
                        // Kompres gambar dan simpan di folder sementara
                        $compressedImagePath = $this->compress_image($path);

                        // Membaca gambar yang telah dikompresi menggunakan PHP GD
                        list($width, $height) = getimagesize($compressedImagePath); // Mendapatkan dimensi gambar

                        // Mendapatkan ukuran lebar kolom (dalam satuan pixel)
                        $columnWidth = $sheet->getColumnDimension(Coordinate::stringFromColumnIndex($col + 1))->getWidth();
                        
                        // Menghitung rasio gambar agar tetap proporsional sesuai dengan lebar kolom
                        $maxWidth = $columnWidth * 7; // Mengonversi ukuran kolom Excel ke pixel (Excel menggunakan unit berbeda)
                        $ratio = $width / $height; // Rasio aspek gambar

                        // Membatasi tinggi gambar maksimal 200 pixel
                        $maxHeight = 200;
                        if ($height > $maxHeight) {
                            // Menyesuaikan tinggi gambar dengan maksimal 200 pixel
                            $height = $maxHeight;
                            $width = round($height * $ratio); // Menyesuaikan lebar berdasarkan rasio
                        }

                        // Jika lebar gambar lebih besar dari lebar kolom, sesuaikan lebar gambar
                        if ($width > $maxWidth) {
                            $width = $maxWidth;
                            $height = round($width / $ratio); // Menyesuaikan tinggi berdasarkan rasio
                        }

                        // Sisipkan gambar ke dalam Excel
                        $drawing = new Drawing();
                        $drawing->setPath($compressedImagePath); // Set path gambar yang sudah dikompresi
                        $drawing->setWidthAndHeight($width, $height); // Set ukuran gambar yang sesuai dengan dimensi yang sudah disesuaikan
                        $drawing->setCoordinates(Coordinate::stringFromColumnIndex($col + 1) . $row); // Menentukan posisi sel
                        $drawing->setWorksheet($sheet); // Menambahkan gambar ke dalam worksheet
                        
                        // Atur tinggi baris agar sesuai dengan gambar
                        $sheet->getRowDimension($row)->setRowHeight($height - 50); // Mengurangi 50 pixel dari tinggi gambar

                        // Atur lebar kolom agar sesuai dengan lebar gambar
                        $sheet->getColumnDimension(Coordinate::stringFromColumnIndex($col + 1))->setWidth($width / 7); // Menyesuaikan lebar kolom dengan gambar
                        $fieldValue = ''; // Hapus teks karena kita menampilkan gambar
                    }
                }
                // Masukkan nilai ke dalam sel
                $sheet->setCellValue($cell, $fieldValue);

                // Terapkan align center untuk teks (dan gambar yang ditambahkan)
                $sheet->getStyle($cell)->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
                $sheet->getStyle($cell)->getAlignment()->setVertical(Alignment::VERTICAL_CENTER);

                $col++;
            }
            $row++;
        }

        // Atur border
        $styleArray = [
            'borders' => [
                'allBorders' => [
                    'borderStyle' => Border::BORDER_THIN,
                ],
            ],
        ];
        $sheet->getStyle('A1:' . $col_total . $row)->applyFromArray($styleArray);

        // Judul sheet
        $sheet->setTitle(ucwords($subject));

        // Header untuk output
        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment;filename="' . ucwords($subject) . '-' . date('Y-m-d') . '.xls"');
        header('Cache-Control: max-age=0');

        // Simpan output
        $writer = IOFactory::createWriter($spreadsheet, 'Xls');
        $writer->save('php://output');
        exit;
    }

    // Fungsi untuk cek apakah file adalah gambar
    private function is_image($filename)
    {
        $ext = pathinfo($filename, PATHINFO_EXTENSION);
        $validExtensions = ['jpg', 'jpeg', 'png', 'gif', 'bmp']; // Ekstensi gambar yang valid
        return in_array(strtolower($ext), $validExtensions);
    }

    // Fungsi untuk mendapatkan path gambar yang sesuai
    private function get_image_path($filename)
    {
        // Mendefinisikan folder berdasarkan nama gambar yang ada
        $basePaths = [
            'barang' => 'uploads/barang/',
            'blog' => 'uploads/blog/',
            'disposal' => 'uploads/disposal/',
            'page' => 'uploads/page/',
            'retur' => 'uploads/retur/',
            'tmp' => 'uploads/tmp/',
            'user' => 'uploads/user/',
        ];

        // Cek folder mana yang sesuai dengan file gambar
        foreach ($basePaths as $key => $folder) {
            if (strpos($filename, $key) !== false) {
                return FCPATH . $folder . $filename; // Kembalikan path lengkap gambar
            }
        }

        // Jika tidak ditemukan, kembalikan null atau path default
        return null;
    }

    // Fungsi untuk mengompres gambar menggunakan PHP GD
    private function compress_image($path)
    {
        $imageInfo = getimagesize($path);
        $imageType = $imageInfo[2];
        $outputPath = 'uploads/tmp/compressed_' . basename($path);

        // Membaca gambar sesuai dengan tipe
        switch ($imageType) {
            case IMAGETYPE_JPEG:
                $image = imagecreatefromjpeg($path);
                break;
            case IMAGETYPE_PNG:
                $image = imagecreatefrompng($path);
                break;
            case IMAGETYPE_GIF:
                $image = imagecreatefromgif($path);
                break;
            default:
                return $path; // Kembalikan path asli jika tipe gambar tidak dikenali
        }

        // Menyimpan gambar yang sudah dikompresi
        imagejpeg($image, $outputPath, 60); // Kompres dengan kualitas 60% untuk file JPEG

        // Hapus gambar yang telah dimuat dalam memori
        imagedestroy($image);

        return $outputPath;
    }

    public function pdf($table, $subject = 'file')
    {
        // Load library TCPDF
        $this->load->library('HtmlPdf');
        
        // Ambil data dari database
        $result = $this->db->get($table);
        $fields = $result->list_fields();
        
        // Inisialisasi konfigurasi PDF
        $config = [
            'orientation' => 'L', // Landscape
            'format' => 'A4',
            'marges' => [10, 10, 10, 10]
        ];
        $pdf = new HtmlPdf($config);
        
        // Set Auto Page Break
        $pdf->SetAutoPageBreak(true, 10);  // 10mm margin for auto page break
        
        // Tambahkan halaman pertama
        $pdf->AddPage();
        
        // Header PDF
        $html = '<table border="1" cellpadding="1" cellspacing="0" style="width:100%; border-collapse:collapse; text-align:center;">';
        $html .= '<thead><tr>';
        
        // Tambahkan header tabel
        foreach ($fields as $field) {
            $html .= '<th style="background-color:#0082C9; color:#FFFFFF; text-align:center; vertical-align:middle;">' 
                    . strtoupper(str_replace('_', ' ', $field)) 
                    . '</th>';
        }
        $html .= '</tr></thead>';
        $html .= '<tbody>';
        
        // Tambahkan baris data
        foreach ($result->result() as $row) {
            $html .= '<tr>';
            foreach ($fields as $field) {
                $value = isset($row->$field) ? $row->$field : '';
        
                // Cek jika field berisi gambar
                if ($this->is_image($value)) {
                    $imagePath = $this->get_image_path($value);
        
                    if (file_exists($imagePath)) {
                        // Tambahkan gambar dengan ukuran sesuai
                        $compressedImagePath = $this->compress_image($imagePath);
                        $html .= '<td style="text-align:center; vertical-align:middle; padding:10px;">';
                        $html .= '<img src="' . $compressedImagePath . '" style="display:block; margin-left:auto; margin-right:auto;"/>';
                        $html .= '</td>';
                    } else {
                        $html .= '<td style="text-align:center; vertical-align:middle; padding:10px;">(Image Not Found)</td>';
                    }
                } else {
                    $html .= '<td style="text-align:center; vertical-align:middle; padding:10px;">' 
                            . htmlspecialchars($value) 
                            . '</td>';
                }
            }
            $html .= '</tr>';
        }
        $html .= '</tbody></table>';

        // Tulis HTML ke PDF
        $pdf->writeHTML($html, true, false, false, false, '');

        // Output PDF ke browser
        $filename = $subject . '.pdf';
        $pdf->Output($filename, 'I');
    }

}

/* End of file My_Model.php */
/* Location: ./application/core/My_Model.php */