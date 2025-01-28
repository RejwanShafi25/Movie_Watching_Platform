-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 11, 2023 at 09:46 PM
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
-- Database: `online_movie_watching_platform`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `Admin_ID` int(11) NOT NULL,
  `Admin_Name` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`Admin_ID`, `Admin_Name`) VALUES
(1, 'Wasef'),
(2, 'Ayan'),
(7, 'Mehedi Hassan');

-- --------------------------------------------------------

--
-- Table structure for table `comment`
--

CREATE TABLE `comment` (
  `customer_id` int(11) NOT NULL,
  `movie_index` int(11) NOT NULL,
  `comments` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `comment_replies`
--

CREATE TABLE `comment_replies` (
  `customer_id` int(11) NOT NULL,
  `movie_index` int(11) NOT NULL,
  `Reply` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE `customer` (
  `Customer_ID` int(11) NOT NULL,
  `Customer_Name` varchar(150) DEFAULT NULL,
  `Phone_number` varchar(20) DEFAULT NULL,
  `Admin_ID` int(11) DEFAULT NULL,
  `Requested_Movie` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`Customer_ID`, `Customer_Name`, `Phone_number`, `Admin_ID`, `Requested_Movie`) VALUES
(3, 'Sadman Sakib', '01756874231', NULL, 'Johnny English Reborn'),
(4, 'Tammim Liza Khan', '01756874232', NULL, NULL),
(5, 'Abdur Rahman Shihab', '01756874233', NULL, NULL),
(6, 'Zubayer Hassan', '01756874234', NULL, NULL),
(9, 'Hamid Ronon', '01843769915', NULL, NULL),
(12, 'Anina', '1234567891111', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `hall`
--

CREATE TABLE `hall` (
  `Hall_Number` int(11) NOT NULL,
  `Type` varchar(20) DEFAULT NULL,
  `seats` int(11) NOT NULL,
  `Price` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `hall`
--

INSERT INTO `hall` (`Hall_Number`, `Type`, `seats`, `Price`) VALUES
(1, '2D', 30, 200),
(2, '3D', 20, 500);

-- --------------------------------------------------------

--
-- Table structure for table `hall_details`
--

CREATE TABLE `hall_details` (
  `Hall_Number` int(11) NOT NULL,
  `Times` time NOT NULL,
  `Remaining_Seat` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `hall_details`
--

INSERT INTO `hall_details` (`Hall_Number`, `Times`, `Remaining_Seat`) VALUES
(1, '14:30:00', 30),
(1, '18:00:00', 30),
(2, '12:00:00', 17),
(2, '15:30:30', 20);

-- --------------------------------------------------------

--
-- Table structure for table `movies`
--

CREATE TABLE `movies` (
  `Movie_index` int(11) NOT NULL,
  `Title` varchar(200) DEFAULT NULL,
  `Summary` text DEFAULT NULL,
  `Release_Date` year(4) DEFAULT NULL,
  `Trailer_link` varchar(150) DEFAULT NULL,
  `Watch_Time` int(11) DEFAULT NULL,
  `Country` varchar(50) DEFAULT NULL,
  `CImage` text DEFAULT NULL,
  `Pre_sequel` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `movies`
--

INSERT INTO `movies` (`Movie_index`, `Title`, `Summary`, `Release_Date`, `Trailer_link`, `Watch_Time`, `Country`, `CImage`, `Pre_sequel`) VALUES
(1, 'Oppenheimer', 'A dramatization of the life story of J. Robert Oppenheimer, the physicist who had a large hand in the development of the atomic bomb, thus helping end World War 2. We see his life from university days all the way to post-WW2, where his fame saw him embroiled in political machinations.', '2023', 'https://www.youtube.com/watch?v=uYPbbksJxIg', 180, 'USA', 'img/Movies_Cover/OppenHeimer.jpg', NULL),
(2, 'Forrest Gump', 'Forrest Gump is a simple man with a low I.Q. but good intentions. He is running through childhood with his best and only friend Jenny. His \'mama\' teaches him the ways of life and leaves him to choose his destiny. Forrest joins the army for service in Vietnam, finding new friends called Dan and Bubba, he wins medals, creates a famous shrimp fishing fleet, inspires people to jog, starts a ping-pong craze, creates the smiley, writes bumper stickers and songs, donates to people and meets the president several times. However, this is all irrelevant to Forrest who can only think of his childhood sweetheart Jenny Curran, who has messed up her life. Although in the end all he wants to prove is that anyone can love anyone.', '1994', 'https://www.youtube.com/watch?v=bLvqoHBptjg', 142, 'USA', 'img/Movies_Cover/Forrest Grump.jpg', NULL),
(3, 'The Nun II', 'A follow-up to the enigmatic gothic horror about a strong evil that haunts and causes supernatural harm to everybody it comes into contact with. After the events of the first film, the said powerful evil now begins to spread in 1956 throughout a town in France as word gets out that a priest has been violently murdered. A finished contemplative in her novitiate, Sister Irene, begins to investigate the murder, only to find a demon behind it -- the same evil that terrorized her in the original film as a nun -- Valak, whom she once again soon comes to encounter.', '2023', 'https://www.youtube.com/watch?v=QF-oyCwaArU', 150, 'USA', 'img/Movies_Cover/The NUN II.jpg       	', 'The NUN'),
(4, 'The Nun', 'When a young nun at a cloistered abbey in Romania takes her own life, a priest with a haunted past and a novitiate on the threshold of her final vows are sent by the Vatican to investigate. Together they uncover the order\'s unholy secret. Risking not only their lives but their faith and their very souls, they confront a malevolent force in the form of the same demonic nun that first terrorized audiences in \'The Conjuring 2,\' as the abbey becomes a horrific battleground between the living and the damned.', '2018', 'https://www.youtube.com/watch?v=pzD9zGcUNrw', 96, 'USA', 'img/Movies_Cover/The NUN.jpg	', NULL),
(5, 'Gran Turismo', 'Jann is an avid gamer from Cardiff who spends his days playing Gran Turismo, refusing to succeed in the real world. Meanwhile, in Tokyo, Danny, a marketing manager for the Nissan automobile corporation, is running an advertising campaign and, together with the management of Gran Turismo, hatches a plan to launch a competition inviting gamers to try their luck in real racing cars. Needing help organizing an event, Danny turns to Jack, a former racing driver and incorrigible cynic. When fate brings Jann together with Danny and Jack, the gamer becomes the driver of a Nissan racing car, plunging headlong into the fight for a place in the sun in the competitive world of real racing.', '2023', 'https://www.youtube.com/watch?v=GVPzGBvPrzw', 135, 'USA', 'img/Movies_Cover/Gran Turismo.jpg', NULL),
(6, 'M3GAN', 'When Gemma suddenly becomes the caretaker of her orphaned 8-year-old niece, Cady, Gemma\'s unsure and unprepared to be a parent. Under intense pressure at work, Gemma decides to pair her M3GAN prototype with Cady in an attempt to resolve both problems-a decision that will have unimaginable consequences.', '2022', 'https://www.youtube.com/watch?v=BRb4U99OU80', 102, 'USA', 'img/Movies_Cover/M3GAN.jpg	', NULL),
(7, 'The Fault in Our Stars', 'Hazel and Augustus are two teenagers who share an acerbic wit, a disdain for the conventional, and a love that sweeps them on a journey. Their relationship is all the more miraculous, given that Hazel\'s other constant companion is an oxygen tank, Gus jokes about his prosthetic leg, and they meet and fall in love at a cancer support group.', '2014', 'https://www.youtube.com/watch?v=9ItBvH5J6ss', 126, 'USA', 'img/Movies_Cover/The fault in our star.jpg', NULL),
(8, 'Train to Busan', 'Sok-woo, a father with not much time for his daughter, Soo-ahn, are boarding the KTX, a fast train that shall bring them from Seoul to Busan. But during their journey, the apocalypse begins, and most of the earth\'s population become flesh craving zombies. While the KTX is shooting towards Busan, the passenger\'s fight for their families and lives against the zombies - and each other.', '2016', 'https://www.youtube.com/watch?v=pyWuHv2-Abk', 118, 'South Korea', 'img/Movies_Cover/Train To Busan.jpg	', NULL),
(41, 'Johnny English', 'After a sudden attack on MI5, Johnny English, Britain\'s most confident, yet unintelligent spy, becomes Britain\'s only spy.', '2003', 'https://www.youtube.com/watch?v=SL5Ds0sfHkM', 87, 'USA', 'img/Movies_Cover/Johny English.jpg', 'None');

-- --------------------------------------------------------

--
-- Table structure for table `movie_castings`
--

CREATE TABLE `movie_castings` (
  `Movie_index` int(11) NOT NULL,
  `Cast` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `movie_castings`
--

INSERT INTO `movie_castings` (`Movie_index`, `Cast`) VALUES
(1, 'Cillian Murphy'),
(1, 'Emily Blunt'),
(1, 'Florence Pugh'),
(1, 'Robert Downey Jr.'),
(2, 'Gary Sinise'),
(2, 'Robin Wright'),
(2, 'Tom Hanks'),
(3, 'Anna Popplewell'),
(3, 'Jonas Bloquet'),
(3, 'Peter Hudson'),
(3, 'Storm Reid'),
(3, 'Taissa Farmiga\r\n'),
(4, 'Bonnie Aarons'),
(4, 'Demián Bichir'),
(4, 'Jonas Bloquet'),
(4, 'Patrick Wilson'),
(4, 'Taissa Farmiga'),
(5, 'Darren Barnet'),
(5, 'David Harbour'),
(5, 'Orlando Bloom'),
(6, 'Allison Williams'),
(6, 'Jenna Davis'),
(6, 'Violet McGraw'),
(7, ' Nat Wolff'),
(7, 'Ansel Elgort'),
(7, 'Shailene Woodley'),
(8, 'Dong-seok Ma'),
(8, 'Yoo Gong\r\n'),
(8, 'Yu-mi Jung\r\n'),
(41, 'John Malkovich'),
(41, 'Natalie Imbruglia'),
(41, 'Rowan Atkinson');

-- --------------------------------------------------------

--
-- Table structure for table `movie_genre`
--

CREATE TABLE `movie_genre` (
  `Movie_index` int(11) NOT NULL,
  `Genre` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `movie_genre`
--

INSERT INTO `movie_genre` (`Movie_index`, `Genre`) VALUES
(1, 'Biography'),
(1, 'Drama'),
(1, 'History'),
(2, 'Drama'),
(2, 'Romance'),
(3, 'Horror'),
(4, 'Horror'),
(5, 'Action'),
(5, 'Adventure'),
(5, 'Drama'),
(6, 'Horror'),
(6, 'Sci-Fi'),
(7, 'Drama'),
(7, 'Romance'),
(8, 'Action'),
(8, 'Horror'),
(8, 'Thriller'),
(41, 'Action'),
(41, 'Adventure'),
(41, 'Comedy');

-- --------------------------------------------------------

--
-- Table structure for table `new_movies`
--

CREATE TABLE `new_movies` (
  `Movie_index` int(11) NOT NULL,
  `hall_number` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `new_movies`
--

INSERT INTO `new_movies` (`Movie_index`, `hall_number`) VALUES
(3, 1),
(1, 2);

-- --------------------------------------------------------

--
-- Table structure for table `old_movies`
--

CREATE TABLE `old_movies` (
  `Movie_index` int(11) NOT NULL,
  `Stream_Link` varchar(150) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `old_movies`
--

INSERT INTO `old_movies` (`Movie_index`, `Stream_Link`) VALUES
(2, 'https://web.fmoviesto.site/forrest-gump'),
(4, 'https://web.fmoviesto.site/the-nun'),
(5, 'https://web.fmoviesto.site/gran-turismo'),
(6, 'https://web.fmoviesto.site/m3gan'),
(7, 'https://web.fmoviesto.site/the-fault-in-our-stars'),
(8, 'https://www.mov.onl/2020/08/train-to-busan.html'),
(41, 'https://web.fmoviesto.site/johnny-english');

-- --------------------------------------------------------

--
-- Table structure for table `payment`
--

CREATE TABLE `payment` (
  `Payment_ID` varchar(80) NOT NULL,
  `Approved_by` int(11) DEFAULT NULL,
  `Customer` int(11) DEFAULT NULL,
  `Amount` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `payment`
--

INSERT INTO `payment` (`Payment_ID`, `Approved_by`, `Customer`, `Amount`) VALUES
('mkvd144232', NULL, 9, 1500),
('mkvd168587', 1, 3, 1000);

-- --------------------------------------------------------

--
-- Table structure for table `ticket`
--

CREATE TABLE `ticket` (
  `Ticket_ID` int(11) NOT NULL,
  `Ticket_day` date DEFAULT NULL,
  `Ticket_Time` time DEFAULT NULL,
  `Customer_ID` int(11) DEFAULT NULL,
  `Purchased_Date` date DEFAULT current_timestamp(),
  `Movie_Index` int(11) DEFAULT NULL,
  `Hall_Number` int(11) DEFAULT NULL,
  `Seat_Amount` int(11) NOT NULL,
  `Transaction_ID` varchar(80) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `ticket`
--

INSERT INTO `ticket` (`Ticket_ID`, `Ticket_day`, `Ticket_Time`, `Customer_ID`, `Purchased_Date`, `Movie_Index`, `Hall_Number`, `Seat_Amount`, `Transaction_ID`) VALUES
(7, '2023-12-22', '12:00:00', 3, '2023-12-11', 1, 2, 2, 'mkvd168587'),
(8, '2023-12-29', '12:00:00', 9, '2023-12-11', 1, 2, 3, 'mkvd144232');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `U_ID` int(11) NOT NULL,
  `Username` varchar(50) DEFAULT NULL,
  `Email` varchar(100) DEFAULT NULL,
  `Pass` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`U_ID`, `Username`, `Email`, `Pass`) VALUES
(1, 'Admin1', 'admin@gmail.com', '12345Wa@##'),
(2, 'Admin2', 'admin25@yahoo.com', '12345Wf@##'),
(3, 'Sakib', 's@outlook.com', '123456789'),
(4, 'Liza', 'l@gmail.com', '12345Wc@##'),
(5, 'Shihab ', 'sh@outlook.com', '12345Wd@##'),
(6, 'Zubayer', 'z@gmail.com', '12345We@##'),
(7, 'Admin3', 'mehedi25@gmail.com', '123456'),
(9, 'Hamid25', 'hamid@v.com', '123456'),
(12, 'Aninda25', 'aninda@gmail.com', '456789');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`Admin_ID`);

--
-- Indexes for table `comment`
--
ALTER TABLE `comment`
  ADD PRIMARY KEY (`customer_id`,`movie_index`),
  ADD KEY `comment_ibfk_2` (`movie_index`);

--
-- Indexes for table `comment_replies`
--
ALTER TABLE `comment_replies`
  ADD PRIMARY KEY (`customer_id`,`movie_index`),
  ADD KEY `comment_replies_ibfk_2` (`movie_index`);

--
-- Indexes for table `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`Customer_ID`),
  ADD KEY `customer_ibfk_2` (`Admin_ID`);

--
-- Indexes for table `hall`
--
ALTER TABLE `hall`
  ADD PRIMARY KEY (`Hall_Number`);

--
-- Indexes for table `hall_details`
--
ALTER TABLE `hall_details`
  ADD PRIMARY KEY (`Hall_Number`,`Times`);

--
-- Indexes for table `movies`
--
ALTER TABLE `movies`
  ADD PRIMARY KEY (`Movie_index`);

--
-- Indexes for table `movie_castings`
--
ALTER TABLE `movie_castings`
  ADD PRIMARY KEY (`Movie_index`,`Cast`);

--
-- Indexes for table `movie_genre`
--
ALTER TABLE `movie_genre`
  ADD PRIMARY KEY (`Movie_index`,`Genre`);

--
-- Indexes for table `new_movies`
--
ALTER TABLE `new_movies`
  ADD PRIMARY KEY (`Movie_index`),
  ADD KEY `new_movies_ibfk_2` (`hall_number`);

--
-- Indexes for table `old_movies`
--
ALTER TABLE `old_movies`
  ADD PRIMARY KEY (`Movie_index`);

--
-- Indexes for table `payment`
--
ALTER TABLE `payment`
  ADD PRIMARY KEY (`Payment_ID`),
  ADD KEY `Approved_by` (`Approved_by`),
  ADD KEY `Customer` (`Customer`);

--
-- Indexes for table `ticket`
--
ALTER TABLE `ticket`
  ADD PRIMARY KEY (`Ticket_ID`),
  ADD KEY `fk_Ticket1` (`Customer_ID`),
  ADD KEY `fk_Ticket2` (`Hall_Number`),
  ADD KEY `fk_Ticket3` (`Movie_Index`),
  ADD KEY `Transaction_ID` (`Transaction_ID`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`U_ID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `hall`
--
ALTER TABLE `hall`
  MODIFY `Hall_Number` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `movies`
--
ALTER TABLE `movies`
  MODIFY `Movie_index` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=55;

--
-- AUTO_INCREMENT for table `ticket`
--
ALTER TABLE `ticket`
  MODIFY `Ticket_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `U_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `admins`
--
ALTER TABLE `admins`
  ADD CONSTRAINT `admins_ibfk_1` FOREIGN KEY (`Admin_ID`) REFERENCES `users` (`U_ID`) ON UPDATE CASCADE;

--
-- Constraints for table `comment`
--
ALTER TABLE `comment`
  ADD CONSTRAINT `comment_ibfk_1` FOREIGN KEY (`customer_id`) REFERENCES `customer` (`Customer_ID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `comment_ibfk_2` FOREIGN KEY (`movie_index`) REFERENCES `movies` (`Movie_index`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `comment_replies`
--
ALTER TABLE `comment_replies`
  ADD CONSTRAINT `comment_replies_ibfk_1` FOREIGN KEY (`customer_id`) REFERENCES `comment` (`customer_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `comment_replies_ibfk_2` FOREIGN KEY (`movie_index`) REFERENCES `comment` (`movie_index`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `customer`
--
ALTER TABLE `customer`
  ADD CONSTRAINT `customer_ibfk_1` FOREIGN KEY (`Customer_ID`) REFERENCES `users` (`U_ID`) ON DELETE CASCADE,
  ADD CONSTRAINT `customer_ibfk_2` FOREIGN KEY (`Admin_ID`) REFERENCES `admins` (`Admin_ID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `hall_details`
--
ALTER TABLE `hall_details`
  ADD CONSTRAINT `hall_details_ibfk_1` FOREIGN KEY (`Hall_Number`) REFERENCES `hall` (`Hall_Number`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `movie_castings`
--
ALTER TABLE `movie_castings`
  ADD CONSTRAINT `movie_castings_ibfk_1` FOREIGN KEY (`Movie_index`) REFERENCES `movies` (`Movie_index`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `movie_genre`
--
ALTER TABLE `movie_genre`
  ADD CONSTRAINT `movie_genre_ibfk_1` FOREIGN KEY (`Movie_index`) REFERENCES `movies` (`Movie_index`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `new_movies`
--
ALTER TABLE `new_movies`
  ADD CONSTRAINT `new_movies_ibfk_1` FOREIGN KEY (`Movie_index`) REFERENCES `movies` (`Movie_index`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `new_movies_ibfk_2` FOREIGN KEY (`hall_number`) REFERENCES `hall` (`Hall_Number`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `old_movies`
--
ALTER TABLE `old_movies`
  ADD CONSTRAINT `old_movies_ibfk_1` FOREIGN KEY (`Movie_index`) REFERENCES `movies` (`Movie_index`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `payment`
--
ALTER TABLE `payment`
  ADD CONSTRAINT `payment_ibfk_1` FOREIGN KEY (`Approved_by`) REFERENCES `admins` (`Admin_ID`),
  ADD CONSTRAINT `payment_ibfk_2` FOREIGN KEY (`Customer`) REFERENCES `customer` (`Customer_ID`);

--
-- Constraints for table `ticket`
--
ALTER TABLE `ticket`
  ADD CONSTRAINT `fk_Ticket1` FOREIGN KEY (`Customer_ID`) REFERENCES `customer` (`Customer_ID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_Ticket2` FOREIGN KEY (`Hall_Number`) REFERENCES `hall` (`Hall_Number`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_Ticket3` FOREIGN KEY (`Movie_Index`) REFERENCES `new_movies` (`Movie_index`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `ticket_ibfk_1` FOREIGN KEY (`Transaction_ID`) REFERENCES `payment` (`Payment_ID`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
