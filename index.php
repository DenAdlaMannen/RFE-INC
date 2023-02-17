<?php
include_once "classes/Connection.php";
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  <link rel="stylesheet" href="styles.css">
</head>
<body>
  <div class="container">

  <div class="header">  
    <h1 class="headerTxt">PARK IN PRAGUE</h1>
</div>
 
<div class="main">
  <div class="menu">
  <a href="park.php" class="btn">PARK VEHICLE</a>
  <a href="remove.php" class="btn">REMOVE VEHICLE</a>
  <a href="search.php" class="btn">SEARCH VEHICLE</a>
  <a href="view.php" class="btn">VIEW ALL VEHICLES</a>
  </div>
</div>

<?php
$conn = Connection::connection();

if($conn->connect_error) {
  die("Connection failed.");
}
else {
  echo "WOHO!";
}

$conn->close();



?>

  </div>


  
</body>
</html>