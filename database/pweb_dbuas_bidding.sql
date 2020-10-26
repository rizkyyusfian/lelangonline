-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 02 Okt 2020 pada 10.12
-- Versi server: 10.1.37-MariaDB
-- Versi PHP: 7.3.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `pweb_dbuas_bidding`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `biddings`
--

CREATE TABLE `biddings` (
  `iduser` varchar(45) NOT NULL,
  `iditem` int(11) NOT NULL,
  `price_offer` double DEFAULT NULL,
  `is_winner` tinyint(1) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data untuk tabel `biddings`
--

INSERT INTO `biddings` (`iduser`, `iditem`, `price_offer`, `is_winner`) VALUES
('admin', 1, 125000, 0),
('admin', 2, 2150000, 0),
('admin', 12, 412000, 0),
('dio', 5, 210000000, 0),
('ger', 1, 150000, 0),
('ger', 4, 2500000, 1),
('ger', 13, 8750000, 0),
('rizky', 2, 2300000, 0),
('rizky', 6, 650000000, 1),
('rizky', 8, 825000, 0),
('yusfian', 1, 140000, 1),
('yusfian', 3, 230000, 1),
('yusfian', 8, 900000, 0);

-- --------------------------------------------------------

--
-- Struktur dari tabel `items`
--

CREATE TABLE `items` (
  `iditem` int(11) NOT NULL,
  `iduser_owner` varchar(45) NOT NULL,
  `name` varchar(45) DEFAULT NULL,
  `date_posting` datetime DEFAULT NULL,
  `price_initial` double DEFAULT NULL,
  `status` enum('OPEN','SOLD','CANCEL') DEFAULT 'OPEN',
  `image_extension` varchar(3) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data untuk tabel `items`
--

INSERT INTO `items` (`iditem`, `iduser_owner`, `name`, `date_posting`, `price_initial`, `status`, `image_extension`) VALUES
(1, 'rizky', 'Gitar Akustik', '2020-05-31 08:31:09', 120000, 'SOLD', 'png'),
(2, 'yusfian', 'Iphone 11 Pro Max', '2020-05-31 08:34:03', 2000000, 'OPEN', 'png'),
(3, 'rizky', 'Mouse Logitech G502 Hero', '2020-05-31 08:40:13', 200000, 'SOLD', 'png'),
(4, 'rizky', 'Ps4 PRO 1Tb', '2020-05-31 08:42:40', 1300000, 'SOLD', 'jpg'),
(5, 'rizky', 'Jam Rolex Skeleton', '2020-06-01 09:50:51', 200000000, 'CANCEL', 'jpg'),
(6, 'admin', 'Aston Martin DB11', '2020-06-01 09:55:26', 600000000, 'SOLD', 'jpg'),
(7, 'yusfian', 'Pc Gaming i9 2070Rtx', '2020-06-05 08:56:31', 14000000, 'OPEN', 'png'),
(8, 'ger', 'Nintend Switch Animal Crossing Edition', '2020-06-05 09:09:02', 800000, 'OPEN', 'png'),
(9, 'admin', 'Router Asus', '2020-06-05 09:23:16', 3200000, 'CANCEL', 'jpg'),
(10, 'ger', 'Razer Kraken Pro', '2020-06-05 10:19:23', 60000, 'OPEN', 'png'),
(11, 'ger', 'Album Blackpink Kill This Love', '2020-06-05 10:36:23', 160000, 'OPEN', 'jpg'),
(12, 'yusfian', 'Supreme Gun', '2020-06-05 10:39:54', 365000, 'OPEN', 'jpg'),
(13, 'admin', 'Level 1000 Collector Aegis', '2020-06-06 10:14:29', 5000000, 'OPEN', 'jpg');

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `iduser` varchar(45) NOT NULL,
  `name` varchar(45) DEFAULT NULL,
  `password` varchar(50) DEFAULT NULL,
  `salt` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`iduser`, `name`, `password`, `salt`) VALUES
('admin', 'admin', 'be38afbd2e669e70cc3bfd4924c336fb03eca5e6', 'b7a97b57c5'),
('dio', 'dio', '92aa37799f6161012759dcccaa11f848a7e97535', '40fad74a5a'),
('ger', 'ger', '716d0861c64ec157ce8fce0a514cb585ab6e8121', '09a66efef4'),
('rizky', 'rizky', '315c7996d019407484d631ddefe1c9559ba1ce54', '645b743a47'),
('roby', 'roby', '9cc963e45a371858a89eaeb6e1e6f053ace2ad4a', '638b865c75'),
('yusfian', 'yusfian', '24d126c819d43b32b2c4ee95cc326ba84ee9a200', '855bd7ffd6');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `biddings`
--
ALTER TABLE `biddings`
  ADD PRIMARY KEY (`iduser`,`iditem`),
  ADD KEY `fk_users_has_items_items1_idx` (`iditem`),
  ADD KEY `fk_users_has_items_users1_idx` (`iduser`);

--
-- Indeks untuk tabel `items`
--
ALTER TABLE `items`
  ADD PRIMARY KEY (`iditem`),
  ADD KEY `fk_items_users_idx` (`iduser_owner`);

--
-- Indeks untuk tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`iduser`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `items`
--
ALTER TABLE `items`
  MODIFY `iditem` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `biddings`
--
ALTER TABLE `biddings`
  ADD CONSTRAINT `fk_users_has_items_items1` FOREIGN KEY (`iditem`) REFERENCES `items` (`iditem`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_users_has_items_users1` FOREIGN KEY (`iduser`) REFERENCES `users` (`iduser`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Ketidakleluasaan untuk tabel `items`
--
ALTER TABLE `items`
  ADD CONSTRAINT `fk_items_users` FOREIGN KEY (`iduser_owner`) REFERENCES `users` (`iduser`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
