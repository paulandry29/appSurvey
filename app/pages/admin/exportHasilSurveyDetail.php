<?php

require '../../../vendor/autoload.php';
require '../../functions/adminFunction.php';

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

$id = $_GET['id_survey'];
$id_respon = $_GET['id_respon'];
$judul = getOneJudul($id);
$nama = getUserByRespon($id_respon);

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

$border = [];

try {
    $spreadsheet = new Spreadsheet();
    $activeWorksheet = $spreadsheet->getActiveSheet();

    //Srart Row
    $a = 5;
    
    //Value
    $jawaban = getJawabanUser($id, $id_respon);

    foreach ($jawaban as $key => $val2) {
        $activeWorksheet->setCellValue('A' . $a, $val2['pertanyaan']);

        $sb  = ($val2['jawaban'] == 5) ? 'v' : '';
        $b  = ($val2['jawaban'] == 4) ? 'v' : '';
        $c  = ($val2['jawaban'] == 3) ? 'v' : '';
        $k  = ($val2['jawaban'] == 2) ? 'v' : '';
        $sk  = ($val2['jawaban'] == 1) ? 'v' : '';

        $activeWorksheet->setCellValue('B' . $a, $sb);
        $activeWorksheet->setCellValue('C' . $a, $b);
        $activeWorksheet->setCellValue('D' . $a, $c);
        $activeWorksheet->setCellValue('E' . $a, $k);
        $activeWorksheet->setCellValue('F' . $a, $sk);
        $a++;
    }

    //Style
    $style = $activeWorksheet->getStyle("A3:F" . $a - 1);
    $style->applyFromArray($styleSet);

    //width
    $activeWorksheet->getColumnDimension("A")->setWidth(130);
    $activeWorksheet->getColumnDimension("B")->setWidth(15);
    $activeWorksheet->getColumnDimension("C")->setWidth(15);
    $activeWorksheet->getColumnDimension("D")->setWidth(15);
    $activeWorksheet->getColumnDimension("E")->setWidth(15);
    $activeWorksheet->getColumnDimension("F")->setWidth(15);

    //WrapText
    $activeWorksheet->getStyle('A')->getAlignment()->setWrapText(true);

    //Marge Cell
    $activeWorksheet->mergeCells('A3:A4');
    $activeWorksheet->mergeCells('B3:F3');
    $activeWorksheet->mergeCells('A1:F2');

    //Header
    $activeWorksheet->setCellValue('A1', $judul);
    $activeWorksheet->setCellValue('A3', 'Pertanyaan');
    $activeWorksheet->setCellValue('B3', 'Jawaban');
    $activeWorksheet->setCellValue('B4', 'Sangat Baik');
    $activeWorksheet->setCellValue('C4', 'Baik');
    $activeWorksheet->setCellValue('D4', 'Cukup');
    $activeWorksheet->setCellValue('E4', 'Kurang');
    $activeWorksheet->setCellValue('F4', 'Sangat Kurang');

    $activeWorksheet->getStyle('A1:F2')->getFont()->setBold(true);
    $activeWorksheet->getStyle('A1:F2')->getFont()->setName('Times New Roman');
    $activeWorksheet->getStyle('A1:F2')->getFont()->setSize(14);
    $activeWorksheet->getStyle('A1:F2')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
    $activeWorksheet->getStyle('A1:F2')->getAlignment()->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);
    $activeWorksheet->getStyle('A1:F2')->getAlignment()->setWrapText(true);

    //Alignment
    $activeWorksheet->getStyle('A3:F4')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
    $activeWorksheet->getStyle('B5:F' . $a - 1)->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);

    $filename = $nama.'-'.$judul . '-' . date('Ymd His');

    $writer = new Xlsx($spreadsheet);
    header("Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet");
    header("Content-Disposition: attachment;filename=\"" . $filename . ".xlsx\"");
    header("Pragma: public");
    $writer->save("php://output");
} catch (Exception $e) {
    echo 'Error Export = ' . $e->getMessage();
}
