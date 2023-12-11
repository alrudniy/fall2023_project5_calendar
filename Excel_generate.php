<?php
ini_set('display_errors', 1);

require_once __DIR__ . '/../../../Users/xo172/vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_FILES['file_upload'])) {
    $inputFileName = $_FILES['file_upload']['tmp_name'];
    $outputFileName = 'UpdatedSchedule.xlsx'; // Output file name, you can modify as needed
    $startDate = new DateTime('2023-09-01'); // User input for start date
    $endDate = new DateTime('2023-12-15'); // User input for end date

    $spreadsheet = IOFactory::load($inputFileName);
    $worksheet = $spreadsheet->getActiveSheet();

    $validDays = []; // To store valid days of the week
    $rowData = []; // To store original row data

    foreach ($worksheet->getRowIterator() as $row) {
        $cellIterator = $row->getCellIterator();
        $cellIterator->setIterateOnlyExistingCells(false);

        $cells = [];
        foreach ($cellIterator as $cell) {
            $cells[] = $cell->getValue();
        }

        if (!empty($cells[0])) {
            $dateParts = explode(' ', $cells[0]);
            if (count($dateParts) == 3) {
                $dayOfWeek = DateTime::createFromFormat('D', $dateParts[0]);
                if ($dayOfWeek) {
                    $validDays[$dayOfWeek->format('N')] = true; // Store valid days of the week
                }
            }
        }
        $rowData[] = $cells; // Save original row data
    }

    // Create a new schedule
    $newSchedule = [];
    $currentDate = clone $startDate;
    while (count($newSchedule) < count($rowData) && $currentDate <= $endDate) {
        $dayOfWeek = $currentDate->format('N');
        if (isset($validDays[$dayOfWeek])) {
            $newSchedule[] = $currentDate->format('D M d');
        }
        $currentDate->modify('+1 day');
    }

    // Create a new Spreadsheet and fill in the data
    $newSpreadsheet = new Spreadsheet();
    $newWorksheet = $newSpreadsheet->getActiveSheet();

    foreach ($rowData as $rowIndex => $rowCells) {
        foreach ($rowCells as $columnIndex => $value) {
            if ($columnIndex == 0 && !empty($newSchedule[$rowIndex])) {
                $value = $newSchedule[$rowIndex]; // Update the date
            }
            $newWorksheet->setCellValueByColumnAndRow($columnIndex + 1, $rowIndex + 1, $value);
        }
    }

    // Save the new Excel file
    $writer = new Xlsx($newSpreadsheet);
    $writer->save($outputFileName);

    // Provide a download link
    echo "Schedule updated, <a href='$outputFileName' download>click here to download the file</a>";
}
?>

<!-- <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>File Upload and Download</title>
</head>
<body>
    <form method="post" enctype="multipart/form-data">
        Select the file to upload: <input type="file" name="file_upload" accept=".xlsx"><br>
        <input type="submit" value="Upload File">
    </form>
</body>
</html> -->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>File Upload and Download</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
            color: #333;
        }

        .container {
            width: 80%;
            margin: auto;
            overflow: hidden;
        }

        header {
            background: #ffffff; /* White background */
            color: #4CAF50; 
            padding-top: 30px;
            min-height: 70px;
            border-bottom: #e8491d 3px solid;
        }

        header nav {
            float: left;
            margin-top: 10px;
        }

        header ul {
            padding: 0;
            list-style: none;
            overflow: hidden;
        }

        header li {
            float: left;
            display: inline;
            padding: 0 20px 0 20px;
        }

        header a {
            color: #4CAF50;
            text-decoration: none;
            text-transform: uppercase;
            font-size: 16px;
        }

        header a:hover {
            color: #333;
        }

        .button-link {
            display: inline-block;
            padding: 10px 20px;
            margin: 10px 0;
            background-color: #4CAF50; /* Button color */
            color: white;
            text-align: center;
            text-decoration: none;
            border-radius: 5px;
            font-size: 16px;
        }

        .button-link:hover {
            background-color: #45a049;
        }

        input[type="file"] {
            margin: 10px 0;
        }

        .submit-container {
            text-align: center;
            padding: 20px 0;
        }
    </style>
</head>
<body>
    <header>
        <div class="container">
            <div id="branding">
                <h1>Excel Calendar Update</h1>
            </div>
            <nav>
                <ul>
                    <li><a href="http://localhost/fall2023_project5_calendar/index_test.php">Home</a></li> <!-- Update 'home.html' with the actual path to your home page -->
                </ul>
            </nav>
        </div>
    </header>

    <div class="container">
        <form method="post" enctype="multipart/form-data">
            Select the file to upload: <input type="file" name="file_upload" accept=".xlsx"><br>
            <div class="submit-container">
                <input type="submit" class="button-link" value="Upload File">
            </div>
        </form>
    </div>
</body>
</html>
