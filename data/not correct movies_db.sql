-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 30, 2018 at 01:32 AM
-- Server version: 10.1.36-MariaDB
-- PHP Version: 7.2.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `movies_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `movie_table`
--

CREATE TABLE `movie_table` (
  `movie_id` int(11) NOT NULL,
  `movie_name` mediumtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `year_made` int(4) NOT NULL,
  `language` mediumtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `lead_actor` mediumtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `lead_actress` mediumtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `director` mediumtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `music_director` mediumtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `other_cast` mediumtext COLLATE utf8mb4_unicode_ci,
  `status` mediumtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(45) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `movie_table`
--

INSERT INTO `movie_table` (`movie_id`, `movie_name`, `year_made`, `language`, `lead_actor`, `lead_actress`, `director`, `music_director`, `other_cast`, `status`, `image`) VALUES
(1, 'Black Panther', 2018, 'English', 'Chadwick Boseman', 'Lupita Nyong\'o', 'Ryan Coogler', 'Ludwig Goransson', 'Michael B. Jordan', 'Active', 'black_panther.jpg'),
(2, 'Get Out', 2017, 'English', 'Daniel Kaluuya', 'Allison Williams', 'Jordan Peele', 'Michael Ables', 'Bradley Whitford', 'Active', 'get_out.jpg'),
(3, 'Crazy Rich Asians', 2018, 'English', 'Henry Golding', 'Constance Wu', 'Jon M. Chu', 'Brian Tyler', 'Gemma Chan', 'Active', 'crazy_asians.jpg'),
(4, 'Titanic', 1997, 'English', 'Leonardo DiCaprio', 'Kate Winslet', 'James Cameron', 'James Horner', 'Billy Zane', 'Active', 'titanic_titanic.jpg'),
(5, 'The Dark Knight', 2008, 'English', 'Christian Bale', 'Maggie Gyllenhaal', 'Christopher Nolan', 'Hans Zimmer', 'Heath Ledger', 'Active', 'the_knight.jpg'),
(6, 'Avengers', 2012, 'English', 'Robert Downey Jr.', 'Scarlett Johansson', 'Joss Whedon', 'Alan Silvestri', 'Samuel L. Jackson', 'Active', 'avengers_avengers.jpg'),
(7, 'Pulp Fiction', 1994, 'English', 'John Travolta', 'Uma Thurman', 'Quentin Tarantino', 'None', 'Samuel L. Jackson', 'Active', 'pulp_fiction.jpg'),
(8, 'Toy Story', 1995, 'English', 'Tom Hanks', 'Annie Potts', 'John Lasseter', 'Randy Newman', 'Tim Allen', 'Active', 'toy_story.jpg'),
(9, 'Forest Gump', 1994, 'English', 'Tom Hanks', 'Robin Wright', 'Robert Zemeckis', 'Alan Silvestri', 'Gary Sinese', 'Active', 'forest_gump.jpg'),
(10, 'Schindlers List', 1993, 'English', 'Liam Neeson', 'Carline Goodall', 'Steven Spielberg', 'John Williams', 'Ben Kingsley', 'Active', 'schindlers_list.jpg'),
(11, 'GoodFellas', 1990, 'English', 'Robert De Niro', 'Lorraine Bracco', 'Martin Scorsese', 'Pete Townshend', 'Ray Liotta', 'Active', 'goodfellas_goodfellas.jpg'),
(12, 'Rocky', 1976, 'English', 'Sylvester Stallone', 'Talia Shire', 'John G. Avildsen', 'Irwin Winkler', 'Burt Young', 'Active', 'rocky_rocky.jpg'),
(13, 'Gone With the Wind', 1939, 'English', 'Clark Gable', 'Vivien Leigh', 'Victor Fleming', 'Max Steiner', 'Leslie Howard', 'Active', 'gone_wind.jpg'),
(14, 'Citizen Kane', 1941, 'English', 'Orson Welles', 'Dorothy Comingore', 'Orson Welles', 'Bernard Herrmann', 'Everett Sloane', 'Active', 'citizen_kane.jpg'),
(15, 'The Shining', 1980, 'English', 'Jack Nicholson', 'Shelley Duvall', 'Stanley Kubrick', 'Wendy Carlos', 'Scatman Crothers', 'Active', 'the_shining.jpg'),
(27, 'test year', 0, 'test L A', 'Test LAA', 'Test Dir', 'Test Mdir', 'test OC', 'Test Stat', 'Test', ''),
(28, 'test year', 0, 'test L A', 'Test LAA', 'Test Dir', 'Test Mdir', 'test OC', 'Test Stat', 'Test', ''),
(29, 'చందమామ', 1990, 'Telegu', 'చందమామ', '', '', '', '', '', ''),
(30, 'బొబ్బిలిపులి', 2000, 'Telegu', 'బొబ్బిలిపులి', '', '', '', '', '', ''),
(31, 'కొండవీటిసింహం', 2018, 'Telegu', 'కొండవీటిసింహం', '', '', '', '', '', ''),
(32, 'బాహుబలి', 1998, 'Telegu', 'బాహుబలి', '', '', '', '', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `publisher`
--

CREATE TABLE `publisher` (
  `publisher_name` varchar(42) NOT NULL,
  `logo` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `publisher`
--

INSERT INTO `publisher` (`publisher_name`, `logo`) VALUES
('Movie Database', 'MD');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `first_name` varchar(50) NOT NULL,
  `last_name` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `hash` varchar(32) NOT NULL,
  `active` tinyint(1) NOT NULL DEFAULT '0',
  `type` varchar(12) NOT NULL DEFAULT 'Customer'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `first_name`, `last_name`, `email`, `password`, `hash`, `active`, `type`) VALUES
(1, 'Site', 'Admin', 'Admin@moviesdb.com', '$2y$10$zFAG5GBNtf.5BpowMqZSputSLeG8OzfKACpjAMsePjZhu.TnvU/Bu', '357a6fdf7642bf815a88822c447d9dc4', 1, 'Admin');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `movie_table`
--
ALTER TABLE `movie_table`
  ADD PRIMARY KEY (`movie_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `movie_table`
--
ALTER TABLE `movie_table`
  MODIFY `movie_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
