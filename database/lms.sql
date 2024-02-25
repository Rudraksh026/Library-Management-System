-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 21, 2024 at 04:38 PM
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
-- Database: `lms`
--

-- --------------------------------------------------------

--
-- Table structure for table `bookdetails`
--

CREATE TABLE `bookdetails` (
  `bookedition` int(11) DEFAULT NULL,
  `bookyear` year(4) DEFAULT NULL,
  `bookbranch` varchar(255) DEFAULT NULL,
  `bookname` varchar(255) DEFAULT NULL,
  `bookauthor` varchar(255) DEFAULT NULL,
  `bookpublisher` varchar(255) DEFAULT NULL,
  `bookprice` int(11) DEFAULT NULL,
  `bookno` int(11) NOT NULL,
  `bookpages` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `bookdetails`
--

INSERT INTO `bookdetails` (`bookedition`, `bookyear`, `bookbranch`, `bookname`, `bookauthor`, `bookpublisher`, `bookprice`, `bookno`, `bookpages`) VALUES
(4, '2023', 'information technology', 'let us C++', 'yashavant kanetkar', 'bpb publication', 449, 1001, 350),
(3, '2016', 'Information_Technology', 'software engineering', 'bharat bhushan agrawal , sumit prakash tayal', 'firewall media', 499, 5001, 278),
(2, '2018', 'information technology', 'php : the complete reference', 'steven holzner', 'mc graw hill education', 1000, 9750, 512),
(5, '2023', 'information technology', 'let us python', 'yashavant kanetkar, aditya kanetkar', 'bpb publications', 399, 9751, 398);

-- --------------------------------------------------------

--
-- Table structure for table `issuebook`
--

CREATE TABLE `issuebook` (
  `issuedate` date NOT NULL,
  `issuerid` int(11) DEFAULT NULL,
  `issuebookid` int(11) DEFAULT NULL,
  `sno` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `issuebook`
--

INSERT INTO `issuebook` (`issuedate`, `issuerid`, `issuebookid`, `sno`) VALUES
('2024-02-21', 2, 1001, 53),
('2024-02-21', 2, 5001, 54),
('2024-02-21', 2, 9750, 55),
('2024-02-21', 2, 9751, 56);

-- --------------------------------------------------------

--
-- Table structure for table `useridissue`
--

CREATE TABLE `useridissue` (
  `useridno` int(11) NOT NULL,
  `username` varchar(255) DEFAULT NULL,
  `userbranch` varchar(255) DEFAULT NULL,
  `userbranchyear` int(11) DEFAULT NULL,
  `userimageurl` varchar(300) DEFAULT NULL,
  `useridissueyear` date DEFAULT NULL,
  `userpassword` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `useridissue`
--

INSERT INTO `useridissue` (`useridno`, `username`, `userbranch`, `userbranchyear`, `userimageurl`, `useridissueyear`, `userpassword`) VALUES
(1, 'sanandan', 'Information_Technology', 3, 'IMG-65b938067b0532.44367751.jpg', '2024-02-20', '#Rm 260905'),
(2, 'Rudraksh', 'Information_Technology', 3, NULL, '2024-01-31', '#Rm260905'),
(3, 'Sumit', 'Information_Technology', 3, 'IMG-65d59950819a12.34172589.jpg', '2024-02-21', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `bookdetails`
--
ALTER TABLE `bookdetails`
  ADD PRIMARY KEY (`bookno`);

--
-- Indexes for table `issuebook`
--
ALTER TABLE `issuebook`
  ADD PRIMARY KEY (`sno`),
  ADD KEY `issuerid` (`issuerid`),
  ADD KEY `issuebookid` (`issuebookid`);

--
-- Indexes for table `useridissue`
--
ALTER TABLE `useridissue`
  ADD PRIMARY KEY (`useridno`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `issuebook`
--
ALTER TABLE `issuebook`
  MODIFY `sno` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=57;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `issuebook`
--
ALTER TABLE `issuebook`
  ADD CONSTRAINT `issuebook_ibfk_1` FOREIGN KEY (`issuerid`) REFERENCES `useridissue` (`useridno`),
  ADD CONSTRAINT `issuebook_ibfk_2` FOREIGN KEY (`issuebookid`) REFERENCES `bookdetails` (`bookno`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
