<?php
// include PhpSpreadsheet library
require_once 'vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

// create a new spreadsheet object
$spreadsheet = new Spreadsheet();

// get the active worksheet
$worksheet = $spreadsheet->getActiveSheet();

// set the table data
$tableData = array(
    array('Name', 'Age', 'Gender'),
    array('John', 25, 'Male'),
    array('Jane', 30, 'Female'),
    array('Bob', 20, 'Male')
);

// write the table data to the worksheet
$rowIndex = 1;
foreach ($tableData as $rowData) {
    $colIndex = 1;
    foreach ($rowData as $cellData) {
        $worksheet->setCellValueByColumnAndRow($colIndex, $rowIndex, $cellData);
        $colIndex++;
    }
    $rowIndex++;
}

// create a new Excel file and save the spreadsheet to it
$writer = new Xlsx($spreadsheet);
$filename = 'table.xlsx';
$writer->save($filename);

// send the Excel file to the browser
header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment;filename="' . $filename . '"');
header('Cache-Control: max-age=0');
$writer->save('php://output');

?>