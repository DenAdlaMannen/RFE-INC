<?php
include_once 'vehicle-class.php';
include_once 'Connection.php';

$vehicleCost = 80;
$arrivalTime = "2023-02-16 10:00:00";
calculateCost($vehicleCost, $arrivalTime);

function getAllRegNums(){

  //OPEN NEW CONNECTION
  $functionConn = Connection::connection();

  //QUERY TO RUN
  $query = "SELECT RegNum FROM vehicles";

  //RUN THE QUERY
  $exec = $functionConn->query($query);

  //GETS THE LICENSEPLATES OF ALL PARKED VEHICLES
  while($row=mysqli_fetch_array($exec)) 
  {
      $result[] = $row['RegNum'];
  }

  return $result;
}

function removeVehicle($regNum){

    //OPEN NEW CONNECTION
    $functionConn = Connection::connection();

    //QUERY TO RUN
    $query = "SELECT RegNum FROM vehicles";

    //RUN THE QUERY
    $exec = $functionConn->query($query);


}

function getVehicle($regNum){

    //OPEN NEW CONNECTION
    $functionConn = Connection::connection();

    //QUERY TO RUN
    $query = "SELECT * FROM vehicles WHERE regnum = '$regNum'";
    
    //RUN THE QUERY
    $exec = $functionConn->query($query);

    foreach ($exec as $keys) 
    {
        $regNum = $keys['RegNum'];
        $parkingSpot = $keys['ParkingSpotID'];
        $vehicleInfo = $keys['VehicleInfoID'];
        $arrivalTime = $keys['ArrivalTime'];
    }

    $calcVehicle = new Vehicle($regNum, $parkingSpot, $vehicleInfo, $arrivalTime);

    return $calcVehicle;

}

function getCost($vehicletype){

   //OPEN NEW CONNECTION
  $functionConn = Connection::connection();

  //QUERY TO RUN
  $query = "SELECT cost FROM vehicleinfo WHERE vehicleinfoID = $vehicletype";

  //RUN THE QUERY
  $exec = $functionConn->query($query); 

  $temp = mysqli_fetch_array($exec);
  $vehicleCost = $temp['cost'];
  return $vehicleCost;
}

function calculateCost($vehicleCost, $arrivalTime){
    $datetime1 = date_create($arrivalTime);
    $datetime2 = date_create();

    $interval = date_diff($datetime1, $datetime2);

    $diffInDays = $interval->d;
    $diffInHours = $interval->h; 

    if ($diffInDays > 0)
    {
        $diffInHours += ($diffInDays * 24);
    }
    
    $totalCost = $vehicleCost * $diffInHours;

    print_r($totalCost);

}
?>