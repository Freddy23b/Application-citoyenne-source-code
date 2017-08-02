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
-- Table structure for table `ta_bulkywaste`
--

CREATE TABLE `ta_bulkywaste` (
  `id` int(11) NOT NULL,
  `dat` datetime NOT NULL,
  `type` varchar(30) NOT NULL,
  `lat` double NOT NULL,
  `lng` double NOT NULL,
  `address` varchar(250) NOT NULL,
  `archives` tinyint(1) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `ta_bulkywaste`
--

INSERT INTO `ta_bulkywaste` (`id`, `dat`, `type`, `lat`, `lng`, `address`, `archives`) VALUES
(64, '2017-06-14 16:51:01', 'AUTRE', 44.8439871, -0.596839300000056, '58 rue de Marseilles Bordeaux', 1),
(63, '2017-06-14 16:36:57', 'MOBILIER', 44.86616192185141, -0.5535757541656494, '56 Rue des Étrangers, 33300 Bordeaux, France', 0),
(62, '2017-06-14 16:33:35', 'VERT', 44.864555499999994, -0.550485, '1 Rue de Gironde, 33300 Bordeaux, France', 1),
(68, '2017-06-16 14:27:05', 'ELECTROMENAGER', 44.863301, -0.6449016999999913, '13 rue georges brassens eysines', 0),
(75, '2017-06-16 16:29:35', 'FERRAILLE', 44.864520899999995, -0.5504293, '1 Rue de Gironde, 33300 Bordeaux, France', 0),
(65, '2017-06-16 14:23:20', 'FERRAILLE', 44.83298694046774, -0.6591796875, '8 Allée Jean Macé, 33700 Mérignac, France', 0),
(66, '2017-06-16 14:23:59', 'POLLUANT', 44.864522, -0.5504209999999999, '1 Rue de Gironde, 33300 Bordeaux, France', 0),
(67, '2017-06-16 14:24:47', 'AUTRE', 44.84010500000001, -0.6318659999999454, 'Rue Auguste Lamire Mérignac', 0),
(69, '2017-06-16 14:53:58', 'VERT', 44.802614, -0.5880540000000565, 'Talence', 0),
(70, '2017-06-16 14:54:49', 'MOBILIER', 44.86230269485423, -0.5356478691101074, '1 Rue Banlin, 33310 Lormont, France', 0),
(71, '2017-06-16 14:55:08', 'FERRAILLE', 44.85586880735725, -0.53009033203125, '7 Rue Marc Nouhaux, 33150 Cenon, France', 0),
(72, '2017-06-16 14:56:09', 'ELECTROMENAGER', 44.86449760000001, -0.5504433000000001, '1 Rue de Gironde, 33300 Bordeaux, France', 0),
(73, '2017-06-16 14:56:31', 'MENAGER', 44.864531899999996, -0.5504233, '1 Rue de Gironde, 33300 Bordeaux, France', 0),
(74, '2017-06-16 14:56:54', 'AUTRE', 44.8315260871932, -0.5321502685546875, '20 Avenue Paul Laffargue, 33270 Floirac, France', 0),
(76, '2017-06-16 16:29:51', 'MENAGER', 44.80181403934559, -0.635833740234375, '40 Avenue Roger Chaumet, 33600 Pessac, France', 0),
(77, '2017-06-16 16:54:16', 'MOBILIER', 44.87436239539944, -0.5218505859375, '9 Rue du Général Delestraint, 33310 Lormont, France', 0),
(78, '2017-06-17 14:51:57', 'MENAGER', 44.8632001, -0.6453093999999999, '9 Rue Georges Brassens, 33320 Eysines, France', 0),
(79, '2017-06-17 15:02:31', 'MOBILIER', 44.8631909, -0.6453593, '9 Rue Georges Brassens, 33320 Eysines, France', 0),
(80, '2017-06-17 17:11:28', 'ELECTROMENAGER', 44.863190599999996, -0.6453232999999999, '9 Rue Georges Brassens, 33320 Eysines, France', 0),
(81, '2017-06-17 17:12:35', 'FERRAILLE', 44.8646203, -0.6471380000000408, 'rue Camille Saint Saens Eysines', 0),
(82, '2017-06-17 17:18:11', 'POLLUANT', 44.85921512698254, -0.6400823593139648, '27 Rue Louis Coullet, 33700 Mérignac, France', 0),
(83, '2017-06-17 17:20:32', 'MENAGER', 44.88514310000001, -0.6480366000000686, 'Rue du Dr Barrière Eysines', 0),
(84, '2017-06-17 17:42:56', 'MOBILIER', 44.84833887716994, -0.6428074836730957, '5 Allée de la Prairie, 33700 Mérignac, France', 0),
(85, '2017-06-17 17:59:21', 'ELECTROMENAGER', 44.8631445, -0.6452395, '9 Rue Georges Brassens, 33320 Eysines, France', 0),
(86, '2017-06-17 18:00:35', 'ELECTROMENAGER', 44.8630791, -0.6452945999999999, '9 Rue Georges Brassens, 33320 Eysines, France', 0),
(87, '2017-06-17 18:01:08', 'VERT', 44.8630795, -0.6452475000000001, '9 Rue Georges Brassens, 33320 Eysines, France', 0),
(88, '2017-06-17 18:04:16', 'MENAGER', 44.8393993, -0.6364571999999953, 'Avenue de Verdun Mérignac', 1),
(89, '2017-06-19 10:41:52', 'ELECTROMENAGER', 44.864528799999995, -0.5504859999999999, '1 Rue de Gironde, 33300 Bordeaux, France', 0),
(90, '2017-06-19 17:34:22', 'VERT', 44.84820939999999, -0.5286995000000161, 'le Clos St Romain Cenon', 0),
(91, '2017-06-19 17:59:32', 'AUTRE', 44.864543499999996, -0.5505091999999999, '1 Rue de Gironde, 33300 Bordeaux, France', 1),
(92, '2017-06-19 18:00:57', 'VERT', 44.86915026865924, -0.672537088394165, '92-94 Avenue Pasteur, 33185 Le Haillan, France', 0),
(93, '2017-06-20 10:38:15', 'MENAGER', 44.864526999999995, -0.5504762, '1 Rue de Gironde, 33300 Bordeaux, France', 1),
(94, '2017-06-22 09:41:45', 'MOBILIER', 44.860888213868904, -0.5562901496887207, '25-47 Rue de la Faïencerie, 33300 Bordeaux, France', 0),
(95, '2017-06-22 09:42:21', 'MOBILIER', 44.8645563, -0.5505225, '1 Rue de Gironde, 33300 Bordeaux, France', 0),
(96, '2017-06-22 09:55:52', 'MENAGER', 44.8337704, -0.5133880999999292, 'Chemin des Plateaux\nFloirac', 0),
(97, '2017-06-23 15:24:54', 'ELECTROMENAGER', 44.80769009999999, -0.541027999999983, '10 rue des Doris Bègles', 0),
(98, '2017-06-23 15:43:51', 'AUTRE', 44.8021462, -0.6333181999999624, '25 rue Avenue Roger Chaumet Pessac', 0),
(99, '2017-06-24 20:28:06', 'FERRAILLE', 44.86326087190639, -0.6438159942626953, 'Résidence les Argilières, 33320 Eysines, France', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `ta_bulkywaste`
--
ALTER TABLE `ta_bulkywaste`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `ta_bulkywaste`
--
ALTER TABLE `ta_bulkywaste`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=100;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
