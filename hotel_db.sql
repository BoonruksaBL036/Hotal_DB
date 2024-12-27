-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 27, 2024 at 06:50 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.0.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `hotel_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `bookings`
--

CREATE TABLE `bookings` (
  `BookingID` int(11) NOT NULL,
  `UserID` int(11) NOT NULL,
  `RoomID` int(11) NOT NULL,
  `CheckInDate` date NOT NULL,
  `CheckOutDate` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `bookings`
--

INSERT INTO `bookings` (`BookingID`, `UserID`, `RoomID`, `CheckInDate`, `CheckOutDate`) VALUES
(1, 1, 1, '2024-12-27', '2024-12-29'),
(2, 1, 4, '2024-12-27', '2024-12-29'),
(3, 1, 6, '2024-12-27', '2024-12-29'),
(4, 1, 3, '2024-12-27', '2024-12-28'),
(5, 1, 3, '2025-01-03', '2025-01-05'),
(6, 1, 2, '2024-12-27', '2024-12-29'),
(7, 1, 1, '2024-12-06', '2024-12-08'),
(8, 1, 10, '2024-12-27', '2024-12-29'),
(9, 1, 3, '2024-12-01', '2024-12-10'),
(10, 1, 5, '2024-12-26', '2024-12-29'),
(11, 1, 7, '2024-12-27', '2024-12-29'),
(12, 1, 9, '2025-01-01', '2025-01-03'),
(13, 1, 8, '2025-01-01', '2025-01-03'),
(14, 1, 1, '2024-12-28', '2024-12-29'),
(15, 1, 2, '2024-12-28', '2024-12-31'),
(16, 1, 3, '2024-12-28', '2024-12-29'),
(17, 1, 8, '2024-12-28', '2024-12-29'),
(18, 1, 8, '2024-12-28', '2024-12-29'),
(19, 1, 9, '2024-12-29', '2024-12-31'),
(20, 1, 9, '2024-12-28', '2024-12-30'),
(21, 1, 9, '2024-12-29', '2024-12-31'),
(22, 1, 9, '2024-12-28', '2024-12-31'),
(23, 1, 9, '2024-12-28', '2024-12-31'),
(24, 1, 9, '2024-12-28', '2024-12-31'),
(25, 1, 9, '2024-12-28', '2024-12-24'),
(26, 1, 8, '2024-12-28', '2024-12-24'),
(27, 1, 8, '2024-12-28', '2024-12-30'),
(28, 1, 8, '2024-12-28', '2024-12-29'),
(29, 1, 10, '2024-12-28', '2024-12-31');

-- --------------------------------------------------------

--
-- Table structure for table `rooms`
--

CREATE TABLE `rooms` (
  `RoomID` int(11) NOT NULL,
  `RoomNumber` varchar(10) NOT NULL,
  `RoomType` varchar(50) NOT NULL,
  `Description` text DEFAULT NULL,
  `Capacity` int(11) DEFAULT NULL,
  `Amenities` text DEFAULT NULL,
  `PricePerNight` float DEFAULT NULL,
  `IsAvailable` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `rooms`
--

INSERT INTO `rooms` (`RoomID`, `RoomNumber`, `RoomType`, `Description`, `Capacity`, `Amenities`, `PricePerNight`, `IsAvailable`) VALUES
(1, '101', 'Single', 'Cozy single room with a great view.', 1, 'Wi-Fi, Air Conditioning, TV', 50, 1),
(2, '102', 'Single', 'Modern single room with a desk.', 1, 'Wi-Fi, Desk, Air Conditioning', 50, 1),
(3, '103', 'Double', 'Spacious double room for two.', 2, 'Wi-Fi, TV, Mini Bar', 75, 0),
(4, '104', 'Double', 'Comfortable double room with balcony.', 2, 'Wi-Fi, Balcony, TV', 75, 1),
(5, '105', 'Suite', 'Luxury suite with separate living area.', 4, 'Wi-Fi, Living Room, Kitchenette', 120, 1),
(6, '106', 'Suite', 'Elegant suite perfect for families.', 4, 'Wi-Fi, TV, Dining Area', 120, 0),
(7, '107', 'Single', 'Single room near the city center.', 1, 'Wi-Fi, Air Conditioning, Heater', 50, 1),
(8, '108', 'Double', 'Double room with garden view.', 2, 'Wi-Fi, Garden Access, TV', 75, 0),
(9, '109', 'Suite', 'Premium suite with ocean view.', 4, 'Wi-Fi, Ocean View, Mini Bar', 120, 1),
(10, '110', 'Single', 'Single room with modern decor.', 1, 'Wi-Fi, Desk, Heater', 50, 1);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `UserID` int(11) NOT NULL,
  `FullName` varchar(100) NOT NULL,
  `Email` varchar(100) NOT NULL,
  `Password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`UserID`, `FullName`, `Email`, `Password`) VALUES
(1, ' Test1', 'Test1@gmail.com', '$2y$10$Y6/YjQhJ2XryYw.XPbcwV.6L3YVCr2lLF8eK7QxixNwoveOnpSBTS');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `bookings`
--
ALTER TABLE `bookings`
  ADD PRIMARY KEY (`BookingID`),
  ADD KEY `UserID` (`UserID`),
  ADD KEY `RoomID` (`RoomID`);

--
-- Indexes for table `rooms`
--
ALTER TABLE `rooms`
  ADD PRIMARY KEY (`RoomID`),
  ADD UNIQUE KEY `RoomNumber` (`RoomNumber`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`UserID`),
  ADD UNIQUE KEY `Email` (`Email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `bookings`
--
ALTER TABLE `bookings`
  MODIFY `BookingID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `rooms`
--
ALTER TABLE `rooms`
  MODIFY `RoomID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `UserID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `bookings`
--
ALTER TABLE `bookings`
  ADD CONSTRAINT `bookings_ibfk_1` FOREIGN KEY (`UserID`) REFERENCES `users` (`UserID`),
  ADD CONSTRAINT `bookings_ibfk_2` FOREIGN KEY (`RoomID`) REFERENCES `rooms` (`RoomID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
