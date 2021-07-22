<?php
// Untuk koneksi data msurat!
class M_pdf extends CI_Model
{
    function __construct()
    {
        include_once APPPATH . '/third_party/pdf/fpdf.php';
    }

    //print data masuk
    public function printsatum($d)
    {
        $filename = "Data Masuk Surat No " . $d['id'];
        $pdf = new FPDF('P', 'mm', 'A4');
        $pdf->AddPage();

        //set font to arial, bold, 14pt

        $pdf->Setfont('Arial', 'B', 16);

        //cell(width , height , text , border , end line , [align])

        $pdf->Cell(0, 10, 'PENGADILAN AGAMA KARAWANG', 0, 1, 'C'); //end line
        $pdf->Cell(0, 10, "DATA SURAT MASUK " . $d['no'], 0, 1, 'C'); //end line
        $pdf->Ln(10); //end line

        $pdf->SetFont('Arial', '', 14);
        $pdf->Cell(50, 10, 'Tanggal / Nomor ', 0, 0);
        $pdf->Write(10, ': ' . date('d-m-y', strtotime($d['tglsurat'])) . ' / ' . $d['no']);
        $pdf->Ln(10);
        $pdf->Cell(50, 10, 'Asal', 0, 0);
        $pdf->Write(10, ': ' . $d['asal']);
        $pdf->Ln(10);
        $pdf->Cell(50, 10, 'Isi Ringkasan', 0, 0);
        $pdf->Write(10, ': ' . $d['perihal']);
        $pdf->Ln(10);
        $pdf->Cell(50, 10, 'Diterima Tanggal', 0, 0);
        $pdf->Write(10, ': ' . date('d-m-y', strtotime($d['tglmasuk'])));
        $pdf->Ln(10);

        $pdf->Ln(10);

        if ($d['idstat'] != 15) {
            $pdf->Cell(30, 10, 'Tanggal penyelesaian : ', 0, 1);
        } else {
            $pdf->Cell(50, 10, 'Tanggal penyelesaian', 0, 0);
            $pdf->Cell(50, 10, ': ' . date('d-m-y', strtotime($d['tglupdate'])), 0, 1);
        }
        $pdf->Ln(10);
        $pdf->SetFont('Arial', '', 12);
        $pdf->Cell(60, 10, 'Disposisi Sekretaris', 0, 0);
        $pdf->Write(10, ': ' . $d['isisek']);
        $pdf->Ln(10);
        $pdf->Cell(60, 10, 'Disposisi Ketua', 0, 0);
        $pdf->Write(10, ': ' . $d['isiket']);
        $pdf->Ln(10);
        $pdf->Cell(60, 10, 'Disposisi Sekretaris / Panitera', 0, 0);
        $pdf->Write(10, ': ' . $d['isipan']);
        $pdf->Ln(10);

        $pdf->Ln(10);
        $pdf->SetFont('Arial', '', 14);
        if ($d['idstat'] == 15) {
            $pdf->cell(40, 10, $d['status'], 0, 1);
        }
        $pdf->Output($filename, "I");
    }

    //print data  surat keluar
    public function printsatuk($d)
    {
        $filename = "Data Keluar Surat No " . $d['id'];
        $pdf = new FPDF('P', 'mm', 'A4');
        $pdf->AddPage();

        //set font to arial, bold, 14pt

        $pdf->Setfont('Arial', 'B', 16);

        //cell(width , height , text , border , end line , [align])

        $pdf->Cell(0, 10, 'PENGADILAN AGAMA KARAWANG', 0, 1, 'C'); //end line
        $pdf->Cell(0, 10, "DATA SURAT KELUAR " . $d['no'], 0, 1, 'C'); //end line
        $pdf->Ln(10); //end line

        $pdf->SetFont('Arial', '', 14);
        $pdf->Cell(50, 10, 'Tanggal / Nomor ', 0, 0);
        $pdf->Write(10, ': ' . date('d-m-y', strtotime($d['tgl'])) . ' / ' . $d['no']);
        $pdf->Ln(10);
        $pdf->Cell(50, 10, 'Tujuan', 0, 0);
        $pdf->Write(10, ': ' . $d['tujuan']);
        $pdf->Ln(10);
        $pdf->Cell(50, 10, 'Isi Ringkasan', 0, 0);
        $pdf->Write(10, ': ' . $d['perihal']);
        $pdf->Ln(10);
        $pdf->Cell(50, 10, 'Pengolah', 0, 0);
        $pdf->Write(10, ': ' . $d['pengolah']);
        $pdf->Ln(10);
        $pdf->Output($filename, "I");
    }
}
