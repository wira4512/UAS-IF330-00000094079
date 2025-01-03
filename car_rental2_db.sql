-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 11, 2024 at 05:58 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";

# Privileges for `root`@`127.0.0.1`

GRANT ALL PRIVILEGES ON *.* TO `root`@`127.0.0.1` WITH GRANT OPTION;


# Privileges for `root`@`::1`

GRANT ALL PRIVILEGES ON *.* TO `root`@`::1` WITH GRANT OPTION;


# Privileges for `root`@`localhost`

GRANT ALL PRIVILEGES ON *.* TO `root`@`localhost` WITH GRANT OPTION;

GRANT PROXY ON ''@'%' TO 'root'@'localhost' WITH GRANT OPTION;

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `car_rental2_db`
--

DELIMITER $$
--
-- Procedures
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `CancelRental` (IN `p_rental_id` INT)   BEGIN
    START TRANSACTION;
    
    -- Update rental status
    UPDATE rentals SET status = 'canceled' WHERE rental_id = p_rental_id;

    -- Log the cancel action
    INSERT INTO transactions (rental_id, action) VALUES (p_rental_id, 'cancel');

    -- Update car availability
    UPDATE cars SET availability = TRUE WHERE car_id = (SELECT car_id FROM rentals WHERE rental_id = p_rental_id);

    COMMIT;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `RentCar` (IN `p_user_id` INT, IN `p_car_id` INT, IN `p_start_date` DATE, IN `p_end_date` DATE)   BEGIN
    START TRANSACTION;
    -- Insert rental record
    INSERT INTO rentals (user_id, car_id, start_date, end_date, status) 
    VALUES (p_user_id, p_car_id, p_start_date, p_end_date, 'reserved');

    -- Get the last inserted rental ID
    SET @last_rental_id = LAST_INSERT_ID();

    -- Log the rental action
    INSERT INTO transactions (rental_id, action) 
    VALUES (@last_rental_id, 'rent');

    -- Update car availability
    UPDATE cars 
    SET availability = FALSE 
    WHERE car_id = p_car_id;

    COMMIT;
END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `cars`
--

CREATE TABLE `cars` (
  `car_id` int(11) NOT NULL,
  `make` varchar(50) NOT NULL,
  `model` varchar(50) NOT NULL,
  `year` int(11) NOT NULL,
  `availability` tinyint(1) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `cars`
--

INSERT INTO `cars` (`car_id`, `make`, `model`, `year`, `availability`) VALUES
(1, 'Toyota', 'Kijang Innova', 2017, 0),
(2, 'Honda', 'HRV', 2018, 0),
(3, 'Wuling', 'Almaz', 2022, 0),
(4, 'Chevrolet', 'Spin', 2014, 1),
(5, 'Chery', 'Omoda 5', 2024, 0),
(6, 'Toyota', 'Innova Zenix', 2022, 1),
(7, 'Wuling', 'Air', 2023, 0),
(8, 'Honda', 'WRV', 2022, 1);

-- --------------------------------------------------------

--
-- Table structure for table `rentals`
--

CREATE TABLE `rentals` (
  `rental_id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `car_id` int(11) DEFAULT NULL,
  `start_date` date NOT NULL,
  `end_date` date NOT NULL,
  `status` enum('reserved','canceled','completed') DEFAULT 'reserved'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `rentals`
--

INSERT INTO `rentals` (`rental_id`, `user_id`, `car_id`, `start_date`, `end_date`, `status`) VALUES
(2, 1, 2, '2024-12-10', '2024-12-15', 'reserved'),
(3, 2, 7, '2024-01-10', '2024-01-15', 'reserved'),
(4, 3, 3, '2024-02-01', '2024-02-05', 'reserved'),
(5, 4, 5, '2024-03-15', '2024-03-20', 'reserved'),
(6, 5, 1, '2024-04-10', '2024-04-15', 'reserved'),
(7, 5, 1, '2024-04-10', '2024-04-15', 'reserved'),
(8, 5, 1, '2024-04-10', '2024-04-15', 'reserved');

-- --------------------------------------------------------

--
-- Table structure for table `transactions`
--

CREATE TABLE `transactions` (
  `transaction_id` int(11) NOT NULL,
  `rental_id` int(11) DEFAULT NULL,
  `action` varchar(50) DEFAULT NULL,
  `action_date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `transactions`
--

INSERT INTO `transactions` (`transaction_id`, `rental_id`, `action`, `action_date`) VALUES
(1, 2, 'rent', '2024-12-11 01:34:42'),
(2, 3, 'rent', '2024-12-11 02:23:46'),
(3, 4, 'rent', '2024-12-11 02:23:50'),
(4, 5, 'rent', '2024-12-11 02:23:55'),
(5, 6, 'rent', '2024-12-11 02:24:00'),
(6, 7, 'rent', '2024-12-11 02:43:57'),
(7, 8, 'rent', '2024-12-11 02:43:57');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(100) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `username`, `password`, `email`, `created_at`) VALUES
(1, 'john_doe', 'johnd981', 'john@linkedin.com', '2024-12-11 01:16:14'),
(2, 'jane_smith', 'janes901', 'jane@gmail.com', '2024-12-10 01:16:14'),
(3, 'alice_jones', 'alicej123', 'alice@yahoo.com', '2024-09-18 21:16:14'),
(4, 'bob_brown', 'brown01987', 'bob.b34@yahoo.com', '2024-02-04 06:06:21'),
(5, 'charlie_clark', 'charlie8173', 'charlie.c@gmail.com.com', '2017-12-20 05:09:24');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cars`
--
ALTER TABLE `cars`
  ADD PRIMARY KEY (`car_id`);

--
-- Indexes for table `rentals`
--
ALTER TABLE `rentals`
  ADD PRIMARY KEY (`rental_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `car_id` (`car_id`);

--
-- Indexes for table `transactions`
--
ALTER TABLE `transactions`
  ADD PRIMARY KEY (`transaction_id`),
  ADD KEY `rental_id` (`rental_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cars`
--
ALTER TABLE `cars`
  MODIFY `car_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `rentals`
--
ALTER TABLE `rentals`
  MODIFY `rental_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `transactions`
--
ALTER TABLE `transactions`
  MODIFY `transaction_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `rentals`
--
ALTER TABLE `rentals`
  ADD CONSTRAINT `rentals_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`),
  ADD CONSTRAINT `rentals_ibfk_2` FOREIGN KEY (`car_id`) REFERENCES `cars` (`car_id`);

--
-- Constraints for table `transactions`
--
ALTER TABLE `transactions`
  ADD CONSTRAINT `transactions_ibfk_1` FOREIGN KEY (`rental_id`) REFERENCES `rentals` (`rental_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
