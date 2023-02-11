-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 20 Jan 2023 pada 10.56
-- Versi server: 10.4.22-MariaDB
-- Versi PHP: 8.1.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_kasir`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `cart`
--

CREATE TABLE `cart` (
  `idcart` int(11) NOT NULL,
  `invoice` varchar(100) NOT NULL,
  `kode_produk` varchar(100) NOT NULL,
  `nama_produk` varchar(100) NOT NULL,
  `harga` int(11) NOT NULL,
  `harga_modal` int(11) NOT NULL,
  `qty` int(11) NOT NULL,
  `subtotal` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Trigger `cart`
--
DELIMITER $$
CREATE TRIGGER `kurang_stok` AFTER INSERT ON `cart` FOR EACH ROW BEGIN
UPDATE produk set stok = stok - NEW.qty
WHERE kode_produk = NEW.kode_produk;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Struktur dari tabel `inv`
--

CREATE TABLE `inv` (
  `invid` int(11) NOT NULL,
  `invoice` varchar(100) NOT NULL,
  `tgl_inv` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `pembayaran` int(11) NOT NULL,
  `kembalian` int(11) NOT NULL,
  `status` varchar(10) NOT NULL,
  `nama_kasir` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `inv`
--

INSERT INTO `inv` (`invid`, `invoice`, `tgl_inv`, `pembayaran`, `kembalian`, `status`, `nama_kasir`) VALUES
(62, 'AD612393855', '2023-01-06 02:38:12', 0, 0, 'proses', 'putra'),
(63, 'AD612393886', '2023-01-06 02:38:48', 0, 0, 'proses', 'putra'),
(70, 'AD6123145189', '2023-01-06 07:51:04', 0, 0, 'proses', 'fauzan'),
(73, 'AD6123150089', '2023-01-06 08:00:46', 0, 0, 'proses', 'admin1'),
(75, 'AD8123200152', '2023-01-08 13:01:49', 0, 0, 'proses', 'fauzan'),
(76, 'AD912341202', '2023-01-08 21:12:13', 130000, 10000, 'selesai', 'ayusetia'),
(77, 'AD912372821', '2023-01-09 00:29:13', 215000, 3000, 'selesai', 'putra'),
(78, 'AD912373483', '2023-01-09 00:38:05', 50000, 4000, 'selesai', 'fauzanakbar');

-- --------------------------------------------------------

--
-- Struktur dari tabel `kasir`
--

CREATE TABLE `kasir` (
  `id_kasir` int(11) NOT NULL,
  `nama_kasir` varchar(100) NOT NULL,
  `password` int(4) NOT NULL,
  `tgl_regis` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `kasir`
--

INSERT INTO `kasir` (`id_kasir`, `nama_kasir`, `password`, `tgl_regis`) VALUES
(6, 'fauzanakbar', 5682, '2023-01-08 18:06:04'),
(9, 'raylatoriq', 2673, '2023-01-08 18:05:43'),
(11, 'putrasetyo', 1853, '2023-01-08 18:14:53');

-- --------------------------------------------------------

--
-- Struktur dari tabel `kategori`
--

CREATE TABLE `kategori` (
  `id_kategori` int(4) NOT NULL,
  `nama_kategori` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `kategori`
--

INSERT INTO `kategori` (`id_kategori`, `nama_kategori`) VALUES
(1, 'makanan'),
(3, 'Obat-obatan'),
(4, 'ATK'),
(5, 'Elektronik'),
(6, 'Olahraga');

-- --------------------------------------------------------

--
-- Struktur dari tabel `laporan`
--

CREATE TABLE `laporan` (
  `idlaporan` int(11) NOT NULL,
  `invoice` varchar(100) NOT NULL,
  `kode_produk` varchar(100) NOT NULL,
  `nama_produk` varchar(100) NOT NULL,
  `harga` int(11) NOT NULL,
  `harga_modal` int(11) NOT NULL,
  `qty` int(11) NOT NULL,
  `subtotal` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `laporan`
--

INSERT INTO `laporan` (`idlaporan`, `invoice`, `kode_produk`, `nama_produk`, `harga`, `harga_modal`, `qty`, `subtotal`) VALUES
(85, 'AD912341202', '8126578165319', 'Tango Hitam', 40000, 30000, 3, 120000),
(86, 'AD912372821', '8992753101207', 'Susu Kaleng Frisian Flag', 6000, 3000, 2, 12000),
(87, 'AD912372821', '8126578165319', 'Tango Hitam', 40000, 30000, 5, 200000),
(89, 'AD912373483', '8992753101207', 'Susu Kaleng Frisian Flag', 6000, 3000, 1, 6000),
(90, 'AD912373483', '8126578165319', 'Tango Hitam', 40000, 30000, 1, 40000);

-- --------------------------------------------------------

--
-- Struktur dari tabel `login`
--

CREATE TABLE `login` (
  `userid` int(11) NOT NULL,
  `username` varchar(30) NOT NULL,
  `password` varchar(255) NOT NULL,
  `toko` varchar(50) NOT NULL DEFAULT 'Business Center SMKN 12',
  `alamat` text NOT NULL DEFAULT 'Jalan Kebon Bawang XV',
  `telepon` varchar(15) NOT NULL,
  `logo` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `login`
--

INSERT INTO `login` (`userid`, `username`, `password`, `toko`, `alamat`, `telepon`, `logo`) VALUES
(12, 'ayusetia', '$2y$10$R3h15li2o62HhTnTwniatO42w3d8fS3z2TmePB/oxApK1wIepuVOe', 'Business Center SMKN 12', 'Jalan Kebon Bawang XV', '085810898899', ''),
(13, 'sumarti', '$2y$10$iwWhWq6KWKJ4IpNDg.DEK.w595RAQvCdaiVOBC.Owt0XSdPk59ZMe', 'Business Center SMKN 12', 'Jalan Kebon Bawang XV', '085810898899', ''),
(14, 'sukmawati', '$2y$10$AO7ilI7vcvDKh5yDKPidPuRBLXLExNBbV3J3yqgMuloxbtgQZ3Xf2', 'Business Center SMKN 12', 'Jalan Kebon Bawang XV', '085810898899', ''),
(15, 'kurniati', '$2y$10$GraZ0ACFjXa7AKPM30JWoOtCYVNaKgYrkWBarV8/brnUB0D6H2YJq', 'Business Center SMKN 12', 'Jalan Kebon Bawang XV', '085810898899', ''),
(16, 'nurhaida', '$2y$10$iyVRmTnuoMoB1UaM51HuU.XGwnir3a.eNNbKF.SqzcccHh.ZTaeRS', 'Business Center SMKN 12', 'Jalan Kebon Bawang XV', '085810898899', ''),
(17, 'syahbinawati', '$2y$10$7UaitlMjC6EFyJ8rrJlxsuq8aoq4.pyuaHI/5Iwdo1P6ChzehLJ4O', 'Business Center SMKN 12', 'Jalan Kebon Bawang XV', '085810898899', ''),
(18, 'ahmadbasa', '$2y$10$yZEoOL5gDeND39UjKR9vF.4hWYoPdN.aih8zsy1.GaFpm1OTVaQoq', 'Business Center SMKN 12', 'Jalan Kebon Bawang XV', '085810898899', ''),
(20, 'putra', '$2y$10$rL9QVBgeli9/7pjUpG.9B.m57fj.KFOrsgkg7elxmKn8CkZpBDRty', 'Business Center SMKN 12', 'Jalan Kebon Bawang XV', '085810894998', '');

-- --------------------------------------------------------

--
-- Struktur dari tabel `produk`
--

CREATE TABLE `produk` (
  `idproduk` int(11) NOT NULL,
  `kode_produk` varchar(100) NOT NULL,
  `nama_produk` varchar(255) NOT NULL,
  `id_kategori` int(4) NOT NULL,
  `harga_modal` int(11) NOT NULL,
  `harga_jual` int(11) NOT NULL,
  `tgl_input` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `stok` int(11) NOT NULL,
  `berat` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `produk`
--

INSERT INTO `produk` (`idproduk`, `kode_produk`, `nama_produk`, `id_kategori`, `harga_modal`, `harga_jual`, `tgl_input`, `stok`, `berat`) VALUES
(17, '8992753101207', 'Susu Kaleng Frisian Flag', 1, 3000, 6000, '2023-01-09 00:34:13', 18, '80 ml'),
(18, '8126578165319', 'Tango Hitam', 1, 30000, 40000, '2023-01-09 00:34:49', 41, '500 gr');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`idcart`);

--
-- Indeks untuk tabel `inv`
--
ALTER TABLE `inv`
  ADD PRIMARY KEY (`invid`);

--
-- Indeks untuk tabel `kasir`
--
ALTER TABLE `kasir`
  ADD PRIMARY KEY (`id_kasir`);

--
-- Indeks untuk tabel `kategori`
--
ALTER TABLE `kategori`
  ADD PRIMARY KEY (`id_kategori`),
  ADD KEY `kategori_ind` (`id_kategori`);

--
-- Indeks untuk tabel `laporan`
--
ALTER TABLE `laporan`
  ADD PRIMARY KEY (`idlaporan`);

--
-- Indeks untuk tabel `login`
--
ALTER TABLE `login`
  ADD PRIMARY KEY (`userid`);

--
-- Indeks untuk tabel `produk`
--
ALTER TABLE `produk`
  ADD PRIMARY KEY (`idproduk`),
  ADD KEY `id_kategori` (`id_kategori`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `cart`
--
ALTER TABLE `cart`
  MODIFY `idcart` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=118;

--
-- AUTO_INCREMENT untuk tabel `inv`
--
ALTER TABLE `inv`
  MODIFY `invid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=79;

--
-- AUTO_INCREMENT untuk tabel `kasir`
--
ALTER TABLE `kasir`
  MODIFY `id_kasir` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT untuk tabel `kategori`
--
ALTER TABLE `kategori`
  MODIFY `id_kategori` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT untuk tabel `laporan`
--
ALTER TABLE `laporan`
  MODIFY `idlaporan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=91;

--
-- AUTO_INCREMENT untuk tabel `login`
--
ALTER TABLE `login`
  MODIFY `userid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT untuk tabel `produk`
--
ALTER TABLE `produk`
  MODIFY `idproduk` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `produk`
--
ALTER TABLE `produk`
  ADD CONSTRAINT `produk_ibfk_1` FOREIGN KEY (`id_kategori`) REFERENCES `kategori` (`id_kategori`) ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
