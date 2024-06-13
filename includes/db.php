<?php
$csvFile = '../csvs/realtor_teams.csv';

// function readCSV($skipHeader = true) {
//     global $csvFile;
//     $file = fopen($csvFile, 'r');
//     $data = [];
//     if ($skipHeader) {
//         $headers = fgetcsv($file);
//     } else {
//         $headers = null;
//     }
//     while (($row = fgetcsv($file)) !== FALSE) {
//         $data[] = $row;
//     }
//     fclose($file);
//     return ['headers' => $headers, 'data' => $data];
// }

// function writeCSV($data) {
//     global $csvFile;
//     $file = fopen($csvFile, 'w');
//     foreach ($data as $row) {
//         fputcsv($file, $row);
//     }
//     fclose($file);
// }


function readCSV($skipHeader = true)
{
    global $csvFile;
    $data = [];
    if (($file = fopen($csvFile, 'r')) !== false) {
        if ($skipHeader) {
            $headers = fgetcsv($file);
        } else {
            $headers = null;
        }
        while (($row = fgetcsv($file)) !== false) {
            $data[] = $row;
        }
        fclose($file);
        return ['headers' => $headers, 'data' => $data];
    } else {
        // Handle error opening file
        return false;
    }
}

function writeCSV($data)
{
    global $csvFile;
    if (($file = fopen($csvFile, 'w')) !== false) {
        foreach ($data as $row) {
            fputcsv($file, $row);
        }
        fclose($file);
        return true;
    } else {
        // Handle error opening file for writing
        return false;
    }
}
?>