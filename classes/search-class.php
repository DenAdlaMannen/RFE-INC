<?php
include_once 'Connection.php';
$conn = Connection::connection();
//searchvehicles();

function searchvehicles(){
    // OPEN NEW CONNECTION
$functionconn = Connection::connection();
//SETTING THE SEARCH UP
$submit = $_POST['RegNum'];
// IF EMPTY RETURN FAIL!
if (empty($result)){
    echo "That is not a valid registration number";
}
else{
//QUERY FOR SEARCHING THE DB
$sql = "SELECT RegNum, parkingspotid, arrivaltime FROM vehicles WHERE RegNum='$submit'";
$result = $functionconn->query($sql);
$row = $result->fetch_assoc();
//CLOSING CONNECTION
$functionconn->close();
    echo "The vehicle with registration number " . $row['RegNum'] . "<br> is parked at parkingspot " .$row['parkingspotid'] . "<br> and arrived at " . $row['arrivaltime'];  
return $row; 
}
}
?>
