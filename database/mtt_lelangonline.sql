-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 25 Nov 2020 pada 06.45
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
-- Database: `mtt_lelangonline`
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
('ger', 2, 4750000, 0),
('ger', 6, 300000, 0),
('rizky', 1, 2650000, 0),
('rizky', 2, 4800000, 0),
('rizky', 6, 325000, 0),
('roby', 1, 3400000, 1),
('roby', 2, 4500000, 0),
('yusfian', 1, 2700000, 0),
('yusfian', 4, 4300000, 0),
('yusfian', 5, 300000, 0),
('yusfian', 6, 450000, 0);

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
(1, 'ger', 'PS 5', '2020-11-02 09:06:33', 2500000, 'SOLD', 'jpg'),
(2, 'yusfian', 'Xbox Series X', '2020-11-02 09:09:32', 4250000, 'OPEN', 'jpg'),
(3, 'yusfian', 'RTX 3090', '2020-11-02 09:12:20', 6340000, 'OPEN', 'jpg'),
(4, 'rizky', 'Iphone 12', '2020-11-02 09:13:16', 4250000, 'OPEN', 'jpg'),
(5, 'roby', 'Blackpink The Album', '2020-11-03 13:15:10', 250000, 'OPEN', 'jpg'),
(6, 'roby', 'Itzy Not Shy EP', '2020-11-03 13:16:09', 225000, 'OPEN', 'jpg');

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
('feby', 'Feby', 'a155dc74c1ce8a2dfd68e1cb930b8476afdd2179', '35bee7585d'),
('ger', 'Gerald', '3f60e5e0e3128799d59db887855d417bd63b77ed', '759cc4e765'),
('rizky', 'Muhammad Rizky', '30735139992f698fc041391dec49fe52a58326b2', '448364c2b2'),
('roby', 'Roby Firmansyah', '63e0f2ade3a20de20f27125c345dcf7e94c92ff9', '387c626300'),
('yusfian', 'Rizky Yusfian', 'e78b0f536d888af8645be2df93864319875b250a', '21f448a24e');

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
  MODIFY `iditem` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

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
