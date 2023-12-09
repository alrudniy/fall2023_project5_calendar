<?php
if (isset($_GET['file'])) {
   $file = $_GET['file'];
   $filepath = $file;


   if (file_exists($filepath)) {
       header('Content-Type: application/octet-stream');
       header('Content-Disposition: attachment; filename="' . basename($filepath) . '"');
       readfile($filepath);
       exit;
   } else {
       echo 'File not found.';
   }
} else {
   echo 'Invalid request.';
}
?>
