-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 07 Jan 2020 pada 17.11
-- Versi server: 10.1.37-MariaDB
-- Versi PHP: 7.3.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `koperasi_bmt`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_anggota`
--

CREATE TABLE `tbl_anggota` (
  `id_anggota` varchar(6) NOT NULL,
  `nik` varchar(20) NOT NULL,
  `nama_anggota` varchar(30) NOT NULL,
  `tempat_lahir` varchar(20) NOT NULL,
  `tanggal_lahir` date NOT NULL,
  `gender` varchar(15) NOT NULL,
  `alamat` text NOT NULL,
  `pekerjaan` varchar(30) NOT NULL,
  `status` varchar(20) NOT NULL,
  `tanggal_masuk` date NOT NULL,
  `keterangan` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tbl_anggota`
--

INSERT INTO `tbl_anggota` (`id_anggota`, `nik`, `nama_anggota`, `tempat_lahir`, `tanggal_lahir`, `gender`, `alamat`, `pekerjaan`, `status`, `tanggal_masuk`, `keterangan`) VALUES
('AGT001', '123', 'Alvin', 'Padang', '1998-12-31', 'Laki-laki', 'Padang', 'Mahasiswa', 'Belum Menikah', '2020-01-07', 'Pending'),
('AGT002', '1234', 'Testing', 'Padang', '2020-12-31', 'Laki-laki', 'Padang', 'Ex. Mahasiswa', 'Belum Menikah', '2020-01-07', 'Pending');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_login`
--

CREATE TABLE `tbl_login` (
  `id` int(11) NOT NULL,
  `id_anggota` varchar(6) NOT NULL,
  `username` varchar(20) NOT NULL,
  `password` varchar(20) NOT NULL,
  `level` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tbl_login`
--

INSERT INTO `tbl_login` (`id`, `id_anggota`, `username`, `password`, `level`) VALUES
(1, '', 'sekretaris', 'sekretaris', 'sekretaris'),
(2, '', 'bendahara', 'bendahara', 'bendahara'),
(6, 'AGT001', '123', '123', 'anggota'),
(7, 'AGT002', '1234', '1234', 'anggota');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_pembayaran`
--

CREATE TABLE `tbl_pembayaran` (
  `id_angsuran` varchar(6) NOT NULL,
  `id_pinjaman` varchar(6) NOT NULL,
  `cicilan` int(11) NOT NULL,
  `jml_bayar` int(11) NOT NULL,
  `tgl_bayar` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tbl_pembayaran`
--

INSERT INTO `tbl_pembayaran` (`id_angsuran`, `id_pinjaman`, `cicilan`, `jml_bayar`, `tgl_bayar`) VALUES
('AGN001', 'PJN001', 1, 2200000, '2020-02-03');

--
-- Trigger `tbl_pembayaran`
--
DELIMITER $$
CREATE TRIGGER `ubah_pinjaman` AFTER INSERT ON `tbl_pembayaran` FOR EACH ROW BEGIN
UPDATE tbl_pinjaman SET jumlah_pinjaman = jumlah_pinjaman-NEW.jml_bayar WHERE id_pinjaman=NEW.id_pinjaman;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_pengambilan`
--

CREATE TABLE `tbl_pengambilan` (
  `id_pengambilan` varchar(6) NOT NULL,
  `tgl_pengambilan` date NOT NULL,
  `id_anggota` varchar(6) NOT NULL,
  `jumlah_pengambilan` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tbl_pengambilan`
--

INSERT INTO `tbl_pengambilan` (`id_pengambilan`, `tgl_pengambilan`, `id_anggota`, `jumlah_pengambilan`) VALUES
('PGN002', '2020-01-03', 'AGT002', 150000);

--
-- Trigger `tbl_pengambilan`
--
DELIMITER $$
CREATE TRIGGER `delete_saldo` AFTER DELETE ON `tbl_pengambilan` FOR EACH ROW BEGIN
UPDATE tbl_tabungan SET saldo = saldo+old.jumlah_pengambilan WHERE id_anggota=old.id_anggota;
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `kurang_saldo` AFTER INSERT ON `tbl_pengambilan` FOR EACH ROW BEGIN
UPDATE tbl_tabungan SET saldo = saldo-NEW.jumlah_pengambilan WHERE id_anggota=NEW.id_anggota;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_pinjaman`
--

CREATE TABLE `tbl_pinjaman` (
  `id_pinjaman` varchar(6) NOT NULL,
  `tgl_pinjaman` date NOT NULL,
  `id_anggota` varchar(6) NOT NULL,
  `bunga_perbulan` float NOT NULL,
  `lama_cicilan` int(11) NOT NULL,
  `jumlah_pinjaman` int(11) NOT NULL,
  `angsuran` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tbl_pinjaman`
