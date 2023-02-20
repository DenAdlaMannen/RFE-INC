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
  <button><a href="park.php">PARK VEHICLE</a></button>
  <button><a href="remove.php">REMOVE VEHICLE</a></button>
  <button><a href="search.php">SEARCH VEHICLE</a></button>
  <button><a href="view.php">VIEW ALL VEHICLES</a></button>
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