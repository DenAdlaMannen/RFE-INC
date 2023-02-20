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
  <div class="menu">
  <a href="index.php" class="btn">HOME</a>
  <a href="park.php" class="btn">PARK VEHICLE</a>
  <a href="remove.php" class="btn">REMOVE VEHICLE</a>  
  <a href="view.php" class="btn">VIEW ALL VEHICLES</a>
  </div>  
  <div class="formContainer">
    <h3 class="formHeader">Enter vehicle information</h3>
    <div class="form">
    <form method="POST" action="">
      <label class="labelTxt" for="RegNum">Registration number: </label>
      <input type="Text" name="RegNum" class="field">      
      <input type="submit" name="submit" value="Submit" class="park">
    </form>
    <?php 
    if (isset($_POST['submit'])){
      $regNum = $_POST['RegNum'];

    searchvehicles($regNum); 
    }
    ?>
  </div>
  

  

</div>
</div>  
</body>
</html>