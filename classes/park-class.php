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

  $merge = array_merge($emptySpots, $result);
  $functionConn->close();

  // $doubleMcSpots = doubleMcSpots();

  // if(isset($doubleMcSpots)) 
  // {
  //   $allAvailableMcSpots = array_diff($merge, $doubleMcSpots);
  // }

  // //CLOSE CONENCTION

  return $merge;

  
}

function allEmptyMcSpots(){
  $emptySpots = emptyMCSpots();
  $dublicatesMcSpots = doubleMcSpots();
  $allAvailableMcSpots = array_diff($emptySpots, $dublicatesMcSpots);
  return $allAvailableMcSpots;
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

$va = allEmptyMcSpots();
foreach ($va as $value) {
 echo $value;
}

// //CLOSE CONNECTION TO DB
// $conn->close();

