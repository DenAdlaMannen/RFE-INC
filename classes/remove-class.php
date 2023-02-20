<?php
include_once 'vehicle-class.php';
include_once 'Connection.php';

//$vehicleCost = 80;
// $arrivalTime = "2023-02-16 10:00:00";
// calculateCost($vehicleCost, $arrivalTime);

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
//körd
function removeVehicle($regNum){

    //OPEN NEW CONNECTION
    $functionConn = Connection::connection();

    //QUERY TO RUN
    $query = $functionConn->prepare("DELETE FROM vehicles WHERE regnum = ? ");
    $query->bind_param("s", $regNum);
    $query->execute();

    if ($query)
    {
        return true;
    }

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
//körd
function getCost($vehicleType){

   //OPEN NEW CONNECTION
  $functionConn = Connection::connection();

  //QUERY TO RUN
  $query = "SELECT cost FROM vehicleinfo WHERE vehicleinfoID = $vehicleType";

  //RUN THE QUERY
  $exec = $functionConn->query($query); 

  $temp = mysqli_fetch_array($exec);
  $vehicleCost = $temp['cost'];
  return $vehicleCost;
}
//körd
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
    
    $totalCost = $vehicleCost * ($diffInHours + 1);
    
    return $totalCost;

}
//körd
?>