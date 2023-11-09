<?php
$file = "example.doc"; // Name of the DOC file

if (file_exists($file)) {
    // Open the file
    $fp = fopen($file, "r");
    $content = fread($fp, filesize($file)); // Read the file content
    fclose($fp);

    // Convert the encoding to UTF-8
    $content = mb_convert_encoding($content, 'UTF-8', 'ASCII, UTF-8, ISO-8859-1');

    // Output the content of the DOC file to the web page
    echo nl2br($content); // nl2br() ensures that newlines are converted to <br> in HTML
} else {
    echo "File does not exist"; // Error message if the file is not found
}
?>
