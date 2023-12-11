<?php
require_once __DIR__ . '/../../Users/xo172/vendor/autoload.php';

session_start();

// Initialize Google Client
$client = new Google_Client();
$client->setApplicationName('Google Docs API PHP Quickstart');
$client->setScopes(Google_Service_Docs::DOCUMENTS);
$client->setAuthConfig('C:\xampp\htdocs\client_secret_354965931243-0ailorbqdunrgsv52idmmgh811htiot3.apps.googleusercontent.com.json');
$client->setAccessType('offline');
$client->setPrompt('select_account consent');
$client->setRedirectUri('http://localhost/demo1005.php');

// Get OAuth 2.0 credentials
if (!isset($_SESSION['access_token']) && !isset($_GET['code'])) {
    $authUrl = $client->createAuthUrl();
    header('Location: ' . filter_var($authUrl, FILTER_SANITIZE_URL));
    exit();
} elseif (!isset($_SESSION['access_token']) && isset($_GET['code'])) {
    $token = $client->fetchAccessTokenWithAuthCode($_GET['code']);
    $_SESSION['access_token'] = $token;
}

if (isset($_SESSION['access_token']) && $_SESSION['access_token']) {
    $client->setAccessToken($_SESSION['access_token']);
}

// Create Google Docs service instance
$service = new Google_Service_Docs($client);

// Parse document ID
function parseDocumentIdFromUrl($url) {
    $parts = parse_url($url);
    $pathParts = explode('/', $parts['path']);
    return $pathParts[3] ?? '';
}

// Extract text from a cell
function getTextFromCell($cell) {
    $text = '';
    foreach ($cell->getContent() as $cellContentElement) {
        if ($cellContentElement->getParagraph()) {
            foreach ($cellContentElement->getParagraph()->getElements() as $element) {
                if ($element->getTextRun()) {
                    $text .= $element->getTextRun()->getContent();
                }
            }
        }
    }
    return trim($text);
}

// Get day of the week from a date string
function getDayOfWeekFromDateString($dateString) {
    $date = DateTime::createFromFormat('D M d', $dateString);
    return $date ? $date->format('D') : false;
}

// Update document content
function updateDocument($service, $documentId, $startDate, $endDate) {
    $validDays = []; // Store valid weekdays from the original document
    $document = $service->documents->get($documentId);
    $content = $document->getBody()->getContent();

    // Step 1: Determine all valid weekdays
    foreach ($content as $structuralElement) {
        if ($structuralElement->getTable()) {
            $table = $structuralElement->getTable();
            foreach ($table->getTableRows() as $row) {
                $cell = $row->getTableCells()[0];
                $text = getTextFromCell($cell);
                $dayOfWeek = getDayOfWeekFromDateString($text);
                if ($dayOfWeek && !in_array($dayOfWeek, $validDays)) {
                    $validDays[] = $dayOfWeek;
                }
            }
        }
    }

    echo "Valid days found: " . implode(", ", $validDays) . "<br>"; // Test output

    // Step 2: Iterate through the date range, updating the document in sequence
    $rowIndexToUpdate = 1; // Row index to update
    $currentDate = clone $startDate;

    while ($currentDate <= $endDate) {
        $document = $service->documents->get($documentId); // Re-fetch the document to update content
        $content = $document->getBody()->getContent();

        if (in_array($currentDate->format('D'), $validDays)) {
            $tableElementFound = false;

            foreach ($content as $structuralElement) {
                if ($structuralElement->getTable()) {
                    $tableElementFound = true;
                    $table = $structuralElement->getTable();
                    $rows = $table->getTableRows();

                    if (isset($rows[$rowIndexToUpdate])) {
                        $row = $rows[$rowIndexToUpdate];
                        $cell = $row->getTableCells()[0];
                        $endIndex = $cell->getEndIndex() - 1;

                        // Update the cell
                        $updateText = " / " . $currentDate->format("D M d");
                        $request = new Google_Service_Docs_Request([
                            'insertText' => [
                                'location' => ['index' => $endIndex],
                                'text' => $updateText,
                            ]
                        ]);

                        // Send individual update request
                        $batchUpdateRequest = new Google_Service_Docs_BatchUpdateDocumentRequest(['requests' => [$request]]);
                        $service->documents->batchUpdate($documentId, $batchUpdateRequest);
                        echo "Updated row $rowIndexToUpdate with text: $updateText<br>"; // Test output

                        $rowIndexToUpdate++; // Move to the next row
                        break; // Exit the loop, continue to the next date
                    } else {
                        echo "No table row available for updating at index $rowIndexToUpdate<br>"; // Test output
                        break; // Exit the loop, no more rows to update
                    }
                }
            }

            if (!$tableElementFound) {
                echo "No table element found in the document.<br>"; // Test output
                break; // Exit the loop, no table in the document
            }
        }

        $currentDate->modify('+1 day');
    }
}

// Process form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $documentId = parseDocumentIdFromUrl($_POST['docLink']);
    $startDate = new DateTime($_POST['startDate']);
    $endDate = new DateTime($_POST['endDate']);

    if ($documentId) {
        updateDocument($service, $documentId, $startDate, $endDate);
    } else {
        echo "Invalid Google Docs link";
    }
}
?>

<form method="post" action="">
    <label for="docLink">Google Doc Link:</label>
    <input type="text" id="docLink" name="docLink"><br>
    <label for="startDate">Start Date (YYYY-MM-DD):</label>
    <input type="text" id="startDate" name="startDate"><br>
    <label for="endDate">End Date (YYYY-MM-DD):</label>
    <input type="text" id="endDate" name="endDate"><br>
    <input type="submit" value="Submit">
</form>
