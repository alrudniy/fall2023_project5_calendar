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
</div>

<div class="right">
  <h1><center>Generate your class schedule</center></h1>
    <form method="post" action="upload.php">
        Class name: <input type="text" id="name" name="name" required><br><br/>
        Upload your current class schedule: <input type="file" id="uploaded_file" name="filename" 
                                                  accept=".doc,.docx,.xml,application/msword,application/vnd.openxmlformats-officedocument.wordprocessingml.document" />><br><br/>
        Start date: <input type="date" id="start_date" name="start_date" required><br/><br/>
        End date: <input type="date" id="end_date" name="end_date" required><br/><br/>
        When does class meet: <select id="cars" name="cars" size="5" multiple required>
          <option id="day.m" value="monday">Monday</option>
          <option id="day.t" value="tuesday">Tuesday</option>
          <option id="day.w" value="wednesday">Wednesday</option>
          <option id="day.r" value="thursday">Thursday</option>
          <option id="day.f" value="friday">Friday</option>
        </select><br><br>
        <p> 
          <span class="special"> ** </span>
        Hold down the Ctrl (windows) / Command (Mac) button to select multiple options 
        <span class="special"> ** </span>
        </p><br><br>
        What dates do you not want to include? <input type="text" id="exception"name="exception"><br/><br/>
        <center><input type="submit" value="Submit" style="height:auto; width:auto;font-size:500px" > </center>
    </form>
</div>
 

<!--
  How to interpret the multiple dates:
  if(isset($_POST['excemption'])){
    foreach (explode(' ', $_POST['excemption']) as $key => $value){
        ${'var'.$key} = $value
    }
}
?>
-->

</body>
</html> 
