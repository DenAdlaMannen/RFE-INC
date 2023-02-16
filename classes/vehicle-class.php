<?php

class Vehicle {

  public $regNum = "";
  public $parkingSpot = 0;
  public $vehicleInfo = 0;
  public $arrivalTime;

  function __construct($regNum, $parkingSpot, $vehicleInfo, $arrivalTime)
  {
    $this->regNum = $regNum;
    $this->parkingSpot = $parkingSpot;
    $this->vehicleInfo = $vehicleInfo;
    $this->arrivalTime = $arrivalTime;
  }

  function returnRegNum(){
    return $this->regNum;
  }
  function returnParkingSpot(){
    return $this->parkingSpot;
  }
  function returnVehicleInfo(){
    return $this->vehicleInfo;
  }
  function returnArrivalTime(){
    return $this->arrivalTime;
  }

}