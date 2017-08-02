-- phpMyAdmin SQL Dump
-- version 4.6.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 02, 2017 at 08:27 AM
-- Server version: 5.7.14
-- PHP Version: 5.6.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `devzata`
--

-- --------------------------------------------------------

--
-- Table structure for table `ta_rdv`
--

CREATE TABLE `ta_rdv` (
  `id` int(11) NOT NULL,
  `rdvdate` tinytext NOT NULL,
  `rdvhour` tinytext NOT NULL,
  `rdvaddress` varchar(250) NOT NULL,
  `rdvname` tinytext NOT NULL,
  `rdvemail` tinytext NOT NULL,
  `archives` tinyint(1) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `ta_rdv`
--

INSERT INTO `ta_rdv` (`id`, `rdvdate`, `rdvhour`, `rdvaddress`, `rdvname`, `rdvemail`, `archives`) VALUES
(9, '13-06-2017', '8-10', '', '', '', 0),
(8, '14-06-2017', '10-12', '', '', '', 0),
(7, '13-06-2017', '16-18', 'u', '', 'a@a', 0),
(6, '13-06-2017', '10-12', 'f', '', 'a@a', 0),
(10, '28-06-2017', '8-10', '12 rue des Orangers Bègles', '', 'exemple@mail.com', 0),
(11, '20-06-2017', '8-10', 'Avenue des rigoles Langon', '', 'flyeur@mail.fr', 0),
(12, '21-06-2017', '8-10', '28 Quai des Myreilles 33000 Bordeaux', '', 'capa.lomi@mail.fr', 0),
(13, '29-06-2017', '8-10', 'Rue du Béarn, 33600 Langon', 'Kirohui', 'kirohui@numer.com', 0),
(14, '23-06-2017', '16-18', '11 rue des Maronniers\nBouliac', 'Pirei', 'p.plopirei@free.fr', 0),
(15, '30-06-2017', '14-16', 'Rue de Moris Bériand', 'Serrand', 'greg.ser@hotmail.com', 0),
(16, '29-06-2017', '14-16', '12 Place de Parisse Bouliac', 'Lamouru', 'lamou.piana@free.fr', 0),
(17, '29-06-2017', '10-12', '13 rue du Parc Bègles', 'Borin', 'borin22@numericable.fr', 0),
(18, '28-06-2017', '10-12', 'Rue des Marroniers Bègles', 'labouhaere', 'kiou@mail.fr', 0),
(19, '30-06-2017', '8-10', 'iiojiojjoi', 'ijoijoij', 'jiojio@joiji.lo', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `ta_rdv`
--
ALTER TABLE `ta_rdv`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `ta_rdv`
--
ALTER TABLE `ta_rdv`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
