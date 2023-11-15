<!DOCTYPE html>
<head>
<meta name="generator" content="class schedule, initial-scale=1">
<style>
body {
  font-family: Arial;
  color: white;
}

.split {
  height: 100%;
  position: fixed;
  z-index: 1;
  top: 0;
  overflow-x: hidden;
  padding-top: 20px;
}

.left {
  left: 0;
  width: 25%;
}

.right {
  right: 0;
  width: 75%;
}

.centered {
  position: absolute;
  top: 50%;
  left: 50%;
  transform: translate(-50%, -50%);
  text-align: center;
}

.centered img {
  width: 150px;
  border-radius: 50%;
}
</style>
</head>
<body>

<div class="split left">
    <h2>History</h2>
    <p>Some text.</p>
</div>

<div class="split right">
  <div class="centered">
    <h2>John Doe</h2>
    <p>Some text here too.</p>
  </div>
</div>
     
</body>
</html> 
