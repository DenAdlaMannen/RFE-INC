<?php
include_once 'Connection.php';

//OPEN CONNECTION TO DB
$conn = Connection::connection();

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
  $emptySpots = emptyCarSpots();
  
}



//CLOSE CONNECTION TO DB
$conn->close();

