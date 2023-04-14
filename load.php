<?php

require '../vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
$error_message = "";



if(count($_FILES) > 0) {
    $filename = $_FILES['fileToUpload']['name'];
    $filetempname = $_FILES['fileToUpload']['tmp_name'];
    $ext = strtolower(pathinfo($filename, PATHINFO_EXTENSION));
    $allowed_extensions = array("xls","xlsx","ods");
    $proc_params = array();
}


if (isset($_POST["submit"])) {
    if (in_array($ext, $allowed_extensions)) {

        $spreadsheet = \PhpOffice\PhpSpreadsheet\IOFactory::load($filetempname);
        $worksheet = $spreadsheet->getActiveSheet();

        // Get the highest row and column numbers referenced in the worksheet
        $highestRow = $worksheet->getHighestRow(); // e.g. 10
        $highestColumn = $worksheet->getHighestColumn(); // e.g 'F'
        $highestColumnIndex = \PhpOffice\PhpSpreadsheet\Cell\Coordinate::columnIndexFromString($highestColumn); // e.g. 5

        echo '<table>' . "\n";
        for ($row = 1; $row <= $highestRow; ++$row) {
            echo '<tr>' . PHP_EOL;
            $rw = null;
            for ($col = 1; $col <= $highestColumnIndex; ++$col) {
                $value = $worksheet->getCellByColumnAndRow($col, $row)->getValue();
                echo '<td>' . $value . '</td>' . PHP_EOL;

                if($rw != null)
                    $rw = $rw . "%--%" . $value;
                else
                    $rw = $value;
            }

            $proc_params[] = $rw;

            echo '</tr>' . PHP_EOL;
        }
        echo '</table>' . PHP_EOL;


        callProcedure($proc_params);

    } else {
        $error_message = "E' possibile caricare solo file con estensione " . join(", ", $allowed_extensions) ;

    }
}

function callProcedure($proc_params){


//        $_SESSION['$proc_params'] = $proc_params;

    $json_params = json_encode($proc_params);
    header("Location: ../viewtable.php?proc_params=".urlencode($json_params)."&action=aggiornamento");

//    $serverName = "serverName\\localhost"; //serverName\instanceName
//    $connectionInfo = array( "Database"=>"master", "UID"=>"AS", "PWD"=>"<YourStrong@Passw0rd>");
//    $conn = sqlsrv_connect( $serverName, $connectionInfo);
//
//    if( $conn ) {
//        echo "Connection established.<br />";
//    }else{
//        echo "Connection could not be established.<br />";
//        die( print_r( sqlsrv_errors(), true));
//    }
//
//
//var_dump($proc_params);
//
//        var_dump($proc_params);

//        for ($i = 0; $i < count($proc_params); ++$i) {
////        var_dump($proc_params[$i-1]);
//
//        $params = explode("%--%", $proc_params[$i]);
//
//        for ($j = 0; $j < count($params); ++$j) {
//         //TODO: chiamare procedura
//
//            var_dump($params[$j]);
//            echo '<br>';
//        }
////        $sql = "Exec SPDR_InsUpdtIserviceWithAlias ?,?,?,?,?,?";
////        $params = array(6, $params[0], $params[1], $params[2], $params[3], $params[4], $params[5]);
////
////        $stmt = sqlsrv_query( $conn, $sql, $params);
////        if( $stmt === false ) {
////            die( print_r( sqlsrv_errors(), true));
////        }
//        echo '<br>';
//        echo '<br>';
//        echo '<br>';
//
//    }

}


?>