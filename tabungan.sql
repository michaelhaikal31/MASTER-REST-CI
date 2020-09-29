-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 29, 2020 at 06:11 AM
-- Server version: 10.4.6-MariaDB
-- PHP Version: 7.3.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `tabungan`
--

-- --------------------------------------------------------

--
-- Stand-in structure for view `get_pengeluaran`
-- (See below for the actual view)
--
CREATE TABLE `get_pengeluaran` (
`nominal` int(50)
,`id_pengeluaran` int(11)
,`keterangan` varchar(50)
,`date` date
,`saldo` int(11)
,`name` varchar(50)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `get_period`
-- (See below for the actual view)
--
CREATE TABLE `get_period` (
`id_room` int(11)
,`room` varchar(50)
,`period` varchar(50)
,`id_period` int(11)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `get_student`
-- (See below for the actual view)
--
CREATE TABLE `get_student` (
`name` varchar(50)
,`id_student` int(11)
,`saldo` int(11)
,`period` varchar(50)
,`id_period` int(11)
,`room` varchar(50)
,`id_room` int(11)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `get_tabungan`
-- (See below for the actual view)
--
CREATE TABLE `get_tabungan` (
`id_tabungan` int(11)
,`nominal` int(250)
,`id_student` int(11)
,`nama` varchar(50)
,`name_period` varchar(50)
,`name_room` varchar(50)
);

-- --------------------------------------------------------

--
-- Table structure for table `t_pengeluaran`
--

CREATE TABLE `t_pengeluaran` (
  `id_pengeluaran` int(11) NOT NULL,
  `nominal` int(50) NOT NULL,
  `keterangan` varchar(50) NOT NULL,
  `date` date NOT NULL,
  `id_student` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `t_pengeluaran`
--

INSERT INTO `t_pengeluaran` (`id_pengeluaran`, `nominal`, `keterangan`, `date`, `id_student`) VALUES
(1, 20000, 'adm bulan juni', '2020-06-25', 13),
(2, 10000, 'iyuran bpjs', '2020-06-25', 13),
(3, 100, 'iyuran bpjs', '2020-06-28', 13),
(4, 2000, 'iyuran arisan', '2020-06-30', 14),
(5, 2000, 'iyuran arisan', '2020-06-30', 14),
(6, 10, 'ada deh', '0000-00-00', 13);

-- --------------------------------------------------------

--
-- Table structure for table `t_period`
--

CREATE TABLE `t_period` (
  `id_period` int(11) NOT NULL,
  `period` varchar(50) NOT NULL,
  `id_room` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `t_period`
--

INSERT INTO `t_period` (`id_period`, `period`, `id_room`) VALUES
(1, '2020 / 2021', 1),
(2, '2020 / 2021', 2),
(3, '2020 / 2021', 3),
(4, '2020 / 2021', 4),
(5, '2021 / 2022', 1),
(6, '2020 / 2021', 5);

-- --------------------------------------------------------

--
-- Table structure for table `t_room`
--

CREATE TABLE `t_room` (
  `id_room` int(11) NOT NULL,
  `room` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `t_room`
--

INSERT INTO `t_room` (`id_room`, `room`) VALUES
(1, 'A - 1'),
(2, 'A - 2'),
(3, 'B - 1'),
(4, 'B - 2'),
(5, 'C - 1');

-- --------------------------------------------------------

--
-- Table structure for table `t_student`
--

CREATE TABLE `t_student` (
  `id_student` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `saldo` int(11) DEFAULT NULL,
  `id_room` int(11) DEFAULT NULL,
  `id_period` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `t_student`
--

INSERT INTO `t_student` (`id_student`, `name`, `saldo`, `id_room`, `id_period`) VALUES
(1, 'Alvin Zaid Maulana', 0, 1, 1),
(2, 'Aulia Maharani', 0, 1, 1),
(3, 'Dewi Putri Ayu Andini', 0, 1, 1),
(4, 'Fazila Fahmidah Putri', 0, 1, 1),
(5, 'Haikal Mulyana', 6000, 2, 2),
(6, 'Irfan Ma\'arif', 0, 2, 2),
(7, 'Kamal Ramdhani', 0, 2, 2),
(8, 'Khaffa Nabillah', 0, 2, 2),
(9, 'M. Abdul Rahman Al Safar', 0, 3, 3),
(10, 'M. Deddy Heryawan', 0, 3, 3),
(11, 'M. Faiza Nurwahyudi', 0, 4, 4),
(12, 'M. Haikal Fauzi', 0, 4, 4),
(13, 'fathurrohman haikal', 590, 1, 5),
(14, 'inayahtulmaula', -900, 1, 5);

-- --------------------------------------------------------

--
-- Table structure for table `t_tabungan`
--

CREATE TABLE `t_tabungan` (
  `id_tabungan` int(11) NOT NULL,
  `nominal` int(250) NOT NULL,
  `date` date NOT NULL,
  `id_student` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `t_tabungan`
--

INSERT INTO `t_tabungan` (`id_tabungan`, `nominal`, `date`, `id_student`) VALUES
(2, 20000, '0000-00-00', 13),
(3, 10000, '0000-00-00', 13),
(13, 300, '0000-00-00', 13),
(14, 300, '0000-00-00', 13),
(15, 100, '0000-00-00', 13),
(16, 1000, '0000-00-00', 14),
(17, 3000, '0000-00-00', 14),
(18, 6000, '0000-00-00', 5);

-- --------------------------------------------------------

--
-- Table structure for table `t_user`
--

CREATE TABLE `t_user` (
  `id_user` int(11) NOT NULL,
  `Username` varchar(50) NOT NULL,
  `Password` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `t_user`
--

INSERT INTO `t_user` (`id_user`, `Username`, `Password`) VALUES
(1, 'mamat', 'password'),
(2, 'ayay', 'password123');

-- --------------------------------------------------------

--
-- Structure for view `get_pengeluaran`
--
DROP TABLE IF EXISTS `get_pengeluaran`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `get_pengeluaran`  AS  select `t_pengeluaran`.`nominal` AS `nominal`,`t_pengeluaran`.`id_pengeluaran` AS `id_pengeluaran`,`t_pengeluaran`.`keterangan` AS `keterangan`,`t_pengeluaran`.`date` AS `date`,`t_student`.`saldo` AS `saldo`,`t_student`.`name` AS `name` from (`t_pengeluaran` left join `t_student` on(`t_student`.`id_student` = `t_pengeluaran`.`id_student`)) order by `t_pengeluaran`.`date` desc ;

-- --------------------------------------------------------

--
-- Structure for view `get_period`
--
DROP TABLE IF EXISTS `get_period`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `get_period`  AS  select `t_room`.`id_room` AS `id_room`,`t_room`.`room` AS `room`,`t_period`.`period` AS `period`,`t_period`.`id_period` AS `id_period` from (`t_period` left join `t_room` on(`t_room`.`id_room` = `t_period`.`id_room`)) order by `t_room`.`room` ;

-- --------------------------------------------------------

--
-- Structure for view `get_student`
--
DROP TABLE IF EXISTS `get_student`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `get_student`  AS  select `t_student`.`name` AS `name`,`t_student`.`id_student` AS `id_student`,`t_student`.`saldo` AS `saldo`,`t_period`.`period` AS `period`,`t_student`.`id_period` AS `id_period`,`t_room`.`room` AS `room`,`t_student`.`id_room` AS `id_room` from ((`t_student` left join `t_room` on(`t_room`.`id_room` = `t_student`.`id_room`)) left join `t_period` on(`t_period`.`id_period` = `t_student`.`id_period`)) ;

-- --------------------------------------------------------

--
-- Structure for view `get_tabungan`
--
DROP TABLE IF EXISTS `get_tabungan`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `get_tabungan`  AS  select `t_tabungan`.`id_tabungan` AS `id_tabungan`,`t_tabungan`.`nominal` AS `nominal`,`t_student`.`id_student` AS `id_student`,`t_student`.`name` AS `nama`,`t_period`.`period` AS `name_period`,`t_room`.`room` AS `name_room` from (((`t_tabungan` left join `t_student` on(`t_student`.`id_student` = `t_tabungan`.`id_student`)) left join `t_period` on(`t_period`.`id_period` = `t_student`.`id_period`)) left join `t_room` on(`t_room`.`id_room` = `t_period`.`id_room` and `t_room`.`id_room` = `t_student`.`id_room`)) ;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `t_pengeluaran`
--
ALTER TABLE `t_pengeluaran`
  ADD PRIMARY KEY (`id_pengeluaran`);

--
-- Indexes for table `t_period`
--
ALTER TABLE `t_period`
  ADD PRIMARY KEY (`id_period`) USING BTREE;

--
-- Indexes for table `t_room`
--
ALTER TABLE `t_room`
  ADD PRIMARY KEY (`id_room`) USING BTREE;

--
-- Indexes for table `t_student`
--
ALTER TABLE `t_student`
  ADD PRIMARY KEY (`id_student`);

--
-- Indexes for table `t_tabungan`
--
ALTER TABLE `t_tabungan`
  ADD PRIMARY KEY (`id_tabungan`);

--
-- Indexes for table `t_user`
--
ALTER TABLE `t_user`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `t_pengeluaran`
--
ALTER TABLE `t_pengeluaran`
  MODIFY `id_pengeluaran` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `t_period`
--
ALTER TABLE `t_period`
  MODIFY `id_period` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `t_room`
--
ALTER TABLE `t_room`
  MODIFY `id_room` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `t_student`
--
ALTER TABLE `t_student`
  MODIFY `id_student` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `t_tabungan`
--
ALTER TABLE `t_tabungan`
  MODIFY `id_tabungan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `t_user`
--
ALTER TABLE `t_user`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
