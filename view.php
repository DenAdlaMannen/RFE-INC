<?php
include_once "classes/Connection.php";
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
  <button><a href="index.php">HOME</a></button>  
  <button><a href="park.php">PARK VEHICLE</a></button>
  <button><a href="remove.php">REMOVE VEHICLE</a></button>
  <button><a href="search.php">SEARCH VEHICLE</a></button>  
</div>
<?php
$conn = Connection::connection();

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
  }

$query = 'SELECT RegNum, parkingspotid, IF (VehicleInfoID = 1, "MC", "CAR") AS vehicleinfoid, arrivaltime FROM VEHICLES
ORDER BY ParkingSpotID ASC;';

$result = $conn->query($query);

// $result = array_merge($emptySpots, $result);


echo '<style>
table, th, td {
    border: 1px solid black;
    background-color: rgb(124, 134, 165, 0.5);
 }</style>
 <table>
<tr>
   <th>Parkingspot</th>
   <th>Registration Number</th>
   <th>Vehicle Type</th>
   <th>Arrival Time</th>
</tr>
</table>';


if ($result != null)
{
    foreach ($result as $info)
    {
    echo '<style>table, th, td {border: 1px solid black; min-width: 10rem;}</style>
    <table><th>'
    .$info['parkingspotid'].'</th><th>'
    .$info['RegNum'].'</th><th>'
    .$info['vehicleinfoid'].'</th><th>'
    .$info['arrivaltime'].'</th></table>';
    } 
}

$conn->close();



?>
</div>



  </div>


  
</body>
</html>