<?php
include_once 'Connection.php';
$conn = Connection::connection();
//searchvehicles();

function searchvehicles($regNum){
    // OPEN NEW CONNECTION
$functionConn = Connection::connection();
// IF EMPTY RETURN FAIL!
if (empty($regNum)){
    echo "That is not a valid registration number";
}
else{
//PREPARING THE QUERY
$query = "SELECT RegNum, parkingspotid, arrivaltime FROM vehicles WHERE RegNum=?";   
$stmt = $functionConn->prepare($query);
//INSERT VARIBLES
$stmt->bind_param('s', $regNum);
//EXECUTE
$stmt->execute();
//GET THE RESULT
$result = $stmt->get_result();
$row = $result->fetch_assoc();
//CLOSING CONNECTION
$functionConn->close();
if($row == 0){
echo "No vehicle with that registration number on this parkinglot.";
}
else{
echo "The vehicle with registration number: " . $row['RegNum'] . "<br> is parked at parkingspot: " .$row['parkingspotid'] . "<br> and arrived at: " . $row['arrivaltime'];   
}
}
}
?>
