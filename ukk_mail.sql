-- phpMyAdmin SQL Dump
-- version 4.6.5.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: 08 Feb 2018 pada 06.47
-- Versi Server: 10.1.21-MariaDB
-- PHP Version: 7.1.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ukk_mail`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `desposition`
--

CREATE TABLE `desposition` (
  `id` int(11) NOT NULL,
  `desposition_at` datetime NOT NULL,
  `reply_at` datetime DEFAULT NULL,
  `description` text NOT NULL,
  `notification` varchar(30) NOT NULL,
  `mailid` int(11) NOT NULL,
  `userid` int(11) NOT NULL,
  `status` int(1) NOT NULL DEFAULT '0',
  `despositionid` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `desposition`
--

INSERT INTO `desposition` (`id`, `desposition_at`, `reply_at`, `description`, `notification`, `mailid`, `userid`, `status`, `despositionid`) VALUES
(1, '2018-02-08 14:23:15', NULL, 'desc', 'notiffffff', 1, 8, 0, NULL),
(2, '2018-02-08 04:32:59', NULL, 'Kerjakan dungs', 'penting', 2, 8, 0, NULL),
(3, '2018-02-08 04:34:55', NULL, 'Harap lapor', 'urgent', 1, 8, 0, NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `mail`
--

CREATE TABLE `mail` (
  `id` int(11) NOT NULL,
  `incoming_at` date NOT NULL,
  `mail_code` varchar(30) NOT NULL,
  `mail_date` date NOT NULL,
  `mail_from` varchar(30) NOT NULL,
  `mail_to` varchar(30) NOT NULL,
  `mail_subject` varchar(30) NOT NULL,
  `description` text NOT NULL,
  `mail_upload` varchar(30) NOT NULL,
  `mail_typeid` int(11) NOT NULL,
  `userid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `mail`
--

INSERT INTO `mail` (`id`, `incoming_at`, `mail_code`, `mail_date`, `mail_from`, `mail_to`, `mail_subject`, `description`, `mail_upload`, `mail_typeid`, `userid`) VALUES
(1, '2018-02-07', '123', '2018-12-31', 'from', 'to', 'subj', 'desc', 'intro.pdf', 1, 1),
(2, '2018-02-07', '1234', '2016-12-31', 'A', 'B', 'AAAA', 'Deafoiaf', 'Code_Your_Future_Proposal.pdf', 1, 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `mail_type`
--

CREATE TABLE `mail_type` (
  `id` int(11) NOT NULL,
  `type` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `mail_type`
--

INSERT INTO `mail_type` (`id`, `type`) VALUES
(1, 'Internal'),
(2, 'Eksternal');

-- --------------------------------------------------------

--
-- Struktur dari tabel `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `username` varchar(30) NOT NULL,
  `password` text NOT NULL,
  `fullname` varchar(30) NOT NULL,
  `level` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `user`
--

INSERT INTO `user` (`id`, `username`, `password`, `fullname`, `level`) VALUES
(1, 'admin', '$2y$10$rKiuj0KSaEY1J7LDN.0tlu4PM/m2MtTiLEq1MfqRsMIto//MhpmV2', 'Admin', 1),
(8, 'halo', '$2y$10$xf4cyIV0TfWWSBJZip1RVenI4IJJzKQ.LPDJnXEjWfUTN32wc.lQK', 'Halo Hai', 3);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `desposition`
--
ALTER TABLE `desposition`
  ADD PRIMARY KEY (`id`),
  ADD KEY `mailid` (`mailid`),
  ADD KEY `userid` (`userid`),
  ADD KEY `dispositionid` (`despositionid`);

--
-- Indexes for table `mail`
--
ALTER TABLE `mail`
  ADD PRIMARY KEY (`id`),
  ADD KEY `mail_typeid` (`mail_typeid`),
  ADD KEY `userid` (`userid`);

--
-- Indexes for table `mail_type`
--
ALTER TABLE `mail_type`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `desposition`
--
ALTER TABLE `desposition`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `mail`
--
ALTER TABLE `mail`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `mail_type`
--
ALTER TABLE `mail_type`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `desposition`
--
ALTER TABLE `desposition`
  ADD CONSTRAINT `desposition_ibfk_1` FOREIGN KEY (`mailid`) REFERENCES `mail` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `desposition_ibfk_2` FOREIGN KEY (`userid`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `desposition_ibfk_3` FOREIGN KEY (`despositionid`) REFERENCES `desposition` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `mail`
--
ALTER TABLE `mail`
  ADD CONSTRAINT `mail_ibfk_1` FOREIGN KEY (`mail_typeid`) REFERENCES `mail_type` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `mail_ibfk_2` FOREIGN KEY (`userid`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
