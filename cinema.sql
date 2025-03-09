-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 08, 2025 at 03:11 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `moviedb`
--
CREATE DATABASE IF NOT EXISTS `moviedb` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `moviedb`;

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `AdminID` int(11) NOT NULL,
  `Username` varchar(255) DEFAULT NULL,
  `Password` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`AdminID`, `Username`, `Password`) VALUES
(1, 'admin1', '123'),
(2, 'admin2', '123'),
(3, 'admin3', '123');

-- --------------------------------------------------------

--
-- Table structure for table `bookings`
--

CREATE TABLE `bookings` (
  `BookingID` int(11) NOT NULL,
  `UserID` int(11) DEFAULT NULL,
  `ShowtimeID` int(11) DEFAULT NULL,
  `Seats` int(11) DEFAULT NULL,
  `BookingDateTime` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `bookings`
--

INSERT INTO `bookings` (`BookingID`, `UserID`, `ShowtimeID`, `Seats`, `BookingDateTime`) VALUES
(1, 1, 1, 2, '2025-04-01 10:00:00'),
(2, 2, 2, 3, '2025-04-02 15:00:00'),
(3, 1, 3, 1, '2025-04-05 12:00:00'),
(4, 2, 4, 4, '2025-04-06 14:00:00'),
(5, 3, 5, 2, '2025-04-07 16:00:00'),
(6, 1, 6, 5, '2025-04-08 18:00:00'),
(7, 3, 7, 3, '2025-04-09 20:00:00'),
(8, 2, 8, 2, '2025-04-10 13:00:00'),
(9, 1, 9, 1, '2025-04-11 11:00:00'),
(10, 3, 10, 4, '2025-04-12 17:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `movies`
--

CREATE TABLE `movies` (
  `MovieID` int(11) NOT NULL,
  `Title` varchar(255) DEFAULT NULL,
  `Genre` varchar(100) DEFAULT NULL,
  `ReleaseDate` date DEFAULT NULL,
  `Duration` int(11) DEFAULT NULL,
  `Rating` decimal(3,1) DEFAULT NULL,
  `Image` varchar(255) DEFAULT NULL,
  `TrailerURL` varchar(255) DEFAULT NULL,
  `Cast` varchar(255) DEFAULT NULL,
  `Description` varchar(255) DEFAULT NULL,
  `Price` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `movies`
--

INSERT INTO `movies` (`MovieID`, `Title`, `Genre`, `ReleaseDate`, `Duration`, `Rating`, `Image`, `TrailerURL`, `Cast`, `Description`, `Price`) VALUES
(1, 'Dune: Part Two', 'Sci-Fi', '2024-03-01', 155, 8.6, 'movie_1.jpg', 'Way9Dexny3w', 'Timothée Chalamet, Zendaya, Rebecca Ferguson', 'Phần hai của bộ phim viễn tưởng nổi tiếng \"Dune\", tiếp tục câu chuyện về Paul Atreides.', 70000),
(2, 'The Brutalist', 'Drama', '2024-12-20', 140, 7.8, 'movie_2.jpg', 'GdRXPAHIEW4', 'Adrien Brody, Felicity Jones, Guy Pearce', 'Bộ phim chính kịch về sự đấu tranh và đổi mới kiến trúc giữa thế kỷ 20.', 60000),
(3, 'Ghostlight', 'Comedy', '2024-06-14', 100, 7.5, 'movie_3.jpg', 'R1TycuGX4Mw', 'Tony Hale, Ana Gasteyer, Steve Zahn', 'Một bộ phim hài xoay quanh cuộc sống của những người làm việc trong nhà hát.', 45000),
(4, 'Nosferatu', 'Horror', '2024-12-25', 110, 8.1, 'movie_4.jpg', 'nulvWqYUM8k', 'Anya Taylor-Joy, Bill Skarsgård, Willem Dafoe', 'Bản làm lại của bộ phim kinh điển về ma cà rồng \"Nosferatu\".', 80000),
(5, 'The Wild Robot', 'Animation', '2024-09-27', 95, 8.2, 'movie_5.jpg', '67vbA5ZJdKQ', 'Scarlett Johansson, Taron Egerton, Ben Whishaw', 'Một bộ phim hoạt hình về cuộc hành trình của một con robot hoang dã.', 40000),
(6, 'Furiosa: A Mad Max Saga', 'Action', '2024-05-24', 130, 8.0, 'movie_6.jpg', 'XJMuhwVlca4', 'Anya Taylor-Joy, Chris Hemsworth, Yahya Abdul-Mateen II', 'Phần tiếp theo của bộ phim hành động \"Mad Max\", tập trung vào nhân vật Furiosa.', 78000),
(7, 'The Substance', 'Horror', '2024-09-20', 105, 7.4, 'movie_7.jpg', 'xRd1KZZ76_o', 'Demi Moore, Margaret Qualley, Ray Liotta', 'Một bộ phim kinh dị xoay quanh sự xuất hiện của một chất lạ gây ra những hiện tượng kỳ bí.', 52000),
(8, 'A Real Pain', 'Comedy', '2024-11-01', 90, 7.3, 'movie_8.jpg', 'b2et8Vpu7Ls', 'Nathan Fielder, Emma Stone, Jonah Hill', 'Một bộ phim hài về những tình huống dở khóc dở cười trong cuộc sống.', 47000),
(9, 'Inside Out 2', 'Animation', '2024-06-14', 95, 8.5, 'movie_9.jpg', 'LEjhY15eCx0', 'Amy Poehler, Bill Hader, Mindy Kaling', 'Phần hai của bộ phim hoạt hình \"Inside Out\", tiếp tục khám phá cảm xúc bên trong của cô bé Riley.', 68000),
(10, 'Captain America: Brave New World', 'Action', '2025-02-14', 130, 8.4, 'movie_10.jpg', '1pHDWnXmK7Y', 'Anthony Mackie, Sebastian Stan, Emily VanCamp', 'Phần tiếp theo của loạt phim \"Captain America\", kể về hành trình mới của Sam Wilson với vai trò Captain America.', 75000),
(11, 'Guardians of the Galaxy Vol. 3', 'Action', '2024-05-05', 149, 8.3, 'movie_11.jpg', 'u3V5KDHRQvk', 'Chris Pratt, Zoe Saldana, Dave Bautista', 'Phần ba của loạt phim siêu anh hùng \"Guardians of the Galaxy\".', 62000),
(12, 'The Batman: Arkham', 'Action', '2024-10-31', 160, 8.7, 'movie_12.jpg', 'wsf78BS9VE0', 'Robert Pattinson, Zoë Kravitz, Colin Farrell', 'Một phần mới trong loạt phim \"The Batman\", tập trung vào cuộc đối đầu với thế lực tội phạm trong Arkham.', 76000),
(13, 'Fantastic Beasts: The Blue Flame', 'Fantasy', '2025-07-15', 142, 7.9, 'movie_13.jpg', 'by_gr6oC9Fg', 'Eddie Redmayne, Katherine Waterston, Jude Law', 'Phần tiếp theo của loạt phim \"Fantastic Beasts\", với cuộc phiêu lưu mới.', 58000),
(14, 'Mission: Impossible - Dead Reckoning Part Two', 'Action', '2025-08-22', 145, 8.5, 'movie_14.jpg', 'NOhDyUmT9z0', 'Tom Cruise, Rebecca Ferguson, Simon Pegg', 'Phần hai của bộ phim hành động \"Mission: Impossible - Dead Reckoning\".', 77000),
(15, 'The Meg 2: The Trench', 'Sci-Fi', '2024-08-09', 116, 7.1, 'movie_15.jpg', 'dG91B3hHyY4', 'Jason Statham, Li Bingbing, Ruby Rose', 'Phần hai của bộ phim khoa học viễn tưởng \"The Meg\".', 44000),
(16, 'Avatar: The Way of Water', 'Fantasy', '2024-12-17', 190, 8.9, 'movie_16.jpg', 'a8Gx8wiNbs8', 'Sam Worthington, Zoe Saldana, Sigourney Weaver', 'Phần tiếp theo của bộ phim \"Avatar\", tiếp tục câu chuyện về Pandora.', 80000),
(17, 'Joker: Folie à Deux', 'Drama', '2025-10-04', 130, 8.8, 'movie_17.jpg', '_OKAwz2MsJs', 'Joaquin Phoenix, Lady Gaga, Zazie Beetz', 'Phần tiếp theo của bộ phim \"Joker\", khám phá thêm về sự điên rồ của nhân vật chính.', 78000),
(18, 'Spider-Man: Beyond the Spider-Verse', 'Animation', '2024-04-08', 120, 8.9, 'movie_18.jpg', 'D7pQ-S8QlC8', 'Shameik Moore, Hailee Steinfeld, Mahershala Ali', 'Phần tiếp theo của bộ phim hoạt hình \"Spider-Man: Into the Spider-Verse\".', 69000),
(19, 'Black Panther: Wakanda Forever', 'Action', '2024-11-10', 150, 8.6, 'movie_19.jpg', '_Z3QKkl1WyM', 'Letitia Wright, Winston Duke, Angela Bassett', 'Phần tiếp theo của bộ phim siêu anh hùng \"Black Panther\".', 73000),
(20, 'John Wick: Chapter 5', 'Action', '2025-03-21', 135, 8.7, 'movie_20.jpg', 'zv3NDaFqjIc', 'Keanu Reeves, Laurence Fishburne, Ian McShane', 'Phần tiếp theo của loạt phim hành động \"John Wick\".', 71000);

-- --------------------------------------------------------

--
-- Table structure for table `showtimes`
--

CREATE TABLE `showtimes` (
  `ShowtimeID` int(11) NOT NULL,
  `MovieID` int(11) DEFAULT NULL,
  `TheaterID` int(11) DEFAULT NULL,
  `ShowDateTime` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `showtimes`
--

INSERT INTO `showtimes` (`ShowtimeID`, `MovieID`, `TheaterID`, `ShowDateTime`) VALUES
(1, 1, 1, '2025-04-10 18:30:00'),
(2, 2, 2, '2025-04-11 19:00:00'),
(3, 3, 1, '2025-04-12 20:00:00'),
(4, 4, 2, '2025-04-13 17:30:00'),
(5, 5, 3, '2025-04-14 18:00:00'),
(6, 6, 1, '2025-04-15 21:00:00'),
(7, 7, 2, '2025-04-16 19:30:00'),
(8, 8, 3, '2025-04-17 20:30:00'),
(9, 9, 1, '2025-04-18 18:45:00'),
(10, 10, 2, '2025-04-19 17:15:00'),
(11, 11, 3, '2025-04-20 19:00:00'),
(12, 12, 1, '2025-04-21 20:00:00'),
(13, 13, 2, '2025-04-22 18:30:00'),
(14, 14, 3, '2025-04-23 19:45:00'),
(15, 15, 1, '2025-04-24 21:00:00'),
(16, 16, 2, '2025-04-25 20:15:00'),
(17, 17, 3, '2025-04-26 18:45:00'),
(18, 18, 1, '2025-04-27 19:30:00'),
(19, 19, 2, '2025-04-28 20:00:00'),
(20, 20, 3, '2025-04-29 21:15:00');

-- --------------------------------------------------------

--
-- Table structure for table `theaters`
--

CREATE TABLE `theaters` (
  `TheaterID` int(11) NOT NULL,
  `Name` varchar(255) DEFAULT NULL,
  `Location` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `theaters`
--

INSERT INTO `theaters` (`TheaterID`, `Name`, `Location`) VALUES
(1, 'Grand Cinema Downtown', '123 Main St, Ho Chi Minh City'),
(2, 'Sunshine Cinema', '456 Sunshine Ave, Ho Chi Minh City'),
(3, 'Starlight Theater', '789 Star Rd, Ho Chi Minh City');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `UserID` int(11) NOT NULL,
  `UserName` varchar(255) DEFAULT NULL,
  `Email` varchar(255) DEFAULT NULL,
  `Password` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`UserID`, `UserName`, `Email`, `Password`) VALUES
(1, 'JohnDoe', 'john@example.com', '123'),
(2, 'JaneSmith', 'jane@example.com', '123'),
(3, 'EmilyJones', 'emily@example.com', '123');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`AdminID`);

--
-- Indexes for table `bookings`
--
ALTER TABLE `bookings`
  ADD PRIMARY KEY (`BookingID`),
  ADD KEY `ShowtimeID` (`ShowtimeID`);

--
-- Indexes for table `movies`
--
ALTER TABLE `movies`
  ADD PRIMARY KEY (`MovieID`);

--
-- Indexes for table `showtimes`
--
ALTER TABLE `showtimes`
  ADD PRIMARY KEY (`ShowtimeID`),
  ADD KEY `MovieID` (`MovieID`),
  ADD KEY `TheaterID` (`TheaterID`);

--
-- Indexes for table `theaters`
--
ALTER TABLE `theaters`
  ADD PRIMARY KEY (`TheaterID`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`UserID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `AdminID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `bookings`
--
ALTER TABLE `bookings`
  MODIFY `BookingID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `movies`
--
ALTER TABLE `movies`
  MODIFY `MovieID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `showtimes`
--
ALTER TABLE `showtimes`
  MODIFY `ShowtimeID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `theaters`
--
ALTER TABLE `theaters`
  MODIFY `TheaterID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `UserID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `bookings`
--
ALTER TABLE `bookings`
  ADD CONSTRAINT `bookings_ibfk_1` FOREIGN KEY (`ShowtimeID`) REFERENCES `showtimes` (`ShowtimeID`);

--
-- Constraints for table `showtimes`
--
ALTER TABLE `showtimes`
  ADD CONSTRAINT `showtimes_ibfk_1` FOREIGN KEY (`MovieID`) REFERENCES `movies` (`MovieID`),
  ADD CONSTRAINT `showtimes_ibfk_2` FOREIGN KEY (`TheaterID`) REFERENCES `theaters` (`TheaterID`);
--
-- Database: `mts`
--
CREATE DATABASE IF NOT EXISTS `mts` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `mts`;

-- --------------------------------------------------------

--
-- Table structure for table `addon`
--

CREATE TABLE `addon` (
  `addonUniqID` varchar(255) NOT NULL,
  `addonName` varchar(255) NOT NULL,
  `addonPrice` decimal(10,0) NOT NULL,
  `addonImage` varchar(255) NOT NULL,
  `addonDescription` mediumtext DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `addonorders`
--

CREATE TABLE `addonorders` (
  `addonOrderID` varchar(255) NOT NULL,
  `addonID` varchar(255) NOT NULL,
  `addonQuantity` int(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `assignedseats`
--

CREATE TABLE `assignedseats` (
  `ticketID` varchar(255) NOT NULL,
  `seat` varchar(255) NOT NULL,
  `assignedShowtimeID` varchar(255) NOT NULL,
  `time` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cinemaexperiences`
--

CREATE TABLE `cinemaexperiences` (
  `uniqID` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `iconPath` varchar(255) NOT NULL,
  `description` mediumtext DEFAULT NULL,
  `ticketPrice` decimal(10,0) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `films`
--

CREATE TABLE `films` (
  `filmID` varchar(255) NOT NULL DEFAULT '255',
  `experienceID` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL DEFAULT '255',
  `altName` varchar(255) DEFAULT 'none',
  `logoPath` varchar(255) NOT NULL,
  `filmRating` varchar(255) NOT NULL,
  `filmGenre` varchar(255) NOT NULL DEFAULT '255',
  `releaseDate` date DEFAULT NULL,
  `isAvailable` tinyint(1) NOT NULL DEFAULT 0,
  `isFeatured` tinyint(1) NOT NULL DEFAULT 0,
  `filmDescription` mediumtext NOT NULL DEFAULT '65536',
  `cast` varchar(255) NOT NULL DEFAULT '255',
  `director` varchar(255) NOT NULL DEFAULT '255',
  `imagePosterPath` varchar(255) NOT NULL DEFAULT '255',
  `artwork` varchar(255) NOT NULL DEFAULT '255',
  `trailerURL` varchar(255) NOT NULL,
  `associatedShowtimeID` varchar(255) NOT NULL,
  `subtitle` varchar(255) NOT NULL,
  `language` varchar(255) NOT NULL,
  `length` int(3) NOT NULL DEFAULT 0,
  `logoAvailable` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `globalsettings`
--

CREATE TABLE `globalsettings` (
  `intervalTime` int(3) NOT NULL,
  `showStart` varchar(5) NOT NULL,
  `showEnd` varchar(5) NOT NULL,
  `dayValue` varchar(255) NOT NULL,
  `currentGlobalSetting` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `halls`
--

CREATE TABLE `halls` (
  `hallUniqID` varchar(255) NOT NULL,
  `hallName` varchar(255) NOT NULL,
  `experienceID` varchar(255) NOT NULL,
  `seatmapDir` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `showtimes`
--

CREATE TABLE `showtimes` (
  `filmID` varchar(255) NOT NULL,
  `time` int(10) NOT NULL,
  `showtimeID` varchar(255) NOT NULL,
  `hallID` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tickets`
--

CREATE TABLE `tickets` (
  `userID` varchar(255) NOT NULL,
  `paymentID` varchar(255) NOT NULL,
  `ticketID` varchar(255) NOT NULL,
  `filmID` varchar(255) NOT NULL,
  `totalPrice` int(3) NOT NULL,
  `addonID` varchar(255) NOT NULL DEFAULT '0',
  `isValidated` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `userorders`
--

CREATE TABLE `userorders` (
  `filmID` varchar(255) NOT NULL,
  `userID` varchar(255) NOT NULL,
  `selectedSeats` varchar(255) NOT NULL,
  `selectedAddonID` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `userUniqID` varchar(255) NOT NULL,
  `firstName` varchar(255) NOT NULL,
  `lastName` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `isAdmin` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `addon`
--
ALTER TABLE `addon`
  ADD UNIQUE KEY `addonUniqID` (`addonUniqID`);
--
-- Database: `phpflix_db`
--
CREATE DATABASE IF NOT EXISTS `phpflix_db` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `phpflix_db`;

-- --------------------------------------------------------

--
-- Table structure for table `t_admins`
--

CREATE TABLE `t_admins` (
  `adminID` int(11) NOT NULL,
  `adminUsername` varchar(50) NOT NULL,
  `adminPassword` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `t_admins`
--

INSERT INTO `t_admins` (`adminID`, `adminUsername`, `adminPassword`) VALUES
(4, 'admin1', '0192023a7bbd73250516f069df18b500');

-- --------------------------------------------------------

--
-- Table structure for table `t_booking`
--

CREATE TABLE `t_booking` (
  `bookingID` int(11) NOT NULL,
  `movieID` int(11) NOT NULL,
  `firstName` varchar(100) NOT NULL,
  `lastName` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `phoneNumber` varchar(15) NOT NULL,
  `bookDate` varchar(30) NOT NULL,
  `bookTime` varchar(10) NOT NULL,
  `rowLetter` varchar(10) NOT NULL,
  `colNumber` varchar(15) NOT NULL,
  `username` varchar(100) NOT NULL,
  `bookTimestamp` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `t_booking`
--

INSERT INTO `t_booking` (`bookingID`, `movieID`, `firstName`, `lastName`, `email`, `phoneNumber`, `bookDate`, `bookTime`, `rowLetter`, `colNumber`, `username`, `bookTimestamp`) VALUES
(43, 1, 'Χρήστος', 'Μπάντης', 'chr.bandis@gmail.com', '6973979235', 'Wednesday 3 June', '18:00', 'Row B', 'Number 2', 'user', '2021-05-24 12:19:41'),
(45, 8, 'Χρήστος', 'Μπάντης', 'email@email.com', '6973979235', 'Thursday 2 June', '21:00', 'Row A', 'Line 4', 'admin', '2021-05-28 07:49:15'),
(47, 5, 'Χρήστος', 'Μπάντης', 'guest@guest.com', '6973979235', 'Wednesday 3 June', '23:00', 'Row G', 'Number 3', 'guest', '2021-05-28 07:50:27');

-- --------------------------------------------------------

--
-- Table structure for table `t_movies`
--

CREATE TABLE `t_movies` (
  `movieID` int(11) NOT NULL,
  `movieTitle` varchar(100) NOT NULL,
  `movieLogo` varchar(150) NOT NULL,
  `movieDesc` varchar(500) NOT NULL,
  `movieGenre` varchar(50) NOT NULL,
  `movieCast` varchar(150) NOT NULL,
  `movieDuration` varchar(10) NOT NULL,
  `movieRelDate` varchar(25) NOT NULL,
  `movieCover` varchar(150) NOT NULL,
  `movieTrailer` varchar(500) NOT NULL,
  `movieSeats` int(11) NOT NULL,
  `movieLink` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `t_movies`
--

INSERT INTO `t_movies` (`movieID`, `movieTitle`, `movieLogo`, `movieDesc`, `movieGenre`, `movieCast`, `movieDuration`, `movieRelDate`, `movieCover`, `movieTrailer`, `movieSeats`, `movieLink`) VALUES
(1, 'Bohemian Rhapsody', '../images/movie-logos/bohemian-rhapsody-logo.png', 'Bohemian Rhapsody is a foot-stomping celebration of Queen, their music and their extraordinary lead singer Freddie Mercury. Freddie defied stereotypes and shattered convention to become one of the most beloved entertainers on the planet.', 'Biography, Drama, Music', 'Rami Malek, Lucy Boynton, Gwilym Lee', '2h 14min', '1 November 2018', '../images/movies/Bohemian-Rapsody.jpg', '<iframe width=\"1116\" height=\"630\" src=\"https://www.youtube.com/embed/mP0VHJYFOAU?controls=0&autoplay=1&mute=1\" title=\"YouTube video player\" frameborder=\"0\" allow=\"accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture\" allowfullscreen></iframe>\r\n\r\n', 100, 'bohemian-rhapsody'),
(2, 'Fight Club', '../images/movie-logos/fight-club-logo.png', 'An insomniac office worker and a devil-may-care soap maker form an underground fight club that evolves into much more.', 'Drama', 'Brad Pitt, Edward Norton, Meat Loaf', '2h 19min', '18 February 2000', '../images/movies/Fight-Club.jpg', '<iframe width=\"1116\" height=\"630\" src=\"https://www.youtube.com/embed/qtRKdVHc-cE?controls=0&autoplay=1&mute=1\" title=\"YouTube video player\" frameborder=\"0\" allow=\"accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture\" allowfullscreen></iframe>', 80, 'fight-club'),
(3, 'Focus', '../images/movie-logos/focus-logo.png', 'In the midst of veteran con man Nicky\'s latest scheme, a woman from his past - now an accomplished femme fatale - shows up and throws his plans for a loop.', 'Comedy, Crime, Drama', 'Will Smith, Margot Robbie, Rodrigo Santoro', '1h 45min', '5 March 2015', '../images/movies/Focus.jpg', '<iframe width=\"1116\" height=\"630\" src=\"https://www.youtube.com/embed/MxCRgtdAuBo?controls=0&autoplay=1&mute=1\" title=\"YouTube video player\" frameborder=\"0\" allow=\"accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture\" allowfullscreen></iframe>', 40, 'focus'),
(5, 'Captain Marvel', '../images/movie-logos/captain-marvel-logo.png', 'Former Air Force pilot and intelligence agent Carol Danvers pursued her dream of space exploration as a NASA employee, but her life forever changed when she was accidentally transformed into a human-Kree hybrid with extraordinary powers.<br><br>\r\nNow, Carol is the latest warrior to embrace the mantle of Captain Marvel, and she has taken her place as one of the world\'s mightiest heroes.', 'Action, Adventure, Fantasy, Sci Fi', 'Brie Larson, Samuel L. Jackson, Ben Mendelsohn, Jude Law', '2h 3min', '7 March 2019', '../images/movies/captain-marvel.jpg', '<iframe width=\"1116\" height=\"630\" src=\"https://www.youtube.com/embed/Z1BCujX3pw8?controls=0&autoplay=1&mute=1\" title=\"YouTube video player\" frameborder=\"0\" allow=\"accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture\" allowfullscreen></iframe>', 120, 'captain-marvel'),
(6, 'Joker', '../images/movie-logos/joker-logo.png', 'In Gotham City, mentally troubled comedian Arthur Fleck is disregarded and mistreated by society. He then embarks on a downward spiral of revolution and bloody crime. This path brings him face-to-face with his alter-ego: the Joker.', 'Crime, Drama, Thriller', 'Joaquin Phoenix, Robert De Niro, Zazie Beetz', '2h 2min', '3 October 2019', '../images/movies/Joker.jpg', '<iframe width=\"1116\" height=\"630\" src=\"https://www.youtube.com/embed/zAGVQLHvwOY?controls=0&autoplay=1&mute=1\" title=\"YouTube video player\" frameborder=\"0\" allow=\"accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture\" allowfullscreen></iframe>', 90, 'joker'),
(7, 'Now You See Me 2', '../images/movie-logos/nysm2-logo.png', 'The Four Horsemen resurface, and are forcibly recruited by a tech genius to pull off their most impossible heist yet.', 'Action, Adventure, Comedy', 'Jesse Eisenberg, Mark Ruffalo, Woody Harrelson', '2h 9min', '9 June 2016', '../images/movies/NowYouSeeMe2.jpg', '<iframe width=\"1116\" height=\"630\" src=\"https://www.youtube.com/embed/4I8rVcSQbic?controls=0&autoplay=1&mute=1\" title=\"YouTube video player\" frameborder=\"0\" allow=\"accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture\" allowfullscreen></iframe>', 70, 'now-you-see-me-2'),
(8, 'The Lion King', '../images/movie-logos/lion-king-logo.png', 'Lion prince Simba and his father are targeted by his bitter uncle, who wants to ascend the throne himself.', 'Animation, Adventure, Drama', 'Matthew Broderick, Jeremy Irons, James Earl Jones', '1h 28min', '1 December 1994', '../images/movies/the-lion-king.jpg', '<iframe width=\"1116\" height=\"630\" src=\"https://www.youtube.com/embed/lFzVJEksoDY?controls=0&autoplay=1&mute=1\" title=\"YouTube video player\" frameborder=\"0\" allow=\"accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture\" allowfullscreen></iframe>', 150, 'lion-king'),
(9, 'The Accountant', '../images/movie-logos/accountant-logo.png', 'As a math savant uncooks the books for a new client, the Treasury Department closes in on his activities, and the body count starts to rise.', 'Action, Crime, Drama', 'Ben Affleck, Anna Kendrick, J.K. Simmons', '2h 8min', '20 October 2016', '../images/movies/The-Accountant.jpg', '<iframe width=\"1116\" height=\"630\" src=\"https://www.youtube.com/embed/DBfsgcswlYQ?controls=0&autoplay=1&mute=1\" title=\"YouTube video player\" frameborder=\"0\" allow=\"accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture\" allowfullscreen></iframe>', 50, 'accountant'),
(10, 'Pele', '../images/movie-logos/pele-logo.png', 'Pele\'s meteoric rise from the slums of Sao Paulo to leading Brazil to its first World Cup victory at the age of 17 is chronicled in this biographical drama.', 'Biography, Drama, Sport ', 'Vincent D\'Onofrio, Rodrigo Santoro, Diego Boneta', '1h 47min', '22 September 2016', '../images/movies/Pele.jpg', '<iframe width=\"1116\" height=\"630\" src=\"https://www.youtube.com/embed/XBrfxHOXsDE?controls=0&autoplay=1&mute=1\" title=\"YouTube video player\" frameborder=\"0\" allow=\"accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture\" allowfullscreen></iframe>', 30, 'pele'),
(11, 'A Star Is Born', '../images/movie-logos/star-born-logo.png', 'A musician helps a young singer find fame as age and alcoholism send his own career into a downward spiral.', 'Drama, Music, Romance', 'Lady Gaga, Bradley Cooper, Sam Elliott', '2h 16min', '4 October 2018', '../images/movies/Star-Born.jpg', '<iframe width=\"1116\" height=\"630\" src=\"https://www.youtube.com/embed/nSbzyEJ8X9E?controls=0&autoplay=1&mute=1\" title=\"YouTube video player\" frameborder=\"0\" allow=\"accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture\" allowfullscreen></iframe>', 60, 'star-born'),
(12, 'The Town', '../images/movie-logos/the-town-logo.png', 'A longtime thief, planning his next job, tries to balance his feelings for a bank manager connected to an earlier heist, and a hell-bent F.B.I Agent looking to bring him and his crew down.', 'Crime, Drama, Thriller ', 'Ben Affleck, Rebecca Hall, Jon Hamm ', '2h 5min', '21 October 2010', '../images/movies/The-Town.jpg', '<iframe width=\"1116\" height=\"630\" src=\"https://www.youtube.com/embed/WcXt9aUMbBk?controls=0&autoplay=1&mute=1\" title=\"YouTube video player\" frameborder=\"0\" allow=\"accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture\" allowfullscreen></iframe>', 30, 'the-town');

-- --------------------------------------------------------

--
-- Table structure for table `t_users`
--

CREATE TABLE `t_users` (
  `userID` int(11) NOT NULL,
  `firstName` varchar(100) NOT NULL,
  `lastName` varchar(100) NOT NULL,
  `username` varchar(100) NOT NULL,
  `phoneNumber` varchar(20) NOT NULL,
  `email` varchar(100) NOT NULL,
  `pass` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `t_users`
--

INSERT INTO `t_users` (`userID`, `firstName`, `lastName`, `username`, `phoneNumber`, `email`, `pass`) VALUES
(7, 'Χρήστος', 'Μπάντης', 'user', '6973979235', 'chr.bandis@gmail.com', '$2y$10$SojEi37etAsM1BXvYBj65u5UWDOLV0kw0Jh.d3cHKo18sPa1c.t3q');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `t_admins`
--
ALTER TABLE `t_admins`
  ADD PRIMARY KEY (`adminID`);

--
-- Indexes for table `t_booking`
--
ALTER TABLE `t_booking`
  ADD PRIMARY KEY (`bookingID`),
  ADD KEY `FK_movieID` (`movieID`);

--
-- Indexes for table `t_movies`
--
ALTER TABLE `t_movies`
  ADD PRIMARY KEY (`movieID`);

--
-- Indexes for table `t_users`
--
ALTER TABLE `t_users`
  ADD PRIMARY KEY (`userID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `t_admins`
--
ALTER TABLE `t_admins`
  MODIFY `adminID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `t_booking`
--
ALTER TABLE `t_booking`
  MODIFY `bookingID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=48;

--
-- AUTO_INCREMENT for table `t_movies`
--
ALTER TABLE `t_movies`
  MODIFY `movieID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `t_users`
--
ALTER TABLE `t_users`
  MODIFY `userID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `t_booking`
--
ALTER TABLE `t_booking`
  ADD CONSTRAINT `FK_movieID` FOREIGN KEY (`movieID`) REFERENCES `t_movies` (`movieID`) ON DELETE CASCADE ON UPDATE CASCADE;
--
-- Database: `phpmyadmin`
--
CREATE DATABASE IF NOT EXISTS `phpmyadmin` DEFAULT CHARACTER SET utf8 COLLATE utf8_bin;
USE `phpmyadmin`;

-- --------------------------------------------------------

--
-- Table structure for table `pma__bookmark`
--

CREATE TABLE `pma__bookmark` (
  `id` int(10) UNSIGNED NOT NULL,
  `dbase` varchar(255) NOT NULL DEFAULT '',
  `user` varchar(255) NOT NULL DEFAULT '',
  `label` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '',
  `query` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Bookmarks';

-- --------------------------------------------------------

--
-- Table structure for table `pma__central_columns`
--

CREATE TABLE `pma__central_columns` (
  `db_name` varchar(64) NOT NULL,
  `col_name` varchar(64) NOT NULL,
  `col_type` varchar(64) NOT NULL,
  `col_length` text DEFAULT NULL,
  `col_collation` varchar(64) NOT NULL,
  `col_isNull` tinyint(1) NOT NULL,
  `col_extra` varchar(255) DEFAULT '',
  `col_default` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Central list of columns';

-- --------------------------------------------------------

--
-- Table structure for table `pma__column_info`
--

CREATE TABLE `pma__column_info` (
  `id` int(5) UNSIGNED NOT NULL,
  `db_name` varchar(64) NOT NULL DEFAULT '',
  `table_name` varchar(64) NOT NULL DEFAULT '',
  `column_name` varchar(64) NOT NULL DEFAULT '',
  `comment` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '',
  `mimetype` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '',
  `transformation` varchar(255) NOT NULL DEFAULT '',
  `transformation_options` varchar(255) NOT NULL DEFAULT '',
  `input_transformation` varchar(255) NOT NULL DEFAULT '',
  `input_transformation_options` varchar(255) NOT NULL DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Column information for phpMyAdmin';

-- --------------------------------------------------------

--
-- Table structure for table `pma__designer_settings`
--

CREATE TABLE `pma__designer_settings` (
  `username` varchar(64) NOT NULL,
  `settings_data` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Settings related to Designer';

-- --------------------------------------------------------

--
-- Table structure for table `pma__export_templates`
--

CREATE TABLE `pma__export_templates` (
  `id` int(5) UNSIGNED NOT NULL,
  `username` varchar(64) NOT NULL,
  `export_type` varchar(10) NOT NULL,
  `template_name` varchar(64) NOT NULL,
  `template_data` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Saved export templates';

--
-- Dumping data for table `pma__export_templates`
--

INSERT INTO `pma__export_templates` (`id`, `username`, `export_type`, `template_name`, `template_data`) VALUES
(1, 'root', 'server', 'cinema', '{\"quick_or_custom\":\"quick\",\"what\":\"sql\",\"db_select[]\":[\"moviedb\",\"mts\",\"phpflix_db\",\"phpmyadmin\",\"test\"],\"aliases_new\":\"\",\"output_format\":\"sendit\",\"filename_template\":\"@SERVER@\",\"remember_template\":\"on\",\"charset\":\"utf-8\",\"compression\":\"none\",\"maxsize\":\"\",\"codegen_structure_or_data\":\"data\",\"codegen_format\":\"0\",\"csv_separator\":\",\",\"csv_enclosed\":\"\\\"\",\"csv_escaped\":\"\\\"\",\"csv_terminated\":\"AUTO\",\"csv_null\":\"NULL\",\"csv_columns\":\"something\",\"csv_structure_or_data\":\"data\",\"excel_null\":\"NULL\",\"excel_columns\":\"something\",\"excel_edition\":\"win\",\"excel_structure_or_data\":\"data\",\"json_structure_or_data\":\"data\",\"json_unicode\":\"something\",\"latex_caption\":\"something\",\"latex_structure_or_data\":\"structure_and_data\",\"latex_structure_caption\":\"Structure of table @TABLE@\",\"latex_structure_continued_caption\":\"Structure of table @TABLE@ (continued)\",\"latex_structure_label\":\"tab:@TABLE@-structure\",\"latex_relation\":\"something\",\"latex_comments\":\"something\",\"latex_mime\":\"something\",\"latex_columns\":\"something\",\"latex_data_caption\":\"Content of table @TABLE@\",\"latex_data_continued_caption\":\"Content of table @TABLE@ (continued)\",\"latex_data_label\":\"tab:@TABLE@-data\",\"latex_null\":\"\\\\textit{NULL}\",\"mediawiki_structure_or_data\":\"data\",\"mediawiki_caption\":\"something\",\"mediawiki_headers\":\"something\",\"htmlword_structure_or_data\":\"structure_and_data\",\"htmlword_null\":\"NULL\",\"ods_null\":\"NULL\",\"ods_structure_or_data\":\"data\",\"odt_structure_or_data\":\"structure_and_data\",\"odt_relation\":\"something\",\"odt_comments\":\"something\",\"odt_mime\":\"something\",\"odt_columns\":\"something\",\"odt_null\":\"NULL\",\"pdf_report_title\":\"\",\"pdf_structure_or_data\":\"data\",\"phparray_structure_or_data\":\"data\",\"sql_include_comments\":\"something\",\"sql_header_comment\":\"\",\"sql_use_transaction\":\"something\",\"sql_compatibility\":\"NONE\",\"sql_structure_or_data\":\"structure_and_data\",\"sql_create_table\":\"something\",\"sql_auto_increment\":\"something\",\"sql_create_view\":\"something\",\"sql_create_trigger\":\"something\",\"sql_backquotes\":\"something\",\"sql_type\":\"INSERT\",\"sql_insert_syntax\":\"both\",\"sql_max_query_size\":\"50000\",\"sql_hex_for_binary\":\"something\",\"sql_utc_time\":\"something\",\"texytext_structure_or_data\":\"structure_and_data\",\"texytext_null\":\"NULL\",\"yaml_structure_or_data\":\"data\",\"\":null,\"as_separate_files\":null,\"csv_removeCRLF\":null,\"excel_removeCRLF\":null,\"json_pretty_print\":null,\"htmlword_columns\":null,\"ods_columns\":null,\"sql_dates\":null,\"sql_relation\":null,\"sql_mime\":null,\"sql_disable_fk\":null,\"sql_views_as_tables\":null,\"sql_metadata\":null,\"sql_drop_database\":null,\"sql_drop_table\":null,\"sql_if_not_exists\":null,\"sql_simple_view_export\":null,\"sql_view_current_user\":null,\"sql_or_replace_view\":null,\"sql_procedure_function\":null,\"sql_truncate\":null,\"sql_delayed\":null,\"sql_ignore\":null,\"texytext_columns\":null}');

-- --------------------------------------------------------

--
-- Table structure for table `pma__favorite`
--

CREATE TABLE `pma__favorite` (
  `username` varchar(64) NOT NULL,
  `tables` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Favorite tables';

-- --------------------------------------------------------

--
-- Table structure for table `pma__history`
--

CREATE TABLE `pma__history` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `username` varchar(64) NOT NULL DEFAULT '',
  `db` varchar(64) NOT NULL DEFAULT '',
  `table` varchar(64) NOT NULL DEFAULT '',
  `timevalue` timestamp NOT NULL DEFAULT current_timestamp(),
  `sqlquery` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='SQL history for phpMyAdmin';

-- --------------------------------------------------------

--
-- Table structure for table `pma__navigationhiding`
--

CREATE TABLE `pma__navigationhiding` (
  `username` varchar(64) NOT NULL,
  `item_name` varchar(64) NOT NULL,
  `item_type` varchar(64) NOT NULL,
  `db_name` varchar(64) NOT NULL,
  `table_name` varchar(64) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Hidden items of navigation tree';

-- --------------------------------------------------------

--
-- Table structure for table `pma__pdf_pages`
--

CREATE TABLE `pma__pdf_pages` (
  `db_name` varchar(64) NOT NULL DEFAULT '',
  `page_nr` int(10) UNSIGNED NOT NULL,
  `page_descr` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='PDF relation pages for phpMyAdmin';

-- --------------------------------------------------------

--
-- Table structure for table `pma__recent`
--

CREATE TABLE `pma__recent` (
  `username` varchar(64) NOT NULL,
  `tables` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Recently accessed tables';

--
-- Dumping data for table `pma__recent`
--

INSERT INTO `pma__recent` (`username`, `tables`) VALUES
('root', '[{\"db\":\"moviedb\",\"table\":\"users\"},{\"db\":\"moviedb\",\"table\":\"bookings\"}]');

-- --------------------------------------------------------

--
-- Table structure for table `pma__relation`
--

CREATE TABLE `pma__relation` (
  `master_db` varchar(64) NOT NULL DEFAULT '',
  `master_table` varchar(64) NOT NULL DEFAULT '',
  `master_field` varchar(64) NOT NULL DEFAULT '',
  `foreign_db` varchar(64) NOT NULL DEFAULT '',
  `foreign_table` varchar(64) NOT NULL DEFAULT '',
  `foreign_field` varchar(64) NOT NULL DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Relation table';

-- --------------------------------------------------------

--
-- Table structure for table `pma__savedsearches`
--

CREATE TABLE `pma__savedsearches` (
  `id` int(5) UNSIGNED NOT NULL,
  `username` varchar(64) NOT NULL DEFAULT '',
  `db_name` varchar(64) NOT NULL DEFAULT '',
  `search_name` varchar(64) NOT NULL DEFAULT '',
  `search_data` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Saved searches';

-- --------------------------------------------------------

--
-- Table structure for table `pma__table_coords`
--

CREATE TABLE `pma__table_coords` (
  `db_name` varchar(64) NOT NULL DEFAULT '',
  `table_name` varchar(64) NOT NULL DEFAULT '',
  `pdf_page_number` int(11) NOT NULL DEFAULT 0,
  `x` float UNSIGNED NOT NULL DEFAULT 0,
  `y` float UNSIGNED NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Table coordinates for phpMyAdmin PDF output';

-- --------------------------------------------------------

--
-- Table structure for table `pma__table_info`
--

CREATE TABLE `pma__table_info` (
  `db_name` varchar(64) NOT NULL DEFAULT '',
  `table_name` varchar(64) NOT NULL DEFAULT '',
  `display_field` varchar(64) NOT NULL DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Table information for phpMyAdmin';

-- --------------------------------------------------------

--
-- Table structure for table `pma__table_uiprefs`
--

CREATE TABLE `pma__table_uiprefs` (
  `username` varchar(64) NOT NULL,
  `db_name` varchar(64) NOT NULL,
  `table_name` varchar(64) NOT NULL,
  `prefs` text NOT NULL,
  `last_update` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Tables'' UI preferences';

-- --------------------------------------------------------

--
-- Table structure for table `pma__tracking`
--

CREATE TABLE `pma__tracking` (
  `db_name` varchar(64) NOT NULL,
  `table_name` varchar(64) NOT NULL,
  `version` int(10) UNSIGNED NOT NULL,
  `date_created` datetime NOT NULL,
  `date_updated` datetime NOT NULL,
  `schema_snapshot` text NOT NULL,
  `schema_sql` text DEFAULT NULL,
  `data_sql` longtext DEFAULT NULL,
  `tracking` set('UPDATE','REPLACE','INSERT','DELETE','TRUNCATE','CREATE DATABASE','ALTER DATABASE','DROP DATABASE','CREATE TABLE','ALTER TABLE','RENAME TABLE','DROP TABLE','CREATE INDEX','DROP INDEX','CREATE VIEW','ALTER VIEW','DROP VIEW') DEFAULT NULL,
  `tracking_active` int(1) UNSIGNED NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Database changes tracking for phpMyAdmin';

-- --------------------------------------------------------

--
-- Table structure for table `pma__userconfig`
--

CREATE TABLE `pma__userconfig` (
  `username` varchar(64) NOT NULL,
  `timevalue` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `config_data` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='User preferences storage for phpMyAdmin';

--
-- Dumping data for table `pma__userconfig`
--

INSERT INTO `pma__userconfig` (`username`, `timevalue`, `config_data`) VALUES
('root', '2025-03-08 14:11:09', '{\"Console\\/Mode\":\"collapse\"}');

-- --------------------------------------------------------

--
-- Table structure for table `pma__usergroups`
--

CREATE TABLE `pma__usergroups` (
  `usergroup` varchar(64) NOT NULL,
  `tab` varchar(64) NOT NULL,
  `allowed` enum('Y','N') NOT NULL DEFAULT 'N'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='User groups with configured menu items';

-- --------------------------------------------------------

--
-- Table structure for table `pma__users`
--

CREATE TABLE `pma__users` (
  `username` varchar(64) NOT NULL,
  `usergroup` varchar(64) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Users and their assignments to user groups';

--
-- Indexes for dumped tables
--

--
-- Indexes for table `pma__bookmark`
--
ALTER TABLE `pma__bookmark`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pma__central_columns`
--
ALTER TABLE `pma__central_columns`
  ADD PRIMARY KEY (`db_name`,`col_name`);

--
-- Indexes for table `pma__column_info`
--
ALTER TABLE `pma__column_info`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `db_name` (`db_name`,`table_name`,`column_name`);

--
-- Indexes for table `pma__designer_settings`
--
ALTER TABLE `pma__designer_settings`
  ADD PRIMARY KEY (`username`);

--
-- Indexes for table `pma__export_templates`
--
ALTER TABLE `pma__export_templates`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `u_user_type_template` (`username`,`export_type`,`template_name`);

--
-- Indexes for table `pma__favorite`
--
ALTER TABLE `pma__favorite`
  ADD PRIMARY KEY (`username`);

--
-- Indexes for table `pma__history`
--
ALTER TABLE `pma__history`
  ADD PRIMARY KEY (`id`),
  ADD KEY `username` (`username`,`db`,`table`,`timevalue`);

--
-- Indexes for table `pma__navigationhiding`
--
ALTER TABLE `pma__navigationhiding`
  ADD PRIMARY KEY (`username`,`item_name`,`item_type`,`db_name`,`table_name`);

--
-- Indexes for table `pma__pdf_pages`
--
ALTER TABLE `pma__pdf_pages`
  ADD PRIMARY KEY (`page_nr`),
  ADD KEY `db_name` (`db_name`);

--
-- Indexes for table `pma__recent`
--
ALTER TABLE `pma__recent`
  ADD PRIMARY KEY (`username`);

--
-- Indexes for table `pma__relation`
--
ALTER TABLE `pma__relation`
  ADD PRIMARY KEY (`master_db`,`master_table`,`master_field`),
  ADD KEY `foreign_field` (`foreign_db`,`foreign_table`);

--
-- Indexes for table `pma__savedsearches`
--
ALTER TABLE `pma__savedsearches`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `u_savedsearches_username_dbname` (`username`,`db_name`,`search_name`);

--
-- Indexes for table `pma__table_coords`
--
ALTER TABLE `pma__table_coords`
  ADD PRIMARY KEY (`db_name`,`table_name`,`pdf_page_number`);

--
-- Indexes for table `pma__table_info`
--
ALTER TABLE `pma__table_info`
  ADD PRIMARY KEY (`db_name`,`table_name`);

--
-- Indexes for table `pma__table_uiprefs`
--
ALTER TABLE `pma__table_uiprefs`
  ADD PRIMARY KEY (`username`,`db_name`,`table_name`);

--
-- Indexes for table `pma__tracking`
--
ALTER TABLE `pma__tracking`
  ADD PRIMARY KEY (`db_name`,`table_name`,`version`);

--
-- Indexes for table `pma__userconfig`
--
ALTER TABLE `pma__userconfig`
  ADD PRIMARY KEY (`username`);

--
-- Indexes for table `pma__usergroups`
--
ALTER TABLE `pma__usergroups`
  ADD PRIMARY KEY (`usergroup`,`tab`,`allowed`);

--
-- Indexes for table `pma__users`
--
ALTER TABLE `pma__users`
  ADD PRIMARY KEY (`username`,`usergroup`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `pma__bookmark`
--
ALTER TABLE `pma__bookmark`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pma__column_info`
--
ALTER TABLE `pma__column_info`
  MODIFY `id` int(5) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pma__export_templates`
--
ALTER TABLE `pma__export_templates`
  MODIFY `id` int(5) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `pma__history`
--
ALTER TABLE `pma__history`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pma__pdf_pages`
--
ALTER TABLE `pma__pdf_pages`
  MODIFY `page_nr` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pma__savedsearches`
--
ALTER TABLE `pma__savedsearches`
  MODIFY `id` int(5) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- Database: `test`
--
CREATE DATABASE IF NOT EXISTS `test` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `test`;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
