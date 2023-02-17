<?php
include_once "classes/Connection.php";
include_once "classes/search-class.php";

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
<a href="index.php" class="btn">HOME</a>
  <a href="park.php" class="btn">PARK VEHICLE</a>
  <a href="remove.php" class="btn">REMOVE VEHICLE</a>  
  <a href="view.php" class="btn">VIEW ALL VEHICLES</a>
  <form method="post" action="">
  <label for="RegNum">Insert registration number:</label><br>
  <input type="text" name="RegNum" ><br><br>
  <input type="submit" value="Submit"></form>
  
  <?php 
  if (isset($_POST['submit'])){  
  searchvehicles(); 
  }
  ?>

</div>
</div>  
</body>
</html>