-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th5 01, 2020 lúc 08:33 AM
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

DELIMITER $$
--
-- Thủ tục
--
CREATE DEFINER=`id13393536_root`@`localhost` PROCEDURE `sp_insert_news` (IN `title` VARCHAR(300) CHARSET utf8mb4, IN `link` VARCHAR(3000) CHARSET utf8mb4, IN `source` TINYTEXT CHARSET utf8mb4, IN `imgUri` VARCHAR(3000) CHARSET utf8mb4)  Begin
    Declare id tinyint(3);
    Set id = f_get_source_id(source);
    Insert into news (title, link, sourceId, imgUri) Value (title, link, id, imgUri);
End$$

CREATE DEFINER=`id13393536_root`@`localhost` PROCEDURE `sp_select_news` (`num_offset` SMALLINT, `num_limit` SMALLINT)  Begin
    Select title, link, source, imgUri From news_detail
        Order by id Desc Limit num_limit Offset num_offset;
End$$

--
-- Các hàm
--
CREATE DEFINER=`id13393536_root`@`localhost` FUNCTION `f_get_latest_title_news` () RETURNS VARCHAR(300) CHARSET utf8mb4 COLLATE utf8mb4_unicode_ci Begin
	Declare tt varchar(300);
    Set tt = (Select title From news_detail
        Where id = (Select MAX(id) From news_detail));
    Return tt;
End$$

CREATE DEFINER=`id13393536_root`@`localhost` FUNCTION `f_get_source_id` (`source` TINYTEXT) RETURNS TINYINT(3) Begin
    Declare id tinyint(3);

    Select n.id Into id From news_source as n
        Where n.source = source;

    If id IS NULL THEN
        Begin
            Insert into news_source (source) Value (source);
            Set id = (SELECT LAST_INSERT_ID());
        End;
    End if;

    return id;
End$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `hospital_hotlines`
--

CREATE TABLE `hospital_hotlines` (
  `id` tinyint(3) UNSIGNED NOT NULL,
  `name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone_number` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `news`
--

CREATE TABLE `news` (
  `id` smallint(5) UNSIGNED NOT NULL,
  `title` varchar(300) COLLATE utf8mb4_unicode_ci NOT NULL,
  `link` varchar(3000) COLLATE utf8mb4_unicode_ci NOT NULL,
  `sourceId` tinyint(3) UNSIGNED NOT NULL,
  `imgUri` varchar(3000) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc đóng vai cho view `news_detail`
-- (See below for the actual view)
--
CREATE TABLE `news_detail` (
`id` smallint(5) unsigned
,`title` varchar(300)
,`source` tinytext
,`link` varchar(3000)
,`imgUri` varchar(3000)
);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `news_source`
--

CREATE TABLE `news_source` (
  `id` tinyint(3) UNSIGNED NOT NULL,
  `source` tinytext COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `users`
--

CREATE TABLE `users` (
  `id` tinyint(3) UNSIGNED NOT NULL,
  `userName` varchar(25) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` tinytext COLLATE utf8mb4_unicode_ci NOT NULL,
  `level` tinyint(4) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `users`
--

INSERT INTO `users` (`id`, `userName`, `password`, `level`, `status`) VALUES
(1, 'admin', '$2y$10$gZfmlD/1e.dWoAnsHiJw1.5EuPBJgyXvg/5ze/WtZPSx.K30YvpOi', 1, 0);

-- --------------------------------------------------------

--
-- Cấu trúc cho view `news_detail`
--
DROP TABLE IF EXISTS `news_detail`;

CREATE ALGORITHM=UNDEFINED SQL SECURITY DEFINER VIEW `news_detail`  AS  select `n`.`id` AS `id`,`n`.`title` AS `title`,`s`.`source` AS `source`,`n`.`link` AS `link`,`n`.`imgUri` AS `imgUri` from (`news` `n` join `news_source` `s`) where (`n`.`sourceId` = `s`.`id`) ;

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `hospital_hotlines`
--
ALTER TABLE `hospital_hotlines`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `news`
--
ALTER TABLE `news`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sourceId` (`sourceId`);

--
-- Chỉ mục cho bảng `news_source`
--
ALTER TABLE `news_source`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `userName` (`userName`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `hospital_hotlines`
--
ALTER TABLE `hospital_hotlines`
  MODIFY `id` tinyint(3) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT cho bảng `news`
--
ALTER TABLE `news`
  MODIFY `id` smallint(5) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `news_source`
--
ALTER TABLE `news_source`
  MODIFY `id` tinyint(3) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `users`
--
ALTER TABLE `users`
  MODIFY `id` tinyint(3) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Các ràng buộc cho các bảng đã đổ
--

--
-- Các ràng buộc cho bảng `news`
--
ALTER TABLE `news`
  ADD CONSTRAINT `news_ibfk_1` FOREIGN KEY (`sourceId`) REFERENCES `news_source` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
