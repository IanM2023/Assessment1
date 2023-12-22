-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 22, 2023 at 02:09 AM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `assessment_tbl`
--

-- --------------------------------------------------------

--
-- Table structure for table `sample_list`
--

CREATE TABLE `sample_list` (
  `id` int(11) NOT NULL,
  `fname` varchar(255) NOT NULL,
  `lname` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `job_title` varchar(255) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `sample_list`
--

INSERT INTO `sample_list` (`id`, `fname`, `lname`, `email`, `job_title`, `created_at`, `updated_at`) VALUES
(10, 'Mark', 'Twain', 'test@gmail.com', 'Assistant', '2023-10-25 09:10:05', '2023-10-25 01:55:48'),
(11, 'John', 'Doe Jane', 'Masunurin232@gmail.com', 'IT Support', '2023-10-25 09:14:25', '2023-10-25 01:56:06'),
(16, 'Jane', 'Doe', 'magix232@gmail.com', 'Assistant', '2023-10-26 11:08:56', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(155) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password_hash` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password_hash`) VALUES
(17, 'Niks', 'sdw22@gmail.coms', '$2y$10$Cyrjk4D4ps6kZau2enE87eBkg2jwdAck.4VulGpTGWuCjRW6r.iFW'),
(18, 'Ian', 'Ianxs23@gmail.com', '$2y$10$rRocht6Hp/.XC79M.O69AuTdDVCHbTSqbmUsK93f8JaCzMWmp/8LC'),
(19, 'Less', 'Luxsim23@gmail.com', '$2y$10$vBl3fPHCc/yRU0Ih8SQRMu9YbgXo9x5TNWxheiL9BBu/XJOTaEikW');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `sample_list`
--
ALTER TABLE `sample_list`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `sample_list`
--
ALTER TABLE `sample_list`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