--

INSERT INTO `tbl_pinjaman` (`id_pinjaman`, `tgl_pinjaman`, `id_anggota`, `bunga_perbulan`, `lama_cicilan`, `jumlah_pinjaman`, `angsuran`) VALUES
('PJN001', '2020-01-03', 'AGT002', 0.1, 12, 21800000, 2200000);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_simpanan`
--

CREATE TABLE `tbl_simpanan` (
  `id_simpanan` varchar(6) NOT NULL,
  `tgl_simpanan` date NOT NULL,
  `id_anggota` varchar(6) NOT NULL,
  `jenis_simpanan` varchar(20) NOT NULL,
  `jumlah_simpanan` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tbl_simpanan`
--

INSERT INTO `tbl_simpanan` (`id_simpanan`, `tgl_simpanan`, `id_anggota`, `jenis_simpanan`, `jumlah_simpanan`) VALUES
('SPN003', '2020-01-03', 'AGT002', 'Simpanan Wajib', 300000),
('SPN004', '2020-01-03', 'AGT002', 'Simpanan Pokok', 400000);

--
-- Trigger `tbl_simpanan`
--
DELIMITER $$
CREATE TRIGGER `hapus_saldo` AFTER DELETE ON `tbl_simpanan` FOR EACH ROW BEGIN
IF (old.jenis_simpanan = 'Simpanan Pokok') THEN
UPDATE tbl_tabungan SET saldo = saldo-old.jumlah_simpanan WHERE id_anggota=old.id_anggota;
ELSE
IF (old.jenis_simpanan = 'Simpanan Wajib') THEN
UPDATE tbl_tabungan SET saldo_wajib = saldo_wajib-old.jumlah_simpanan WHERE id_anggota=old.id_anggota;
END IF;
END IF;
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `tambah_saldo` AFTER INSERT ON `tbl_simpanan` FOR EACH ROW BEGIN
IF (NEW.jenis_simpanan = 'Simpanan Pokok') THEN
UPDATE tbl_tabungan SET saldo = saldo+NEW.jumlah_simpanan WHERE id_anggota=NEW.id_anggota;
ELSE
IF (NEW.jenis_simpanan = 'Simpanan Wajib') THEN
UPDATE tbl_tabungan SET saldo_wajib = saldo_wajib+NEW.jumlah_simpanan WHERE id_anggota=NEW.id_anggota;
END IF;
END IF;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_tabungan`
--

CREATE TABLE `tbl_tabungan` (
  `id_tabungan` varchar(6) NOT NULL,
  `id_anggota` varchar(6) NOT NULL,
  `saldo` int(11) NOT NULL,
  `saldo_wajib` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tbl_tabungan`
--

INSERT INTO `tbl_tabungan` (`id_tabungan`, `id_anggota`, `saldo`, `saldo_wajib`) VALUES
('TBN001', 'AGT001', 0, 0),
('TBN002', 'AGT002', 0, 0);

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `tbl_anggota`
--
ALTER TABLE `tbl_anggota`
  ADD PRIMARY KEY (`id_anggota`);

--
-- Indeks untuk tabel `tbl_login`
--
ALTER TABLE `tbl_login`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `tbl_pembayaran`
--
ALTER TABLE `tbl_pembayaran`
  ADD PRIMARY KEY (`id_angsuran`);

--
-- Indeks untuk tabel `tbl_pengambilan`
--
ALTER TABLE `tbl_pengambilan`
  ADD PRIMARY KEY (`id_pengambilan`);

--
-- Indeks untuk tabel `tbl_pinjaman`
--
ALTER TABLE `tbl_pinjaman`
  ADD PRIMARY KEY (`id_pinjaman`);

--
-- Indeks untuk tabel `tbl_simpanan`
--
ALTER TABLE `tbl_simpanan`
  ADD PRIMARY KEY (`id_simpanan`);

--
-- Indeks untuk tabel `tbl_tabungan`
--
ALTER TABLE `tbl_tabungan`
  ADD PRIMARY KEY (`id_tabungan`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `tbl_login`
--
ALTER TABLE `tbl_login`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
