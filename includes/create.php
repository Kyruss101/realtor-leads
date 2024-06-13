<?php
include 'db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $data = readCSV();
    $newId = end($data)[0] + 1;
    $newEntry = [
        $newId,
        $_POST['name'],
        $_POST['email'],
        $_POST['phone']
    ];
    $data[] = $newEntry;
    writeCSV($data);
    echo json_encode(['status' => 'success', 'message' => 'Team member added successfully']);
}
?>
