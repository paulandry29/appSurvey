<?php

require '../../../vendor/autoload.php';
require '../../functions/adminFunction.php';

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

$id = $_GET['id_survey'];
$judul = getOneJudul($id); 
$responden = getResponden($id);
$pertanyaan = getPertanyaan($id);
$jumlahPertanyaan = count(getPertanyaan($id));

$styleSet = [
    // FONT
    "font" => [
      "color" => ["argb" => "FF000000"],
      "name" => "Times New Roman",
      "size" => 12
    ],
   
    // VERTICAL ALIGNMENT
    "alignment" => [
      "vertical" => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER
    ],

    'borders' => [
        'allBorders' => [
            'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
            'color' => ['argb' => 'FF000000'],
        ],
    ],
];

$border = [
    
];

try {
    $spreadsheet = new Spreadsheet();
    $activeWorksheet = $spreadsheet->getActiveSheet();

    //Srart Row
    $a = 5;
    $x = 5;
    //Value
    foreach ($responden as $key => $val1) {
        $activeWorksheet->setCellValue('A'.$x, $val1['nama']);
        $jawaban = getJawabanUser($id, $val1['id_respon']);

        foreach ($jawaban as $key => $val2) {
            $activeWorksheet->setCellValue('B'.$a, $val2['pertanyaan']);

            $sb  = ($val2['jawaban'] == 5) ? 'v' : '' ;
            $b  = ($val2['jawaban'] == 4) ? 'v' : '' ;
            $c  = ($val2['jawaban'] == 3) ? 'v' : '' ;
            $k  = ($val2['jawaban'] == 2) ? 'v' : '' ;
            $sk  = ($val2['jawaban'] == 1) ? 'v' : '' ;

            $activeWorksheet->setCellValue('C'.$a, $sb);
            $activeWorksheet->setCellValue('D'.$a, $b);
            $activeWorksheet->setCellValue('E'.$a, $c);
            $activeWorksheet->setCellValue('F'.$a, $k);
            $activeWorksheet->setCellValue('G'.$a, $sk);
            $a++;
        }

        $activeWorksheet->mergeCells("A".$x.":A".$a-1);
        $x=$a;
    }

    //Style
    $style = $activeWorksheet->getStyle("A3:G".$a-1);
    $style->applyFromArray($styleSet);

    //width
    $activeWorksheet->getColumnDimension("A")->setWidth(30);
    $activeWorksheet->getColumnDimension("B")->setWidth(130);
    $activeWorksheet->getColumnDimension("C")->setWidth(15);
    $activeWorksheet->getColumnDimension("D")->setWidth(15);
    $activeWorksheet->getColumnDimension("E")->setWidth(15);
    $activeWorksheet->getColumnDimension("F")->setWidth(15);
    $activeWorksheet->getColumnDimension("G")->setWidth(15);
    
    //WrapText
    $activeWorksheet->getStyle('B')->getAlignment()->setWrapText(true);

    //Marge Cell
    $activeWorksheet->mergeCells('A3:A4');
    $activeWorksheet->mergeCells('B3:B4');
    $activeWorksheet->mergeCells('C3:G3');
    $activeWorksheet->mergeCells('A1:G2');

    //Header
    $activeWorksheet->setCellValue('A1', $judul);
    $activeWorksheet->setCellValue('A3', 'Nama');
    $activeWorksheet->setCellValue('B3', 'Pertanyaan');
    $activeWorksheet->setCellValue('C3', 'Jawaban');
    $activeWorksheet->setCellValue('C4', 'Sangat Baik');
    $activeWorksheet->setCellValue('D4', 'Baik');
    $activeWorksheet->setCellValue('E4', 'Cukup');
    $activeWorksheet->setCellValue('F4', 'Kurang');
    $activeWorksheet->setCellValue('G4', 'Sangat Kurang');

    $activeWorksheet->getStyle('A1:G2')->getFont()->setBold(true);
    $activeWorksheet->getStyle('A1:G2')->getFont()->setName('Times New Roman');
    $activeWorksheet->getStyle('A1:G2')->getFont()->setSize(14);
    $activeWorksheet->getStyle('A1:G2')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
    $activeWorksheet->getStyle('A1:G2')->getAlignment()->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);
    $activeWorksheet->getStyle('A1:G2')->getAlignment()->setWrapText(true);

    //Alignment
    $activeWorksheet->getStyle('A3:G4')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
    $activeWorksheet->getStyle('C5:G'.$a-1)->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);

    $filename = $judul.'-'.date('Ymd His');

    $writer = new Xlsx($spreadsheet);
    header("Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet");
    header("Content-Disposition: attachment;filename=\"".$filename.".xlsx\"");
    header("Pragma: public");
    $writer->save("php://output");

} catch (Exception $e) {
    echo'Error Export = '.$e->getMessage();
}