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
  <a href="index.php" class="btn">HOME</a>
  <a href="park.php" class="btn">PARK VEHICLE</a>
  <a href="remove.php" class="btn">REMOVE VEHICLE</a>
  <a href="search.php" class="btn">SEARCH VEHICLE</a>
</div>
<?php
$conn = Connection::connection();

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
  }

$query = 'SELECT RegNum, parkingspotid, vehicleinfoid, arrivaltime FROM VEHICLES;';
$result = $conn->query($query);

echo '<style>
table, th, td {
    border: 1px solid black;
 }</style>
 <table>
<tr>
   <th>Registration Number</th>
   <th>Parkingspot</th>
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
    .$info['RegNum'].'</th><th>'
    .$info['parkingspotid'].'</th><th>'
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