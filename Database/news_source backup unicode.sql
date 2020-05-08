-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th5 07, 2020 lúc 09:13 PM
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

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `news_source`
--

CREATE TABLE `news_source` (
  `id` tinyint(3) UNSIGNED NOT NULL,
  `source` tinytext COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `news_source`
--

INSERT INTO `news_source` (`id`, `source`) VALUES
(1, 'Tuá»i Tráº» Online'),
(2, 'BÃ¡o Thanh NiÃªn'),
(3, 'Tuổi Trẻ Online'),
(4, 'BÃ¡o Kinh Táº¿ ÄÃŽ Thá»'),
(5, 'Game - Báo Thanh Niên'),
(6, 'VietNamNet'),
(7, 'Báo Thanh Niên'),
(8, 'RFI'),
(9, 'BÃ¡o TGVN'),
(10, 'KÃªnh 14'),
(11, 'Dân Trí'),
(12, 'BÃ¡o Thá» thao & VÄn hÃ³a Mobile'),
(13, 'BBC Tiáº¿ng Viá»t'),
(14, 'DÃ¢n TrÃ­'),
(15, 'CafeBiz.vn'),
(16, 'LuatVietNam'),
(17, 'Cafef.vn'),
(18, 'Tia Sáng'),
(19, 'BÃ¡o Gia ÄÃ¬nh & XÃ£ há»i'),
(20, 'VOA Tiếng Việt'),
(21, 'TheLEADER'),
(22, 'Báo TGVN'),
(23, 'VnExpress Đời sống'),
(24, 'Báo T? i nguyên & Môi trường'),
(25, 'BNA'),
(26, 'BÃ¡o Äiá»n tá»­ CÃŽng ThÆ°Æ¡ng'),
(27, 'Xe - Báo Thanh Niên'),
(28, 'Báo Đấu thầu'),
(29, 'Đ? i Tiếng Nói Việt Nam'),
(30, 'ÄÃ i Tiáº¿ng NÃ³i Viá»t Nam'),
(31, 'NDH'),
(32, 'VOA Tiáº¿ng Viá»t'),
(33, 'Thời báo T? i chính Việt Nam'),
(34, 'Báo điện tử Quân đội nhân dân');

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `news_source`
--
ALTER TABLE `news_source`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `news_source`
--
ALTER TABLE `news_source`
  MODIFY `id` tinyint(3) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
