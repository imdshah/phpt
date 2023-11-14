-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 14, 2023 at 12:19 PM
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
-- Database: `sports`
--

-- --------------------------------------------------------

--
-- Table structure for table `coach`
--

CREATE TABLE `coach` (
  `coach_id` int(11) NOT NULL,
  `coachname` varchar(40) NOT NULL,
  `coach_age` int(11) NOT NULL,
  `coach_type` varchar(40) NOT NULL,
  `team_id` int(11) NOT NULL,
  `experience_in_years` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `coach`
--

INSERT INTO `coach` (`coach_id`, `coachname`, `coach_age`, `coach_type`, `team_id`, `experience_in_years`) VALUES
(101, 'Stephen Fleming', 50, 'Head Coach', 1, 15),
(102, 'Ashish Nehra', 44, 'Head Coach', 2, 4),
(103, 'Mark Wood', 28, 'Batting Coach', 2, 4);

-- --------------------------------------------------------

--
-- Table structure for table `matches`
--

CREATE TABLE `matches` (
  `match_id` int(11) NOT NULL,
  `hometeam_id` int(11) NOT NULL,
  `awayteam_id` int(11) NOT NULL,
  `date` date NOT NULL,
  `ground` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `matches`
--

INSERT INTO `matches` (`match_id`, `hometeam_id`, `awayteam_id`, `date`, `ground`) VALUES
(1, 1, 2, '2023-12-01', 'chepuk'),
(2, 2, 1, '2023-12-04', 'Eden Gardens Stadium');

-- --------------------------------------------------------

--
-- Table structure for table `players`
--

CREATE TABLE `players` (
  `player_id` int(11) NOT NULL,
  `playername` varchar(40) NOT NULL,
  `age` int(11) NOT NULL,
  `country` varchar(40) NOT NULL,
  `type` varchar(40) NOT NULL,
  `style` varchar(40) NOT NULL,
  `team_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `players`
--

INSERT INTO `players` (`player_id`, `playername`, `age`, `country`, `type`, `style`, `team_id`) VALUES
(1, 'Jos Buttler', 30, 'England', 'Batter', 'Right-handed attacking', 1);

-- --------------------------------------------------------

--
-- Table structure for table `score`
--

CREATE TABLE `score` (
  `match_id` int(11) NOT NULL,
  `won_teamname` varchar(40) NOT NULL,
  `lost_teamname` varchar(40) NOT NULL,
  `won_teamscore` int(11) NOT NULL,
  `lost_teamscore` int(11) NOT NULL,
  `ground` varchar(40) NOT NULL,
  `date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `score`
--

INSERT INTO `score` (`match_id`, `won_teamname`, `lost_teamname`, `won_teamscore`, `lost_teamscore`, `ground`, `date`) VALUES
(1, 'CSK', 'RCB', 234, 200, 'Chepuk', '2023-12-01');

-- --------------------------------------------------------

--
-- Table structure for table `team`
--

CREATE TABLE `team` (
  `team_id` int(11) NOT NULL,
  `coach_id` int(25) NOT NULL,
  `teamname` varchar(50) NOT NULL,
  `captainname` varchar(40) NOT NULL,
  `home_ground` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `team`
--

INSERT INTO `team` (`team_id`, `coach_id`, `teamname`, `captainname`, `home_ground`) VALUES
(1, 101, 'Chennai Super Kings (CSK)', 'Mahendra Singh Dhoni', 'Chepauk Stadium'),
(2, 102, 'Gujarat Titans (GT)', 'Hardik Pandya', 'Narendra Modi Stadium'),
(3, 103, 'Gujarat Royal Titans (GRT)', 'OMKAR', 'Chepauk Stadium');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`) VALUES
(1, 'user1', 'pass');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `coach`
--
ALTER TABLE `coach`
  ADD PRIMARY KEY (`coach_id`);

--
-- Indexes for table `matches`
--
ALTER TABLE `matches`
  ADD PRIMARY KEY (`match_id`),
  ADD KEY `f1_fk` (`awayteam_id`),
  ADD KEY `f2_fk` (`hometeam_id`);

--
-- Indexes for table `players`
--
ALTER TABLE `players`
  ADD PRIMARY KEY (`player_id`);

--
-- Indexes for table `team`
--
ALTER TABLE `team`
  ADD PRIMARY KEY (`team_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `coach`
--
ALTER TABLE `coach`
  MODIFY `coach_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=104;

--
-- AUTO_INCREMENT for table `matches`
--
ALTER TABLE `matches`
  MODIFY `match_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `players`
--
ALTER TABLE `players`
  MODIFY `player_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `matches`
--
ALTER TABLE `matches`
  ADD CONSTRAINT `f1_fk` FOREIGN KEY (`awayteam_id`) REFERENCES `team` (`team_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `f2_fk` FOREIGN KEY (`hometeam_id`) REFERENCES `team` (`team_id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
