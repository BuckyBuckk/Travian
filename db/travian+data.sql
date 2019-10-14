-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 25, 2019 at 11:27 PM
-- Server version: 10.4.6-MariaDB
-- PHP Version: 7.1.32

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `travian`
--

-- --------------------------------------------------------

--
-- Table structure for table `allbuildings`
--

CREATE TABLE `allbuildings` (
  `idCity` int(11) NOT NULL,
  `idBuilding` int(10) UNSIGNED NOT NULL,
  `level` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `allvillage`
--

CREATE TABLE `allvillage` (
  `idPlayer` int(10) UNSIGNED NOT NULL,
  `idCity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `buildings`
--

CREATE TABLE `buildings` (
  `idBuilding` int(10) UNSIGNED NOT NULL,
  `name` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `cost`
--

CREATE TABLE `cost` (
  `idCost` int(10) UNSIGNED NOT NULL,
  `production_idProductionField` int(11) DEFAULT NULL,
  `allBuildings_idCity` int(11) DEFAULT NULL,
  `allBuildings_idBuilding` int(10) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `cost_has_resources`
--

CREATE TABLE `cost_has_resources` (
  `idCost` int(10) UNSIGNED NOT NULL,
  `idResource` int(10) UNSIGNED NOT NULL,
  `count` decimal(10,0) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `playerresources`
--

CREATE TABLE `playerresources` (
  `idPlayer` int(10) UNSIGNED NOT NULL,
  `idResource` int(10) UNSIGNED NOT NULL,
  `count` decimal(10,0) UNSIGNED ZEROFILL NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `playerresources`
--

INSERT INTO `playerresources` (`idPlayer`, `idResource`, `count`) VALUES
(1, 1, '0000000999'),
(1, 2, '0000000999'),
(1, 3, '0000000000'),
(1, 4, '0000000005'),
(2, 1, '0000000500'),
(2, 2, '0000000250'),
(2, 3, '0000001500'),
(2, 4, '0000010250');

-- --------------------------------------------------------

--
-- Table structure for table `productionfield`
--

CREATE TABLE `productionfield` (
  `idProductionField` int(11) NOT NULL,
  `idResource` int(10) UNSIGNED NOT NULL,
  `idPlayer` int(10) UNSIGNED NOT NULL,
  `idCity` int(11) NOT NULL,
  `production` decimal(10,0) DEFAULT NULL,
  `upgradeProduction` decimal(10,0) DEFAULT NULL,
  `time` int(11) DEFAULT NULL COMMENT 'How much seconds it takes to upgrade.',
  `level` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `resources`
--

CREATE TABLE `resources` (
  `idResource` int(10) UNSIGNED NOT NULL,
  `name` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `resources`
--

INSERT INTO `resources` (`idResource`, `name`) VALUES
(2, 'clay'),
(3, 'grain'),
(1, 'iron'),
(4, 'wood');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `idPlayer` int(10) UNSIGNED NOT NULL,
  `username` text NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`idPlayer`, `username`, `password`, `email`) VALUES
(1, 'admin', '$2y$10$IFnLZUuZBl7PZ9rBVDPi5eh/CKFxG1m01Q43KcZd/HWGZv7jyF2Rm', 'admin@admin.si'),
(2, 'user', '$2y$10$HQrWkd491T3U7g/cs4ouseH3Q073xxwFCuwnFh/UCzvU6p54Xp6QS', 'user@user.si');

-- --------------------------------------------------------

--
-- Table structure for table `village`
--

CREATE TABLE `village` (
  `idCity` int(11) NOT NULL,
  `name` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `allbuildings`
--
ALTER TABLE `allbuildings`
  ADD PRIMARY KEY (`idCity`,`idBuilding`),
  ADD KEY `fk_City_has_buildings_buildings1_idx` (`idBuilding`),
  ADD KEY `fk_City_has_buildings_City1_idx` (`idCity`);

--
-- Indexes for table `allvillage`
--
ALTER TABLE `allvillage`
  ADD PRIMARY KEY (`idPlayer`,`idCity`),
  ADD KEY `fk_player_has_City_City1_idx` (`idCity`),
  ADD KEY `fk_player_has_City_player1_idx` (`idPlayer`);

--
-- Indexes for table `buildings`
--
ALTER TABLE `buildings`
  ADD PRIMARY KEY (`idBuilding`),
  ADD UNIQUE KEY `idBuilding_UNIQUE` (`idBuilding`);

--
-- Indexes for table `cost`
--
ALTER TABLE `cost`
  ADD PRIMARY KEY (`idCost`),
  ADD KEY `fk_cost_production1_idx` (`production_idProductionField`),
  ADD KEY `fk_cost_allBuildings1_idx` (`allBuildings_idCity`,`allBuildings_idBuilding`);

--
-- Indexes for table `cost_has_resources`
--
ALTER TABLE `cost_has_resources`
  ADD PRIMARY KEY (`idCost`,`idResource`),
  ADD KEY `fk_cost_has_resources_resources1_idx` (`idResource`),
  ADD KEY `fk_cost_has_resources_cost1_idx` (`idCost`);

--
-- Indexes for table `playerresources`
--
ALTER TABLE `playerresources`
  ADD PRIMARY KEY (`idPlayer`,`idResource`),
  ADD KEY `fk_player_has_resources_resources2_idx` (`idResource`),
  ADD KEY `fk_player_has_resources_player1_idx` (`idPlayer`);

--
-- Indexes for table `productionfield`
--
ALTER TABLE `productionfield`
  ADD PRIMARY KEY (`idProductionField`,`idResource`,`idPlayer`,`idCity`),
  ADD KEY `fk_player_has_resources_resources1_idx` (`idResource`),
  ADD KEY `fk_production_allCities1_idx` (`idPlayer`,`idCity`);

--
-- Indexes for table `resources`
--
ALTER TABLE `resources`
  ADD PRIMARY KEY (`idResource`),
  ADD UNIQUE KEY `idResource_UNIQUE` (`idResource`),
  ADD UNIQUE KEY `name_UNIQUE` (`name`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`idPlayer`),
  ADD UNIQUE KEY `idplayer_UNIQUE` (`idPlayer`);

--
-- Indexes for table `village`
--
ALTER TABLE `village`
  ADD PRIMARY KEY (`idCity`),
  ADD UNIQUE KEY `idCity_UNIQUE` (`idCity`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `buildings`
--
ALTER TABLE `buildings`
  MODIFY `idBuilding` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `cost`
--
ALTER TABLE `cost`
  MODIFY `idCost` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `productionfield`
--
ALTER TABLE `productionfield`
  MODIFY `idProductionField` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `resources`
--
ALTER TABLE `resources`
  MODIFY `idResource` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `idPlayer` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `village`
--
ALTER TABLE `village`
  MODIFY `idCity` int(11) NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `allbuildings`
--
ALTER TABLE `allbuildings`
  ADD CONSTRAINT `fk_City_has_buildings_City1` FOREIGN KEY (`idCity`) REFERENCES `village` (`idCity`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_City_has_buildings_buildings1` FOREIGN KEY (`idBuilding`) REFERENCES `buildings` (`idBuilding`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `allvillage`
--
ALTER TABLE `allvillage`
  ADD CONSTRAINT `fk_player_has_City_City1` FOREIGN KEY (`idCity`) REFERENCES `village` (`idCity`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_player_has_City_player1` FOREIGN KEY (`idPlayer`) REFERENCES `users` (`idPlayer`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `cost`
--
ALTER TABLE `cost`
  ADD CONSTRAINT `fk_cost_allBuildings1` FOREIGN KEY (`allBuildings_idCity`,`allBuildings_idBuilding`) REFERENCES `allbuildings` (`idCity`, `idBuilding`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_cost_production1` FOREIGN KEY (`production_idProductionField`) REFERENCES `productionfield` (`idProductionField`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `cost_has_resources`
--
ALTER TABLE `cost_has_resources`
  ADD CONSTRAINT `fk_cost_has_resources_cost1` FOREIGN KEY (`idCost`) REFERENCES `cost` (`idCost`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_cost_has_resources_resources1` FOREIGN KEY (`idResource`) REFERENCES `resources` (`idResource`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `playerresources`
--
ALTER TABLE `playerresources`
  ADD CONSTRAINT `fk_player_has_resources_player1` FOREIGN KEY (`idplayer`) REFERENCES `users` (`idPlayer`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_player_has_resources_resources2` FOREIGN KEY (`idResource`) REFERENCES `resources` (`idResource`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `productionfield`
--
ALTER TABLE `productionfield`
  ADD CONSTRAINT `fk_player_has_resources_resources1` FOREIGN KEY (`idResource`) REFERENCES `resources` (`idResource`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_production_allCities1` FOREIGN KEY (`idPlayer`,`idCity`) REFERENCES `allvillage` (`idPlayer`, `idCity`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
