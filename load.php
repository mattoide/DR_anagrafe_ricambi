<?php

require 'vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

$error_message = "";
$save_dir = __DIR__ . "/uploads/";

if(count($_FILES) > 0) {
    $filename = $_FILES['fileToUpload']['name'];
    $filetempname = $_FILES['fileToUpload']['tmp_name'];
    $ext = strtolower(pathinfo($filename, PATHINFO_EXTENSION));
    $allowed_extensions = array("xls","xlsx","ods");
    $proc_params = array();
}


if (isset($_POST["submit"])) {
    if (in_array($ext, $allowed_extensions)) {

        $file = $save_dir.$_FILES['fileToUpload']['name'];

        move_uploaded_file($_FILES['fileToUpload']['tmp_name'], $file);

        header("Location: ../viewtable.php?action=$action&file=$file");


    } else {
        $error_message = "E' possibile caricare solo file con estensione " . join(", ", $allowed_extensions) ;
    }
}