<?php
session_start();
require 'vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

$error_message = null;
$proc_params = $_SESSION["proc_params"];


if (!isset($_POST["submit"])) {

    $file = $_GET["file"];
    $proc_params = array();

    try {
        $spreadsheet = \PhpOffice\PhpSpreadsheet\IOFactory::load($file);

    } catch (Exception $e){
        $error_message = "Errore! Ricarica il file";
        return;
    }
    $worksheet = $spreadsheet->getActiveSheet();

// Get the highest row and column numbers referenced in the worksheet
    $highestRow = $worksheet->getHighestRow(); // e.g. 10
    $highestColumn = $worksheet->getHighestColumn(); // e.g 'F'
    $highestColumnIndex = \PhpOffice\PhpSpreadsheet\Cell\Coordinate::columnIndexFromString($highestColumn); // e.g. 5

    echo '<table>' . "\n";
    for ($row = 1; $row <= $highestRow; ++$row) {
//            echo '<tr>' . PHP_EOL;
        $rw = null;
        for ($col = 1; $col <= $highestColumnIndex; ++$col) {
            $value = $worksheet->getCellByColumnAndRow($col, $row)->getValue();
//                echo '<td>' . $value . '</td>' . PHP_EOL;

            if ($rw != null)
                $rw = $rw . "%--%" . $value;
            else
                $rw = $value;
        }

        $proc_params[] = $rw;

        echo '</tr>' . PHP_EOL;
    }
    echo '</table>' . PHP_EOL;

    $_SESSION["proc_params"]  = $proc_params;

    unlink($file);
}

if (isset($_POST["submit"])) {

    $proc_params = $_SESSION["proc_params"];

        for ($i = 0; $i < count($proc_params); ++$i) {
//        var_dump($proc_params[$i-1]);

            $params = explode("%--%", $proc_params[$i]);

            for ($j = 0; $j < count($params); ++$j) {
                //TODO: chiamare procedura

                var_dump($params[$j]);
                echo '<br>';
            }
            echo '<br>';
            echo '<br>';
            echo '<br>';

        }

}