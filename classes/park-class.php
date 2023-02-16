<?php
include_once 'Connection.php';

//OPEN CONNECTION TO DB
$conn = Connection::connection();

//CLOSE CONNECTION TO DB
$conn->close();

