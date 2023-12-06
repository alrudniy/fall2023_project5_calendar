<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <title>Activity Schedule</title>
</head>
<body>
   <form action="generate_file.php" method="post">
       <label for="activity_lines">Paste Schedule:</label>
       <br>
       <textarea name="activity_lines" id="activity_lines" rows="4" cols="50" required></textarea>
      
       <br>
      
       <label for="start_date">Start Date:</label>
       <input type="date" name="start_date" id="start_date" required>
      
       <br>
      
       <label>Class meets on:</label>
       <input type="checkbox" name="class_days[]" value="Monday"> Monday
       <input type="checkbox" name="class_days[]" value="Tuesday"> Tuesday
       <input type="checkbox" name="class_days[]" value="Wednesday"> Wednesday
       <input type="checkbox" name="class_days[]" value="Thursday"> Thursday
       <input type="checkbox" name="class_days[]" value="Friday"> Friday
       <input type="checkbox" name="class_days[]" value="Saturday"> Saturday
       <input type="checkbox" name="class_days[]" value="Sunday"> Sunday
      
       <br>
      
       <input type="submit" value="Generate Schedule">
   </form>


   <!-- Display history links on the left-hand side -->
   <div style="float: left; width: 30%;">
       <h2>History</h2>
       <?php
       // Fetch the list of generated files from the session
       session_start();
       if (isset($_SESSION['generated_files']) && count($_SESSION['generated_files']) > 0) {
           foreach ($_SESSION['generated_files'] as $file) {
               echo '<p><a href="download.php?file=' . $file . '">' . $file . '</a></p>';
           }
       } else {
           echo '<p>No files generated yet.</p>';
       }
       ?>
   </div>
</body>
</html>
