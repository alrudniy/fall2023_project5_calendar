<!DOCTYPE html>
<head>
<meta name="generator" content="class schedule, initial-scale=1">
<style>
body {
 font-family: Arial;
 color: black;
 margin: 0;
 display: flex;
 height: 100vh;
}




.left {
 flex: 1;
 background-color: lightgrey;
 text-align: center;
}


.right {
 flex: 3;
 padding-left: 20px;
}


p{
 font-size:13px;
 color: grey;
 font-style:italic;
 text-align: center;
}
.special{
 color: red;
}
</style>
</head>


<body>
<div class="left">
   <h1>History</h1>
   <p>Previously generated documents...</p>
   <?php
   // Fetch the list of generated files from the session
   session_start();
   if (isset($_SESSION['generated_files']) && count($_SESSION['generated_files']) > 0) {
       foreach ($_SESSION['generated_files'] as $file) {
           echo '<p><a href="download.php?file=' . $file . '" download>' . $file . '</a></p>';
       }
   } else {
       echo '<p>No files generated yet.</p>';
   }
   ?>
</div>


<div class="right">
 <h1><center>Generate Your Schedule</center></h1>
   <form method="post" action="generate_file.php">
   <span class="special"> * </span>Class name: <input type="text" id="name" name="name" placeholder="CSCI 150" required><br><br/>
       Upload your current class schedule: <input type="file" id="uploaded_file" name="filename"
                                                 accept=".doc,.docx,.xml,application/msword,application/vnd.openxmlformats-officedocument.wordprocessingml.document" /><br>
                                                 <br/>
   <strong>OR</strong>
   <br><br>
      <form action="generate_file.php" method="post">
      <label for="activity_lines">Paste Schedule:</label>
      <br>
      <textarea name="activity_lines" id="activity_lines" rows="4" cols="50" required></textarea>
      <br><br>
      <span class="special"> * </span>Start date: <input type="date" id="start_date" name="start_date" required><br/><br/>
    
      <label><span class="special"> * </span>Class meets on:</label>
      <input type="checkbox" name="class_days[]" value="Monday"> Monday
      <input type="checkbox" name="class_days[]" value="Tuesday"> Tuesday
      <input type="checkbox" name="class_days[]" value="Wednesday"> Wednesday
      <input type="checkbox" name="class_days[]" value="Thursday"> Thursday
      <input type="checkbox" name="class_days[]" value="Friday"> Friday
      <input type="checkbox" name="class_days[]" value="Saturday"> Saturday
      <input type="checkbox" name="class_days[]" value="Sunday"> Sunday
    
      <br>
      <br>
       Optional: Insert dates class does not meet: <input type="text" id="exception"name="exception" placeholder="mmddyyyy">
       <p>
         <span class="special"> ** </span>
       Separate each date with a comma following the format
       <span class="special"> ** </span>
       </p><br>
       <center><input type="submit" value="Generate Schedule"> </center>
   </form>
</div>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Activity Schedule</title>
</head>
</html>
