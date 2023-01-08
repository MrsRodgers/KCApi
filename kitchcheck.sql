-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 08, 2023 at 01:55 PM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.1.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `kitchcheck`
--

-- --------------------------------------------------------

--
-- Table structure for table `appcleaningduty`
--

CREATE TABLE `appcleaningduty` (
  `AppCleaningDutyID` int(11) NOT NULL,
  `CleaningDuty` varchar(200) DEFAULT NULL,
  `DutyDate` int(10) DEFAULT NULL,
  `ManagerID` int(10) DEFAULT NULL,
  `UnitID` int(10) DEFAULT NULL,
  `CompletionStatus` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `apptemperature`
--

CREATE TABLE `apptemperature` (
  `AppTemperatureID` int(11) NOT NULL,
  `ItemName` varchar(200) DEFAULT NULL,
  `ItemTemperature` int(10) DEFAULT NULL,
  `TemperatureDate` date DEFAULT NULL,
  `TemperatureTime` time DEFAULT NULL,
  `UnitID` int(10) DEFAULT NULL,
  `ManagerID` int(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `employee`
--

CREATE TABLE `employee` (
  `EmployeeID` int(10) NOT NULL,
  `EmployeeName` varchar(200) DEFAULT NULL,
  `EmployeePassword` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `manager`
--

CREATE TABLE `manager` (
  `ManagerID` int(10) NOT NULL,
  `EmployeeID` int(10) DEFAULT NULL,
  `ManagerName` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `nonappcleaningduty`
--

CREATE TABLE `nonappcleaningduty` (
  `NonAppCleaningDutyID` int(11) NOT NULL,
  `CleaningDuty` varchar(200) DEFAULT NULL,
  `DutyDate` int(10) DEFAULT NULL,
  `EmployeeID` int(10) DEFAULT NULL,
  `UnitID` int(10) DEFAULT NULL,
  `CompletionStatus` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `nonapptemperature`
--

CREATE TABLE `nonapptemperature` (
  `NonAppTemperatureID` int(11) NOT NULL,
  `ItemName` varchar(200) DEFAULT NULL,
  `ItemTemperature` int(10) DEFAULT NULL,
  `TemperatureDate` date DEFAULT NULL,
  `TemperatureTime` time DEFAULT NULL,
  `UnitID` int(10) DEFAULT NULL,
  `EmployeeID` int(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `riskapptemperature`
--

CREATE TABLE `riskapptemperature` (
  `RiskAppTemperatureID` int(11) NOT NULL,
  `ItemName` varchar(200) DEFAULT NULL,
  `ItemTemperature` int(10) DEFAULT NULL,
  `TemperatureDate` date DEFAULT NULL,
  `TemperatureTime` time DEFAULT NULL,
  `UnitID` int(10) DEFAULT NULL,
  `ManagerID` int(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `risknonapptemperature`
--

CREATE TABLE `risknonapptemperature` (
  `RiskNonAppTemperatureID` int(11) NOT NULL,
  `ItemName` varchar(200) DEFAULT NULL,
  `ItemTemperature` int(10) DEFAULT NULL,
  `TemperatureDate` date DEFAULT NULL,
  `TemperatureTime` time DEFAULT NULL,
  `UnitID` int(10) DEFAULT NULL,
  `EmployeeID` int(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `unit`
--

CREATE TABLE `unit` (
  `UnitID` int(10) NOT NULL,
  `Location` varchar(200) DEFAULT NULL,
  `UnitName` varchar(50) DEFAULT NULL,
  `ManagerID` int(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `appcleaningduty`
--
ALTER TABLE `appcleaningduty`
  ADD PRIMARY KEY (`AppCleaningDutyID`),
  ADD KEY `UnitID` (`UnitID`),
  ADD KEY `ManagerID` (`ManagerID`);

--
-- Indexes for table `apptemperature`
--
ALTER TABLE `apptemperature`
  ADD PRIMARY KEY (`AppTemperatureID`),
  ADD KEY `UnitID` (`UnitID`),
  ADD KEY `ManagerID` (`ManagerID`);

--
-- Indexes for table `employee`
--
ALTER TABLE `employee`
  ADD PRIMARY KEY (`EmployeeID`);

--
-- Indexes for table `manager`
--
ALTER TABLE `manager`
  ADD PRIMARY KEY (`ManagerID`),
  ADD KEY `EmployeeID` (`EmployeeID`);

--
-- Indexes for table `nonappcleaningduty`
--
ALTER TABLE `nonappcleaningduty`
  ADD PRIMARY KEY (`NonAppCleaningDutyID`),
  ADD KEY `UnitID` (`UnitID`),
  ADD KEY `EmployeeID` (`EmployeeID`);

--
-- Indexes for table `nonapptemperature`
--
ALTER TABLE `nonapptemperature`
  ADD PRIMARY KEY (`NonAppTemperatureID`),
  ADD KEY `UnitID` (`UnitID`),
  ADD KEY `EmployeeID` (`EmployeeID`);

--
-- Indexes for table `riskapptemperature`
--
ALTER TABLE `riskapptemperature`
  ADD PRIMARY KEY (`RiskAppTemperatureID`),
  ADD KEY `UnitID` (`UnitID`),
  ADD KEY `ManagerID` (`ManagerID`);

--
-- Indexes for table `risknonapptemperature`
--
ALTER TABLE `risknonapptemperature`
  ADD PRIMARY KEY (`RiskNonAppTemperatureID`),
  ADD KEY `UnitID` (`UnitID`),
  ADD KEY `EmployeeID` (`EmployeeID`);

--
-- Indexes for table `unit`
--
ALTER TABLE `unit`
  ADD PRIMARY KEY (`UnitID`),
  ADD KEY `ManagerID` (`ManagerID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `appcleaningduty`
--
ALTER TABLE `appcleaningduty`
  MODIFY `AppCleaningDutyID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `apptemperature`
--
ALTER TABLE `apptemperature`
  MODIFY `AppTemperatureID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `nonappcleaningduty`
--
ALTER TABLE `nonappcleaningduty`
  MODIFY `NonAppCleaningDutyID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `nonapptemperature`
--
ALTER TABLE `nonapptemperature`
  MODIFY `NonAppTemperatureID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `riskapptemperature`
--
ALTER TABLE `riskapptemperature`
  MODIFY `RiskAppTemperatureID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `risknonapptemperature`
--
ALTER TABLE `risknonapptemperature`
  MODIFY `RiskNonAppTemperatureID` int(11) NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `appcleaningduty`
--
ALTER TABLE `appcleaningduty`
  ADD CONSTRAINT `appcleaningduty_ibfk_1` FOREIGN KEY (`UnitID`) REFERENCES `unit` (`UnitID`),
  ADD CONSTRAINT `appcleaningduty_ibfk_2` FOREIGN KEY (`ManagerID`) REFERENCES `manager` (`ManagerID`);

--
-- Constraints for table `apptemperature`
--
ALTER TABLE `apptemperature`
  ADD CONSTRAINT `apptemperature_ibfk_1` FOREIGN KEY (`UnitID`) REFERENCES `unit` (`UnitID`),
  ADD CONSTRAINT `apptemperature_ibfk_2` FOREIGN KEY (`ManagerID`) REFERENCES `manager` (`ManagerID`);

--
-- Constraints for table `manager`
--
ALTER TABLE `manager`
  ADD CONSTRAINT `manager_ibfk_1` FOREIGN KEY (`EmployeeID`) REFERENCES `employee` (`EmployeeID`);

--
-- Constraints for table `nonappcleaningduty`
--
ALTER TABLE `nonappcleaningduty`
  ADD CONSTRAINT `nonappcleaningduty_ibfk_1` FOREIGN KEY (`UnitID`) REFERENCES `unit` (`UnitID`),
  ADD CONSTRAINT `nonappcleaningduty_ibfk_2` FOREIGN KEY (`EmployeeID`) REFERENCES `employee` (`EmployeeID`);

--
-- Constraints for table `nonapptemperature`
--
ALTER TABLE `nonapptemperature`
  ADD CONSTRAINT `nonapptemperature_ibfk_1` FOREIGN KEY (`UnitID`) REFERENCES `unit` (`UnitID`),
  ADD CONSTRAINT `nonapptemperature_ibfk_2` FOREIGN KEY (`EmployeeID`) REFERENCES `employee` (`EmployeeID`);

--
-- Constraints for table `riskapptemperature`
--
ALTER TABLE `riskapptemperature`
  ADD CONSTRAINT `riskapptemperature_ibfk_1` FOREIGN KEY (`UnitID`) REFERENCES `unit` (`UnitID`),
  ADD CONSTRAINT `riskapptemperature_ibfk_2` FOREIGN KEY (`ManagerID`) REFERENCES `manager` (`ManagerID`);

--
-- Constraints for table `risknonapptemperature`
--
ALTER TABLE `risknonapptemperature`
  ADD CONSTRAINT `risknonapptemperature_ibfk_1` FOREIGN KEY (`UnitID`) REFERENCES `unit` (`UnitID`),
  ADD CONSTRAINT `risknonapptemperature_ibfk_2` FOREIGN KEY (`EmployeeID`) REFERENCES `employee` (`EmployeeID`);

--
-- Constraints for table `unit`
--
ALTER TABLE `unit`
  ADD CONSTRAINT `unit_ibfk_1` FOREIGN KEY (`ManagerID`) REFERENCES `manager` (`ManagerID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
