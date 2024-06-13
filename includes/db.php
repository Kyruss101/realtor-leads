<?php
$csvFile = '../csvs/realtor_teams.csv';

function readCSV($skipHeader = true) {
    global $csvFile;
    $file = fopen($csvFile, 'r');
    $data = [];
    if ($skipHeader) {
        $headers = fgetcsv($file);
    } else {
        $headers = null;
    }
    while (($row = fgetcsv($file)) !== FALSE) {
        $data[] = $row;
    }
    fclose($file);
    return ['headers' => $headers, 'data' => $data];
}

function writeCSV($data) {
    global $csvFile;
    $file = fopen($csvFile, 'w');
    foreach ($data as $row) {
        fputcsv($file, $row);
    }
    fclose($file);
}
?>
