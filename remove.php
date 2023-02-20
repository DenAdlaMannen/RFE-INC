<?php
include_once "classes/Connection.php";
include_once 'classes/remove-class.php';
include_once 'classes/vehicle-class.php'; 
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

                            // GETS USER INPUT REGNUM TO REMOVE FROM THE LOT
                            $regNum = $_POST['Vehicle'];

                            // INSTANCIATES A VEHICLE OBJECT BASED ON THE VEHICLE FROM THE DB
                            $removeVehicle = getVehicle($regNum);

                            // Extracts vehicletype from the object, 1 = MC 2 = CAR
                            $vehicleType = $removeVehicle->vehicleInfo;

                            //Extracts the arrivaltime from the object.
                            $arrivalTime = $removeVehicle->arrivalTime;

                            //GET THE CORRECT COST TARIFF FROM THE DB DEPENDING ON VTYPE
                            $vehicleCost = getCost($vehicleType);

                            // CALCULATES PRICE OF PARKING BY DIFF ARRIVALTIME AND A DATETIME NOW.
                            $totalCost = calculateCost($vehicleCost, $arrivalTime);

                            // REMOVES THE VEHICLE FROM THE DATABASE AND CREATES RECEIPT.
                            if(removeVehicle($regNum))
                            {
                                switch ($vehicleType)
                                {
                                    case 1: echo "<br>MC $regNum  Arrived: $arrivalTime.
                                    <br> Total cost is $totalCost Kr.
                                    <br> Thank you for your visit!";
                                    break;

                                    case 2: echo "<br>Car $regNum  Arrived: $arrivalTime.
                                    <br> Total cost is $totalCost Kr.
                                    <br> Thank you for your visit!";
                                }
                            }

                        }
                        
                        ?>  
                </div>
            </div>
        </div>
    </div>
</body>
</html>