<?php

class Connection{
  static function connection(){
    $username = "root";
    $password = "";
    $db = "Prague2.0";
    $server = "localhost";

    $conn = new mysqli($server, $username, $password, $db);

    return $conn;
  }
}