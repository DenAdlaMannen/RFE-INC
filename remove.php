<?php
include_once "classes/Connection.php";
include_once 'classes/remove-class.php';
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
            <a href="search.php" class="btn">SEARCH VEHICLE</a>
            <a href="view.php" class="btn">VIEW ALL VEHICLES</a>
            </div>

            <div class="formContainer">
                <h3 class="formHeader">Choose your vehicle to depart.</h3>
                <div class="form">
                    <form action="" method="post">
                        <select name="Vehicle">
                        <?php
                            $regNum = getAllRegNums();
                            for ($i=0; $i < count($regNum); $i++) 
                            { 
                            echo "<option value='$regNum[$i]'>" . $regNum[$i] . "</option>";
                            }
                        ?>
                        </select>  
                        <input type="submit" name="TEST" value="Submit">            
                    </form>
                    <?php

                        if (isset($_POST['TEST']))
                        {

                            $regNum = $_POST['Vehicle'];
                            
                            //FUNKAR 
                            echo'<br>';
                            echo $_POST['Vehicle'];



                        }
                        
                        ?>  
                </div>
            </div>
        </div>
    </div>
</body>
</html>