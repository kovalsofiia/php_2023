<?php
echo "Sofiia Koval MKR 1 V20.";
echo "  На сервері зберігається список Предметів (Id, Назва, Викладач,
Кількість балів). Розробити Web сторінку для перегляду всього списку
предметів. Зробити назву кожного пердмету гіперпосиленням на сторінку
для перегляду даних прелдмету із вказаним Id.";


$error_message = null;

$subjectsList = [];

// filename and mode r for reading from the CSV file
$csvFilePath = 'subjects2.csv';
$file = fopen($csvFilePath, 'r');

if ($file) {
    $header = fgetcsv($file);

    while (($row = fgetcsv($file)) !== false) {
        $object = [
            'id' => $row[0],
            'name' => $row[1],
            'teacher' => $row[2],
            'pointsAmount' => $row[3]
        ];

        $subjectsList[] = $object;
    }
    fclose($file);
} else {
    echo "Failed to open the CSV file and read data.";
}

//adding a subject
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $newSubject = [
        'id' => $_POST['id'] ?? '',
        'name' => $_POST['name'] ?? '',
        'teacher' => $_POST['teacher'] ?? '',
        'pointsAmount' => $_POST['pointsAmount'] ?? ''
    ];

    $subjectsList[] = $newSubject;

    $file = fopen($csvFilePath, 'a');
    if ($file) {
        fputcsv($file, $newSubject);
        fclose($file);
    } else {
        $error_message = "Failed to open the CSV file for writing.";
    }
}






//==============================================================================
include 'templates/subjectsTable.phtml';
include 'templates/subjectsCreate.phtml';

if ($error_message ){
    print $error_message;
}

//
if (isset($_GET['id'])) {
    $subjectId = $_GET['id'];

    $subject = null;

    foreach ($subjectsList as $obj)
    {
        if ($obj['id'] === $subjectId) {
            $subject = $obj;
        }
    }

    if (!empty($subject)) {
        echo "Subject Details for ID {$subjectId}:<br>";
        echo "Name: {$subject['name']}<br>";
        echo "Teacher: {$subject['teacher']}<br>";
        echo "Points Amount: {$subject['pointsAmount']}<br>";
    } else {
        echo "Subject not found.";
    }
} else {
    echo "Subject ID is not provided in the URL.";
}
