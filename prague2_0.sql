-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Värd: 127.0.0.1
-- Tid vid skapande: 20 feb 2023 kl 14:40
-- Serverversion: 10.4.27-MariaDB
-- PHP-version: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Databas: `prague2.0`
--

-- --------------------------------------------------------

--
-- Tabellstruktur `parkinglot`
--

CREATE TABLE `parkinglot` (
  `ParkingSpotID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumpning av Data i tabell `parkinglot`
--

INSERT INTO `parkinglot` (`ParkingSpotID`) VALUES
(1),
(2),
(3),
(4),
(5),
(6),
(7),
(8),
(9),
(10);

-- --------------------------------------------------------

--
-- Tabellstruktur `vehicleinfo`
--

CREATE TABLE `vehicleinfo` (
  `VehicleInfoID` int(11) NOT NULL,
  `VehicleType` varchar(15) DEFAULT NULL,
  `Cost` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumpning av Data i tabell `vehicleinfo`
--

INSERT INTO `vehicleinfo` (`VehicleInfoID`, `VehicleType`, `Cost`) VALUES
(1, 'MC', 40),
(2, 'CAR', 80);

-- --------------------------------------------------------

--
-- Tabellstruktur `vehicles`
--

CREATE TABLE `vehicles` (
  `RegNum` varchar(15) NOT NULL,
  `ParkingSpotID` int(11) NOT NULL,
  `VehicleInfoID` int(11) NOT NULL,
  `ArrivalTime` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumpning av Data i tabell `vehicles`
--

INSERT INTO `vehicles` (`RegNum`, `ParkingSpotID`, `VehicleInfoID`, `ArrivalTime`) VALUES
('def444', 2, 1, '2023-02-20 14:36:56');

--
-- Index för dumpade tabeller
--

--
-- Index för tabell `parkinglot`
--
ALTER TABLE `parkinglot`
  ADD PRIMARY KEY (`ParkingSpotID`);

--
-- Index för tabell `vehicleinfo`
--
ALTER TABLE `vehicleinfo`
  ADD PRIMARY KEY (`VehicleInfoID`);

--
-- Index för tabell `vehicles`
--
ALTER TABLE `vehicles`
  ADD PRIMARY KEY (`RegNum`),
  ADD KEY `ParkingSpotID` (`ParkingSpotID`),
  ADD KEY `VehicleInfoID` (`VehicleInfoID`);

--
-- Restriktioner för dumpade tabeller
--

--
-- Restriktioner för tabell `vehicles`
--
ALTER TABLE `vehicles`
  ADD CONSTRAINT `vehicles_ibfk_1` FOREIGN KEY (`ParkingSpotID`) REFERENCES `parkinglot` (`ParkingSpotID`),
  ADD CONSTRAINT `vehicles_ibfk_2` FOREIGN KEY (`VehicleInfoID`) REFERENCES `vehicleinfo` (`VehicleInfoID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
