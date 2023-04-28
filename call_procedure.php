<?php
session_start();
require 'vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

$error_message = null;
$success_message = null;
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

    $serverName = "localhost\\sqlexpress, 1433"; //serverName\instanceName
    $connectionInfo = array("Database" => "DRMOTOR", "UID" => "SA", "PWD" => "<YourStrong@Passw0rd>", "TrustServerCertificate" => true);
    $conn = sqlsrv_connect($serverName, $connectionInfo);

    if ($conn) {
//        echo "Connection established.<br />";
//        var_dump($conn);
    } else {
        echo "Connection could not be established.<br />";
        die(print_r(sqlsrv_errors(), true));
    }

    $proc_params = $_SESSION["proc_params"];

    try {


        for ($i = 0; $i < count($proc_params); ++$i) {

            $params = explode("%--%", $proc_params[$i]);

            for ($j = 0; $j < count($params); ++$j) {
                $params[$j] = "'" . $params[$j] . "'";
            }

            $sql = "Exec SPDR_InsUpdtIserviceWithAlias " . join(", ", $params) ;


            $stmt = sqlsrv_query($conn, $sql);


           // var_dump(sqlsrv_fetch_object($stmt));


        }

        $success_message = "Inserimento avvenuto con successo";
//        var_dump($success_message);

    } catch (Exception $e){
        var_dump("Errore nell inserimento");
        die();
    }
}