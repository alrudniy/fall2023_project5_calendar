<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  // Get data from the form
  $activity_lines = array_map('trim', explode("\n", $_POST["activity_lines"]));
  $start_date = $_POST["start_date"];
  $class_days = $_POST["class_days"];
  $class_name = $_POST["class_name"];




  // Process data and generate CSV content
  $csv_content = "Activity,Class Date\n";
  $week_counter = 0;




  foreach ($activity_lines as $activity_name) {
      $class_date = date('Y-m-d', strtotime($start_date . " +$week_counter weeks"));




      if (in_array(date('l', strtotime($class_date)), $class_days)) {
          // Add to CSV content
          $csv_content .= "$activity_name,$class_date\n";
      }




      $week_counter++;
  }




  // Get current date and time for the filename
  $currentDateTime = date('Ymd_His');




  // Construct the filename
  $filename = $class_name . '_schedule'. '.csv';




  // Store the schedule data in the file
  file_put_contents($filename, $csv_content);




  // Store the filename in a session variable for history
  session_start();
  if (!isset($_SESSION['generated_files'])) {
      $_SESSION['generated_files'] = [];
  }




  $_SESSION['generated_files'][] = $filename;




  // Set headers for file download
  header('Content-Type: text/csv');
  header('Content-Disposition: attachment; filename="' . $filename . '"');




  // Output CSV content
  echo $csv_content;
  exit();
}
?>

