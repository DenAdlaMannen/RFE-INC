<?php
include_once "classes/Connection.php";
include_once "classes/park-class.php";
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
    <h1 class="headerTxt">PARK VEHICLE</h1>
</div>
 
<div class="main">
  <div class="menu">
  <button><a href="index.php">HOME</a></button>
  <button><a href="remove.php">REMOVE VEHICLE</a></button>
  <button><a href="search.php">SEARCH VEHICLE</a></button>
  <button><a href="view.php">VIEW ALL VEHICLES</a></button>
  </div>

  <div class="formContainer">
    <h3 class="formHeader">Enter vehicle information</h3>
    <div class="form">
    <form method="POST" action="classes/park-class.php">
      <label class="labelTxt">Registration number: </label><input type="Text" name="regNum" placeholder="Registration Number" class="field">
      <br>
      <label class="labelTxt">Type:</label>
      <input type="Radio" name="type" value="1"> MC
      <input type="Radio" name="type" value="2"> CAR
      <br>
      <input type="submit" value="Park" class="park">
    </form>
    </div>


    <?php

    ?>

  </div>
</div>

<?php

?>

  </div>


  
</body>
</html>