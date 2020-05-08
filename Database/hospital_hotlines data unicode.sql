-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th5 05, 2020 lúc 09:22 AM
-- Phiên bản máy phục vụ: 10.1.38-MariaDB
-- Phiên bản PHP: 7.3.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `cnpm_coronavirus`
--

--
-- Đang đổ dữ liệu cho bảng `hospital_hotlines`
--

INSERT INTO `hospital_hotlines` (`id`, `name`, `phone_number`) VALUES
(1, 'Bệnh viện Bạch Mai', '0969.851.616'),
(2, 'Bệnh viện Nhiệt đới Trung ương', '0969.241.616'),
(3, 'Bệnh viện E', '0912.168.887'),
(4, 'Bệnh viện Nhi trung ương', '0372.884.712'),
(5, 'Bệnh viện Phổi trung ương', '0967.941.616'),
(6, 'Bệnh viện Việt Nam – Thụy Điển Uông Bí', '0966.681.313'),
(7, 'Bệnh viện Đa khoa trung ương Thái Nguyên', '0913.394.495'),
(8, 'Bệnh viện Trung ương Huế', '0965.301.212'),
(9, 'Bệnh viện Chợ Rẫy', '0969.871.010'),
(10, 'Bệnh viện Đa khoa trung ương Cần Thơ', '0907.736.736'),
(11, 'Bệnh viện Xanh Pôn Hà Nội', '0904.138.502'),
(12, 'Bệnh viện Vinmec Hà Nội', '0934.472.768'),
(13, 'Bệnh viện Đà Nẵng', '0903.583.881'),
(14, 'Bệnh viện Nhiệt đới TP.HCM', '0967.341.010 ');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
