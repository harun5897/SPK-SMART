<?php
session_start();
require('../FPDF/fpdf.php');

if($_SESSION['loginStatus'] != 1) {
    header('location: index.php?alertBelumLogin=true');
  }

class myPDF extends FPDF {
  function header()
  {
    include_once('../handlingData/smart.php');
    include_once('../handlingData/koneksi.php');

    $this->SetFont('Arial', 'B', 18);
    $this->cell(0,0, 'Notaris & PPAT Ronifiska Kirana, S.H, M. Kn Tanjungpinang', 0, 0, 'C');
    $this->ln();
    $this->SetFont('Arial', 'B', 14);
    $this->cell(0,20, 'Jl. Ir. Sutami, Komplek Ruko Dendang Ria, No.120, kota Tanjungpinang, provinsi Kepulauan Riau.', 0, 0, 'C');
    $this->Line(5, 30, 290, 30);
    $this->ln();
    $this->SetFont('Arial', 'B', 18);
    $this->cell(0,20, 'Laporan Perangkingan Penerimaan Karyawan', 0, 0, 'C');
    $this->ln();

    $this->SetFont('Arial', 'B', 14);
    $this->Cell(15, 10, 'No', 1,0, 'C');
    $this->Cell(90, 10, 'Nama', 1,0,'C');
    $this->Cell(90, 10, 'Kontak', 1,0, 'C');
    $this->Cell(80, 10, 'Nilai', 1,0, 'C');

    $no = 0;
    $id = 0;
    for($i = 0; $i < count($_SESSION['hasilRanking'][0]); $i++) {
      $no++;
      $id = $_SESSION['hasilRanking'][0][$i];
      $dataPeserta = mysqli_query($koneksi, "SELECT * FROM tabelpeserta WHERE idPeserta = '$id'");
      $arrDataPeserta = mysqli_fetch_array($dataPeserta);
      
      $this->ln();
      $this->SetFont('Arial', '', 14);
      $this->Cell(15, 10, $no, 1,0, 'C');
      $this->Cell(90, 10, $arrDataPeserta['namaDepan'], 1,0,'C');
      $this->Cell(90, 10, $arrDataPeserta['kontak'], 1,0, 'C');
      $this->Cell(80, 10, $_SESSION['hasilRanking'][1][$i], 1,0, 'C');
    }
    
  }
  function Footer()
  {
    // FUNC DATE
    date_default_timezone_set('Asia/Jakarta');
    $date = date('Y-m-d');
    $d = 'Tiban, '.$date;
    
    // Position at ... cm from bottom
    $this->SetY(-40);
    // $this->ln();
    $this->SetFont('Arial','', 14);
    $this->cell(244,-18, 'Mengetahui,', 0, 0, 'R');
    $this->ln();
    $this->SetFont('Arial','', 14);
    $this->cell(0,0, '', 0, 0, 'L');
    $this->ln();
    $this->SetFont('Arial','', 14);
    $this->cell(250,30, 'NOTARIS & PPAT', 0, 0, 'R');
    

    $this->ln();
    $this->SetFont('Arial','U', 14);
    $this->cell(255,10, 'RONIFISKA S.H, M.KN', 0, 0, 'R');
    $this->ln();
  }
}

$pdf = new myPDF();
$pdf->AliasNbPages();
$pdf->AddPage('L', 'A4', 0);
$pdf->Output();
?>