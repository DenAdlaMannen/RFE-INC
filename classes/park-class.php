<?php
include_once 'Connection.php';

// //OPEN CONNECTION TO DB
// $conn = Connection::connection();

function emptyCarSpots(){

  //OPEN NEW CONNECTION
  $functionConn = Connection::connection();

  //QUERY TO RUN
  $query = "select ParkingSpotID 
  from parkinglot
  where parkinglot.ParkingSpotID NOT IN (select ParkingSpotID from vehicles)";

  //RUN THE QUERY
  $runQuery = mysqli_query($functionConn, $query);

  //ADD EACH RESULT FROM THE DB TO $result[], THE BRACKETS ARE IMPORTANT FOR THIS TO WORK!
  while($row = mysqli_fetch_array($runQuery)) { 
    $result[] = $row["ParkingSpotID"];
  }

  // RETURNS THE ARRAY WITH ALL PARKINSPOTS AVAILABLE FOR A CAR
  if(isset($result))
  return $result;
  $functionConn->close();
}

function emptyMCSpots(){
  //GET ALL EMPTY SPOTS FROM VEHICLE FUNCTION
  $emptySpots = emptyCarSpots();

  //OPEN CONNECTION
  $functionConn = Connection::connection();

  //QUERY
  $query = "SELECT parkinglot.ParkingSpotID
  FROM parkinglot
  INNER JOIN vehicles
  ON vehicles.VehicleInfoID = 1
  WHERE parkinglot.ParkingSpotID = vehicles.ParkingSpotID;";


  $runQuery = mysqli_query($functionConn, $query);

  while($row = mysqli_fetch_array($runQuery)) {
    $result[] = $row["ParkingSpotID"];
  }

  if($emptySpots > 0 && $result > 0) {
    $merge = array_merge($emptySpots, $result);
    return $merge;
  }
  else if ($emptySpots > 0) {
    return $emptySpots;
  }
  else if($result > 0) {
    return $result;
  }

  $functionConn->close();

  // $doubleMcSpots = doubleMcSpots();

  // if(isset($doubleMcSpots)) 
  // {
  //   $allAvailableMcSpots = array_diff($merge, $doubleMcSpots);
  // }

  // //CLOSE CONENCTION



  
}

function allEmptyMcSpots(){
  $emptySpots = emptyMCSpots();
  $dublicatesMcSpots = doubleMcSpots();
  $allAvailableMcSpots = array_diff($emptySpots, $dublicatesMcSpots);
  if($allAvailableMcSpots > 0)
  {
    return $allAvailableMcSpots;
  }
  else
  {
    return 0;
  }

}


function doubleMcSpots(){
  $check = emptyMCSpots(); //2, 3, 4, 6, 7, 2, 9, 10
  

  //COUNTS ALL PARKIN SPOTS
  $counts = array_count_values($check);

  // print_r($counts);
  $arrayOfDublicates = array();

  //CHECK IF A PARKINSPOT CONTAINS MORE THAN 1 VEHICLE
  foreach ($counts as $key => $value) {
    if ($value > 1) {
      array_push($arrayOfDublicates, $key);
    }
  }
  return $arrayOfDublicates;
}

//PRINT ALL EMPTY MC SPOTS
// $va = allEmptyMcSpots();
// foreach ($va as $value) {
//  echo $value;
// }



if(isset($_POST["regNum"]) && isset($_POST["type"])) 
{
  $conn = Connection::connection();
  if($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
  }
  else{

    //GET USER DATA
    $regNum = $_POST["regNum"];
    $type = $_POST["type"];

    //CHECK TYPE, IF MC OR CAR AND THAT THERE IS SPACE LEFT ON THE PARKINGLOT
    if($type == 2 && emptyCarSpots() > 0)
    {
      $emptySpots = emptyCarSpots(); //GET THE FIRST VALUE OF THE ARRAY AS PARKINGSPOT FOR CAR
      //$date = date("Y-m-d h:i:sa");  //// FOR OOP, IS THIS NECESSARY? 
    
    //$car = new Vehicle($regNum, $emptySpots[0], 2, $date);

    //PREPARED QUERY
    $query = $conn->prepare("INSERT INTO vehicles (RegNum, vehicleinfoID, parkingspotID, ArrivalTime)
    VALUES ( ? , ? , ? , CURRENT_TIMESTAMP());");
    $query->bind_param("sii", $regNum, $type, $emptySpots[0]);
    //$query->bind_param("siis", $car->regNum, $car->parkingSpot, $car->vehicleInfo, $car->arrivalTime); //// FOR OOP
    $query->execute();

    echo "Vehicle Successfully added!";

    }
    //RETURNS DIFFERENT TYPE OF NULL ARRAY, WHICH NEEDS TO BE CHECKED WITH COUNT FUNCTION
    else if ($type == 1 && count(allEmptyMcSpots()) > 0)
    {
      $emptySpots = allEmptyMcSpots(); //GET THE FIRST VALUE OF THE ARRAY AS PARKINGSPOT FOR MC
      $emptySpots = array_reverse($emptySpots); //REVERSE THE ARRAY TO GET ALL MC SPOTS IF ANY TO BE PRIORITIZED.

      //PREPARED QUERY
      $query = $conn->prepare("INSERT INTO vehicles (RegNum, vehicleinfoID, parkingspotID, ArrivalTime)
      VALUES ( ? , ? , ? , CURRENT_TIMESTAMP());");
      $query->bind_param("sii", $regNum, $type, $emptySpots[0]);
      $query->execute();
      //header("Location: ../park.php");
      $parkedSuccessfully = true;
      echo '<script>alert("The parkinglot is full.")</script>';
    }
    else{
      $parkedSuccessfully = false;
      //header("Location: ../park.php");
      echo '<script>alert("The parkinglot is full.")</script>';
    }
  }
}



// //CLOSE CONNECTION TO DB
// $conn->close();

